<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.product");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function uploadImageProduct(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // Menyimpan di folder "images" dalam storage
    
            // Menyusun URL publik
            $imageUrl = Storage::url($imagePath);
    
            return response()->json(['return' => true, 'image_url' => $imageUrl]);
        }
    
        return response()->json([
            'return' => false,
            'error' => 'Image upload failed'], 400);
    }

    public function getAllCategories(){

        $category = Category::all();

        return response()->json($category);
    }

    public function getAllProducts(){
        
        $products = Product::with('category')->get();

        return response()->json($products);
    }

    public function getOneProducts(Request $request){

        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $product = Product::with('category')->where('id', $query)->first();
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            Product::create($validated);
        });

        return response()->json([
            'return' => true
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::with('category')->where('id', $id)->first();

        DB::transaction(function () use ($product) {
            $product->delete();
        });

        return response()->json([
            'return' => true
        ], 201);
    }
}
