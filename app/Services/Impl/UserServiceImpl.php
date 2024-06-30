<?php

namespace App\Services\Impl;
use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        'balqis_fa' => '210321',
        'shilvia_qa' => '170303',
        'irfan_em' => '271197'
    ];
    public function login(string $username, string $password): bool
    {
        if(!isset($this->users[$username])){
            return false;
        }

        $passwordBenar = $this->users[$username];
        return $password === $passwordBenar;

    }
}
