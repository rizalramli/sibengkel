<?php
include "koneksi/koneksi.php";
include "koneksi/function.php";
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) {
    header('location:index.php');
} elseif ($_SESSION['akses'] != "Kasir") {
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
    <?php include "_partial/navbar_mobile_kasir.php"; ?>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <?php include "_partial/navbar_desktop_kasir.php"; ?>
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
                        include "dashboard/dashboard_kasir.php";
                    }
                    // Tutup Dashboard

                    // Parsing halaman service
                    if ($_GET['halaman'] == 'v_tarifService') {
                        include "master/tarif_service/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_tarifService') {
                        include "master/tarif_service/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_tarifService') {
                        include "master/tarif_service/edit.php";
                    }

                    // Parsing halaman suplier
                    if ($_GET['halaman'] == 'v_suplier') {
                        include "master/suplier/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_suplier') {
                        include "master/suplier/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_suplier') {
                        include "master/suplier/edit.php";
                    }

                    // Parsing halaman laporan transaksi
                    if ($_GET['halaman'] == 'laporan_transaksi') {
                        include "transaksi/laporan_transaksi/tampil.php";
                    }

                    // parsing halaman transaksi

                    // parsing halaman transaksi
                    if ($_GET['halaman'] == 'transaksi_penjualan_service') {
                        include "transaksi/penjualan/penjualan_service.php";
                    }
                    if ($_GET['halaman'] == 'transaksi_penjualan_barang') {
                        include "transaksi/penjualan/penjualan_barang.php";
                    }

                    if ($_GET['halaman'] == 'v_work_order') {
                        include "transaksi/work_order/tampil.php";
                    }
                    if ($_GET['halaman'] == 'v_data_transaksi') {
                        include "transaksi/data_transaksi/tampil.php";
                    }
                    if ($_GET['halaman'] == 'detail_transaksi') {
                        include "transaksi/data_transaksi/detail.php";
                    }

                    // parsing halaman pemasokan
                    if ($_GET['halaman'] == 'v_transaksi_pembelian') {
                        include "transaksi/pembelian/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_transaksi_pembelian') {
                        include "transaksi/pembelian/tambah.php";
                    }
                    // parsing halaman data pemasokan
                    if ($_GET['halaman'] == 'v_data_transaksi_pembelian') {
                        include "transaksi/pembelian/tampil_data.php";
                    }
                    if ($_GET['halaman'] == 'detail_transaksi_pembelian') {
                        include "transaksi/pembelian/tampil_detail.php";
                    }

                    if ($_GET['halaman'] == 'sukses') {
                        include "transaksi/penjualan/sukses_transaksi.php";
                    }

                    if ($_GET['halaman'] == 'sukses_pembelian') {
                        include "transaksi/pembelian/sukses_pembelian.php";
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