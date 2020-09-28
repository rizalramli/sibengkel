<?php
include "koneksi/koneksi.php";
include "koneksi/function.php";
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) {
    header('location:index.php');
} elseif ($_SESSION['akses'] != "Gudang")
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
    <?php include "_partial/navbar_mobile_gudang.php"; ?>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <?php include "_partial/navbar_desktop_gudang.php"; ?>
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
                        include "dashboard/dashboard_gudang.php";
                    }
                    // Tutup Dashboard

                    // Parsing halaman Daftar Barang
                    if ($_GET['halaman'] == 'v_daftarBarang') {
                        include "master/daftar_barang/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_daftarBarang') {
                        include "master/daftar_barang/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_daftarBarang') {
                        include "master/daftar_barang/edit.php";
                    }

                    // Parsing halaman Jenis Barang
                    if ($_GET['halaman'] == 'v_jenisBarang') {
                        include "master/jenis_barang/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_jenisBarang') {
                        include "master/jenis_barang/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_jenisBarang') {
                        include "master/jenis_barang/edit.php";
                    }

                    // Parsing halaman Merk Barang
                    if ($_GET['halaman'] == 'v_merkBarang') {
                        include "master/merk_barang/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_merkBarang') {
                        include "master/merk_barang/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_merkBarang') {
                        include "master/merk_barang/edit.php";
                    }

                    // Parsing halaman Satuan Barang
                    if ($_GET['halaman'] == 'v_satuanBarang') {
                        include "master/satuan_barang/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_satuanBarang') {
                        include "master/satuan_barang/tambah.php";
                    }
                    if ($_GET['halaman'] == 'edit_satuanBarang') {
                        include "master/satuan_barang/edit.php";
                    }

                    // parsing halaman pemasokan
                    if ($_GET['halaman'] == 'v_permintaan_barang') {
                        include "transaksi/permintaan_barang/tampil.php";
                    }
                    if ($_GET['halaman'] == 'add_permintaan_barang') {
                        include "transaksi/permintaan_barang/tambah.php";
                    }
                    if ($_GET['halaman'] == 'v_detail_permintaan_barang') {
                        include "transaksi/permintaan_barang/tampil_detail.php";
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