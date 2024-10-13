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

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-6">
                            <!-- Default Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Alternatif</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <?php
                                        include('../config.php');

                                        $query = mysqli_query($connection, "SELECT max(kode) as kodeTerbesar FROM `alternatif`");
                                        $data = mysqli_fetch_array($query);
                                        $kodealternatif = $data['kodeTerbesar'];

                                        $urutan = (int) substr($kodealternatif, 1, 1);

                                        $urutan++;
                                        $huruf = "A";
                                        $kodealternatif = $huruf . sprintf("%01s", $urutan);
                                        ?>
                                        <label for="Kode" class="form-label">Alternatif</label>
                                        <input type="text" class="form-control" value="<?php echo $kodealternatif ?>" id="kode" aria-describedby="kode" name="kode" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama" class="form-label">Nama Alternatif</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Kriteria (Sub Kriteria)</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    include('../config.php');

                                    // Query untuk mendapatkan semua kriteria
                                    $query = mysqli_query($connection, "SELECT * FROM kriteria ORDER BY idKriteria");

                                    // Loop melalui semua hasil kriteria
                                    while ($result = mysqli_fetch_array($query)) {
                                        // Menghasilkan id dinamis berdasarkan idKriteria untuk setiap elemen
                                        $idKriteriaID = "idKriteria_" . $result['idKriteria'];
                                        $subKriteriaID = "subKriteria_" . $result['idKriteria'];

                                        echo '<div class="mb-3">';

                                        // Menampilkan nama kriteria sebagai label
                                        echo '<label for="kode" class="form-label">' . $result['nama'] . '</label>';

                                        // Input hidden untuk menyimpan idKriteria dengan id dinamis
                                        echo '<input type="hidden" class="form-control" value="' . $result['idKriteria'] . '" id="' . $idKriteriaID . '" name="idKriteria[]" readonly>';

                                        // Query untuk mendapatkan subkriteria berdasarkan idKriteria
                                        $hasil2 = mysqli_query($connection, "SELECT * FROM subkriteria WHERE idKriteria='" . $result['idKriteria'] . "' ORDER BY bobot DESC");

                                        // Select untuk menampilkan subkriteria dengan id dinamis
                                        echo '<select name="subKriteria[]" id="' . $subKriteriaID . '" class="form-control">';
                                        echo '<option value="">-- Pilih SubKriteria --</option>';

                                        // Loop melalui semua hasil subkriteria
                                        while ($baris2 = mysqli_fetch_array($hasil2)) {
                                            echo '<option value="' . $baris2['idSubkriteria'] . '">' . $baris2['nama'] . '</option>';
                                        }

                                        echo '</select>';
                                        echo '</div>';
                                    }
                                    ?>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary btn-alternatif">Simpan</button>
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
    <script src="../js/page/tambah_alternatif.js"></script>

</body>

</html>