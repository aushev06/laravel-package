<?php

namespace Tests\Feature;

use GussiApi\GussiApiClient;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase;

class GussiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $model  = new GussiApiClient();

        $data = $model->login('aushevibra@yandex.ru', '11111111', 'mobile')->getData();
        $this->assertTrue($data->success);
        $token = $data->token;
        $this->assertIsString($token);

        $foodData = $model->foods($token)->getData();
        $this->assertTrue($foodData->success);

    }
}
