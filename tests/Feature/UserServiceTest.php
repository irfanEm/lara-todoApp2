<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login('balqis_fa', '210321'));
    }

    public function testLoginValidationError()
    {
        self::assertFalse($this->userService->login('salah', 'salahmaning'));
    }

    public function testLoginSalahPassword()
    {
        self::assertFalse($this->userService->login('balqis_fa', 'salah'));
    }
}
