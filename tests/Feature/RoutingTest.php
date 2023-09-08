<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText("Hello Programmer Zaman Now");
    }

    public function testRedirect()
    {
        $this->get('/youtube')->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/404')->assertSeeText('404 Page Not Found');

        $this->get('/tidakadaurl')->assertSeeText('404 Page Not Found');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');

        $this->get('/products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/keyboard/items/1')
            ->assertSeeText('Product: keyboard, Item: 1');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/23')
            ->assertSeeText('Category 23');

        $this->get('/categories/tidakada')
            ->assertSeeText('404 Page Not Found');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/2016')
            ->assertSeeText('User 2016');

        $this->get('/users/')
            ->assertSeeText('User 404');
    }

    public function testRouteParameterConflict()
    {
        $this->get('/conflict/Udin')
            ->assertSeeText('Conflict Udin');

        $this->get('/conflict/hello')
            ->assertSeeText('Conflict Hello World');
    }
}
