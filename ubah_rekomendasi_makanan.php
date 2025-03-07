<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_rekomendasi_makanan = $_GET['id_rekomendasi_makanan'];
    $data_rekomendasi_makanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rekomendasi_makanan INNER JOIN kategori_bmi ON rekomendasi_makanan.id_kategori_bmi = kategori_bmi.id_kategori_bmi WHERE id_rekomendasi_makanan = '$id_rekomendasi_makanan'"));

    $kategori_bmi = mysqli_query($conn, "SELECT * FROM kategori_bmi ORDER BY bmi_min ASC");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Ubah Rekomendasi Makanan - <?= $data_rekomendasi_makanan['makanan']; ?></title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnUbahKategoriBmi'])) {
            $id_kategori_bmi = htmlspecialchars($_POST['id_kategori_bmi']);
            $makanan = htmlspecialchars($_POST['makanan']);
            $deskripsi = htmlspecialchars($_POST['deskripsi']);

            $foto = $data_rekomendasi_makanan['foto'];
            $foto_new = $_FILES['foto']['name'];
            if ($foto_new != '') {
                $acc_extension = array('png', 'jpg', 'jpeg', 'gif');
                $extension = explode('.', $foto_new);
                $extension_lower = strtolower(end($extension));
                $size = $_FILES['foto']['size'];
                $file_tmp = $_FILES['foto']['tmp_name'];     

                if ($size > 5253120) {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Ukuran file terlalu besar!',
                                confirmButtonText: 'Kembali'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.history.back();
                                }
                            });
                        </script>
                    ";
                    exit;
                }

                if(!in_array($extension_lower, $acc_extension))
                {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'File yang di upload bukan gambar!',
                                confirmButtonText: 'Kembali'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.history.back();
                                }
                            });
                        </script>
                    ";
                    exit;
                }

                $image_path = 'assets/img/makanan/' . $foto;
                
                if ($foto != 'default.jpg' && $foto != '') {
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $foto = uniqid() . '_' . time() . '_' . $foto_new;
            }

            $update_rekomendasi_makanan = mysqli_query($conn, "UPDATE rekomendasi_makanan SET id_kategori_bmi = '$id_kategori_bmi', makanan = '$makanan', deskripsi = '$deskripsi', foto = '$foto' WHERE id_rekomendasi_makanan = '$id_rekomendasi_makanan'");

            if ($update_rekomendasi_makanan) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Rekomendasi Makanan $makanan berhasil diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                if ($foto_new != '') {
                    $file_tmp = $_FILES['foto']['tmp_name'];     
                    move_uploaded_file($file_tmp, 'assets/img/makanan/' . $foto);
                }

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Rekomendasi Makanan " . $makanan . " berhasil diubah!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'rekomendasi_makanan.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Rekomendasi Makanan $makanan gagal diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'KategoriBmi " . $makanan . " gagal diubah!'
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
                            <h3 class="mb-0">Ubah Rekomendasi Makanan - <?= $data_rekomendasi_makanan['makanan']; ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="rekomendasi_makanan.php">Rekomendasi Makanan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Ubah Rekomendasi Makanan
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
                                            <label for="id_kategori_bmi" class="form-label">Kategori</label>
                                            <select class="form-control" id="id_kategori_bmi" name="id_kategori_bmi" required>
                                                <option value="<?= $data_rekomendasi_makanan['id_kategori_bmi']; ?>"><?= $data_rekomendasi_makanan['kategori']; ?></option>
                                                <?php foreach ($kategori_bmi as $dkb): ?>
                                                    <option value="<?= $dkb['id_kategori_bmi']; ?>"><?= $dkb['kategori']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="makanan" class="form-label">Makanan</label>
                                            <textarea class="form-control" id="makanan" name="makanan" required><?= $data_rekomendasi_makanan['makanan']; ?></textarea>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $data_rekomendasi_makanan['deskripsi']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage(event)"> 
                                                <label class="input-group-text" for="foto">Upload</label> 
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnUbahKategoriBmi" class="btn btn-primary">Submit</button>
                                    </div> 
                                </form> <!--end::Form-->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-body text-center">
                                    <h5 class="form-label">Preview Foto</h5>
                                    <div class="row justify-content-between">
                                        <div class="col">
                                            <img id="preview-img" class="img-fluid rounded-3" src="assets/img/makanan/<?= $data_rekomendasi_makanan['foto']; ?>" alt="<?= $data_rekomendasi_makanan['foto']; ?>">
                                        </div>
                                    </div>  
                                </div>
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