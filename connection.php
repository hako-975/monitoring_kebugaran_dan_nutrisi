<?php 
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	
	$host = 'localhost';
	$user = 'hakc2743_localhost';
	$pass = 'md615GPkAtJ798';
	$database = 'hakc2743_monitoring_kebugaran_dan_nutrisi';

	$conn = mysqli_connect($host, $user, $pass, $database);

	// if ($conn) {
	// 	echo "berhasil terkoneksi";
	// }

    if (isset($_SESSION['id_user'])) {
    	$id_user = $_SESSION['id_user'];
		$dataUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user"));
	}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.all.min.js"></script>
