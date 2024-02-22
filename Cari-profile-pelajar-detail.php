<?php
include("../config.php");

$matric = $_GET["matrik"];
$sem = '';

$query_sem = "SELECT semester, sesi_sem, aktif_semasa FROM pel_semester WHERE matrik = '$matric' AND aktif_semasa='1' ORDER BY semester DESC LIMIT 1;";
$result_sem = $link->query($query_sem);
if ($result_sem->num_rows > 0) {
    while ($row_sem = $result_sem->fetch_assoc()) {
        $sem = intval($row_sem['semester']);
    }
}

// check whether bla bla bla 
$selectedKodKurusArr = $_POST['drop_checkbox_kod_kursus'];
if (!empty($selectedKodKurusArr)) {
    // Iterate through selected kod kursus (checkboxes) from the query and execute the statement for each course
    for ($i = 0; $i < count($selectedKodKurusArr); $i++) {
        $kod_kursus = $selectedKodKurusArr[$i];
        // Prepare the SQL statement template to update pel_kursus
        $sqlTemplate = "UPDATE pel_kursus SET data_on = 0 WHERE matrik='$matric' AND kodkursus= '$kod_kursus'";

        // Prepare the statement
        if ($stmt = mysqli_prepare($link, $sqlTemplate)) {
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Success
            } else {
                echo "Oops! Something went wrong. Please try again later.";
                echo "Error: " . $stmt . "<br>" . mysqli_error($link);
            }
        }
    }
    // // Close statement
    mysqli_stmt_close($stmt);

    // Close connection

    // // Redirect back to the page with the matrik value
    // $redirect_url = "Cari-profile-pelajar-detail.php?matrik=" . urlencode($matric);
    // header("Location: $redirect_url");
} else {
    echo "No checkboxes were selected.";
}


