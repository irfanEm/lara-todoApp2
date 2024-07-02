<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use app;

class UserController extends Controller
{
    public function login()
    {
        return response()
            ->view('user.login', [
                'title' => 'Login'
            ]);
    }
}
