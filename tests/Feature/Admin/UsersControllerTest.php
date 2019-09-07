<?php

namespace Tests\Feature\Admin;

use CodeFlix\Models\User;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersControllerTest extends TestCase
{
    Use DatabaseMigrations;

    public function testIfUserDoesntSeeUserList()
    {
        $this->get(route('admin.users.index'))
             ->assertRedirect(route('admin.login'))
             ->assertStatus(302);
    }

    public function testIfUserSeeUserList()
    {
        Model::unguard();
        $user = factory(User::class)
            ->states('admin')
            ->create(['verified' => true]);

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertSee('Listagem de usuários')
            ->assertStatus(200);
    }
}