function getKodSesiData($link)
{
    //fetch Kod Sesi data
    $result = $link->query("SELECT kod_sesi FROM sesi_akademik ORDER BY kod_sesi desc");
    return $result;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title> Dashboard - NiceAdmin Bootstrap Template </title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!--Favicons-->
    <link href="../assets/img/favicon.png" rel="icon" />
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!--Google Fonts-->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!--Vendor CSS Files-->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!--Template Main CSS File-->
    <link href="../assets/css/style.css" rel="stylesheet" />

    <!--=======================================================* Template Name: NiceAdmin * Updated: Sep 18 2023 with Bootstrap v5 .3 .2 * Template URL: https: //bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ * Author: BootstrapMade.com * License: https: //bootstrapmade.com/license/========================================================-->

</head>

<body>
    <!--=======Header=======-->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="../index.php" class="logo d-flex align-items-center">
                <img src="../assets/img/logo.png" alt="" />
                <span class="d-none d-lg-block"> KIMS </span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn">
            </i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle" href="#">
                        <i class="bi bi-search">
                        </i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" />
                        <span class="d-none d-md-block dropdown-toggle ps-2"> Badrul Hisham </span> </a>
                    <!--End Profile Iamge Icon-->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6> Badrul Hisham </h6>
                            <span> Pegawai Teknologi Maklumat </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person">
                                </i>
                                <span> Maklumat Diri </span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle">
                                </i>
                                <span> Perlukan Bantuan ? </span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right">
                                </i>
                                <span> Log Keluar </span>
                            </a>
                        </li>
                    </ul>
                    <!--End Profile Dropdown Items-->
                </li>
            </ul>
        </nav>
    </header>
    <!--=======Sidebar=======-->

    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <i class="bi bi-grid">
                    </i>
                    <span> Dashboard </span>
                </a>
            </li>
            <!--End Dashboard Nav-->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide">
                    </i><span>Akademik</span>
                    <i class="bi bi-chevron-down ms-auto">
                    </i>
                </a>
                <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="Enrol-semester.php">
                            <i class="bi bi-circle">
                            </i><span>Enrol Semester</span>
                        </a>
                    </li>
                    <li>
                        <a href="Daftar-kursus.php">
                            <i class="bi bi-circle">
                            </i><span>Daftar Kursus</span>
                        </a>
                    </li>
                    <li>
                        <a href="Add-drop.php">
                            <i class="bi bi-circle">
                            </i><span>Drop Kursus</span>
                        </a>
                    </li>
                    <li>
                        <a href="Analisa.php">
                            <i class="bi bi-circle">
                            </i><span>Analisa</span>
                        </a>
                    </li>
                    <li>
                        <a href="Cari-profile-pelajar.php">
                            <i class="bi bi-circle">
                            </i><span>Carian Pelajar</span>
                        </a>
                    </li>
                    <li>
                        <a href="Peperiksaan.php">
                            <i class="bi bi-circle">
                            </i><span>Peperiksaan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--End Components Nav-->
            <!--End Blank Page Nav-->
        </ul>
    </aside>
    <!--End Sidebar-->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1> Maklumat Diri Pelajar </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="../index.php"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="Cari-profile-pelajar.php"> Carian Pelajar </a>
                    </li>
                </ol>
            </nav>
        </div>
        <!--End Page Title-->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-12">
                <!-- <div class="col-xl-4"> -->
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <?php
                                $sql = "SELECT * FROM pel_pelajar INNER JOIN prog_program ON pel_pelajar.kod_prog = prog_program.kod_prog WHERE pel_pelajar.matrik= '$matric'";
                                $result = $link->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {

                                        $Gambar = '../assets/gambar/pelajar/' . $row['matrik'] . '.png';
                                ?>
              <img src="<?php echo $Gambar?>" alt="Profile" class="rounded-circle">
                                              
              <h2><?= $row['nama_pel']; ?></h2>
              <h3>PELAJAR</h3>
              
                                <?php }
                                }
                                ?>
            </div>
          </div>
                    <div class="card">
                        <div class="card-body pt-3">
                            <!--Bordered Tabs-->
                            <ul class="nav nav-tabs nav-tabs-bordered" id="myTab">
                                <li class="nav-item">
                                    <button id="tab-maklumat-pelajar" class="nav-link active" data-bs-toggle="tab" data-bs-target="#maklumat-pelajar"> Maklumat Pelajar </button>
                                </li>
                                <li class="nav-item">
                                    <button id="tab-kursus-semasa" class="nav-link" data-bs-toggle="tab" data-bs-target="#kursus-semasa"> Kursus Diambil </button>
                                </li>
                                <li class="nav-item">
                                    <button id="tab-rekod-pengajian" class="nav-link" data-bs-toggle="tab" data-bs-target="#rekod-pengajian"> Rekod Pengajian </button>
                                </li>
                                <li>
                                    <a href="Cari-profile-pelajar-peperiksaan.php?matrik=<?= urlencode($matric) ?>" class="nav-link"> Peperiksaan</a>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">
                                <?php
                                $sql = "SELECT * FROM pel_pelajar INNER JOIN prog_program ON pel_pelajar.kod_prog = prog_program.kod_prog WHERE pel_pelajar.matrik= '$matric'";
                                $result = $link->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row2 = $result->fetch_assoc()) {
                                ?>

                                        <div class="tab-pane fade show active profile-overview" id="maklumat-pelajar">
                                            <h5 class="card-title"> About </h5>
                                            <p class="small fst-italic"> Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus.Tempora libero non est unde veniam est qui dolor.Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit.Fuga sequi sed ea saepe at unde. </p>
                                            <h5 class="card-title"> Profile Details </h5>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label "> Nama Pelajar </div>
                                                <div class="col-lg-9 col-md-8"> <?= $row2['nama_pel']; ?> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"> No.Kad Pengenalan </div>
                                                <div class="col-lg-9 col-md-8"> <?= $row2['kppass_pel']; ?> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"> No.Telefon </div>
                                                <div class="col-lg-9 col-md-8"> <?= $row2['notel_pel']; ?> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"> Nombor Matrik </div>
                                                <div class="col-lg-9 col-md-8"> <?= $row2['matrik']; ?> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"> Program </div>
                                                <div class="col-lg-9 col-md-8"> <?= $row2['namaprog_MY']; ?> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"> Kod Program </div>
                                                <div class="col-lg-9 col-md-8"> <?= $row2['kod_prog']; ?> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"> Kod Program Struktur </div>
                                                <div class="col-lg-9 col-md-8"> <?= $row2['kod_progstruk']; ?> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"> Sesi Daftar </div>
                                                <div class="col-lg-9 col-md-8"> <?= $row2['sesi_daftar']; ?> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"> Sesi Konvokesyen </div>
                                                <div class="col-lg-9 col-md-8"> <?= $row2['sesikonvo']; ?> </div>
                                            </div>

                                            <a href="Cari-profile-pelajar-edit-maklumat-diri.php?matrik=<?= urlencode($matric) ?>" class="btn btn-primary"> Edit Maklumat </a>
                                        </div>

                                <?php }
                                }
                                ?>

                                <div class="tab-pane fade pt-3" id="kursus-semasa">
                                    <form action='Cari-profile-pelajar-detail.php?matrik=<?= urlencode($matric) ?>' method="post">
                                        <div class="enrol-container">
                                            <label for="kodsesi" class="kodsesi"> Kod Sesi: </label>
                                            <select class="enrol" id="kodsesi" name="kodsesi">
                                                <?php

                                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kodsesi'])) {
                                                    $selectedKodSesi = $_POST['kodsesi'];
                                                }

                                                $isSelectAll = ($selectedKodSesi == null || empty($selectedKodSesi)) ? "selected" : "";
                                                echo "<option value='' $isSelectAll>All semester</option>";

                                                $kodSesiData = getKodSesiData($link);
                                                while ($row = $kodSesiData->fetch_assoc()) {
                                                    $selected = ($row['kod_sesi'] == $selectedKodSesi) ? 'selected' : '';
                                                    echo "<option value='" . $row['kod_sesi'] . "' $selected>" . $row['kod_sesi'] . "</option>";
                                                }

                                                ?>
                                            </select>
                                            <input class="btn btn-primary" type="submit" value="Pilih">
                                        </div>
                                    </form>
                                    <div class="card-body">
                                        <form action="Cari-profile-pelajar-detail.php?matrik=<?= urlencode($matric) ?>" method="post">
                                            <table class="table">
                                                <!-- <h5 class="table-header"> Kursus Diambil Semester Semasa </h5> -->
                                                <thead>
                                                    <tr>
                                                        <th> &nbsp; </th>
                                                        <th scope="col"> # </th>
                                                        <th scope="col"> Kod Kursus </th>
                                                        <th scope="col"> Nama Kursus </th>
                                                        <th scope="col"> Semester </th>
                                                        <th scope="col"> Kredit </th>
                                                        <th scope="col"> Sesi </th>
                                                        <th scope="col"> Catatan </th>
                                                        <!-- <th scope="col"> Drop Kursus </th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $selectedKodSesiQuery = "";

                                                    if ($selectedKodSesi != null && !empty($selectedKodSesi)) {
                                                        $selectedKodSesiQuery =  "AND C.sesi_sem = '$selectedKodSesi'";
                                                    }

                                                    $bil = 1;
                                                    $total_kredit = 0;
                                                    $sql = "SELECT
                                                    *
                                                FROM
                                                    kur_tawar as A
                                                    INNER JOIN kur_kursus as B ON A.kodkursus = B.kodkursus
                                                    INNER JOIN pel_kursus as C ON B.kodkursus = C.kodkursus
                                                    INNER JOIN progstruk_kursus as D ON C.kodkursus = D.kodkursus
                                                WHERE
                                                    C.matrik = '$matric'
                                                    AND C.data_on = 1
                                                    AND D.sem = '$sem'
                                                    $selectedKodSesiQuery
                                                GROUP BY
                                                    C.kodkursus";

                                                    $result = $link->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        // output data of each row
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?> <tr>
                                                                <td>
                                                                    <input type="checkbox" name="drop_checkbox_kod_kursus[]" value="<?= $row['kodkursus']; ?>">
                                                                </td>
                                                                <td scope="col"> <?= $bil++; ?> </td>
                                                                <td scope="col"> <?= $row['kodkursus']; ?></td>
                                                                <td scope="col"> <?= $row['namakur_MY']; ?> </td>
                                                                <td scope="col"> <?= $row['sem']; ?> </td>
                                                                <td scope="col"> <?= $row['kredit']; ?> </td>
                                                                <td scope="col"> <?= $row['sesi_sem']; ?> </td>
                                                                <td scope="col"> <?= $row['catatan']; ?> </td>
                                                            </tr>

                                                    <?php
                                                            $total_kredit = $total_kredit + $row['kredit'];
                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td> &nbsp; </td>
                                                        <td> &nbsp; </td>
                                                        <td> &nbsp; </td>
                                                        <td> &nbsp; </td>
                                                        <td>
                                                            <strong> JUMLAH KREDIT </strong>
                                                        </td>
                                                        <td> <?= $total_kredit; ?> </td>
                                                        <td> &nbsp; </td>
                                                        <td>
                                                            <a href="Slip-daftar-kursus.php?matrik=<?= urlencode($matric) ?>&semester=<?= urlencode($sem) ?>" class="btn btn-primary"> Cetak </a>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                            <a href="Cari-profile-pelajar-tambah-kursus.php?matrik=<?= urlencode($matric) ?>" class="btn btn-primary"> Tambah Kursus </a>
                                            <input class="btn btn-danger" type="submit" value="Drop" style="float: right;">
                                        </form>
                                        <!--End Table with stripped rows-->
                                    </div>
                                </div>
                                <div class="tab-pane fade pt-3" id="rekod-pengajian">
                                    <div class="card-body">
                                        <table class="table">
                                            <!-- <h5 class="table-header"> Rekod Pengajian </h5> -->
                                            <thead>
                                                <tr>
                                                    <th scope="col"> # </th>
                                                    <th scope="col"> Matrik </th>
                                                    <th scope="col"> Sesi Semester </th>
                                                    <th scope="col"> Semester </th>
                                                    <th scope="col"> Kod Status </th>
                                                    <th scope="col"> Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $bil = 1;
                                                $sql = "SELECT
                                                pel_semester.matrik,
                                                pel_semester.semester,
                                                pel_semester.sesi_sem,
                                                pel_semester.kodstatus_pel,
                                                pilih_status.namastatus_MY,
                                                CASE
                                                    WHEN LENGTH(pel_semester.kodstatus_pel) = 1 THEN pilih_status.kat_status
                                                    WHEN LENGTH(pel_semester.kodstatus_pel) = 2 THEN pilih_status.kodstatus
                                                    ELSE NULL
                                                END AS selected_status
                                            FROM
                                                pel_semester
                                                LEFT JOIN pilih_status ON (LENGTH(pel_semester.kodstatus_pel) = 1 AND pel_semester.kodstatus_pel = pilih_status.kat_status)
                                                                       OR (LENGTH(pel_semester.kodstatus_pel) = 2 AND pel_semester.kodstatus_pel = pilih_status.kodstatus)
                                            WHERE
                                                pel_semester.matrik = '$matric'
                                            ORDER BY
                                                semester ASC;";
                                                $result = $link->query($sql);
                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                                    while ($row = $result->fetch_assoc()) {
                                                        $status_pel = $row['kodstatus_pel'];
                                                ?> <tr>
                                                            <td scope="col"> <?= $bil++; ?> </td>
                                                            <td scope="col"> <?= $row['matrik']; ?> <br>
                                                            </td>
                                                            <td scope="col"> <?= $row['sesi_sem']; ?> </td>
                                                            <td scope="col"> <?= $row['semester']; ?> </td>
                                                            <td scope="col"> <?= $row['kodstatus_pel']; ?> </td>
                                                            <td scope="col"> <?= $row['namastatus_MY']; ?> </td>
                                                        </tr>
                                                <?php }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <!--End Table with stripped rows-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Bordered Tabs-->
                </div>
            </div>
        </section>
    </main>
    <!--=======Footer=======-->
    <footer id="footer" class="footer fixed">
        <div class="copyright">
            &
            copy;
            Copyright <strong>
                <span> NiceAdmin </span></strong> .All Rights Reserved </div>
        <div class="credits">
            <!--All the links in the footer should remain intact.-->

            <!--You can delete the links only if you purchased the pro version.-->

            <!--Licensing information: https: //bootstrapmade.com/license/ -->

            <!--Purchase the pro version with working PHP / AJAX contact form: https: //bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->

            Designed by <a href="https://bootstrapmade.com/"> BootstrapMade </a>
        </div>
    </footer>
    <!--End Footer-->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short">
        </i></a>

    <!--Vendor JS Files-->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js">
    </script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

    <script>
        function displayBiasiswa(suratB) {

            // alert(suratB);

            window.open(suratB, "_blank", "width=1000,height=700");

        }
    </script>

    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>

</body>

</html>

<?php
// auto navigate to "Kursus Diambil" tab when "kodsesi" exist
if (isset($_POST['kodsesi']) || $_POST['drop_checkbox_kod_kursus']) {
    echo '
    <script type="text/JavaScript">  
     new bootstrap.Tab(document.querySelector("#tab-kursus-semasa")).show();
    </script>
     ';
}
mysqli_close($link);

?>
