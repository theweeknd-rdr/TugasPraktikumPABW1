<div class="card mb-4">
    <div class="card-body">
        <p><strong>Nama:</strong> {{ $booking['nama'] }}</p>
        <p><strong>Jurusan:</strong> {{ $booking['jurusan'] }}</p>
        <p><strong>Umur:</strong> {{ $booking['umur'] }} tahun</p>
        <p><strong>Kode Booking:</strong> {{ $booking['kode'] }}</p>
        <p><strong>Jam Booking:</strong> {{ $booking['jam'] }}</p>
        <p><strong>Status:</strong> <a href="#" class="text-decoration-none text-primary">{{ $booking['status'] }}</a></p>
        <p><strong>Makanan:</strong> {{ $booking['makanan'] }}</p>
    </div>
</div>
