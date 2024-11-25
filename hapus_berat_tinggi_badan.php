<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_berat_tinggi_badan = $_GET['id_berat_tinggi_badan'];

    $data_berat_tinggi_badan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM berat_tinggi_badan WHERE id_berat_tinggi_badan = '$id_berat_tinggi_badan'"));
    
    $id_pelanggan = $data_berat_tinggi_badan['id_pelanggan'];

    $data_pelanggan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'"));
    $nama_lengkap = $data_pelanggan['nama_lengkap'];

	$delete_berat_tinggi_badan = mysqli_query($conn, "DELETE FROM berat_tinggi_badan WHERE id_berat_tinggi_badan = '$id_berat_tinggi_badan'");

	if ($delete_berat_tinggi_badan) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Berat Tinggi Badan $nama_lengkap berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Pelanggan " . $nama_lengkap . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'berat_tinggi_badan.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Pelanggan $nama_lengkap gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Pelanggan " . $nama_lengkap . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'berat_tinggi_badan.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
