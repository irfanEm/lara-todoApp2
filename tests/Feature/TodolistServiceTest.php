<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\TodolistService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSimpanTodolist()
    {
        $this->todolistService->simpanTodo("1", "todo Test");

        $todolists = Session::get("todolist");

        foreach($todolists as $todo){
            self::assertEquals("1", $todo['id']);
            self::assertEquals("todo Test", $todo['todo']);
        }
    }

    public function testAmbilTodoKosong()
    {
        self::assertEquals([], $this->todolistService->ambilTodo());
    }

    public function testAmbilTodoTidakKosong()
    {
        $harapan = [
            [
                "id" => "1",
                "todo" => "satu"
            ],
            [
                "id" => "2",
                "todo" => "dua"
            ],
            [
                "id" => "3",
                "todo" => "tiga"
            ],
        ];

        $this->todolistService->simpanTodo("1", "satu");
        $this->todolistService->simpanTodo("2", "dua");
        $this->todolistService->simpanTodo("3", "tiga");

        self::assertNotEquals([], $this->todolistService->ambilTodo());
        self::assertEquals($harapan, $this->todolistService->ambilTodo());
    }

    public function testHapusTodo()
    {
        $this->todolistService->simpanTodo("1", "satu");
        $this->todolistService->simpanTodo("2", "dua");
        $this->todolistService->simpanTodo("3", "tiga");
        self::assertEquals(3, sizeof($this->todolistService->ambilTodo()));

        $this->todolistService->hapusTodo("4");
        self::assertEquals(3, sizeof($this->todolistService->ambilTodo()));

        $this->todolistService->hapusTodo("3");
        self::assertEquals(2, sizeof($this->todolistService->ambilTodo()));

        $this->todolistService->hapusTodo("2");
        self::assertEquals(1, sizeof($this->todolistService->ambilTodo()));

        $this->todolistService->hapusTodo("1");
        self::assertEquals(0, sizeof($this->todolistService->ambilTodo()));
    }
}
