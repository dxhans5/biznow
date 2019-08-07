<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    * Logout user
    **/
    public function logout() {
      Auth::logout();
      return redirect('/login');
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
         $res = $client->post($url, [RequestOptions::JSON => [
           'email' => $request->get('email'),
           'password' => $request->get('password')
        ]]);

         // It appears that reqres provides a token for a user for any password
         // provided. I would have provided an authentication check here had
         // they been able to provide me a "password incorrect" message
         $user = User::where('email', $request->get('email'))->first();
         Auth::login($user);

         return $res->getBody();
      } catch (\Exception $e) {
          return $e->getResponse()->getBody(true);
      }
    }
}
