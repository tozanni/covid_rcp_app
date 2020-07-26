<?php

namespace App\Tests;

use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\HttpClient;

/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 26/07/20 Time: 1:36
 */
class ApiTestCase extends WebTestCase
{
    protected $client;
    protected $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create('es_MX');
        $this->client = HttpClient::create([
            'resolve' => ['covid_app.test' => '127.0.0.1'],
            'base_uri' => 'https://covid_app.test',
            'verify_peer' => false,
        ]);
    }
}