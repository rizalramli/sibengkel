<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

  // Membuat Kode otomatis
  $sql = mysqli_query($koneksi, "SELECT max(kode_jenis_p) FROM jenis_pegawai");
  $kode_faktur = mysqli_fetch_array($sql);
  if ($kode_faktur) {
    $nilai = substr($kode_faktur[0], 2);
    $kode = (int) $nilai;
    //tambahkan sebanyak + 1
    $kode = $kode + 1;
    $auto_kode = "JP" . str_pad($kode, 2, "0",  STR_PAD_LEFT);
  } else {
    $auto_kode = "JP01";
  }

  $nama_jenis_p = ucfirst($_POST['nama_jenis_p']);
  $query = mysqli_query($koneksi, "INSERT INTO jenis_pegawai (kode_jenis_p,nama_jenis_p) VALUES ('$auto_kode','$nama_jenis_p') ");
  if ($query) {
    echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'admin.php?halaman=v_jenis_pegawai'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'admin.php?halaman=add_jenis_pegawai'</script>";
  }
}
?>
<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Tambah Jenis Pegawai</h2>
  </div>

  <form action="" method="post">

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="">Nama Jenis Pegawai</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="nama_jenis_p" class="form-control" placeholder="Isi form nama jenis pegawai"
              required="" maxlength="30" oninvalid="this.setCustomValidity('Nama Jenis Wajib Diisi')"
              oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="admin.php?halaman=v_jenis_pegawai" class="btn btn-danger">Kembali</a>
  </form>

</div>