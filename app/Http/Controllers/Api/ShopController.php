<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $shops = Shop::get();

        return new JsonResponse($shops);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        $shop = Shop::findOrFail($shop->id);

        return new JsonResponse($shop);
    }
}
