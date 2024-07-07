<?php

namespace App\Services\Impl;
use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function simpanTodo(string $id, string $todo): void
    {
        if(!Session::exists("todolist")){
            Session::put("todolist",[]);
        }

        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }

    public function ambilTodo(): array
    {
        return Session::get("todolist", []);
    }

    public function hapusTodo(string $id): void
    {
        $todolist = Session::get("todolist");

        foreach($todolist as $index => $value){
            if($value["id"] == $id){
                unset($todolist[$index]);
            }
        }

        Session::put("todolist", $todolist);
    }
}
