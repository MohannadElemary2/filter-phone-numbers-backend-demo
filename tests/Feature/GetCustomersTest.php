<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetCustomersTest extends TestCase
{
    const ROUTE = 'customer.index';

    public $mockConsoleOutput = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareDatabase();
    }

    /**
     * @test
     */
    public function will_get_customers_successfully()
    {
        $response = $this->json('GET', route(self::ROUTE));

        $response->assertStatus(Response::HTTP_OK);

        $this->assertArrayHasKey('data', $response->json());
        $this->assertArrayHasKey('id', $response->json()['data'][0]);

        $this->assertArrayHasKey('meta', $response->json());

        $this->assertEquals($response->json()['meta']['total'], Customer::count());
    }

    /**
     * @test
     */
    public function will_get_customers_successfully_with_valid_filter()
    {
        $response = $this->json('GET', route(self::ROUTE), ['valid' => 1]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertArrayHasKey('data', $response->json());
        $this->assertArrayHasKey('id', $response->json()['data'][0]);

        $this->assertArrayHasKey('meta', $response->json());

        $this->assertEquals($response->json()['meta']['total'], 27);
    }

    /**
     * @test
     */
    public function will_get_customers_successfully_with_country_filter()
    {
        $response = $this->json('GET', route(self::ROUTE), ['country' => 212]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertArrayHasKey('data', $response->json());
        $this->assertArrayHasKey('id', $response->json()['data'][0]);

        $this->assertArrayHasKey('meta', $response->json());

        $this->assertEquals($response->json()['meta']['total'], 7);
    }

    /**
     * @test
     */
    public function will_get_customers_successfully_with_valid_and_country_filter()
    {
        $response = $this->json(
            'GET',
            route(self::ROUTE),
            ['country' => 212, 'valid' => 1]
        );

        $response->assertStatus(Response::HTTP_OK);

        $this->assertArrayHasKey('data', $response->json());
        $this->assertArrayHasKey('id', $response->json()['data'][0]);

        $this->assertArrayHasKey('meta', $response->json());

        $this->assertEquals($response->json()['meta']['total'], 4);
    }
}
