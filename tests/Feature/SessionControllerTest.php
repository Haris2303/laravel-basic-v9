<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'udin')
            ->assertSessionHas('isMember', "true");
    }

    public function testGetSessionValid()
    {
        $this->withSession([
            'userId' => 'udin',
            'isMember' => "true"
        ])->get('/session/get')
            ->assertSeeText('User Id : udin, Is Member : true');
    }

    public function testGetSessionInvalid()
    {
        $this->withSession([])->get('/session/get')
            ->assertSeeText('User Id : guest, Is Member : false');
    }
}
