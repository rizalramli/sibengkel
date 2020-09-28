<!-- koneksi -->
<?php

$koneksi = mysqli_connect("localhost", "root", "", "sibengkel");
if (!$koneksi) {
	echo "koneksi data base gagal = " . mysqli_connect_error();
}

// // auto generate kode
// function kode($field, $tabel, $digit, $kode)
// {
// 	$koneksi2 = mysqli_connect("localhost", "root", "", "sibengkel");
// 	$data = mysqli_fetch_array(mysqli_query($koneksi2, "SELECT MAX(RIGHT($field,$digit)) FROM $tabel"));
// 	$id = (int) $data[0] + 1;
// 	$id_baru = $kode . sprintf('%0' . $digit . 's', $id);
// 	return $id_baru;
// }
?>