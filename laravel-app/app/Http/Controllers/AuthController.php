<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class AuthController extends Controller {
    /**
     * Show the application login
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login()
    {
        return view('auth/login');
    }

    /**
     * Authenticate user
     */
    public function authenticate(Request $request) {
        $validatedData = $request->validate([
           'email' => 'required',
           'password' => 'required',
       ]);
       
       try {
         $url = 'https://reqres.in/api/login';
         $client = new Client();
         $res = $client->post($url, [RequestOptions::JSON => ['email' => $request->get('email'), 'password' => $request->get('password')]]);
         return $res->getBody();
      } catch (\Exception $e) {
          return $e->getResponse()->getBody(true);
      }
    }
}
