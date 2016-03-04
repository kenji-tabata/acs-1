<?php

require_once dirname(__FILE__) . '/../../vendor/autoload.php';
require_once dirname(__FILE__) . '/../app.php';

class RequisicoesTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp() {
        $this->client = new GuzzleHttp\Client(['base_uri' => 'http://localhost/acs/src']);
        // $_SESSION['auth'] = "1234";
    }

    public function testIndex() {
        $response = $this->client->request('GET');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPoms() {
        $response = $this->client->request('GET', 'poms/');
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->client->request('GET', 'poms/q={"nome": "Maicon Alves Martinez"}');
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->client->request('GET', 'poms/14');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
?>