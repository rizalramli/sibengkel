<?php 
$query = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN customer USING(kode_customer) JOIN pegawai USING (kode_pegawai) ORDER BY no_faktur_penjualan DESC LIMIT 1");
$data = mysqli_fetch_array($query);
$id = $data['no_faktur_penjualan'];
$query2 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_barang FROM detail_penjualan_barang WHERE no_faktur_penjualan = '$id'");
$data2 = mysqli_fetch_array($query2);
$query3 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_service FROM detail_penjualan_service JOIN penjualan_wo USING(kode_wo) WHERE no_faktur_penjualan = '$id'");
$data3 = mysqli_fetch_array($query3);
?>
<div class="container">
  <div class="alert alert-success" role="alert">
  <h2 class="alert-heading">Transaksi Sukses!</h2>
  <h5>Apakah anda akan melakukan print nota?</h5>
  <p>No Faktur : <?= $data['no_faktur_penjualan'] ?></p>
  <p>Nama : <?= $data['nama_customer'] ?></p>
  <p>Jumlah Barang : <?= $data2['jumlah_barang'] ?></p>
  <p>Jumlah Service : <?= $data3['jumlah_service'] ?></p>
  <hr>
  <form action="halaman_print/nota_penjualan_barang.php" method="post" target="_blank">
  <p class="mb-0"><button type="submit" name="print" class="btn btn-primary btn-lg">PRINT</button><a style="margin-left:10px" href="?halaman=v_data_transaksi" class="btn btn-danger btn-lg">LEWATI</a></p>
  </form>
</div>
</div>