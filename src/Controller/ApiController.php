<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends FOSRestController
{

    /**
     * @Rest\Get("/first")
     * @param Request $request
     * @return View
     */
    public function firstAction(Request $request)
    {
        return View::create([
            'message' => 'hello get'
        ], Response::HTTP_OK);
    }
}