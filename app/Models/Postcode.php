<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Database\Factories\PostcodeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Postcode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Postcode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Postcode query()
 *
 * @mixin \Eloquent
 */
class Postcode extends Model
{
    /** @use HasFactory<\Database\Factories\PostcodeFactory> */
    use HasFactory;

    /**
     * Potential security risk for mass-assignment attack, but as we
     * are populating the model from an Artisan command it's a medium risk.
     *
     * If we added a controller, we'd need to secure this.
     */
    public $fillable = ['*'];
}
