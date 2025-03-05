<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property int $is_open
 * @property string $store_type
 * @property float $max_delivery_distance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\ShopFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop whereIsOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop whereMaxDeliveryDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop whereStoreType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shop whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Shop extends Model
{
    /** @use HasFactory<\Database\Factories\ShopFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'is_open',
        'store_type',
        'max_delivery_distance',
    ];

    /**
     * Scope a query to only include shops that are open.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsOpen($query)
    {
        return $query->where('is_open', true);
    }
}
