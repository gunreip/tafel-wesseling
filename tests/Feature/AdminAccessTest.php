<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    /** @test */
    public function admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->make(['role' => 'admin']);
        $this->actingAs($admin)->get('/admin')->assertOk();
    }

    /** @test */
    public function user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->make(['role' => 'user']);
        $this->actingAs($user)->get('/admin')->assertForbidden();
    }
}
