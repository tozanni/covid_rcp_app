<?php

namespace App\Tests;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface as TransportException;

/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 26/07/20 Time: 4:27
 */
class ApiAvailabilityFunctionalTest extends ApiTestCase
{
    /**
     * @dataProvider urlProvider
     * @param $url
     * @throws TransportException
     */
    public function testEndPointIsSuccessful($url)
    {
        $response = $this->client->request('GET', $url);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function urlProvider()
    {
        yield ['/api/v1/blood_chemistry'];
        yield ['/api/v1/clotting_time'];
        yield ['/api/v1/hematic_biometry'];
        yield ['/api/v1/imagin'];
        yield ['/api/v1/immunological'];
        yield ['/api/v1/liver_function'];
        yield ['/api/v1/medical_notes'];
        yield ['/api/v1/serum_electrolytes'];
        yield ['/api/v1/triage'];
        yield ['/api/v1/records'];
        yield ['/api/v1/vital_signs'];
    }
}