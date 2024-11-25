<aside class="app-sidebar bg-primary-subtle shadow" data-bs-theme="dark">
    <div class="sidebar-brand"> 
        <a href="index.php" class="brand-link"> 
            <img src="assets/img/properties/logo.png" alt="Logo" class="brand-image rounded-circle">
            <span class="brand-text fw-light small">Sistem Monitoring <br> Kebugaran & Nutrisi</span>
        </a> 
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> 
                    <a href="index.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/monitoring_kebugaran_dan_nutrisi/index.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item"> 
                    <a href="berat_tinggi_badan.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/monitoring_kebugaran_dan_nutrisi/berat_tinggi_badan.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-weight"></i>
                        <p>Berat Tinggi Badan</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="pelanggan.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/monitoring_kebugaran_dan_nutrisi/pelanggan.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-users"></i>
                        <p>Pelanggan</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="kategori_bmi.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/monitoring_kebugaran_dan_nutrisi/kategori_bmi.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-solid fa-child"></i>
                        <p>Kategori BMI</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="rekomendasi_makanan.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/monitoring_kebugaran_dan_nutrisi/rekomendasi_makanan.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-carrot"></i>
                        <p>Rekomendasi Makanan</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="rekomendasi_olahraga.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/monitoring_kebugaran_dan_nutrisi/rekomendasi_olahraga.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-dumbbell"></i>
                        <p>Rekomendasi Olahraga</p>
                    </a> 
                </li>
                <!-- <li class="nav-item"> 
                    <a href="laporan.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/monitoring_kebugaran_dan_nutrisi/laporan.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-file-alt"></i>
                        <p>Laporan</p>
                    </a>
                </li> -->
                <hr class="sidebar-divider">
                <li class="nav-item"> 
                    <a href="log.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/monitoring_kebugaran_dan_nutrisi/log.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-history"></i>
                        <p>Log</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div> 
</aside> 