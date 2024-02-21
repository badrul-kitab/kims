<?php 
include("../config.php");
include("../global_sys.php");

$matrik = $_GET["matrik"];
echo $matrik;

$query_rsCurSem = sprintf("SELECT ps.semester, ps.sesi_sem, p.nama_pel, p.kod_prog,
p.matrik, p.status_pel, sp.namastatus_MY, sp.namastatus_EN
FROM
pel_semester ps
inner join pel_pelajar p on (ps.matrik = p.matrik)
inner Join pilih_status sp ON (p.`status_pel` = sp.kat_status)
WHERE
ps.matrik = '$matrik' AND ps.data_on = '1' AND ps.aktif_semasa='1'");
$rsCurSem = mysqli_query($link, $query_rsCurSem) or die(mysqli_error());
$row_rsCurSem = mysqli_fetch_assoc($rsCurSem);
$totalRows_rsCurSem = mysqli_num_rows($rsCurSem);

$current_sem 				= $row_rsCurSem['semester'];
$current_sesi_sem 			= $row_rsCurSem['sesi_sem'];
$current_status 			= $row_rsCurSem['status_pel'];
$ktr_current_status_bm 		= $row_rsCurSem['namastatus_MY'];
$ktr_current_status_bi 		= $row_rsCurSem['namastatus_EN'];
$nama						= $row_rsCurSem['nama_pel'];
$matrik						= $row_rsCurSem['matrik'];
$prog_id_semasa			    = $row_rsCurSem['kod_prog'];


//check sama ada student ada PK/PM
$query_rsPKPM = sprintf("SELECT id_trans
FROM 
pel_transkrip  WHERE matrik = '$matrik' AND aktif='1' AND semester = '0.0'");
$rsPKPM 			= mysqli_query($link, $query_rsPKPM) or die(mysqli_error());
$row_rsPKPM 		= mysqli_fetch_assoc($rsPKPM);
$totalRows_rsPKPM 	= mysqli_num_rows($rsPKPM);

if($totalRows_rsPKPM>0)
{
	$query_union = "UNION (SELECT t.id_trans, 'PK/PM' AS sesi_sem, t.semester, '-' as `status`, '-' as KETERANGAN, 0 as  sem_value, t.prog_id as prog_id 
	FROM pel_transkrip t where t.matrik='$matrik' AND t.semester='0.0' AND t.aktif='1')";
}
else
{
    $query_union = '';
}

$query_rsPljrSem = sprintf("(SELECT
'-' as id_trans,
ps.sesi_sem,
ps.semester,
ps.`kodstatus_pel`,
sp.namastatus_MY,
(ps.semester * 1.0)  as sem_value,
ps.prog_id AS prog_id
FROM
pel_semester ps
inner Join pilih_status sp ON (ps.`kodstatus_pel` = sp.kat_status)
WHERE ps.matrik = '$matrik' AND ps.data_on='1')
$query_union 
ORDER BY ps.prog_id='$prog_id_semasa' DESC, sem_value ASC" );
$rsPljrSem = mysqli_query($link, $query_rsPljrSem) or die(mysqli_error());
$row_rsPljrSem = mysqli_fetch_assoc($rsPljrSem);
$totalRows_rsPljrSem = mysqli_num_rows($rsPljrSem);

//echo $query_rsPljrSem
function getKodSesiData($link)
{
    //fetch Kod Sesi data
    $result = $link->query("SELECT kod_sesi FROM sesi_akademik ORDER BY kod_sesi desc");
    return $result;
}
?>
<!-- include the interface design from cari-profile-pelajar-detail -->
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

<>
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
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <?php
                                $sql = "SELECT * FROM pel_pelajar INNER JOIN prog_program ON pel_pelajar.kod_prog = prog_program.kod_prog WHERE pel_pelajar.matrik= '$matrik'";
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
                            <!-- <ul class="nav nav-tabs nav-tabs-bordered" id="myTab">
                                <li class="nav-item">
                                    <a class="nav-link"  href="Cari-profile-pelajar-detail.php?matrik=<?= urlencode($matrik) ?>" data-bs-target="#maklumat-pelajar"> Maklumat Pelajar </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"  href="Cari-profile-pelajar-detail.php?matrik=<?= urlencode($matrik) ?>" data-bs-target="#kursus-semasa"> Kursus Diambil </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"  href="Cari-profile-pelajar-detail.php?matrik=<?= urlencode($matrik) ?>"> Rekod Pengajian </a>
                                </li>
                                <li>
                                    <button id="tab-keputusan" class="nav-link active" data-bs-toggle="tab" data-bs-target="keputusan"> Keputusan Peperiksaan </button>
                                </li>
                            </ul> -->
<ul class="nav nav-tabs nav-tabs-bordered" id="myTab">
    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0);" onclick="changeTab('maklumat-pelajar')">Maklumat Pelajar</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0);" onclick="changeTab('kursus-semasa')">Kursus Diambil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0);" onclick="changeTab('rekod-pengajian')">Rekod Pengajian</a>
    </li>
    <li>
        <button id="tab-keputusan" class="nav-link active" data-bs-toggle="tab" data-bs-target="#keputusan">Keputusan Peperiksaan</button>
    </li>
