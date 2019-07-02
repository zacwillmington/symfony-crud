<?php
namespace App\Controller;

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
        // return new Response('<html><body>Hello</body></html>');
        return $this->render('articles/index.html.twig');

    }
}