<?php

namespace App\Services;

interface TodolistService
{
    public function simpanTodo(string $id, string $todo): void;

    public function ambilTodo(): array;

    public function hapusTodo(string $id): void;
}
