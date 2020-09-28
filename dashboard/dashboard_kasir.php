<?php
$query_penjualan =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_penjualan FROM penjualan");
$data_penjualan = mysqli_fetch_array($query_penjualan);
$query_pembelian =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_pembelian FROM pembelian WHERE status='1'");
$data_pembelian = mysqli_fetch_array($query_pembelian);
$query_supplier =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_supplier FROM suplier");
$data_supplier = mysqli_fetch_array($query_supplier);
$query_service =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_service FROM service");
$data_service = mysqli_fetch_array($query_service);
?>
<!-- Icon Cards-->
<div class="row">
      <a style="color:black" href="?halaman=v_data_transaksi">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
        <div class="contact-inner">
          <h2><span class="counter"><?= $data_penjualan['jumlah_penjualan'] ?></span></h2>
          <span><strong>JUMLAH TRANSAKSI PENJUALAN</strong></span>
        </div>
        </div>
      </div>
      </a>
      <a style="color:black" href="?halaman=v_data_transaksi_pembelian">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
        <div class="contact-inner">
          <h2><span class="counter"><?= $data_pembelian['jumlah_pembelian'] ?></span></h2>
          <span><strong>JUMLAH TRANSAKSI PEMASOKAN</strong></span>
        </div>
        </div>
      </div>
      </a>
      <a style="color:black" href="?halaman=v_suplier">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
        <div class="contact-inner">
          <h2><span class="counter"><?= $data_supplier['jumlah_supplier'] ?></span></h2>
          <span><strong>JUMLAH DATA SUPPLIER</strong></span>
        </div>
        </div>
      </div>
      </a>

      <a style="color:black" href="?halaman=v_tarifService">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
        <div class="contact-inner">
          <h2><span class="counter"><?= $data_service['jumlah_service'] ?></span></h2>
          <span><strong>JUMLAH DATA SERVICE</strong></span>
        </div>
        </div>
      </div>
      </a>
  </div>
