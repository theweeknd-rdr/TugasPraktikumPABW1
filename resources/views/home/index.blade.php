@extends('layouts.main')

@section('title', 'Food Explorer | Restoran Terdekat')

@section('content')
    <div class="text-center mb-3">
        <img src="{{ asset('images/food-explorer-logo.png') }}" alt="Food Explorer" width="100">
    </div>

    <x-alert type="success" message="Data restoran berhasil dimuat!" />

    <h4 class="text-center text-danger fw-bold mb-4">Restoran Terdekat di Sekitar Anda</h4>

    <div class="mx-auto" style="max-width: 700px;">
        @foreach ($restaurants as $restaurant)
            @include('partials.restaurant-card', ['restaurant' => $restaurant])
        @endforeach
    </div>
@endsection