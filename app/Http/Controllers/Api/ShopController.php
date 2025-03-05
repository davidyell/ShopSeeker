<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Postcode;
use App\Models\Shop;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use VasilDakov\Postcode\Postcode as PostcodeObject;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Shop::query();

        if ($request->query('postcode')) {
            $postcode = $request->query('postcode');

            // Validate the postcode
            if (! PostcodeObject::isValid($postcode)) {
                return new JsonResponse(['error' => ['message' => sprintf('Invalid postcode, %s', $postcode)]], 400);
            }

            // Lookup the postcode in the Postcode table to get a lat/lng for it
            try {
                /** @var Postcode $point */
                $point = Postcode::query()->where('pcd', $postcode)->firstOrFail();
            } catch (ModelNotFoundException $exception) {
                return new JsonResponse(['error' => ['message' => sprintf('Unable to lookup postcode, %s', $postcode)]], 400);
            }

            // Filter the Shop model by the lat/lng radius query
            $latitude = $point->lat;
            $longitude = $point->long;
            $radius = 50; // km

            // Use Haversine formula as balance between accuracy and performance
            $query->selectRaw('*, (6371 * 2 * ASIN(SQRT(POWER(SIN((? - abs(latitude)) * pi()/180 / 2), 2) + COS(? * pi()/180 ) * COS(abs(latitude) * pi()/180) * POWER(SIN((? - longitude) * pi()/180 / 2), 2) ))) as distance', [$latitude, $latitude, $longitude])
                ->having('distance', '<', $radius);
        }

        if ($request->query('open')) {
            $query->isOpen();
        }

        $shops = $query->get();

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
