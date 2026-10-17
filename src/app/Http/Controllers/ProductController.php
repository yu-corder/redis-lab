<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Product;


class ProductController extends Controller
{
    public function show(int $id)
    {
        $key = "product:{$id}";

        DB::enableQueryLog();

        $product = Cache::remember($key, 300, function () use ($id) {
            return Product::findOrFail($id)->toArray();
        });

        return response()->json([
            'product' => $product,
            'queries' => DB::getQueryLog(),
        ]);
    }
}
