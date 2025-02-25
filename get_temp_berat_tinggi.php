<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'monitoring_kebugaran_dan_nutrisi';

$conn = mysqli_connect($host, $user, $pass, $database);


// Query untuk mengambil data terakhir
$sql = "SELECT berat, tinggi FROM temp_berat_tinggi ORDER BY id_temp_berat_tinggi DESC LIMIT 1";

// Jalankan query
$result = mysqli_query($conn, $sql);

$data = array('berat' => '', 'tinggi' => '');

if ($result) {
    if ($row = mysqli_fetch_assoc($result)) {
        $data['berat'] = $row['berat'];
        $data['tinggi'] = $row['tinggi'];
    }
} else {
    // Jika query gagal, tampilkan error
    $data['error'] = 'Query failed: ' . mysqli_error($conn);
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
