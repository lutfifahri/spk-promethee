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

        <!-- nav -->
        <?php
        include('./sidebar/nav.php');
        ?>
        <!-- End of nav -->

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

                    <?php
                    include('../config.php');
                    $idKriteria = $_GET['idKriteria'];
                    $data = mysqli_query($connection, "SELECT * FROM `kriteria` WHERE idKriteria='$idKriteria'");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"><span><?php echo $d['nama']; ?></span></h1>
                            <a href="../page/tambah_subkriteria.php?idKriteria=<?php echo $d['idKriteria'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-60"></i> Tambah</a>
                        </div>
                    <?php } ?>
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Default Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Data subKriteria</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Bobot</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                /** Kondeksi Database */
                                                include('../config.php');
                                                $idKriteria = $_GET['idKriteria'];
                                                $no = 1;
                                                $query = mysqli_query($connection, "SELECT * FROM `subkriteria` WHERE  `idKriteria` ='" . $idKriteria . "'");
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $row['nama'] ?></td>
                                                        <td><?php echo $row['bobot'] ?></td>
                                                        <td>
                                                            <a href="edit_subkriteria.php?idSubkriteria=<?php echo $row['idSubkriteria'] ?>" class="btn btn-sm btn-primary">
                                                                Edit Kriteria</a>
                                                            <a href="../page/act/hapus_subkriteria.php?idSubkriteria=<?php echo $row['idSubkriteria'] ?>" onclick="return confirm('Apakah anda Yakin ingin Hapus?')" class="btn btn-sm btn-danger">Delete Kriteria</a>
                                                        </td>
                                                    </tr>
                                                <?php  } ?>
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
    <script src="../js/page/tambah_kriteria.js"></script>
</body>

</html>