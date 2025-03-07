<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $kategori_bmi = mysqli_query($conn, "SELECT * FROM kategori_bmi ORDER BY bmi_min ASC");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Tambah Rekomendasi Olahraga</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahRekomendasiOlahraga'])) {
            $id_kategori_bmi = htmlspecialchars($_POST['id_kategori_bmi']);
            $olahraga = htmlspecialchars($_POST['olahraga']);
            $deskripsi = htmlspecialchars($_POST['deskripsi']);

            $foto = $_FILES['foto']['name'];
            if ($foto != '') {
                $acc_extension = array('png', 'jpg', 'jpeg', 'gif');
                $extension = explode('.', $foto);
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

                $foto = uniqid() . '_' . time() . '_' . $foto;
            } else {
                $foto = 'default.jpg';
            }


            $insert_kategori_bmi = mysqli_query($conn, "INSERT INTO rekomendasi_olahraga VALUES ('', '$id_kategori_bmi', '$olahraga', '$deskripsi', '$foto')");

            if ($insert_kategori_bmi) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Rekomendasi Olahraga $olahraga berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                if ($foto != '') {
                    $file_tmp = $_FILES['foto']['tmp_name'];     
                    move_uploaded_file($file_tmp, 'assets/img/olahraga/' . $foto);
                }

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Rekomendasi Olahraga " . $olahraga . " berhasil ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'rekomendasi_olahraga.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Rekomendasi Olahraga $olahraga gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Rekomendasi Olahraga " . $olahraga . " gagal ditambahkan!'
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
                            <h3 class="mb-0"><i class="fas  fa-fw fa-plus"></i> Tambah Rekomendasi Olahraga</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="rekomendasi_olahraga.php">Rekomendasi Olahraga</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Rekomendasi Olahraga
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
                                            <label for="id_kategori_bmi" class="form-label">Kategori BMI</label>
                                            <select class="form-select" id="id_kategori_bmi" name="id_kategori_bmi" required>
                                                <option value="0">--- Pilih Kategori BMI ---</option>
                                                <?php foreach ($kategori_bmi as $dkb): ?>
                                                    <option value="<?= $dkb['id_kategori_bmi'] ?>"><?= $dkb['kategori'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="olahraga" class="form-label">Olahraga</label>
                                            <textarea class="form-control" id="olahraga" name="olahraga" required></textarea>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto Olahraga</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage(event)"> 
                                                <label class="input-group-text" for="foto">Upload</label> 
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnTambahRekomendasiOlahraga" class="btn btn-primary">Submit</button>
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
                                            <img id="preview-img" class="img-fluid rounded-3" src="assets/img/profiles/default.jpg" alt="default.jpg" style="max-height: 300px;">
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