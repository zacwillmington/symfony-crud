<?php
namespace App\Controller;

use App\Entity\Author;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route; // This(Annotations) means that you can define the routes in this file. There is no need to add the routes to the routing.ymal file.
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; //Adds @method type to route line 12  
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AuthorController extends Controller {

    /**
     * @Route("/authors", name="Author")
     * @Method({"GET"})
     */

    public function index() {

        $authors = $this->getDoctrine()->getRepository(Author::class)->findAll();

        return $this->render('authors/index.html.twig', array("authors" => $authors));
    }

     /**
     * @Route("/author/new", name="new_author")
     * @Method({"GET", "POST"})
     */

     public function new(Request $request) {
        $author = new Author;
        $form = $this->createFormBuilder($author)->add('name', 
            TextType::class,
            array('required' => true, 
            'attr' => array('class', 'form-control'))
        )->add('save', 
            SubmitType::class,
            array('label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            )
        )->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($author);
            $entityManager->flush();

            return $this->redirectToRoute('Home');
        }

        return $this->render('authors/new.html.twig', array('form' => $form->createView()));
     }

      /**
     * @Route("/author/edit/{id}", name="edit_author")
     * @Method({"GET", "POST"})
     */

    public function edit(Request $request, $id, LoggerInterface $logger) {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        // $this->log( level: Logger::EMERGENCY, message: 'emg mss');

        $logger->info("error");
        $form = $this->createFormBuilder($author)->add('name', 
            TextType::class, 
            array('attr' => array('class' => 'form-control'))
        )->add('name', 
            TextareaType::class,
            array('required' => false, 
            'attr' => array('class', 'form-control'))
        )->add('save', 
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

        return $this->render('authors/edit.html.twig', array('form' => $form->createView()));
     }

      /**
     * @Route("/author/{id}", name="author_show")
     */

    public function show($id) {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        return $this->render('authors/show.html.twig', array("author" => $author));
     }


    /**
     * @Route("/author/save")
     */

     public function save() {
         $entityManager = $this->getDoctrine()->getManager();

         $author = new Author();
         $author->setName('Author Two');
    
         $entityManager->persist($author);

         $entityManager->flush();

         return new Response("Saved and Author with the id of ".$author->getId());
     }

      /**
     * @Route("/author/delete/{id}", name="delete_author")
     * @Method({"DELETE"})
     */

     public function delete(Request $request, $id) {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);
        print_r($author);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($author);
        $entityManager->flush();

        $response = new Response();
        return $response->send();

     }

}