<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_kategori_bmi = $_GET['id_kategori_bmi'];
    $data_kategori_bmi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kategori_bmi WHERE id_kategori_bmi = '$id_kategori_bmi'"));

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Ubah Kategori BMI - <?= $data_kategori_bmi['kategori']; ?></title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnUbahKategoriBmi'])) {
            $kategori = htmlspecialchars($_POST['kategori']);
            $bmi_min = htmlspecialchars($_POST['bmi_min']);
            $bmi_max = htmlspecialchars($_POST['bmi_max']);

            $update_kategori_bmi = mysqli_query($conn, "UPDATE kategori_bmi SET kategori = '$kategori', bmi_min = '$bmi_min', bmi_max = '$bmi_max' WHERE id_kategori_bmi = '$id_kategori_bmi'");

            if ($update_kategori_bmi) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kategori BMI $kategori berhasil diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Kategori BMI " . $kategori . " berhasil diubah!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'kategori_bmi.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kategori BMI $kategori gagal diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'KategoriBmi " . $kategori . " gagal diubah!'
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
                            <h3 class="mb-0">Ubah Kategori BMI - <?= $data_kategori_bmi['kategori']; ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="kategori_bmi.php">Kategori BMI</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Ubah Kategori BMI
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
                                            <label for="kategori" class="form-label">Kategori</label>
                                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $data_kategori_bmi['kategori']; ?>" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="bmi_min" class="form-label">BMI Min</label>
                                            <input type="number" class="form-control" id="bmi_min" name="bmi_min" value="<?= $data_kategori_bmi['bmi_min']; ?>" min="0" step=".01" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="bmi_max" class="form-label">BMI Max</label>
                                            <input type="number" class="form-control" id="bmi_max" name="bmi_max" value="<?= $data_kategori_bmi['bmi_max']; ?>" min="0" step=".01" required>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnUbahKategoriBmi" class="btn btn-primary">Submit</button>
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