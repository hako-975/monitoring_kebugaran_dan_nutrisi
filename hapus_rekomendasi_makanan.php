<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_rekomendasi_makanan = $_GET['id_rekomendasi_makanan'];

    $data_rekomendasi_makanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rekomendasi_makanan WHERE id_rekomendasi_makanan = '$id_rekomendasi_makanan'"));
    $makanan = $data_rekomendasi_makanan['makanan'];

    $foto = $data_rekomendasi_makanan['foto'];
    $image_path = 'assets/img/makanan/' . $foto;

	$delete_rekomendasi_makanan = mysqli_query($conn, "DELETE FROM rekomendasi_makanan WHERE id_rekomendasi_makanan = '$id_rekomendasi_makanan'");

	if ($delete_rekomendasi_makanan) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kategori BMI $makanan berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

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
	                text: 'Kategori BMI " . $makanan . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'rekomendasi_makanan.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kategori BMI $makanan gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Kategori BMI " . $makanan . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'rekomendasi_makanan.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
