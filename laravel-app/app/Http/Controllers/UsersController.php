<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class UsersController extends Controller
{
    /**
    * Show Users table
    */
    public function index() {
      if (Auth::check()) {
        return view('users');
      }

      return redirect()->route('login');
    }

    /**
    * Fetch users from Api
    */
    public function getUsers() {
      $url = 'https://reqres.in/api/users?per_page=100';
      $client = new Client();
      $res = $client->get($url);

      return $res->getBody();
    }

    /**
    * Fetch users from Api
    */
    public function addUser(Request $request) {
      $validatedData = $request->validate([
         'fullName' => 'required',
         'job' => 'required',
     ]);

      try {
        $url = 'https://reqres.in/api/users';
        $client = new Client();
        $res = $client->post($url, [RequestOptions::JSON => [
          'name' => $request->get('fullName'),
          'job' => $request->get('job')
        ]]);
        return $res->getBody();
     } catch (\Exception $e) {
         return $e->getResponse()->getBody(true);
     }
    }
}
