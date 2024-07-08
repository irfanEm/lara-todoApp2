<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todolist()
    {
        $todolist = $this->todolistService->ambilTodo();

        return response()->view('todolist.index', [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function tambahTodo(Request $request): RedirectResponse
    {
        $todo = $request->input("todo");
        if(empty($todo)){
            $todolist = $this->todolistService->ambilTodo();
            return response()->view("todolist.index", [
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Todo-ne diisi disit cok !"
            ]);
        }
        $this->todolistService->simpanTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class, "todolist"]);
    }

    public function hapusTodo(Request $request, string $id): RedirectResponse
    {
        $this->todolistService->hapusTodo($id);
        return redirect()->action([TodolistController::class, "todolist"]);
    }
}
