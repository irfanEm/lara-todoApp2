<?php

namespace App\Http\Controllers;

use app;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login()
    {
        return response()
            ->view('user.login', [
                'title' => 'Login'
            ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $user = $request->input('user');
        $sandi = $request->input('password');

        if(empty($user) || empty($sandi)){
            return response()->view('user.login', [
                'title' => 'Login',
                'error' => 'User atau sandi tidak boleh kosong !'
            ]);
        }

        if($this->userService->login($user, $sandi)) {
            $request->session()->put('user', $user);
            return redirect('/');
        }

        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'User atau password salah !'
        ]);
    }

    public function doLogout(Request $request): RedirectResponse
    {
        $request->session()->forget('user');

        return redirect("/");
    }
}
