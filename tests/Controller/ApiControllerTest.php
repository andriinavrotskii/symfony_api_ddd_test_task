<?php

namespace App\Tests\Controller;

use App\Controller\ApiController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ApiControllerTest extends TestCase
{
    /**
     * @test
     */
    public function firstAction()
    {
        $controller = new ApiController();
        $request = $this->createMock(Request::class);

        $result = $controller->firstAction($request);

        var_dump($result->getData());

        $this->assertTrue(true);
    }
}