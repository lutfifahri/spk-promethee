<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php

include('./sidebar/header.php');
session_start();

if (!$_SESSION['id']) {
    header("location: index.php");
}

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include('./sidebar/nav.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['email'] ?></span>
                                <!-- <img class="img-profile rounded-circle" src="img/undraw_profile.svg"> -->
                                <i class="fas fa-fw fa-user"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Penilaian</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Default Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Data Penilaian</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Kode</th>
                                                    <th scope="col">Alternatif</th>
                                                    <?php
                                                    include('../config.php');
                                                    $query = mysqli_query($connection, "SELECT * FROM `kriteria` ORDER BY `idKriteria` ");
                                                    while ($result = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <th scope="col"><?php echo $result['nama'] ?></th>

                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Koneksi Database
                                                include('../config.php');
                                                $query = mysqli_query($connection, "SELECT * FROM `alternatif`  ORDER BY id ASC");
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $id = $row['id'];
                                                    $kode = $row['kode'];
                                                    $nama = $row['nama'];

                                                    // Mulai baris tabel untuk setiap alternatif
                                                    echo "<tr>";
                                                    echo "<td>$kode</td>";
                                                    echo "<td>$nama</td>";

                                                    // Menampilkan nilai subkriteria dalam satu baris
                                                    $query1 = mysqli_query($connection, "SELECT s.nama as sub FROM `subkriteria` s, `perhitungan` kp WHERE kp.idAlternatif='" . $id . "' AND s.idSubkriteria=kp.idSubkriteria ORDER BY kp.idAlternatif ASC");
                                                    while ($result2 = mysqli_fetch_array($query1)) {
                                                        echo "<td>{$result2['sub']}</td>";
                                                    }

                                                    // Tutup baris tabel untuk setiap alternatif
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include('./sidebar/footer.php');
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</body>

</html>