<?php

namespace Tests\Feature\Api;

use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class CategoryTest extends TestCase
{
    Use DatabaseMigrations;

    public function testListCategories()
    {
        $testResponse = $this->makeJWTToken();

        $token = $testResponse->json()['token'];
        $this->get('api/categories',[
            'Authorization' => "Bearer $token"
        ])->assertStatus(200);
    }

    protected function makeJWTToken(){
        $urlGenerator = app(UrlGenerator::class)->version('v1');
        return $this->post($urlGenerator->route('api.access_token'),[
            'email' => 'admin@user.com',
            'password' => 'secret'
        ]);
    }
}
