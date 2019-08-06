<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
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
      $url = 'https://reqres.in/api/users';
      $client = new Client();
      $res = $client->get($url);

      return $res->getBody();
    }
}
