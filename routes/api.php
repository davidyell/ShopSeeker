<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('shops', [ShopController::class, 'index'])->name('api.shops.index');
Route::get('shop/{shop}', [ShopController::class, 'show'])->name('api.shops.view');
