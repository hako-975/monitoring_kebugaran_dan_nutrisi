<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama_lengkap ASC");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Tambah Berat Tinggi Badan</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahBeratTinggiBadan'])) {
            $id_pelanggan = htmlspecialchars($_POST['id_pelanggan']);
            $berat_badan = htmlspecialchars($_POST['berat_badan']);
            $tinggi_badan = htmlspecialchars($_POST['tinggi_badan']);
            
            // Konversi tinggi badan dari cm ke meter
            $tinggi_badan_m = $tinggi_badan / 100;

            // Hitung BMI
            $hasil_bmi = $berat_badan / ($tinggi_badan_m * $tinggi_badan_m);

            $insert_pelanggan = mysqli_query($conn, "INSERT INTO berat_tinggi_badan VALUES ('', '$id_pelanggan', '$berat_badan', '$tinggi_badan', '$hasil_bmi', CURRENT_TIMESTAMP())");

            $nama_lengkap = mysqli_fetch_assoc(mysqli_query($conn, "SELECT  * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'"))['nama_lengkap'];

            if ($insert_pelanggan) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Berat Tinggi Badan $nama_lengkap berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Berat Tinggi Badan " . $nama_lengkap . " berhasil ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'berat_tinggi_badan.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Berat Tinggi Badan $nama_lengkap gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Berat Tinggi Badan " . $nama_lengkap . " gagal ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.history.back();
                            }
                        });
                    </script>
                ";
                exit;
            }
        }
    ?>
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="fas  fa-fw fa-plus"></i> Tambah Berat Tinggi Badan</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="berat_tinggi_badan.php">Berat Tinggi Badan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Berat Tinggi Badan
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-primary card-outline mb-4">
                                <form method="post" enctype="multipart/form-data"> 
                                    <div class="card-body">
                                        <div class="mb-3"> 
                                            <label for="id_pelanggan" class="form-label">Nama Pelanggan</label>
                                            <select class="form-select" id="id_pelanggan" name="id_pelanggan" required>
                                                <option value="0">--- Pilih Nama Pelanggan ---</option>
                                                <?php foreach ($pelanggan as $dkb): ?>
                                                    <option value="<?= $dkb['id_pelanggan'] ?>"><?= $dkb['nama_lengkap'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                            <input type="number" step=".01" class="form-control" id="berat_badan" name="berat_badan" required value="">
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                            <input type="number" step=".01" class="form-control" id="tinggi_badan" name="tinggi_badan" required value="">
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnTambahBeratTinggiBadan" class="btn btn-primary">Submit</button>
                                    </div> 
                                </form> <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> 
        <?php include_once 'include/footer.php'; ?>
    </div> <!--end::App Wrapper--> 
    <?php include_once 'include/script.php'; ?>

    <script>
    $(document).ready(function() {
        // Fungsi untuk fetch data dari server
        function fetchData() {
            $.ajax({
                url: 'get_temp_berat_tinggi.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#berat_badan').val(data.berat || '');
                    $('#tinggi_badan').val(data.tinggi || '');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire('Error', 'Failed to fetch data: ' + error, 'error');
                }
            });
        }

        // Panggil fetch pertama kali saat halaman dimuat
        fetchData();

        // Jalankan setiap 5 detik (5000 ms)
        setInterval(fetchData, 5000);
    });
    </script>


</body><!--end::Body-->

</html>


