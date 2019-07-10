<?php
namespace App\Controller;

use App\Entity\Article;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; // This(Annotations) means that you can define the routes in this file. There is no need to add the routes to the routing.ymal file.
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; //Adds @method type to route line 12  
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller {

    /**
     * @Route("/", name="Home")
     * @Method({"GET"})
     */

    public function index() {

        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('articles/index.html.twig', array("articles" => $articles));
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */

     public function show($id) {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render('articles/show.html.twig', array("article" => $article));
     }


    /**
     * @Route("/article/save")
     */

     public function save() {
         $entityManager = $this->getDoctrine()->getManager();

         $article = new Article();
         $article->setTitle('Article Two');
         $article->setBody('This is the body');

         $entityManager->persist($article);

         $entityManager->flush();

         return new Response("Saved and Article with the id of ".$article->getId());
     }


}