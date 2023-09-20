@extends('layouts.default')

@section('content')

<section class="text-gray-600 overflow-hidden">
    <div class="container px-5 py-24 mx-auto">
    <h1>Payment Error</h1>

    <p>{{ $errorMessage }}</p>
    <h1>Customer Details</h1>
<p><strong>Name:</strong> {{ $customer->name }}</p>
<p><strong>Email:</strong> {{ $customer->email }}</p>
<p><strong>Phone:</strong> {{ $customer->phone }}</p>
   
    </div>
</section>
@endsection
