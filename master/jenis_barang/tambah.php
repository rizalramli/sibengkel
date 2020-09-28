<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

  // Membuat Kode otomatis
  $sql = mysqli_query($koneksi, "SELECT max(kode_jenis) FROM jenis_barang");
  $kode_faktur = mysqli_fetch_array($sql);
  if ($kode_faktur) {
    $nilai = substr($kode_faktur[0], 1);
    $kode = (int) $nilai;
    //tambahkan sebanyak + 1
    $kode = $kode + 1;
    $auto_kode = "J" . str_pad($kode, 2, "0",  STR_PAD_LEFT);
  } else {
    $auto_kode = "J01";
  }

  $nama_jenis = ucfirst($_POST['nama_jenis']);
  $query = mysqli_query($koneksi, "INSERT INTO jenis_barang (kode_jenis,nama_jenis) VALUES ('$auto_kode','$nama_jenis') ");
  if ($query) {
    echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'gudang.php?halaman=v_jenisBarang'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'gudang.php?halaman=add_jenisBarang'</script>";
  }
}
?>
<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Tambah Jenis Barang</h2>
  </div>

  <form action="" method="post">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama Jenis Barang</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="nama_jenis" class="form-control" placeholder="Isi form nama jenis barang"
              required="" maxlength="20" oninvalid="this.setCustomValidity('Nama Jenis Wajib Diisi')"
              oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="gudang.php?halaman=v_jenisBarang" class="btn btn-danger">Kembali</a>
  </form>


</div>