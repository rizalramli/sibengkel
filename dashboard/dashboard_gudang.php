<?php
$query_permintaan =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_permintaan FROM permintaan_barang WHERE status='0'");
$data_permintaan = mysqli_fetch_array($query_permintaan);
$query_barang =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_barang FROM barang");
$data_barang = mysqli_fetch_array($query_barang);
$query_jenis =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_jenis FROM jenis_barang");
$data_jenis = mysqli_fetch_array($query_jenis);
$query_merk =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_merk FROM merk");
$data_merk = mysqli_fetch_array($query_merk);
$query_satuan =  mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_satuan FROM satuan");
$data_satuan = mysqli_fetch_array($query_satuan);
?>
<!-- Icon Cards-->
  <div class="row">
    <a style="color:black" href="?halaman=v_permintaan_barang">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
          <div class="contact-inner">
            <h2><span class="counter"><?= $data_permintaan['jumlah_permintaan'] ?></span></h2>
            <span><strong>JUMLAH PERMINTAAN BARANG</strong></span>
          </div>
        </div>
      </div>
    </a>
    <a style="color:black" href="?halaman=v_daftarBarang">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
          <div class="contact-inner">
            <h2><span class="counter"><?= $data_barang['jumlah_barang'] ?></span></h2>
            <span><strong>JUMLAH DAFTAR BARANG</strong></span>
          </div>
        </div>
      </div>
    </a>
    <a style="color:black" href="?halaman=v_jenisBarang">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
          <div class="contact-inner">
            <h2><span class="counter"><?= $data_jenis['jumlah_jenis'] ?></span></h2>
            <span><strong>JUMLAH JENIS BARANG</strong></span>
          </div>
        </div>
      </div>
    </a>
    <a style="color:black" href="?halaman=v_merkBarang">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
          <div class="contact-inner">
            <h2><span class="counter"><?= $data_merk['jumlah_merk'] ?></span></h2>
            <span><strong>JUMLAH MERK BARANG</strong></span>
          </div>
        </div>
      </div>
    </a>
    <a style="color:black" href="?halaman=v_satuanBarang">
      <div style="margin-bottom: 30px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
          <div class="contact-inner">
            <h2><span class="counter"><?= $data_satuan['jumlah_satuan'] ?></span></h2>
            <span><strong>JUMLAH SATUAN BARANG</strong></span>
          </div>
        </div>
      </div>
    </a>
  </div>