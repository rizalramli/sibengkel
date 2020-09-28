<?php
$query_penggajian =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_penggajian FROM penggajian WHERE status='1'");
$data_penggajian = mysqli_fetch_array($query_penggajian);
$query_pegawai =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_pegawai FROM pegawai");
$data_pegawai = mysqli_fetch_array($query_pegawai);
$query_jenis_pegawai =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_jenis_pegawai FROM jenis_pegawai");
$data_jenis_pegawai = mysqli_fetch_array($query_jenis_pegawai);
$query_mekanik =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_mekanik FROM mekanik");
$data_mekanik = mysqli_fetch_array($query_mekanik);
?>
<!-- Icon Cards-->
<div class="row">
      <a style="color:black" href="?halaman=v_penggajian">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
        <div class="contact-inner">
          <h2><span class="counter"><?= $data_penggajian['jumlah_penggajian'] ?></span></h2>
          <span><strong>JUMLAH DATA PENGGAJIAN</strong></span>
        </div>
        </div>
      </div>
      </a>
      <a style="color:black" href="?halaman=v_pegawai">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
        <div class="contact-inner">
          <h2><span class="counter"><?= $data_pegawai['jumlah_pegawai'] ?></span></h2>
          <span><strong>JUMLAH DATA PEGAWAI</strong></span>
        </div>
        </div>
      </div>
      </a>
      <a style="color:black" href="?halaman=v_jenis_pegawai">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
        <div class="contact-inner">
          <h2><span class="counter"><?= $data_jenis_pegawai['jumlah_jenis_pegawai'] ?></span></h2>
          <span><strong>JUMLAH JENIS PEGAWAI</strong></span>
        </div>
        </div>
      </div>
      </a>

      <a style="color:black" href="?halaman=v_mekanik">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
        <div class="contact-inner">
          <h2><span class="counter"><?= $data_mekanik['jumlah_mekanik'] ?></span></h2>
          <span><strong>JUMLAH DATA MEKANIK</strong></span>
        </div>
        </div>
      </div>
      </a>
  </div>
