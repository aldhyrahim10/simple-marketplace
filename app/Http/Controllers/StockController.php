<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StockRequest;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.stock");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockRequest $request, string $id)
    {

        $product = Product::with('category')->where('id', $id)->first();

        DB::transaction(function () use ($request, $product) {
            $validated = $request->validated();

            $product->update($validated);
        });


        return response()->json([
            'return' => true
        ], 201);
    }

    
}
