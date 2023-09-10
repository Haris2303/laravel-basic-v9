<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Haris')
            ->assertSeeText('Hello Haris');

        $this->post('/input/hello', ['name' => 'Haris'])
            ->assertSeeText('Hello Haris');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Haris"
            ]
        ])->assertSeeText('Hello Haris');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Haris",
                "last" => "Aja"
            ]
        ])->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('Haris')
            ->assertSeeText('last')
            ->assertSeeText('Aja');
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'OPPO A5 2020',
                    'price' => 2400000
                ],
                [
                    'name' => 'POCO PHONE F5',
                    'price' => 5000000
                ]
            ]
        ])->assertSeeText('OPPO A5 2020')
            ->assertSeeText('POCO PHONE F5');
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Udin',
            'married' => 'false',
            'birth_date' => '2000-10-20'
        ])->assertSeeText('Udin')
            ->assertSeeText(false)
            ->assertSeeText('2000-10-20');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'Udin',
                'middle' => 'Bin',
                'last' => 'Jamal'
            ]
        ])->assertSeeText('Udin')
            ->assertSeeText('Jamal')
            ->assertDontSeeText('Bin');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'username' => 'otong',
            'password' => 'yntkts',
            'admin' => 'true'
        ])->assertSeeText('username')
            ->assertSeeText('password')
            ->assertDontSeeText('admin');
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            'username' => 'ucup',
            'password' => 'kepo',
            'admin' => 'true'
        ])->assertSeeText('ucup')->assertSeeText('kepo')
            ->assertSeeText('admin')->assertSeeText('false');
    }
}
