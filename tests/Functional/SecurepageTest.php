<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 10/11/2017
 * Time: 11:43 AM
 */

namespace Tests\Functional;

/**
 * Class SecurepageTest
 * @package Tests\Functional
 */
class SecurepageTest extends BaseTestCase
{
    public function testGetLoginNotAllowed()
    {
        $response = $this->runApp('GET', '/api/v1/login');

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }

    public function testGetRegisterNotAllowed()
    {
        $response = $this->runApp('GET', '/api/v1/register');

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}