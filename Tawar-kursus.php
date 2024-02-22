<?php
include("../config.php");
function getKodSesiData($link)
{
    // Replace with your code to fetch Kod Sesi data
    $result = $link->query("SELECT kod_sesi FROM sesi_akademik ORDER BY kod_sesi DESC;");
    return $result;
}

// Function to fetch Program data from the database
function getProgramData($link)
{
    // Replace with your code to fetch Program data
    $result = $link->query("SELECT namaprog_MY FROM prog_program");
    return $result;
}

if (isset($_POST['submit'])) {
    // Get selected values
    $selectedKodSesi = $_POST['kodsesi'];
    $selectedProgram = $_POST['program'];

    echo $selectedKodSesi;
    echo $selectedProgram;

    if ($selectedProgram == "DIPLOMA KAUNSELING") {
        $kodprog = "DKS1";
    } elseif ($selectedProgram == "DIPLOMA PENGAJIAN ISLAM") {
        $kodprog = "DPI1";
    } elseif ($selectedProgram == "DIPLOMA PENGURUSAN HALAL") {
        $kodprog = "DPH1";
    } elseif ($selectedProgram == "DIPLOMA PENTADBIRAN MUAMALAT") {
        $kodprog = "DPM1";
    } elseif ($selectedProgram == "DIPLOMA TAHFIZ AL-QURAN") {
        $kodprog = "DT";
    } elseif ($selectedProgram == "DIPLOMA SYARIAH") {
        $kodprog = "DS";
    } elseif ($selectedProgram == "DIPLOMA KEWANGAN") {
        $kodprog = "DK1";
    } elseif ($selectedProgram == "SIJIL PENGAJIAN TAHFIZ AL QURAN") {
        $kodprog = "SPTA1";
    } elseif ($selectedProgram == "SIJIL PENGAJIAN BAHASA AL QURAN") {
        $kodprog = "SBA1";
    } elseif ($selectedProgram == "DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM") {
        $kodprog = "DPISI1";
    } elseif ($selectedProgram == "SIJIL USULUDDIN") {
        $kodprog = "SU1";
    }


    $kursusList = $link->query("SELECT
    *
    FROM
        progstruk_kursus
    INNER JOIN kur_kursus ON progstruk_kursus.kodkursus = kur_kursus.kodkursus
    WHERE
        kod_progstruk LIKE '%$kodprog%'
    ORDER BY
	    sem ASC;");
}

// if (isset($_POST['Tawar'])) {
// todo: Array problem somewhere, need to check
$selectedKodKurusArr = $_POST['tawar_checkbox_kod_kursus'];
if (!empty($selectedKodKurusArr)) {
    // Iterate through selected kod kursus (checkboxes) from the query and execute the statement for each course
    for ($i = 0; $i < count($selectedKodKurusArr); $i++) {
        $kod_kursus = $selectedKodKurusArr[$i];
        //$selectedKodSesi = $_POST['selectedKodSesi'];
        $kodprog = $_POST['kodprog'];

        if ($kodprog == "DKS1") {
            $kod_prog = "DKS";
        } elseif ($kodprog == "DPI1") {
            $kod_prog = "DPI";
        } elseif ($kodprog == "DPH1") {
            $kod_prog = "DPH";
        } elseif ($kodprog == "DPM1") {
            $kod_prog = "DPM";
        } elseif ($kodprog == "DT") {
            $kod_prog = "DT";
        } elseif ($kodprog == "DS") {
            $kod_prog = "DS";
        } elseif ($kodprog == "DK1") {
            $kod_prog = "DK";
        } elseif ($kodprog == "SPTA1") {
            $kod_prog = "SPTA";
        } elseif ($kodprog == "SBA1") {
            $kod_prog = "SBA";
        } elseif ($kodprog == "DPISI1") {
            $kod_prog = "DPISI";
        } elseif ($kodprog == "SU1") {
            $kod_prog = "SU";
        }

        print_r($selectedKodSesi);
        die();
        // Prepare the SQL statement template to update pel_kursus
        $sqlTemplate = "INSERT INTO kur_tawar (sesi_sem,kodkursus,kod_prog,est_bilpel,twr_on,user_add,dt_add,user_upd,dt_upd) VALUES ('$selectedKodSesi','$kod_kursus','$kod_prog',0,1,'sysAdm',CURRENT_TIMESTAMP,NULL,NULL)";

        //Prepare the statement
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
    $redirect_url = "Tawar-kursus.php";
    header("Location: $redirect_url");
} else {
    echo "No checkboxes were selected.";
}




?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon" />
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet" />

    <style>
        .enrol-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .kodsesi {
            width: 100px;
            margin-right: 10px;
        }

        .enrol {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #fff;
        }
    </style>

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="../index.php" class="logo d-flex align-items-center">
                <img src="../assets/img/logo.png" alt="" />
                <span class="d-none d-lg-block">KIMS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle" href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" />
                        <span class="d-none d-md-block dropdown-toggle ps-2">Badrul Hisham</span> </a>
                    <!-- End Profile Iamge Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Badrul Hisham</h6>
                            <span>Pegawai Teknologi Maklumat</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>Maklumat Diri</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Perlukan Bantuan?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Keluar</span>
                            </a>
                        </li>
                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Akademik</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="Enrol-semester.php">
                            <i class="bi bi-circle"></i><span>Enrol Semester</span>
                        </a>
                    </li>
                    <li>
                        <a href="Daftar-kursus.php">
                            <i class="bi bi-circle"></i><span>Daftar Kursus</span>
                        </a>
                    </li>
                    <li>
                        <a href="Add-drop.php">
                            <i class="bi bi-circle"></i><span>Drop Kursus</span>
                        </a>
                    </li>
                    <li>
                        <a href="Analisa.php">
                            <i class="bi bi-circle"></i><span>Analisa</span>
                        </a>
                    </li>
                    <li>
                        <a href="Cari-profile-pelajar.php">
                            <i class="bi bi-circle"></i><span>Carian Pelajar</span>
                        </a>
                    </li>
                    <li>
                        <a href="Peperiksaan.php">
                            <i class="bi bi-circle"></i><span>Peperiksaan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- End Components Nav -->
            <!-- End Blank Page Nav -->
        </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Penawaran Kursus</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="Tawar-kursus.php">Penarawaran Kursus</a></li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <br />
                            <br />
                            <div>
                                <form action="" method="post">
                                    <div class="enrol-container">
                                        <label for="kodsesi" class="kodsesi">Kod Sesi:</label>
                                        <select class="enrol" id="kodsesi" name="kodsesi">
                                            <?php
                                            $kodSesiData = getKodSesiData($link);
                                            while ($row = $kodSesiData->fetch_assoc()) {
                                                $selected = ($row['kod_sesi'] == $selectedKodSesi) ? 'selected' : '';
                                                echo "<option value='" . $row['kod_sesi'] . "' $selected>" . $row['kod_sesi'] . "</option>";
                                                // echo "<option value='" . $row['kod_sesi'] . "'>" . $row['kod_sesi'] . "</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="enrol-container">
                                        <label for="program" class="kodsesi">Program:</label>
                                        <select class="enrol" id="program" name="program">
                                            <?php
                                            $programData = getProgramData($link);
                                            while ($row = $programData->fetch_assoc()) {
                                                $selected = ($row['namaprog_MY'] == $selectedProgram) ? 'selected' : '';
                                                echo "<option value='" . $row['namaprog_MY'] . "' $selected>" . $row['namaprog_MY'] . "</option>";
                                                // echo "<option value='" . $row['namaprog_MY'] . "'>" . $row['namaprog_MY'] . "</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <input class="btn btn-primary" type="submit" name="submit">
                                </form>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <?php
                                        $bil = 1;
                                        $total_kredit = 0;
                                        if (isset($kursusList) && $kursusList->num_rows > 0) : ?>
                                            <input style="margin: 5px;" type="checkbox" onclick="toggle(this);" />Pilih Semua<br />
                                            <table class="table" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th> &nbsp; </th>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Kod Kursus</th>
                                                        <th scope="col">Nama Kursus</th>
                                                        <th scope="col">Struktur Program</th>
                                                        <th scope="col">Semester</th>
                                                        <th scope="col">Kredit</th>
                                                        <th scope="col">Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($kursus = $kursusList->fetch_assoc()) :
                                                        $kod_progstruk = $kursus['kod_progstruk'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="tawar_checkbox_kod_kursus[]" value="<?= $kursus['kodkursus']; ?>">
                                                            </td>
                                                            <td scope="col"><?= $bil++; ?></td>
                                                            <td scope="col"><?= $kursus['kodkursus']; ?></td>
                                                            <td scope="col"><?= $kursus['namakur_MY']; ?></td>
                                                            <td scope="col"><?= $kod_progstruk; ?></td>
                                                            <td scope="col"><?= $kursus['sem']; ?></td>
                                                            <td scope="col"><?= $kursus['kredit']; ?></td>
                                                            <!-- todo: pass value link ke next page -->
                                                            <td scope="col"><button class="btn btn-primary" href="test.php">Edit</button>
                                                        </tr>

                                                    <?php
                                                    // $total_kredit += (int)$student['kredit'];
                                                    endwhile; ?>
                                                </tbody>
                                            </table>

                                            <!-- Button to update kodstatus_pel -->
                                            <input class="btn btn-primary" type="submit" value="Tawar">
                                            <input type="hidden" name="selectedProgram" value="<?= $selectedProgram ?>">
                                            <input type="hidden" name="selectedKodSesi" value="<?= $selectedKodSesi ?>">
                                            <input type="hidden" name="kodprog" value="<?= $kod_progstruk ?>">


                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer id="footer" class="footer fixed">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->

            <!-- You can delete the links only if you purchased the pro version. -->

            <!-- Licensing information: https://bootstrapmade.com/license/ -->

            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->

            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
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
