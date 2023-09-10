<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testCrypt()
    {
        $encrypt = Crypt::encrypt('Udin Kece');
        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals('Udin Kece', $decrypt);
    }
}
