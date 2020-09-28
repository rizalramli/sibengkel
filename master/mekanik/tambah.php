<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

  // Membuat Kode otomatis
  $sql = mysqli_query($koneksi, "SELECT max(kode_mekanik) FROM mekanik");
  $kode_faktur = mysqli_fetch_array($sql);
  if ($kode_faktur) {
    $nilai = substr($kode_faktur[0], 2);
    $kode = (int) $nilai;
    //tambahkan sebanyak + 1
    $kode = $kode + 1;
    $auto_kode = "MK" . str_pad($kode, 3, "0",  STR_PAD_LEFT);
  } else {
    $auto_kode = "MK001";
  }

  $nama_mekanik = ucfirst($_POST['nama_mekanik']);
  $alamat = ucfirst($_POST['alamat']);
  $no_telp = $_POST['no_telp'];
  $query = mysqli_query($koneksi, "INSERT INTO mekanik (kode_mekanik,nama_mekanik,alamat,no_telp) VALUES ('$auto_kode','$nama_mekanik','$alamat','$no_telp') ");
  if ($query) {
    echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'admin.php?halaman=v_mekanik'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'admin.php?halaman=add_mekanik'</script>";
  }
}
?>
<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Tambah Mekanik</h2>
  </div>
  <form action="" method="post">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama mekanik</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="nama_mekanik" class="form-control" placeholder="Isi form nama mekanik" required=""
              maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Alamat</label>
        <div class="form-group">
          <div class="nk-int-st">
            <textarea class="form-control" id="alamat" name="alamat" placeholder="Isi form Alamat" rows="3" required=""
              oninvalid="this.setCustomValidity('Alamat Wajib Diisi')" oninput="setCustomValidity('')"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">No telp</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" onkeypress="return hanyaAngka(event)" name="no_telp" class="form-control"
              placeholder="Isi form No telp" required="" maxlength="20"
              oninvalid="this.setCustomValidity('Nomor Telephone Wajib Diisi & Harus Angka')"
              oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="admin.php?halaman=v_mekanik" class="btn btn-danger">Kembali</a>

  </form>

</div>
<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>