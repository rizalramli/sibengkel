<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

  // Membuat Kode otomatis
  $sql = mysqli_query($koneksi, "SELECT max(kode_suplier) FROM suplier");
  $kode_faktur = mysqli_fetch_array($sql);
  if ($kode_faktur) {
    $nilai = substr($kode_faktur[0], 1);
    $kode = (int) $nilai;
    //tambahkan sebanyak + 1
    $kode = $kode + 1;
    $auto_kode = "S" . str_pad($kode, 3, "0",  STR_PAD_LEFT);
  } else {
    $auto_kode = "S001";
  }

  $nama_suplier = ucfirst($_POST['nama_suplier']);
  $alamat = ucfirst($_POST['alamat']);
  $kontak_person = $_POST['kontak_person'];
  $telp = $_POST['telp'];
  $query = mysqli_query($koneksi, "INSERT INTO suplier VALUES ('$auto_kode','$nama_suplier','$alamat','$kontak_person','$telp') ");
  if ($query) {
    echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'kasir.php?halaman=v_suplier'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'kasir.php?halaman=add_suplier'</script>";
  }
}
?>
<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Tambah Suplier</h2>
  </div>
  <form action="" method="post">

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama Suplier</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="nama_suplier" class="form-control" placeholder="Isi form nama Suplier" required=""
              maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Kontak Person</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="kontak_person" class="form-control" placeholder="Isi form Kontak Person"
              required="" oninvalid="this.setCustomValidity('Kontak Wajib Diisi')" oninput="setCustomValidity('')">
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
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">No telp</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" onkeypress="return hanyaAngka(event)" name="telp" class="form-control"
              placeholder="Isi form No telp" required="" maxlength="20"
              oninvalid="this.setCustomValidity('No Telepon Wajib Diisi & Harus Angka')"
              oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="kasir.php?halaman=v_suplier" class="btn btn-danger">Kembali</a>

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