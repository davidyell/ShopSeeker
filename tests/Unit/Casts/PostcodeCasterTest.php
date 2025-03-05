<?php

declare(strict_types=1);

use App\Casts\PostcodeCaster;
use App\Models\Postcode;
use Tests\TestCase;
use VasilDakov\Postcode\Postcode as PostcodeObject;

class PostcodeCasterTest extends TestCase
{
    public function test_getter(): void
    {
        $caster = new PostcodeCaster;
        $result = $caster->get(new Postcode, 'pcd', 'LD2 3DT', []);
        $this->assertInstanceOf(PostcodeObject::class, $result);
    }

    public function test_setter(): void
    {
        $caster = new PostcodeCaster;
        $result = $caster->set(new Postcode, 'pcd', new PostcodeObject('LD2 3DT'), []);
        $this->assertSame('LD2 3DT', $result);
    }
}
