<?php
include 'koneksi/koneksi.php';
session_start();
$kode_pegawai = $_SESSION['kode_pegawai'];
mysqli_query($koneksi, "UPDATE pegawai SET status_login='0' , session_id = 'kosong' WHERE kode_pegawai='$kode_pegawai'");
session_destroy();
header("location:index.php");
