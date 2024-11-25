<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_pelanggan = $_GET['id_pelanggan'];

    $data_pelanggan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'"));
    $nama_lengkap = $data_pelanggan['nama_lengkap'];

    $foto = $data_pelanggan['foto'];
    $image_path = 'assets/img/pelanggan/' . $foto;

	$delete_pelanggan = mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");

	if ($delete_pelanggan) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Pelanggan $nama_lengkap berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

        if ($foto != 'default.jpg' && $foto != '') {
		    if (file_exists($image_path)) {
		        unlink($image_path);
		    }
		}
		
		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Pelanggan " . $nama_lengkap . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'pelanggan.php';
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
	                    window.location.href = 'pelanggan.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
