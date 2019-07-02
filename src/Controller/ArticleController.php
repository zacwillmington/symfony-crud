<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; // This(Annotations) means that you can define the routes in this file. There is no need to add the routes to the routing.ymal file.

class ArticleController {

    /**
     * @Route("/", name="Home")
     */

    public function index() {
        return new Response('<html><body>Hello</body></html>');
    }
}