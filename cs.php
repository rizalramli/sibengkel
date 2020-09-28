<?php
include "koneksi/koneksi.php";
include "koneksi/function.php";
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) {
    header('location:index.php');
} 
elseif ($_SESSION['akses'] != "Cs")
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
    <?php include "_partial/navbar_mobile_cs.php"; ?>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <?php include "_partial/navbar_desktop_cs.php"; ?>
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
                        include "dashboard/dashboard_cs.php";
                    }
                    // Tutup Dashboard

                    // Parsing halaman Data Customer
                    if ($_GET['halaman'] == 'v_customer') {
                        include "master/customer/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_customer') {
                        include "master/customer/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_customer') {
                        include "master/customer/edit.php";
                    }

                    // Parsing halaman Jenis Barang
                    if ($_GET['halaman'] == 'v_jenisPegawai') {
                        include "master/jenis_pegawai/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_jenisPegawai') {
                        include "master/jenis_pegawai/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_jenisPegawai') {
                        include "master/jenis_pegawai/edit.php";
                    }

                    // WORK ORDER
                    if ($_GET['halaman'] == 'add_work_order') {
                        include "transaksi/work_order/tambah.php";
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