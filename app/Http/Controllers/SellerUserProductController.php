<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SellerUserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
  {
    $products = Product::all();

    return view('auth.sellers.products',compact('products'));
  }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('auth.sellers.product_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsStoreRequest $request)
    {
    $input = $request->validated();

     $input['slug'] = Str::slug($input['name']);
      if(!empty($input['cover']) && $input['cover']->isValid()){
        $file = $input['cover'];

        $path = $file->store('public');

         $input['cover'] = $path;

      }
      Product::create($input);

      return Redirect::route('home');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
      return view('auth.sellers.product_edit',[
          'product' => $product
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, ProductsStoreRequest $request)
  {
    $input = $request->validated();
    if(!empty($input['cover']) && $input['cover']->isValid()){
        Storage::delete($product->cover ?? '');
        $file = $input['cover'];
        $path = $file->store('public');
        $input['cover'] = $path;

      }
    $product->fill($input);
    $product->save();
    return Redirect::route('sellers.products');
  }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
  {
    $product ->delete();
    Storage::delete($product->cover ?? '');
    return Redirect::route('sellers.products');
  }

  public function destroyImage(Product $product)
  {


    Storage::delete($product->cover);

    $product->cover = null;
    Storage::delete($product->cover ?? '');

    $product->save();

    return Redirect::back();
  }
}
