<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    /**
     * Potential security risk for mass-assignment attack, but as we
     * are populating the model from an Artisan command it's a medium risk.
     *
     * If we added a controller, we'd need to secure this.
     */
    public $fillable = ['*'];
}
