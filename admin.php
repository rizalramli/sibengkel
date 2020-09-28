<?php
include "koneksi/koneksi.php";
include "koneksi/function.php";
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) {
    header('location:index.php');
} elseif ($_SESSION['akses'] != "Admin")
{
    echo "<script>alert('Maaf Anda tidak berhak mengakses halaman ini')</script>";
    echo "<script>window.history.back();</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "_partial/head.php"; ?>

    <!-- modernizr JS
        ============================================ -->
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <?php include "_partial/header.php"; ?>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <?php include "_partial/navbar_mobile_admin.php"; ?>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <?php include "_partial/navbar_desktop_admin.php"; ?>
    <!-- Main Menu area End-->
    <!-- Breadcomb area Start-->
    <!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                    include 'koneksi/koneksi.php';

                    // Dashboard
                    if (!isset($_GET['halaman'])) {
                        error_reporting(0);
                    }
                    if ($_GET['halaman'] == 'dashboard') {
                        include "dashboard/dashboard_admin.php";
                    }
                    // Tutup Dashboard

                    // Parsing halaman Pegawai
                    if ($_GET['halaman'] == 'v_pegawai') {
                        include "master/pegawai/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_pegawai') {
                        include "master/pegawai/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_pegawai') {
                        include "master/pegawai/edit.php";
                    }

                    // Parsing halaman Jenis Pegawai
                    if ($_GET['halaman'] == 'v_jenis_pegawai') {
                        include "master/jenis_pegawai/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_jenis_pegawai') {
                        include "master/jenis_pegawai/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_jenis_pegawai') {
                        include "master/jenis_pegawai/edit.php";
                    }

                    // Parsing halaman Mekanik
                    if ($_GET['halaman'] == 'v_mekanik') {
                        include "master/mekanik/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_mekanik') {
                        include "master/mekanik/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_mekanik') {
                        include "master/mekanik/edit.php";
                    }

                    // parsing halaman Penggajian
                    if ($_GET['halaman'] == 'v_penggajian') {
                        include "penggajian/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_penggajian') {
                        include "penggajian/tambah.php";
                    }
                    if ($_GET['halaman'] == 'v_detail_penggajian') {
                        include "penggajian/tampil_detail.php";
                    }

                    if ($_GET['halaman'] == 'laporan_transaksi') {
                        include "transaksi/laporan_transaksi/tampil.php";
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->
    <!-- Start Footer area-->
    <?php include "_partial/footer.php"; ?>
    <!-- End Footer area-->
    <!-- jquery
        ============================================ -->
    <?php include "_partial/javascript.php"; ?>

</body>

</html>