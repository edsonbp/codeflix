<?php

namespace Tests\Browser;

use CodeFlix\Models\Category;
use CodeFlix\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends DuskTestCase
{
    public function testCreate()
    {
        $user = User::where('email', '=', 'admin@user.com' )->first();
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.index'))
                ->clickLink('Nova Categoria')
                ->assertSee('Nova Categoria')
                ->type('name', 'test')
                ->click('button[type=submit]')
                ->assertSee('Listagem de Categorias')
                ->assertSee('test');
        });
    }

    public function testUpdate()
    {
        $user = User::where('email', '=', 'admin@user.com' )->first();
        $category = Category::first();
        $this->browse(function (Browser $browser) use($user, $category) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.index'))
                ->assertSee('Listagem de Categorias')
                ->click("#edit_{$category->id}")
                ->assertSee('Editar Categoria')
                ->type('name', 'test edit')
                ->click('button[type=submit]')
                ->assertSee('Listagem de Categorias')
                ->assertSee('test edit');
        });
    }

    public function testShow()
    {
        $user = User::where('email', '=', 'admin@user.com' )->first();
        $category = Category::first();
        $this->browse(function (Browser $browser) use($user, $category) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.index'))
                ->assertSee('Listagem de Categorias')
                ->assertSee($category->name);
        });
    }

    public function testDelete()
    {
        $user = User::where('email', '=', 'admin@user.com' )->first();
        $category = Category::first();
        $this->browse(function (Browser $browser) use($user, $category) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.index'))
                ->assertSee('Listagem de Categorias')
                ->click("#delete_{$category->id}")
                ->assertSee('Ver Categoria')
                ->click("#delete_{$category->id}")
                ->assertSee('Listagem de Categorias')
                ->assertSee('Categoria excluída com sucesso');
        });
    }
}
