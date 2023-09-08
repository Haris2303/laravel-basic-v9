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
}
