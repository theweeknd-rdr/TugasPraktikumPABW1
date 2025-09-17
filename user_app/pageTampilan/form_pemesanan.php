<?php
session_start();
require_once '../../config.php';

// Default values
$title = "Form Pemesanan";

// Check for required parameters
if (!isset($_GET['id_wisata']) || !isset($_GET['item'])) {
    // Redirect back to destinasi page if parameters are missing
    header("Location: destinasipage.php");
    exit();
}

// Get parameters with validation
$id_wisata = filter_input(INPUT_GET, 'id_wisata', FILTER_VALIDATE_INT);
$item = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_STRING);

if ($id_wisata === false) {
    header("Location: destinasipage.php");
    exit();
}

$title .= " - " . htmlspecialchars($item);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = check_connection($conn);
        
        // Generate kode pemesanan
        do {
            $kode_pemesanan = 'TRX' . rand(10000, 99999);
            $check = $conn->query("SELECT kode_pemesanan FROM pemesanan WHERE kode_pemesanan = '$kode_pemesanan'");
        } while ($check->num_rows > 0);

        // Simpan data pemesanan
        $tgl_pesan = date('Y-m-d H:i:s');
        $tgl_berangkat = $_POST['tgl_berangkat'];
        $jumlah_pesan = $_POST['jumlah_pesan'];
        $nama_pemesan = $_POST['nama_pemesan'];
        
        $sql = "INSERT INTO pemesanan (kode_pemesanan, tgl_pesan, tgl_berangkat, jumlah_pesan, nama_pemesan) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        
        $stmt->bind_param("sssis", 
            $kode_pemesanan, 
            $tgl_pesan, 
            $tgl_berangkat, 
            $jumlah_pesan,
            $nama_pemesan
        );
        
        if ($stmt->execute()) {
            // Get wisata price
            $sql_price = "SELECT harga_wisata FROM tujuan_wisata WHERE id_wisata = ?";
            $stmt_price = $conn->prepare($sql_price);
            $stmt_price->bind_param("i", $id_wisata);
            $stmt_price->execute();
            $price = $stmt_price->get_result()->fetch_assoc()['harga_wisata'];
            
            // Calculate total
            $total = $price * $jumlah_pesan;
            
            // Redirect to payment page
            header("Location: pembayaran.php?" . http_build_query([
                'kode' => $kode_pemesanan,
                'nama' => $nama_pemesan,
                'jumlah' => $jumlah_pesan,
                'tanggal' => $tgl_berangkat,
                'total' => $total
            ]));
            exit();
        } else {
            throw new Exception("Error executing statement: " . $stmt->error);
        }
    } catch (Exception $e) {
        echo "<div class='bg-red-100 text-red-700 p-4 rounded mb-4'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800"><?= $title ?></h2>
    <form method="POST" action="" class="space-y-6">
        <!-- Hidden input for id_wisata -->
        <input type="hidden" name="id_wisata" value="<?= htmlspecialchars($id_wisata) ?>">

        <!-- Nama Pemesan -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="nama_pemesan" required 
                   value="<?php echo isset($_SESSION['namaDepan']) ? htmlspecialchars($_SESSION['namaDepan']) : ''; ?>"
                   placeholder="Masukkan nama lengkap"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
        </div>

        <!-- Tanggal Berangkat -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Berangkat</label>
            <input type="date" id="tgl_berangkat" name="tgl_berangkat" required
                   min="<?php echo date('Y-m-d'); ?>"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
        </div>

        <!-- Jumlah Tiket -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Tiket</label>
            <div class="flex items-center">
                <button type="button" onclick="decrementTicket()" 
                        class="px-4 py-2 bg-gray-200 rounded-l-lg hover:bg-gray-300 transition-colors">-</button>
                <input type="number" id="jumlah_pesan" name="jumlah_pesan" required
                       class="w-24 px-4 py-2 text-center border-t border-b border-gray-300"
                       value="1" min="1" max="10">
                <button type="button" onclick="incrementTicket()" 
                        class="px-4 py-2 bg-gray-200 rounded-r-lg hover:bg-gray-300 transition-colors">+</button>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
            Konfirmasi Pemesanan
        </button>
    </form>
</div>

<script>
    function incrementTicket() {
        let input = document.getElementById("jumlah_pesan");
        if (parseInt(input.value) < 10) input.value = parseInt(input.value) + 1;
    }

    function decrementTicket() {
        let input = document.getElementById("jumlah_pesan");
        if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
    }
</script>

</body>
</html>
</html>
