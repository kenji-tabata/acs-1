<?php

require_once dirname(__FILE__) . '/../../vendor/autoload.php';
require_once dirname(__FILE__) . '/../app.php';

class RequisicoesTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp() {
        $this->client = new GuzzleHttp\Client(['base_uri' => 'localhost/acs/src/']);
        $_SESSION['auth'] = "1234";
    }

    public function testIndex() {
        $response = $this->client->request('GET');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testFoo() {
        // $response = $this->client->request('GET', 'python/');
        // $this->assertEquals(200, $response->getStatusCode());

        // $response = $this->client->request('GET', 'python/built-in/');
        // $this->assertEquals(200, $response->getStatusCode());

        // $response = $this->client->request('GET', 'php/');
        // $this->assertEquals(200, $response->getStatusCode());
    }
}
?>