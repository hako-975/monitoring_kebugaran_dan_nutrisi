<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $jml_pelanggan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pelanggan"));
    $jml_kategori_bmi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kategori_bmi"));
    $jml_rekomendasi_makanan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekomendasi_makanan"));
    $jml_rekomendasi_olahraga = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekomendasi_olahraga"));
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Dashboard - Sistem Monitoring Kebugaran & Nutrisi</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-tachometer-alt"></i> Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dashboard
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="pelanggan.php" class="nav-link">
                                <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i class="fas fa-fw fa-users text-white"></i> </span>
                                    <div class="info-box-content"> <span class="info-box-text">Jumlah Pelanggan</span>
                                        <span class="info-box-number"><?= $jml_pelanggan; ?></span>
                                    </div> 
                                    <!-- /.info-box-content -->
                                </div> <!-- /.info-box -->
                            </a>
                        </div> <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="kategori_bmi.php" class="nav-link">
                                <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm"> <i class="fas fa-fw fa-child"></i> </span>
                                    <div class="info-box-content"> <span class="info-box-text">Jumlah Kategori BMI</span> 
                                        <span class="info-box-number"><?= $jml_kategori_bmi; ?></span> 
                                    </div> 
                                    <!-- /.info-box-content -->
                                </div> <!-- /.info-box -->
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="rekomendasi_makanan.php" class="nav-link">
                                <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm"> <i class="fas fa-fw fa-carrot"></i> </span>
                                    <div class="info-box-content"> <span class="info-box-text">Rekomendasi Makanan</span> 
                                        <span class="info-box-number"><?= $jml_rekomendasi_makanan; ?></span> 
                                    </div>
                                </div> <!-- /.info-box -->
                            </a>
                        </div> <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="rekomendasi_olahraga.php" class="nav-link">
                                <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="fas fa-fw fa-dumbbell"></i> </span>
                                    <div class="info-box-content"> <span class="info-box-text">Rekomendasi Olahraga</span> 
                                        <span class="info-box-number"><?= $jml_rekomendasi_olahraga; ?></span> 
                                    </div>
                                </div>
                            </a>
                        </div> 
                    </div> <!-- /.row --> <!--begin::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> 
        <?php include_once 'include/footer.php'; ?>
    </div> <!--end::App Wrapper--> 
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>