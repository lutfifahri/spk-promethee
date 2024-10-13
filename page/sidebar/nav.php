<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->

        <img src="../img/logo_arp.png" alt="" width="180">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <?php
    session_start();

    // Mendapatkan URL saat ini
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <?php
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
    ?>
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

    <?php } ?>

    <?php
    if ($_SESSION['level'] == 1) {
    ?>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed <?php echo ($current_page == 'kriteria.php' || $current_page == 'subkriteria.php' || $current_page == 'alternatif.php') ? 'active' : ''; ?>"
                href="#" data-toggle="collapse"
                data-target="#collapseTwo"
                aria-expanded="<?php echo ($current_page == 'kriteria.php' || $current_page == 'subkriteria.php' || $current_page == 'alternatif.php') ? 'true' : 'false'; ?>"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-anchor"></i>
                <span>Components</span>
            </a>
            <div id="collapseTwo" class="collapse <?php echo ($current_page == 'kriteria.php' || $current_page == 'subkriteria.php' || $current_page == 'alternatif.php') ? 'show' : ''; ?>"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master Data</h6>
                    <a class="collapse-item <?php echo ($current_page == 'kriteria.php') ? 'active' : ''; ?>" href="kriteria.php">Data Kriteria</a>
                    <a class="collapse-item <?php echo ($current_page == 'subkriteria.php') ? 'active' : ''; ?>" href="subkriteria.php">Data Subkriteria</a>
                    <a class="collapse-item <?php echo ($current_page == 'alternatif.php') ? 'active' : ''; ?>" href="alternatif.php">Data Alternatif</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'penilaian.php') ? 'active' : ''; ?>" href="penilaian.php">
                <i class="fas fa-fw fa-edit"></i>
                <span>Data Penilaian</span>
            </a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'perhitungan.php') ? 'active' : ''; ?>" href="perhitungan.php">
                <i class="fas fa-fw fa-calculator"></i>
                <span>Data Perhitungan</span>
            </a>
        </li>

    <?php } ?>
    <?php
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
    ?>
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'hasil.php') ? 'active' : ''; ?>" href="hasil.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Data Hasil Akhir</span>
            </a>
        </li>

    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php
    if ($_SESSION['level'] == 1) {
    ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Master User
        </div>

        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'data_profile.php') ? 'active' : ''; ?>" href="data_profile.php">
                <i class="fas fa-fw fa-user"></i>
                <span>Data Profile</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    <?php } ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>