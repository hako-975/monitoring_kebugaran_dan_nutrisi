<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $rekomendasi_olahraga = mysqli_query($conn, "SELECT * FROM rekomendasi_olahraga INNER JOIN kategori_bmi ON rekomendasi_olahraga.id_kategori_bmi = kategori_bmi.id_kategori_bmi ORDER BY kategori_bmi.id_kategori_bmi ASC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Rekomendasi Olahraga</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-dumbbell"></i> Rekomendasi Olahraga</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Rekomendasi Olahraga
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
                                <a href="tambah_rekomendasi_olahraga.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Rekomendasi Olahraga</a>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Kategori</th>
                                            <th class="text-center align-middle">Olahraga</th>
                                            <th class="text-center align-middle">Deskripsi</th>
                                            <th class="text-center align-middle">Gambar</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($rekomendasi_olahraga as $drm): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                <td class="align-middle"><?= $drm['kategori']; ?></td>
                                                <td class="align-middle"><?= $drm['olahraga']; ?></td>
                                                <td class="align-middle"><?= $drm['deskripsi']; ?></td>
                                                <td class="align-middle"><img style="max-width: 200px; max-height: 200px" src="assets/img/olahraga/<?= $drm['foto']; ?>" alt="<?= $drm['foto']; ?>"></td>
                                                <td class="text-center align-middle">
                                                    <a href="ubah_rekomendasi_olahraga.php?id_rekomendasi_olahraga=<?= $drm['id_rekomendasi_olahraga']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="hapus_rekomendasi_olahraga.php?id_rekomendasi_olahraga=<?= $drm['id_rekomendasi_olahraga']; ?>" data-nama="<?= $drm['kategori']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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