</ul>

                    </div>
                        <div class="tab-pane fade show active profile-overview" id="keputusan">
                            <div class="card-body">
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
                                <table class="table">
                                <!-- <h5 class="table-header"> Kursus Diambil Semester Semasa </h5> -->
                                    <thead>
                                        <tr>
                                            <th scope="col"> # </th>
                                            <th scope="col"> Sesi </th>
                                            <th scope="col"> Program </th>
                                            <th scope="col"> Semester </th>
                                            <th scope="col"> Status </th>
                                            <th scope="col"> PNG </th>
                                            <th scope="col"> PNGK </th>
                                            <th scope="col"> Keputusan </th>
                                            <th scope="col"> Student View </th>
                                            <th scope="col"> Cetak </th>
                                            <!-- <th scope="col"> Drop Kursus </th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
<?php 
$bil=1; 
do { 
$papar_stud  = '&#10005;';
$sesi_sem 	 = $row_rsPljrSem['sesi_sem'];
$semester		 = $row_rsPljrSem['semester'];
$prog_id	= $row_rsPljrSem['prog_id'];
$ktr_status  = $row_rsPljrSem['namastatus_MY'];
$id_trans  = $row_rsPljrSem['id_trans'];


if($sesi_sem=='PK/PM' || $sesi_sem=='SPECIAL EXAM' )
{
	$query_rstran = sprintf("SELECT id_trans, semester, png, pngk, kptsan_sms, status_view, jana_slip, prog_id
	FROM 
	pel_transkrip WHERE id_trans = '$id_trans'");	
}
else
{
	$query_rstran = sprintf("SELECT id_trans, semester, png, pngk, kptsan_sms, status_view, jana_slip, prog_id
	FROM 
	pel_transkrip WHERE matrik = '$matrik' AND sesi_sem='$sesi_sem' and semester='$semester' and aktif='1'");
}

//echo $query_rstran."<br>";
$rstran 			= mysqli_query($link, $query_rstran) or die(mysqli_error());
$row_rstran 		= mysqli_fetch_assoc($rstran);
$totalRows_rstran 	= mysqli_num_rows($rstran);

if($totalRows_rstran> 0)
{
	$sem_trans 		= $row_rstran['semester'];
	$png		 	= $row_rstran['png'];
	$pngk		 	= $row_rstran['pngk'];
	$kptsan_sms 	= $row_rstran['kptsan_sms'];
	$release		= $row_rstran['status_view'];
	$id_trans		= $row_rstran['id_trans'];
	
	if($release==1) { $papar_stud = '&#10004'; }
	$link_result	= '<a href="result.print.php?trans='.$id_trans.'" target="_blank">View</a>';
}
else
{
	$sem_trans 		= '-';
	$png		 	= '-';
	$pngk		 	= '-';
	$kptsan_sms 	= 'NO RESULT FOUND';
	$papar_stud 	= '-';
	$link_result	= '-';
}

?>
<tr>
    <td scope="col"><?php echo $bil++; ?>.</td>
    <td scope="col"><?php echo $sesi_sem; ?></td>
    <td scope="col"><?php echo $prog_id;?></td>
    <td scope="col"><?php echo $semester; ?></td>
    <td scope="col"><?php echo $ktr_status; ?></td>
    <td scope="col"><?php echo $png; ?></td>
    <td scope="col"><?php echo $pngk; ?></td>
    <td scope="col"><?php echo $kptsan_sms; ?></td>
    <td scope="col"><?php echo $papar_stud; ?></td>
    <td scope="col"><?php echo $link_result; ?></td>
  </tr>
</tbody>
<?php }while($row_rsPljrSem = mysqli_fetch_assoc($rsPljrSem)); ?>
</table>
                                    
                            </div>
                        </div>
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
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <!-- Add this to include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


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

<script>
    function changeTab(sectionId) {
        var matrik = '<?= urlencode($matrik) ?>';
        window.location.href = 'Cari-profile-pelajar-detail.php?matrik=' + matrik + '#' + sectionId;
    }
</script>



</body>

</html>












<!-- insert this part in the interface but do include the previous section as well. the section later on need to be separated into different pages -->
<!-- <H3 align="center">EXAMINATION RESULT</H3>
<table width="80%" align="center" style="border:solid" id="jadual">
<thead>
  <tr></tr>
</thead>
<thead>
  <tr>
    <th width="27%" align="left">Name</th>
    <th width="2%" align="center">:</th>
    <th width="71%" align="left"><?php echo $nama; ?></th>
  </tr>
  <tr>
    <th align="left">Matric Number</th>
    <th align="center">:</th>
    <th align="left"><?php echo $matrik; ?></th>
  </tr>
  <tr>
    <th align="left">Current Academic Session</th>
    <th align="center">:</th>
    <th align="left"><?php echo $current_sesi_sem; ?></th>
  </tr>
  <tr>
    <th align="left">Current Status</th>
    <th align="center">:</th>
    <th align="left"><?php echo $current_status." : ".$ktr_current_status_bm." / ".$ktr_current_status_bi; ?></th>
  </tr>
  <tr>
    <th align="left">Current Semester</th>
    <th align="center">:</th>
    <th align="left"><?php echo $current_sem; ?></th>
  </tr>
</thead>
</table>
<br>
<?php if($totalRows_rsPljrSem > 0) { ?>
<table width="100%" id="jadual" border="1">
<thead>
  <tr>
    <th>#</th>
    <th>SESSION</th>
    <th>PROGAM</th>
    <th>SEMESTER</th>
    <th>STATUS</th>
    <th>PNG</th>
    <th>PNGK</th>
    <th>RESULT</th>
    <th>STUDENT VIEW</th>
    <th>PRINT</th>
  </tr>
</thead>
<?php $bil=1; do { 
$papar_stud  = '&#10005;';
$sesi_sem 	 = $row_rsPljrSem['sesi_sem'];
$semester		 = $row_rsPljrSem['semester'];
$prog_id	= $row_rsPljrSem['prog_id'];
$ktr_status  = $row_rsPljrSem['namastatus_MY'];
$id_trans  = $row_rsPljrSem['id_trans'];


if($sesi_sem=='PK/PM' || $sesi_sem=='SPECIAL EXAM' )
{
	$query_rstran = sprintf("SELECT id_trans, semester, png, pngk, kptsan_sms, status_view, jana_slip, prog_id
	FROM 
	pel_transkrip WHERE id_trans = '$id_trans'");	
}
else
{
	$query_rstran = sprintf("SELECT id_trans, semester, png, pngk, kptsan_sms, status_view, jana_slip, prog_id
	FROM 
	pel_transkrip WHERE matrik = '$matrik' AND sesi_sem='$sesi_sem' and semester='$semester' and aktif='1'");
}

//echo $query_rstran."<br>";
$rstran 			= mysqli_query($link, $query_rstran) or die(mysqli_error());
$row_rstran 		= mysqli_fetch_assoc($rstran);
$totalRows_rstran 	= mysqli_num_rows($rstran);

if($totalRows_rstran> 0)
{
	$sem_trans 		= $row_rstran['semester'];
	$png		 	= $row_rstran['png'];
	$pngk		 	= $row_rstran['pngk'];
	$kptsan_sms 	= $row_rstran['kptsan_sms'];
	$release		= $row_rstran['status_view'];
	$id_trans		= $row_rstran['id_trans'];
	
	if($release==1) { $papar_stud = '&#10004'; }
	$link_result	= '<a href="/../../kitab_test/result.print.php?trans='.$id_trans.'" target="_blank">View</a>';
}
else
{
	$sem_trans 		= '-';
	$png		 	= '-';
	$pngk		 	= '-';
	$kptsan_sms 	= 'NO RESULT FOUND';
	$papar_stud 	= '-';
	$link_result	= '-';
}

?>
  <tr align="center">
    <td><?php echo $bil++; ?>.</td>
    <td><?php echo $sesi_sem; ?></td>
    <td><?php echo $prog_id;?></td>
    <td><?php echo $semester; ?></td>
    <td><?php echo $ktr_status; ?></td>
    <td><?php echo $png; ?></td>
    <td><?php echo $pngk; ?></td>
    <td><?php echo $kptsan_sms; ?></td>
    <td><?php echo $papar_stud; ?></td>
    <td><?php echo $link_result; ?></td>
  </tr>
<?php }while($row_rsPljrSem = mysqli_fetch_assoc($rsPljrSem)); ?>
</table>
<?php } else { echo '<p align="center">-No Record Found-</p>'; } ?> -->