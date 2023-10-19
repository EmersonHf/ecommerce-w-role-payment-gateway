<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsStoreRequest;

use App\Models\Product;
use App\Models\Role;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SellerUserProductController extends Controller
{

  public readonly User $user;
  public function __construct()
  {
    $this->user = new User();
  }
    /**
     * Display a listing of the resource.
     */

     public function index(User $seller,Product $products)
     {
    
      $seller = Auth::user();

      // Retrieve the "seller" role
      $sellerRole = Role::where('name', 'seller')->firstOrFail();
      
      // Retrieve products associated with the logged-in user who has the "seller" role
      $products = $seller->products()
          ->where('role_id', $sellerRole->id) // Add a condition to check the role_id
          ->get();
     
          return view('auth.sellers.seller.products.index', ['seller' => $seller, 'products' => $products]);
     }
     

  
    /**
     * Show the form for creating a new resource.
     */
    public function create(User $seller)
    {
      $seller = Auth::user();
    return view('auth.sellers.seller.products.product_create',['seller'=>$seller]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsStoreRequest $request)
    {
    $input = $request->validated();
    $sellerRole = Role::where('name', 'seller')->firstOrFail();
    $input['role_id'] = $sellerRole->id;
    $input['user_id'] = auth()->user()->id;
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
    public function show(Product $products, Seller $seller)
    {

      $seller = Auth::user();

      // Retrieve the "seller" role
      $sellerRole = Role::where('name', 'seller')->firstOrFail();
      
      // Retrieve products associated with the logged-in user who has the "seller" role
      $products = $seller->products()
          ->where('role_id', $sellerRole->id) // Add a condition to check the role_id
          ->get();
        return view('auth.sellers.seller.products.show',  ['seller'=>$seller,'products'=>$products]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($productId)
    {
      $product = Product::find($productId);
      $seller = Auth::user();
  
      if (!$product) {
          // Handle the case when the product doesn't exist (e.g., show an error page or redirect)
      }
  
      return view('auth.sellers.seller.products.edit', compact('product', 'seller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $seller, Product $product, ProductsStoreRequest $request)
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

    return Redirect::route('index.products', compact('product', 'seller'));
  }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
  {
    $product ->delete();
    Storage::delete($product->cover ?? '');
    return Redirect::route('index.products');
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
