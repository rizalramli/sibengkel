<?php 
$query = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pegawai USING(kode_pegawai) JOIN suplier USING(kode_suplier) ORDER BY no_faktur_pembelian DESC LIMIT 1"); 
$data = mysqli_fetch_array($query);
$id = $data['no_faktur_pembelian'];
$query2 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_barang FROM detail_permintaan JOIN purchase_order USING(kode_permintaan) WHERE no_faktur_pembelian = '$id'");
$data2 = mysqli_fetch_array($query2);
$tgl_transaksi = $data['tgl_transaksi'];
$tanggal = date('d/m/Y H:i:s', strtotime($tgl_transaksi));
?>
<div class="container">
  <div class="alert alert-warning" role="alert">
  <h2 class="alert-heading">Transaksi Pembelian Sukses!</h2>
  <h5>Apakah anda akan melakukan print nota?</h5>
  <p>No Faktur : <?= $data['no_faktur_pembelian'] ?></p>
  <p>Tanggal : <?= $tanggal ?></p>
  <p>Nama Suplier : <?= $data['nama_suplier'] ?></p>
  <p>Jumlah Barang : <?= $data2['jumlah_barang'] ?></p>
  <hr>
  <form action="halaman_print/nota_pembelian_barang.php" method="post" target="_blank">
  <p class="mb-0"><button type="submit" name="print" class="btn btn-primary btn-lg">PRINT</button><a style="margin-left:10px" href="?halaman=v_data_transaksi_pembelian" class="btn btn-danger btn-lg">LEWATI</a></p>
  </form>
</div>
</div>