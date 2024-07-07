<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginForMember()
    {
        $this->withSession([
            "user" => "balqis_fa"
        ])
        ->get("/login")
        ->assertRedirect("/");
    }

    public function testLoginUntukUserSudahLogin()
    {
        $this->withSession([
            "user" => "balqis_fa"
        ])
        ->post('/login', [
            'user' => 'balqis_fa',
            'password' => '210321'
        ])
            ->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'balqis_fa',
            'password' => '210321'
        ])
            ->assertRedirect('/')
            ->assertSessionHas('user', 'balqis_fa');
    }

    public function testLoginValidationError()
    {
        $this->post('/login')
            ->assertSeeText('User atau sandi tidak boleh kosong !')
            ->assertSeeText('Login');
    }

    public function testLoginWrongPassword()
    {
        $this->post('/login', [
            'user' => 'balqis_fa',
            'password' => 'salah'
        ])
            ->assertSeeText('User atau password salah !')
            ->assertSeeText('Login');
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "balqis_fa"
        ])->post("/logout")
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }
}
