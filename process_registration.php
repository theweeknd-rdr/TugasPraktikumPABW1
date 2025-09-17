<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: loginMitra.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $type = $_POST['type'];
    $nama_mitra = $_POST['nama_mitra'];
    
    // Process the form data based on type
    switch($type) {
        case 'transportasi':
            // Process transportation registration
            $sql = "INSERT INTO mitra_transportasi (user_id, nama_mitra, jenis_kendaraan) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $user_id, $nama_mitra, $_POST['jenis_kendaraan']);
            break;
            
        case 'penginapan':
            // Process accommodation registration
            break;
            
        case 'wisata':
            // Process tourism registration
            break;
    }
    
    if ($stmt->execute()) {
        $_SESSION['setup_complete'] = true;
        header('Location: DashboardMitra.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
