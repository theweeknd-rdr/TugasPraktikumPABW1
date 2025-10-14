@extends('layouts.main')

@section('content')
<div class="text-center mb-4">
    <img src="{{ asset('images/food-explorer-logo.png') }}" alt="Food Explorer" width="100">
</div>

<div class="alert alert-success text-center" role="alert">
    Success: Data restoran berhasil dimuat
</div>

<h5 class="text-danger mb-4 text-center">Restoran Terdekat di Sekitar Anda</h5>

@foreach($restaurants as $restaurant)
<div class="card p-4 mb-4 shadow-sm">
    <p><strong>Nama Restoran:</strong> {{ $restaurant["nama"] }}</p>

    @if($restaurant['kategori'] === 'Fine Dining')
        <p><strong>Tipe:</strong> {{ $restaurant['tipe'] }}</p>
    @elseif($restaurant['kategori'] === 'Cafe')
        <p><strong>Spesialisasi:</strong> {{ $restaurant['spesialisasi'] }}</p>
    @elseif($restaurant['kategori'] === 'Street Food')
        <p><strong>Lokasi:</strong> {{ $restaurant['lokasi'] }}</p>
    @elseif($restaurant['kategori'] === 'Buffet')
        <p><strong>Fitur:</strong> All-you-can-eat dengan berbagai pilihan</p>
    @endif

    <p><strong>Rating:</strong> {{ $restaurant['rating'] }} ⭐</p>
    <p><strong>Kode Reservasi:</strong> {{ $restaurant['kode_reservasi'] }}</p>
    <p><strong>Jam Buka:</strong> {{ $restaurant['jam_buka'] }}</p>

    @php
    $color = match($restaurant['kategori']) {
        'Cafe' => 'brown',
        'Fine Dining' => 'gold',
        'Street Food' => 'orange',
        'Buffet' => 'purple',
        default => 'gray'
    }
    @endphp

    <p><strong>Kategori:</strong> <span style="color: {{ $color }};">{{ $restaurant['kategori'] }}</span></p>
    <p><strong>Chef:</strong> {{ $restaurant['chef'] }}</p>
</div>
@endforeach

<div class="text-center mt-4">
    <h5 class="text-danger">Food Explorer App</h5>
    <p>Temukan Restoran Terbaik</p>
    <p class="text-muted">© 2025 Food Explorer - Muhammad Anantha Mahardika Ridwan</p>
</div>
@endsection