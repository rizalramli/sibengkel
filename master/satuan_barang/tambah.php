<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

  // Membuat Kode otomatis
  $sql = mysqli_query($koneksi, "SELECT max(kode_satuan) FROM satuan");
  $kode_faktur = mysqli_fetch_array($sql);
  if ($kode_faktur) {
    $nilai = substr($kode_faktur[0], 1);
    $kode = (int) $nilai;
    //tambahkan sebanyak + 1
    $kode = $kode + 1;
    $auto_kode = "S" . str_pad($kode, 2, "0",  STR_PAD_LEFT);
  } else {
    $auto_kode = "S01";
  }

  $nama_satuan = ucfirst($_POST['nama_satuan']);
  $query = mysqli_query($koneksi, "INSERT INTO satuan (kode_satuan,nama_satuan) VALUES ('$auto_kode','$nama_satuan') ");
  if ($query) {
    echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'gudang.php?halaman=v_satuanBarang'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'gudang.php?halaman=add_satuanBarang'</script>";
  }
}
?>
<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Tambah Satuan Barang</h2>
  </div>
  <form action="" method="post">

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama Satuan Barang</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="nama_satuan" class="form-control" placeholder="Isi form nama satuan barang"
              required="" maxlength="20" oninvalid="this.setCustomValidity('Nama Satuan Wajib Diisi')"
              oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="gudang.php?halaman=v_satuanBarang" class="btn btn-danger">Kembali</a>
  </form>
</div>