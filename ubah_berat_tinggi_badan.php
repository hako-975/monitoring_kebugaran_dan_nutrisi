<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }


    $id_berat_tinggi_badan = $_GET['id_berat_tinggi_badan'];
    $data_berat_tinggi_badan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM berat_tinggi_badan INNER JOIN pelanggan ON berat_tinggi_badan.id_pelanggan = pelanggan.id_pelanggan WHERE id_berat_tinggi_badan = '$id_berat_tinggi_badan'"));

    $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama_lengkap ASC");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Ubah Berat Tinggi Badan</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnUbahBeratTinggiBadan'])) {
            $id_pelanggan = htmlspecialchars($_POST['id_pelanggan']);
            $berat_badan = htmlspecialchars($_POST['berat_badan']);
            $tinggi_badan = htmlspecialchars($_POST['tinggi_badan']);
            
            // Konversi tinggi badan dari cm ke meter
            $tinggi_badan_m = $tinggi_badan / 100;

            // Hitung BMI
            $hasil_bmi = $berat_badan / ($tinggi_badan_m * $tinggi_badan_m);

            $update_pelanggan = mysqli_query($conn, "UPDATE berat_tinggi_badan SET id_pelanggan = '$id_pelanggan', berat_badan = '$berat_badan', tinggi_badan = '$tinggi_badan', hasil_bmi = '$hasil_bmi', tanggal_dibuat = CURRENT_TIMESTAMP() WHERE id_berat_tinggi_badan = '$id_berat_tinggi_badan'");

            $nama_lengkap = mysqli_fetch_assoc(mysqli_query($conn, "SELECT  * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'"))['nama_lengkap'];

            if ($update_pelanggan) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Berat Tinggi Badan $nama_lengkap berhasil diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Berat Tinggi Badan " . $nama_lengkap . " berhasil diubah!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'berat_tinggi_badan.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Berat Tinggi Badan $nama_lengkap gagal diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Berat Tinggi Badan " . $nama_lengkap . " gagal diubah!'
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
                            <h3 class="mb-0"><i class="fas  fa-fw fa-plus"></i> Ubah Berat Tinggi Badan</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="berat_tinggi_badan.php">Berat Tinggi Badan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Ubah Berat Tinggi Badan
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
                                                <option value="<?= $data_berat_tinggi_badan['id_pelanggan']; ?>"><?= $data_berat_tinggi_badan['nama_lengkap']; ?></option>
                                                <?php foreach ($pelanggan as $dkb): ?>
                                                    <?php if ($dkb['id_pelanggan'] != $data_berat_tinggi_badan['id_pelanggan']): ?>
                                                        <option value="<?= $dkb['id_pelanggan'] ?>"><?= $dkb['nama_lengkap'] ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                            <input type="number" step=".01" class="form-control" id="berat_badan" name="berat_badan" value="<?= $data_berat_tinggi_badan['berat_badan']; ?>" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                            <input type="number" step=".01" class="form-control" id="tinggi_badan" name="tinggi_badan" value="<?= $data_berat_tinggi_badan['tinggi_badan']; ?>" required>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnUbahBeratTinggiBadan" class="btn btn-primary">Submit</button>
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
</body><!--end::Body-->

</html>