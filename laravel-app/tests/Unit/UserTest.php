<?php

namespace Tests\Unit;

use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A successful API user fetch
     *
     * @return void
     */
    public function testSuccessfulAPIUserFetch()
    {
        $url = 'https://reqres.in/api/users';
        $client = new Client();
        $res = $client->get($url);
        $this->assertTrue($res->getStatusCode() === 200); // 200
        $this->assertJson($res->getBody());
    }

    /**
     * A successful API user add
     *
     * @return void
     */
    public function testSuccessfulAPIUserAdd()
    {
        $user = new \stdClass();
        $user->name = 'Candle Man';
        $user->job = 'Candlemaker';
        $user->email = 'testing@test.com';
        $user->password = '1234567890';

        $url = 'https://reqres.in/api/add';
        $client = new Client();
        $res = $client->post($url, [RequestOptions::JSON => ['name' => $user->name, 'job' => $user->job]]);
        $this->assertTrue($res->getStatusCode() === 201); // 201
        $this->assertJson($res->getBody());
    }

    /**
     * A successful user fetch
     *
     * @return void
     */
    public function testSuccessfulUserFetch()
    {
      $res = $this->call('GET', '/get-users');
      $this->assertTrue($res->getStatusCode() === 200);
      $this->assertTrue(array_key_exists('data', json_decode($res->getContent(), true)));
      $this->assertNotEmpty(json_decode($res->getContent(), true)['data']);
    }

    /**
     * A successful user add
     *
     * @return void
     */
    public function testSuccessfulUserAdd()
    {

        Session::start();

        $user = array(
            'fullName' => 'Candle Man',
            'job' => 'Candlemaker',
            '_token' => csrf_token()
        );

        $res = $this->call('POST', '/add-user', $user);
        $this->assertTrue($res->getStatusCode() === 200);
        $this->assertTrue(array_key_exists('id', json_decode($res->getContent(), true)));
        $this->assertNotEmpty(json_decode($res->getContent(), true));
    }
}
