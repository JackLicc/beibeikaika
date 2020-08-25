<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends BaseController
{

    public function login() {
        return view('user/login');
    }

    public function register() {
        return view('user/register');
    }
}
