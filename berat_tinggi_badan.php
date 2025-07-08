<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $berat_tinggi_badan = mysqli_query($conn, "SELECT * FROM berat_tinggi_badan INNER JOIN pelanggan ON berat_tinggi_badan.id_pelanggan = pelanggan.id_pelanggan ORDER BY berat_tinggi_badan.tanggal_dibuat DESC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Berat Tinggi Badan</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-weight"></i> Berat Tinggi Badan</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Berat Tinggi Badan
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-2">
                                <a href="tambah_berat_tinggi_badan.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Berat Tinggi Badan</a>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Berat Badan</th>
                                            <th class="text-center align-middle">Tinggi Badan</th>
                                            <th class="text-center align-middle">Nama Pelanggan</th>
                                            <th class="text-center align-middle">Hasil BMI</th>
                                            <th class="text-center align-middle">Kategori BMI</th>
                                            <th class="text-center align-middle">Rekomendasi Makanan</th>
                                            <th class="text-center align-middle">Rekomendasi Olahraga</th>
                                            <th class="text-center align-middle">Tanggal Dibuat</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($berat_tinggi_badan as $dbtb): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                <td class="text-center align-middle"><?= $dbtb['berat_badan']; ?></td>
                                                <td class="text-center align-middle"><?= $dbtb['tinggi_badan']; ?></td>
                                                <td class="text-center align-middle"><?= $dbtb['nama_lengkap']; ?></td>
                                                <td class="text-center align-middle"><?= $dbtb['hasil_bmi']; ?></td>
                                                <?php 
                                                    $hasil_bmi = $dbtb['hasil_bmi'];
                                                    // Query untuk mencari kategori BMI
                                                    $kategori_bmi_query = mysqli_query($conn, 
                                                        "SELECT * FROM kategori_bmi 
                                                         WHERE bmi_min <= '$hasil_bmi' AND bmi_max >= '$hasil_bmi'"
                                                    );

                                                    // Ambil hasil kategori BMI
                                                    $kategori_bmi = mysqli_fetch_assoc($kategori_bmi_query);
                                                    $id_kategori_bmi = $kategori_bmi['id_kategori_bmi'];
                                                    $rekomendasi_makanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rekomendasi_makanan WHERE id_kategori_bmi = '$id_kategori_bmi'"));
                                                    $rekomendasi_olahraga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rekomendasi_olahraga WHERE id_kategori_bmi = '$id_kategori_bmi'"));
                                                ?>
                                                <td class="text-center align-middle">
                                                    <?= $kategori_bmi['kategori']; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <img style="max-width: 200px; max-height: 200px" src="assets/img/makanan/<?= $rekomendasi_makanan['foto']; ?>" alt="<?= $rekomendasi_makanan['makanan']; ?>"><br>
                                                    <?= $rekomendasi_makanan['makanan']; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <img style="max-width: 200px; max-height: 200px" src="assets/img/olahraga/<?= $rekomendasi_olahraga['foto']; ?>" alt="<?= $rekomendasi_olahraga['olahraga']; ?>"><br>
                                                    <?= $rekomendasi_olahraga['olahraga']; ?>
                                                </td>
                                                <td class="text-center align-middle"><?= date('d-m-Y', strtotime($dbtb['tanggal_dibuat'])); ?></td>
                                                <td class="text-center align-middle">
                                                    <a href="ubah_berat_tinggi_badan.php?id_berat_tinggi_badan=<?= $dbtb['id_berat_tinggi_badan']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="hapus_berat_tinggi_badan.php?id_berat_tinggi_badan=<?= $dbtb['id_berat_tinggi_badan']; ?>" data-nama="<?= $dbtb['nama_lengkap']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
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