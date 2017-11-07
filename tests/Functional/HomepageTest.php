<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that the index route
     */
    public function testGetHomepage()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Greenter APP', (string)$response->getBody());
        $this->assertNotContains('Hello', (string)$response->getBody());
    }

    /**
     * Test that the swagger route
     */
    public function testGetSwagger()
    {
        $response = $this->runApp('GET', '/swagger');

        $this->assertEquals(200, $response->getStatusCode());
        $obj = json_decode((string)$response->getBody());

        $this->assertTrue(is_object($obj));
        $this->assertEquals('2.0', $obj->swagger);
        $this->assertNotEmpty($obj->host);
        $this->assertTrue(isset($obj->basePath));
        $this->assertTrue(isset($obj->schemes));
        $this->assertTrue(isset($obj->paths));
        $this->assertTrue(isset($obj->definitions));
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed()
    {
        $response = $this->runApp('POST', '/', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}