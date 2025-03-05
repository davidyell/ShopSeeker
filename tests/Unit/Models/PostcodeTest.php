<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Postcode;
use PHPUnit\Framework\TestCase;
use VasilDakov\Postcode\Postcode as PostcodeObject;

class PostcodeTest extends TestCase
{
    public function test_casting_postcode()
    {
        $postcode = new Postcode;
        $postcode->pcd = 'BS7 8HP';

        $this->assertInstanceOf(PostcodeObject::class, $postcode->pcd);
    }
}
