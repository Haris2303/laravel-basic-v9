<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')->assertSeeText('Hello Haris');

        $this->get('/hello-again')->assertSeeText('Hello Ilham');
    }

    public function testNested()
    {
        $this->get('/hello-world')->assertSeeText('World Minecraft');
    }

    public function testTemlate()
    {
        $this->view('hello', ['name' => 'Haris'])
            ->assertSeeText('Hello Haris');

        $this->view('hello.world', ['name' => 'Ilham'])
            ->assertSeeText('World Ilham');
    }
}
