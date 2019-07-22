<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Article;
use App\Entity\Author;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route; // This(Annotations) means that you can define the routes in this file. There is no need to add the routes to the routing.ymal file.

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Psr\Log\LoggerInterface;

class ArticleController extends AbstractController {

    /**
     * @Route("/", name="Home")
     */

    public function index(LoggerInterface $logger) {
            $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('articles/index.html.twig', array("articles" => $articles));
    }

     /**
     * @Route("/article/new", name="new_article")
     */

     public function new(Request $request) {
      
        $article = new Article;

        $logger->debug('Blank article', [$article]);
        $form = $this->createFormBuilder($article)->add('title', 
            TextType::class, 
            array('attr' => array('class' => 'form-control'))
        )->add('Author', EntityType::class, [
              'class' => Author::class,
               'choice_label' => 'name'
        ])->add('body', 
            TextareaType::class,
            array('required' => false, 
            'attr' => array('class', 'form-control'))
        )->add('save', 
            SubmitType::class,
            array('label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            )
        )->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $logger->debug('article', [$article]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->render('articles/show.html.twig', array('article' => $article));
        }

        return $this->render('articles/new.html.twig', array('form' => $form->createView()));
     }

      /**
     * @Route("/article/edit/{id}", name="edit_article")
     */

    public function edit(Request $request, $id) {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        
        $form = $this->createFormBuilder($article)->add('title', 
            TextType::class, 
            array('attr' => array('class' => 'form-control'))
        )->add('body', 
            TextareaType::class,
            array('required' => false, 
            'attr' => array('class', 'form-control'))
        )->add('Author', EntityType::class, [
            'class' => Author::class,
             'choice_label' => 'name'
        ])->add('save', 
            SubmitType::class,
            array('label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            )
        )->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('Home');
        }

        return $this->render('articles/edit.html.twig', array('form' => $form->createView()));
     }

      /**
     * @Route("/article/{id}", name="article_show")
     */

    public function show($id) {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('articles/show.html.twig', array("article" => $article));
     }


    //  Delete this controller
    /**
     * @Route("/article/save")
     */

      /**
     * @Route("/article/delete/{id}", name="delete_article")
     */

     public function delete(Request $request, $id, LoggerInterface $logger) {
        $logger->debug('test');
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        $response = new Response();
        return $response->send();

     }

}

?>