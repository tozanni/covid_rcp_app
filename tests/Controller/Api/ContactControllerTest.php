<?php

namespace App\Tests\Controller\Api;

use App\Tests\ApiTestCase;

/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 25/07/20 Time: 23:46
 */
class ContactControllerTest extends ApiTestCase
{
    /**
    public function testPOST()
    {
        $data = [
            'name' => $this->faker->name,
            'subject' => $this->faker->sentence,
            'email' => $this->faker->email,
            'message' => $this->faker->paragraph,
        ];

        $response = $this->client->request('POST', '/api/v1/contacts', [
            'body' => json_encode($data),
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertContains($data['email'], $response->getContent());
    }*/
}