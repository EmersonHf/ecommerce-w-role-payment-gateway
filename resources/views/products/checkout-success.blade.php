@extends('layouts.default')

@section('content')

<section class="text-gray-600 overflow-hidden">
    <div class="container px-5 py-24 mx-auto">
      <h1>Success</h1>
  <h1>Thanks for your order, {{$customer->name}}!</h1>
    </div>
</section>
@endsection
