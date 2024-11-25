<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_rekomendasi_olahraga = $_GET['id_rekomendasi_olahraga'];

    $data_rekomendasi_olahraga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rekomendasi_olahraga WHERE id_rekomendasi_olahraga = '$id_rekomendasi_olahraga'"));
    $olahraga = $data_rekomendasi_olahraga['olahraga'];

    $foto = $data_rekomendasi_olahraga['foto'];
    $image_path = 'assets/img/olahraga/' . $foto;

	$delete_rekomendasi_olahraga = mysqli_query($conn, "DELETE FROM rekomendasi_olahraga WHERE id_rekomendasi_olahraga = '$id_rekomendasi_olahraga'");

	if ($delete_rekomendasi_olahraga) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Rekomendasi Olahraga $olahraga berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

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
	                text: 'Rekomendasi Olahraga " . $olahraga . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'rekomendasi_olahraga.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Rekomendasi Olahraga $olahraga gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Rekomendasi Olahraga " . $olahraga . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'rekomendasi_olahraga.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
