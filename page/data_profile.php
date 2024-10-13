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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Profile</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12">

                            <?php
                            // Memastikan koneksi ke database sudah dibuat di 'config.php'
                            include '../config.php';
                            $query = mysqli_query($connection, "SELECT * FROM `users` WHERE `id` = '" . $_SESSION['id'] . "' ");
                            $result = mysqli_fetch_array($query);

                            ?>

                            <!-- Default Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Data Profile</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="hidden" class="form-control" value="<?php echo $result['id'] ?>" id="id" name="id">
                                        <input type="text" class="form-control" value="<?php echo $result['nama'] ?>" id="nama" name="nama">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" value="<?php echo $result['email'] ?>" id="email" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama" class="form-label">Password</label>
                                        <input type="text" class="form-control" id="password" name="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-profile">Simpan</button>
                                    <input type='button' value='Kembali' class="btn btn-info" onclick='history.back(-1)' />
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
    <script src="../js/page/update_profile.js"></script>
</body>

</html>