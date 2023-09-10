<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testLocal()
    {
        $fileSystem = Storage::disk('local');

        $fileSystem->put('file.txt', 'Haris mengkece abiez');

        $content = $fileSystem->get('file.txt');

        self::assertEquals('Haris mengkece abiez', $content);
    }

    public function testPublic()
    {
        $fileSystem = Storage::disk('public');

        $fileSystem->put('file.txt', 'Haris mengkece abiez');

        $content = $fileSystem->get('file.txt');

        self::assertEquals('Haris mengkece abiez', $content);
    }
}
