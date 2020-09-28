<?php
$jumlah_barang = 0;
$total_hrg1 = 0;
if (isset($_POST["jumlah_barang"])) {
	$jumlah_barang = $_POST["jumlah_barang"];
	if ($jumlah_barang > 0) {
		for ($count = 0; $count < count($_POST["kode_barang2"]); $count++) {
			$harga1 = $_POST["harga_jual"][$count] * $_POST["jumlah_barang"][$count];
			$total_hrg1 = $total_hrg1 + $harga1;
		}
	}
}
echo $total_hrg1;
