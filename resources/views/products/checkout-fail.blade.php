@extends('layouts.default')

@section('content')
    <div class="container">
        <h2>Checkout Failed</h2>
        <p>{{ $errorMessage }}</p>
    </div>
@endsection