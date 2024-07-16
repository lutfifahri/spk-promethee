<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<?php

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
        include('./sidebar/header.php');
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
                        <h1 class="h3 mb-0 text-gray-800">Perhitungan</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Default Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Data Kriteria</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
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
                                                /** Hapus datanya */
                                                $sql = mysqli_query($connection, "TRUNCATE TABLE `hasil`");
                                                /** selesai */

                                                $query = mysqli_query($connection, "SELECT * FROM `alternatif`");
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $id = $row['id'];
                                                    $kode = $row['kode'];
                                                    $nama = $row['nama'];

                                                    // Mulai baris tabel untuk setiap alternatif
                                                    echo "<tr>";
                                                    echo "<td>$kode</td>";

                                                    // Menampilkan nilai subkriteria dalam satu baris
                                                    $query1 = mysqli_query($connection, "SELECT s.bobot as sub FROM `subkriteria` s, `perhitungan` kp WHERE kp.idAlternatif='" . $id . "' AND s.idSubkriteria=kp.idSubkriteria ORDER BY kp.idKriteria");
                                                    while ($result2 = mysqli_fetch_array($query1)) {
                                                        echo "<td>{$result2['sub']}</td>";
                                                    }

                                                    // Tutup baris tabel untuk setiap alternatif
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <h3>Nilai Preferensi</h3>
                                        <br>
                                        <?php
                                        include('../config.php');

                                        // Step 1: Fetch all criteria and their weights
                                        $kriteria = [];
                                        $query = mysqli_query($connection, "SELECT * FROM `kriteria` ORDER BY `idKriteria`");
                                        while ($result = mysqli_fetch_array($query)) {
                                            $kriteria[] = $result;
                                        }

                                        // Step 2: Fetch all alternatives and their sub-criteria values
                                        $alternatif = [];
                                        $query = mysqli_query($connection, "SELECT * FROM `alternatif`");
                                        while ($row = mysqli_fetch_array($query)) {
                                            $id = $row['id'];
                                            $kode = $row['kode'];
                                            $nama = $row['nama'];

                                            $subkriteria = [];
                                            $query1 = mysqli_query($connection, "SELECT s.bobot as sub, kp.idKriteria FROM `subkriteria` s, `perhitungan` kp WHERE kp.idAlternatif='$id' AND s.idSubkriteria=kp.idSubkriteria ORDER BY kp.idKriteria");
                                            while ($result2 = mysqli_fetch_array($query1)) {
                                                $subkriteria[$result2['idKriteria']] = $result2['sub'];
                                            }

                                            $alternatif[] = [
                                                'id' => $id,
                                                'kode' => $kode,
                                                'nama' => $nama,
                                                'subkriteria' => $subkriteria
                                            ];
                                        }

                                        // Step 3: Calculate preference values
                                        $preferences = [];

                                        for ($i = 0; $i < count($alternatif); $i++) {
                                            for ($j = 0; $j < count($alternatif); $j++) {
                                                if ($i != $j) {
                                                    foreach ($kriteria as $k) {
                                                        $idKriteria = $k['idKriteria'];
                                                        $diff = $alternatif[$i]['subkriteria'][$idKriteria] - $alternatif[$j]['subkriteria'][$idKriteria];

                                                        // Usual preference function
                                                        $preference = ($diff > 0) ? 1 : 0;

                                                        $preferences[$alternatif[$i]['id']][$alternatif[$j]['id']][$idKriteria] = $preference;
                                                    }
                                                }
                                            }
                                        }

                                        // Step 4: Display preferences
                                        echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th scope="col">Alternatif 1</th>';
                                        echo '<th scope="col">Alternatif 2</th>';
                                        foreach ($kriteria as $k) {
                                            echo '<th scope="col">' . $k['nama'] . '</th>';
                                        }
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';

                                        foreach ($alternatif as $alt1) {
                                            foreach ($alternatif as $alt2) {
                                                if ($alt1['id'] != $alt2['id']) {
                                                    echo '<tr>';
                                                    echo '<td>' . $alt1['kode'] . '</td>';
                                                    echo '<td>' . $alt2['kode'] . '</td>';
                                                    foreach ($kriteria as $k) {
                                                        $idKriteria = $k['idKriteria'];
                                                        echo '<td>' . $preferences[$alt1['id']][$alt2['id']][$idKriteria] . '</td>';
                                                    }
                                                    echo '</tr>';
                                                }
                                            }
                                        }

                                        echo '</tbody>';
                                        echo '</table>';
                                        ?>
                                        <hr>
                                        <h3>Nilai Indexs Preferensi</h3>
                                        <?php
                                        include('../config.php');

                                        // Step 1: Fetch all criteria and their weights
                                        $kriteria = [];
                                        $query = mysqli_query($connection, "SELECT * FROM `kriteria` ORDER BY `idKriteria`");
                                        while ($result = mysqli_fetch_array($query)) {
                                            $kriteria[] = $result;
                                        }

                                        // Step 2: Fetch all alternatives and their sub-criteria values
                                        $alternatif = [];
                                        $query = mysqli_query($connection, "SELECT * FROM `alternatif`");
                                        while ($row = mysqli_fetch_array($query)) {
                                            $id = $row['id'];
                                            $kode = $row['kode'];
                                            $nama = $row['nama'];

                                            $subkriteria = [];
                                            $query1 = mysqli_query($connection, "SELECT s.bobot as sub FROM `subkriteria` s, `perhitungan` kp WHERE kp.idAlternatif='$id' AND s.idSubkriteria=kp.idSubkriteria ORDER BY kp.idKriteria");
                                            while ($result2 = mysqli_fetch_array($query1)) {
                                                $subkriteria[] = $result2['sub'];
                                            }

                                            $alternatif[] = [
                                                'id' => $id,
                                                'kode' => $kode,
                                                'nama' => $nama,
                                                'subkriteria' => $subkriteria
                                            ];
                                        }

                                        // Step 3: Calculate preference values
                                        $preferences = [];

                                        foreach ($alternatif as $alt1) {
                                            foreach ($alternatif as $alt2) {
                                                if ($alt1['id'] != $alt2['id']) {
                                                    $preference = 0;
                                                    for ($i = 0; $i < count($kriteria); $i++) {
                                                        $diff = $alt1['subkriteria'][$i] - $alt2['subkriteria'][$i];

                                                        // Here, we use a usual preference function for simplicity
                                                        $preference += ($diff > 0) ? 1 : 0;
                                                    }
                                                    $preferences[$alt1['id']][$alt2['id']] = $preference / count($kriteria);
                                                }
                                            }
                                        }

                                        // Display preferences in table format
                                        echo '<table class="table table-bordered" id="preferencesTable">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th scope="col">Alternatif</th>';
                                        foreach ($alternatif as $alt) {
                                            echo '<th scope="col">' . $alt['kode'] . '</th>';
                                        }
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';

                                        foreach ($alternatif as $alt1) {
                                            echo '<tr>';
                                            echo '<th scope="row">' . $alt1['kode'] . '</th>';
                                            foreach ($alternatif as $alt2) {
                                                if ($alt1['id'] != $alt2['id']) {
                                                    echo '<td>' . number_format($preferences[$alt1['id']][$alt2['id']], 2) . '</td>';
                                                } else {
                                                    echo '<td>-</td>'; // Alternatif tidak membandingkan dirinya sendiri
                                                }
                                            }
                                            echo '</tr>';
                                        }

                                        echo '</tbody>';
                                        echo '</table>';
                                        ?>

                                        <hr>
                                        <h3>Nilai Leaving Flow , Nilai Entering Flow, Nilai Net Flow</h3>
                                        <?php
                                        include('../config.php');

                                        // Step 1: Fetch all criteria and their weights
                                        $kriteria = [];
                                        $query = mysqli_query($connection, "SELECT * FROM `kriteria` ORDER BY `idKriteria`");
                                        while ($result = mysqli_fetch_array($query)) {
                                            $kriteria[] = $result;
                                        }

                                        // Step 2: Fetch all alternatives and their sub-criteria values
                                        $alternatif = [];
                                        $query = mysqli_query($connection, "SELECT * FROM `alternatif`");
                                        while ($row = mysqli_fetch_array($query)) {
                                            $id = $row['id'];
                                            $kode = $row['kode'];
                                            $nama = $row['nama'];

                                            $subkriteria = [];
                                            $query1 = mysqli_query($connection, "SELECT s.bobot as sub, kp.idKriteria FROM `subkriteria` s, `perhitungan` kp WHERE kp.idAlternatif='$id' AND s.idSubkriteria=kp.idSubkriteria ORDER BY kp.idKriteria");
                                            while ($result2 = mysqli_fetch_array($query1)) {
                                                $subkriteria[$result2['idKriteria']] = $result2['sub'];
                                            }

                                            $alternatif[] = [
                                                'id' => $id,
                                                'kode' => $kode,
                                                'nama' => $nama,
                                                'subkriteria' => $subkriteria
                                            ];
                                        }

                                        // Step 3: Calculate preference values
                                        $preferences = [];
                                        for ($i = 0; $i < count($alternatif); $i++) {
                                            for ($j = 0; $j < count($alternatif); $j++) {
                                                if ($i != $j) {
                                                    foreach ($kriteria as $k) {
                                                        $idKriteria = $k['idKriteria'];
                                                        $diff = $alternatif[$i]['subkriteria'][$idKriteria] - $alternatif[$j]['subkriteria'][$idKriteria];

                                                        // Usual preference function
                                                        $preference = ($diff > 0) ? 1 : 0;

                                                        $preferences[$alternatif[$i]['id']][$alternatif[$j]['id']][$idKriteria] = $preference;
                                                    }
                                                }
                                            }
                                        }

                                        // Step 4: Calculate preference index
                                        $preference_index = [];
                                        foreach ($alternatif as $alt1) {
                                            foreach ($alternatif as $alt2) {
                                                if ($alt1['id'] != $alt2['id']) {
                                                    $sum = 0;
                                                    foreach ($kriteria as $k) {
                                                        $idKriteria = $k['idKriteria'];
                                                        $sum += $preferences[$alt1['id']][$alt2['id']][$idKriteria];
                                                    }
                                                    $preference_index[$alt1['id']][$alt2['id']] = $sum / count($kriteria);
                                                }
                                            }
                                        }

                                        // Step 5: Calculate leaving flow, entering flow, and net flow
                                        $leaving_flow = [];
                                        $entering_flow = [];
                                        $net_flow = [];

                                        foreach ($alternatif as $alt1) {
                                            $leaving_flow[$alt1['id']] = 0;
                                            $entering_flow[$alt1['id']] = 0;
                                        }

                                        foreach ($alternatif as $alt1) {
                                            foreach ($alternatif as $alt2) {
                                                if ($alt1['id'] != $alt2['id']) {
                                                    $leaving_flow[$alt1['id']] += $preference_index[$alt1['id']][$alt2['id']];
                                                    $entering_flow[$alt1['id']] += $preference_index[$alt2['id']][$alt1['id']];
                                                }
                                            }
                                            $leaving_flow[$alt1['id']] /= (count($alternatif) - 1);
                                            $entering_flow[$alt1['id']] /= (count($alternatif) - 1);
                                            $net_flow[$alt1['id']] = $leaving_flow[$alt1['id']] - $entering_flow[$alt1['id']];
                                        }

                                        // Step 6: Display preference index, leaving flow, entering flow, and net flow
                                        echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th scope="col">Alternatif</th>';
                                        echo '<th scope="col">Leaving Flow</th>';
                                        echo '<th scope="col">Entering Flow</th>';
                                        echo '<th scope="col">Net Flow</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';

                                        foreach ($alternatif as $alt) {
                                            echo '<tr>';
                                            echo '<td>' . $alt['kode'] . '</td>';
                                            echo '<td>' . $leaving_flow[$alt['id']] . '</td>';
                                            echo '<td>' . $entering_flow[$alt['id']] . '</td>';
                                            echo '<td>' . $net_flow[$alt['id']] . '</td>';
                                            echo '</tr>';
                                        }

                                        echo '</tbody>';
                                        echo '</table>';
                                        ?>
                                        <hr>
                                        <h3>Perhitungan Rangking</h3>
                                        <?php
                                        include('../config.php');

                                        // Step 1: Fetch all criteria and their weights
                                        $kriteria = [];
                                        $query = mysqli_query($connection, "SELECT * FROM `kriteria` ORDER BY `idKriteria`");
                                        while ($result = mysqli_fetch_array($query)) {
                                            $kriteria[] = $result;
                                        }

                                        // Step 2: Fetch all alternatives and their sub-criteria values
                                        $alternatif = [];
                                        $query = mysqli_query($connection, "SELECT * FROM `alternatif`");
                                        while ($row = mysqli_fetch_array($query)) {
                                            $id = $row['id'];
                                            $kode = $row['kode'];
                                            $nama = $row['nama'];

                                            $subkriteria = [];
                                            $query1 = mysqli_query($connection, "SELECT s.bobot as sub FROM `subkriteria` s, `perhitungan` kp WHERE kp.idAlternatif='$id' AND s.idSubkriteria=kp.idSubkriteria ORDER BY kp.idKriteria");
                                            while ($result2 = mysqli_fetch_array($query1)) {
                                                $subkriteria[] = $result2['sub'];
                                            }

                                            $alternatif[] = [
                                                'id' => $id,
                                                'kode' => $kode,
                                                'nama' => $nama,
                                                'subkriteria' => $subkriteria
                                            ];
                                        }

                                        // Step 3: Calculate preference values
                                        $preferences = [];
                                        foreach ($alternatif as $alt1) {
                                            foreach ($alternatif as $alt2) {
                                                if ($alt1['id'] != $alt2['id']) {
                                                    $preference = 0;
                                                    for ($i = 0; $i < count($kriteria); $i++) {
                                                        $diff = $alt1['subkriteria'][$i] - $alt2['subkriteria'][$i];

                                                        // Here, we use a usual preference function for simplicity
                                                        $preference += ($diff > 0) ? 1 : 0;
                                                    }
                                                    $preferences[$alt1['id']][$alt2['id']] = $preference / count($kriteria);
                                                }
                                            }
                                        }

                                        // Step 4: Calculate leaving flow, entering flow, and net flow
                                        $leaving_flow = [];
                                        $entering_flow = [];
                                        $net_flow = [];

                                        foreach ($alternatif as $alt1) {
                                            $leaving_flow[$alt1['id']] = 0;
                                            $entering_flow[$alt1['id']] = 0;
                                        }

                                        foreach ($alternatif as $alt1) {
                                            foreach ($alternatif as $alt2) {
                                                if ($alt1['id'] != $alt2['id']) {
                                                    $leaving_flow[$alt1['id']] += $preferences[$alt1['id']][$alt2['id']];
                                                    $entering_flow[$alt1['id']] += $preferences[$alt2['id']][$alt1['id']];
                                                }
                                            }
                                            $leaving_flow[$alt1['id']] /= (count($alternatif) - 1);
                                            $entering_flow[$alt1['id']] /= (count($alternatif) - 1);
                                            $net_flow[$alt1['id']] = $leaving_flow[$alt1['id']] - $entering_flow[$alt1['id']];
                                        }

                                        // Step 5: Rank alternatives based on net flow
                                        $ranking = [];
                                        foreach ($alternatif as $alt) {
                                            $ranking[] = [
                                                'id' => $alt['id'],
                                                'kode' => $alt['kode'],
                                                'nama' => $alt['nama'],
                                                'net_flow' => $net_flow[$alt['id']]
                                            ];
                                        }

                                        // Sort the ranking array by net flow descending
                                        usort($ranking, function ($a, $b) {
                                            return $b['net_flow'] <=> $a['net_flow'];
                                        });

                                        // Step 6: Display results with rankings
                                        echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th scope="col">Rank</th>';
                                        echo '<th scope="col">Alternatif</th>';
                                        echo '<th scope="col">Nama</th>';
                                        echo '<th scope="col">Net Flow</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';

                                        $rank = 1;
                                        foreach ($ranking as $ranked_alt) {

                                            echo '<tr>';
                                            echo '<td>' . $rank . '</td>';
                                            echo '<td>' . $ranked_alt['kode'] . '</td>';
                                            echo '<td>' . $ranked_alt['nama'] . '</td>';
                                            echo '<td>' . $ranked_alt['net_flow'] . '</td>';
                                            echo '</tr>';

                                            /** Simpan data ke table hasil */
                                            $idnya = $ranked_alt['id'];
                                            $nilai = $ranked_alt['net_flow'];
                                            $sql = "INSERT INTO `hasil` (`rangking`, `idAlternatif`, `bobot`) VALUES ('$rank', '$idnya','$nilai')
                                                    ON DUPLICATE KEY UPDATE `bobot` = VALUES(`bobot`)
                                                    ";
                                            mysqli_query($connection, $sql);
                                            $rank++;
                                        }

                                        echo '</tbody>';
                                        echo '</table>';
                                        ?>
                                        <hr>

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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>