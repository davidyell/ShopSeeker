<?php

declare(strict_types=1);

namespace App\Enums;

enum ShopType: string
{
    case Shop = 'Shop';
    case Takeaway = 'Takeaway';
    case Restaurant = 'Restaurant';
}
