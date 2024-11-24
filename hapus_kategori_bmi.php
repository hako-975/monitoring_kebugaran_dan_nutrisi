<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_kategori_bmi = $_GET['id_kategori_bmi'];

    $data_kategori_bmi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kategori_bmi WHERE id_kategori_bmi = '$id_kategori_bmi'"));
    $kategori = $data_kategori_bmi['kategori'];

	$delete_kategori_bmi = mysqli_query($conn, "DELETE FROM kategori_bmi WHERE id_kategori_bmi = '$id_kategori_bmi'");

	if ($delete_kategori_bmi) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kategori BMI $kategori berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Kategori BMI " . $kategori . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'kategori_bmi.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kategori BMI $kategori gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Kategori BMI " . $kategori . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'kategori_bmi.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
