<?php

namespace Tests\Unit;

use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * A successful API authentication
     *
     * @return void
     */
    public function testSuccessfulAPIAuthConnection()
    {
        $url = 'https://reqres.in/api/login';
        $client = new Client();
        $res = $client->post($url, [RequestOptions::JSON => ['email' => 'eve.holt@reqres.in', 'password' => 'cityslicka']]);
        $this->assertTrue($res->getStatusCode() === 200); // 200
        $this->assertJson($res->getBody());
    }

    /**
     * A successful login form submission
     *
     * @return void
     */
    public function testSuccessfulLoginFormSubmission()
    {

      Session::start();

      $credentials = array(
          'email' => 'eve.holt@reqres.in',
          'password' => 'cityslicka',
          '_token' => csrf_token()
      );

      $res = $this->call('POST', '/login', $credentials);
      $this->assertTrue($res->getStatusCode() === 200);
      $res->assertJson([
                'token' => true,
            ]);
    }

    /**
     * A login form submission with missing fields
     *
     * @return void
     */
    public function testUnsuccessfulLoginFormSubmissionWithMissingData()
    {

      Session::start();

      $credentials = array(
          'email' => 'test@tester.com',
          '_token' => csrf_token()
      );

      $res = $this->call('POST', '/login', $credentials);
      $this->assertFalse($res->getStatusCode() === 200);
    }

    /**
     * A login form submission user not found
     *
     * @return void
     */
    public function testUserNotFound()
    {

      Session::start();

      $credentials = array(
          'email' => 'test@tester.com',
          'password' => 'password',
          '_token' => csrf_token()
      );

      $res = $this->call('POST', '/login', $credentials);
      $this->assertTrue($res->getStatusCode() === 200);
      $res->assertJson([
          'error' => 'user not found'
        ]);
    }
}
