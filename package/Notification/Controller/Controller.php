<?php

declare(strict_types=1);

namespace Notification\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    /**
    * @Route("/")
    */
   public function index()
   {
       return new Response(
            '<html><body>Hello World!</body></html>'
        );
   }
}
