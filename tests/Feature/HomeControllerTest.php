<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testTamu()
    {
        $this->get("/")
            ->assertRedirect("/login");
    }

    public function testAnggota()
    {
        $this->withSession([
            "user" => "balqis_fa"
        ])->get("/")
            ->assertRedirect("/todolist");
    }
}
