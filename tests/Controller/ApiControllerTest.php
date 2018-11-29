<?php

namespace App\Tests\Controller;

use App\Controller\ApiController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ApiControllerTest extends TestCase
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    protected function setUp()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'http://127.0.0.1:8000/api/'
        ]);
    }

    /**
     * @test
     */
    public function firstAction()
    {
        $controller = new ApiController();
        $request = $this->createMock(Request::class);

        $result = $controller->firstAction($request);

        $this->assertArrayHasKey('message', $result->getData());
        $this->assertSame([
            'message' => 'hello get'
        ], $result->getData());
    }

    /**
     * @test
     */
    public function firstActionFunctionalTest()
    {
        $response = $this->client->get('first');
        $data = json_decode($response->getBody(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertSame([
            'message' => 'hello get'
        ], $data);
    }
}