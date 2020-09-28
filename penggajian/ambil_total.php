<?php
$total_gaji = 0;
$total_gaji_m = 0;

$total_hrg1 = 0;
$total_hrg2 = 0;

if (isset($_POST["total_gaji"])) {
    $total_gaji = $_POST["total_gaji"];
    if ($total_gaji > 0) {
        for ($count = 0; $count < count($_POST["kode_pegawai"]); $count++) {

            $harga1 = $_POST["total_gaji"][$count];
            $total_hrg1 = $total_hrg1 + $harga1;
        }
    }
}

if (isset($_POST["total_gaji_m"])) {
    $total_gaji_m = $_POST["total_gaji_m"];
    if ($total_gaji_m > 0) {
        for ($count = 0; $count < count($_POST["kode_mekanik"]); $count++) {

            $harga2 = $_POST["total_gaji_m"][$count];
            $total_hrg2 = $total_hrg2 + $harga2;
        }
    }
}

$total = $total_hrg1 + $total_hrg2;

echo $total;
