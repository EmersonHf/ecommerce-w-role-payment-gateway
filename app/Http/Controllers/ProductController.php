<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $products,User $user)
    {
        // Retrieve all products

        $products = Product::all();
        
        return view('products.index', ['products'=>$products]);
    }
    public function getUserId() {
        // Assuming you have some logic to identify the user (e.g., authentication)
        $user = Auth::user(); // Replace with your authentication logic
    
        if ($user) {
            $user_id = $user->id; // Get the user's ID
        } else {
            // Handle the case when the user is not authenticated or does not exist
            $user_id = null; // Set a default value or handle the error as needed
        }
    
        return $user_id;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return view('product', [
            'product' => $product
        ]);
    }

    public function checkout($id)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $product = Product::findOrFail($id);

        $lineItems = [];
        $totalPrice = 0;

        $totalPrice += $product->price;
        $lineItems[] = [
            'price_data' => [
                'currency' => 'brl',
                'product_data' => [
                    'name' => $product->name,
                    // 'images' =>[$product -> image ]
                ],
                'unit_amount' => $product->price * 100,
            ],
            'quantity' => 1,
        ];

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        // Update product stock when checkout is successful
        if ($checkout_session->payment_status === 'paid') {
            $product->stock -= 1;
            $product->save();
        }
        $user_id = $this->getUserId();
        if ($user_id !== null) {
            $order = new Order();
            $order->user_id = $user_id;
        $order->status = 'unpaid';
        $order->total_price = $totalPrice;  
        $order->session_id = $checkout_session->id;

        $order->save();
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return redirect($checkout_session->url);
    }
    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51N5iGAEFvalkC3Y2KmEAZRZsJ1wt684ogZ9v5lJUsbKsviuBFsO5V2CGuSHNw8u6jZC28hEoOjIpO3FK1CLuH4Wz003R3uis2z');

        try {
            $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);

            if (!$session) {
                throw new NotFoundHttpException;
            }

            $customer = $session->customer_details;

            $order = Order::where('session_id', $session->id)->where('status', 'unpaid')->first();

            if (!$order) {
                throw new NotFoundHttpException;
            }

            $order->status = 'paid';
            $order->save();

            return view('products.checkout-success', compact('customer'));
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle specific Stripe errors
            $errorMessage = $e->getMessage();
            return view('products.checkout-fail', compact('errorMessage'));
        }
    }
    public function cancel()
    {
        return redirect()->route('home')->with('message', 'Checkout canceled.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('sellers.product_edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
