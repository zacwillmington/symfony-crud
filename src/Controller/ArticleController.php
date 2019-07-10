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
        
        $articles = ['Article one', 'Article Two', 'Article three'];

        return $this->render('articles/index.html.twig', array("articles" => $articles));
    }

      /**
     * @Route("/article/save")
     */

     public function save() {
         $entityManager = $this->getDoctrine()->getManager();

         $article = new Article();
         $article->setTitle('Article One');
         $article->setBody('This is the body');

         $entityManager->persist($article);

         $entityManager->flush();

         return new Response("Saved and Article with the id of ".$article->getId());
     }


}