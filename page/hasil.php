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
                        <h1 class="h3 mb-0 text-gray-800">Data hasil Akhir</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Default Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Data Hasil</h6>
                                </div>
                                <div class="card-body">
                                    <a href="../laporan.php" target="_blank" class="btn btn-sm btn-primary">Laporan PDF</a>
                                    <br>
                                    <br>
                                    <div class="table-responsive">
                                        <?php
                                        include('../config.php');

                                        $query = mysqli_query($connection, "
    SELECT h.*, a.kode, a.nama AS nama_alternatif
    FROM hasil h
    INNER JOIN alternatif a ON h.idAlternatif = a.id
    
    ORDER BY a.kode ASC
");

                                        echo '<table class="table table-bordered" id="hasilTable" width="100%" cellspacing="0">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th scope="col">Rangking</th>';
                                        echo '<th scope="col">Kode Alternatif</th>';
                                        echo '<th scope="col">Nama Alternatif</th>';
                                        echo '<th scope="col">Bobot</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';

                                        if ($query) {
                                            while ($result = mysqli_fetch_array($query)) {
                                                echo '<tr>';
                                                echo '<td>' . $result['rangking'] . '</td>';
                                                echo '<td>' . $result['kode'] . '</td>';
                                                echo '<td>' . $result['nama_alternatif'] . '</td>';
                                                echo '<td>' . $result['bobot'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="6">Tidak ada data yang ditemukan</td></tr>';
                                        }

                                        echo '</tbody>';
                                        echo '</table>';

                                        // Jangan lupa untuk menutup koneksi setelah selesai digunakan
                                        mysqli_close($connection);
                                        ?>

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