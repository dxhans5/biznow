<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index() {
      if (Auth::check()) {
        return view('users');
      }

      return redirect()->route('login');
    }
}
