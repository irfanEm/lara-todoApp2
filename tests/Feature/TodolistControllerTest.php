<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testFuncTodolist()
    {
        $this->withSession([
            "user" => "balqis_fa",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Bikin kopi dulu."
                ],
                [
                    "id" => "2",
                    "todo" => "Ghibah dengan keri."
                ],
            ]
        ])
            ->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("Bikin kopi dulu.")
            ->assertSeeText("2")
            ->assertSeeText("Ghibah dengan keri.");
    }

    public function testSimpanTodoGagal()
    {
        $this->withSession([
            "user" => "balqis_fa"
        ])
            ->post("/todolist", [])
            ->assertSeeText("Todo-ne diisi disit cok !");
    }

    public function testSimpanTodoSukses()
    {
        $this->withSession([
            "user" => "balqis_fa"
        ])
            ->post("/todolist", [
                "todo" => "Ngops duls hehehe"
            ])
            ->assertRedirect("/todolist");
    }

    public function testHapusTodolist()
    {
        $this->withSession([
            "user" => "balqis_fa",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Bikin kopi dulu."
                ],
                [
                    "id" => "2",
                    "todo" => "Ghibah dengan keri."
                ],
            ]
        ])
            ->post("/todolist/1/hapus")
            ->assertRedirect("/todolist");
    }
}
