<?php
header("Expires: 0");
header("Cache-Control: no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header('Content-Type: application/json');


$host = 'localhost';
$user = 'hakc2743_localhost';
$pass = 'md615GPkAtJ798';
$database = 'hakc2743_monitoring_kebugaran_dan_nutrisi';

$conn = mysqli_connect($host, $user, $pass, $database);

// if ($conn) {
// 	echo "berhasil terkoneksi";
// }


// Query untuk mengambil data terakhir
$sql = "SELECT id_temp, berat_badan, tinggi_badan FROM temp_berat_tinggi_badan ORDER BY id_temp DESC LIMIT 1";

// Jalankan query
$result = mysqli_query($conn, $sql);

$data = array('berat_badan' => '', 'tinggi_badan' => '');

if ($result) {
    if ($row = mysqli_fetch_assoc($result)) {
        $data['berat_badan'] = $row['berat_badan'];
        $data['tinggi_badan'] = $row['tinggi_badan'];
    }
} else {
    // Jika query gagal, tampilkan error
    $data['error'] = 'Query failed: ' . mysqli_error($conn);
}

echo json_encode($data);

?>