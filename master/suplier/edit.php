<?php
// mengambil ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM suplier WHERE kode_suplier='$id'");

if (isset($_POST['update'])) {
  $kode_suplier = $_POST['kode_suplier'];
  $nama_suplier = ucfirst($_POST['nama_suplier']);
  $alamat = ucfirst($_POST['alamat']);
  $kontak_person = $_POST['kontak_person'];
  $telp = $_POST['telp'];

  $update = mysqli_query($koneksi, "UPDATE suplier SET nama_suplier='$nama_suplier',alamat='$alamat',kontak_person='$kontak_person',telp='$telp' WHERE kode_suplier='$kode_suplier'");
  if ($update) {
    echo "<script>alert('Data Berhasil Terupdate'); window.location = 'kasir.php?halaman=v_suplier'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Update Database'); window.location = 'kasir.php?halaman=edit_suplier&id=" . $id . "'</script>";
  }
}


?>

<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Edit Suplier</h2>
  </div>

  <?php
  foreach ($query as $data) {
    ?>

  <form action="" method="post">

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama Suplier</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="hidden" name="kode_suplier" class="form-control" value="<?= $data['kode_suplier'] ?>">
            <input type="text" name="nama_suplier" class="form-control" placeholder="Isi form nama Suplier" required=""
              maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')"
              value="<?= $data['nama_suplier'] ?>">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Kontak Person</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="kontak_person" class="form-control" placeholder="Isi form Kontak Person"
              required="" oninvalid="this.setCustomValidity('Kontak Wajib Diisi')" oninput="setCustomValidity('')"
              value="<?= $data['kontak_person'] ?>">
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
              oninvalid="this.setCustomValidity('Alamat Wajib Diisi')"
              oninput="setCustomValidity('')"><?= $data['alamat'] ?></textarea>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">No telp</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" onkeypress="return hanyaAngka(event)" name="telp" class="form-control"
              placeholder="Isi form No telp" required="" maxlength="20"
              oninvalid="this.setCustomValidity('No Telepon Wajib Diisi & Harus Angka')" oninput="setCustomValidity('')"
              value="<?= $data['telp'] ?>">
          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="kasir.php?halaman=v_suplier" class="btn btn-danger">Kembali</a>

  </form>

</div>

<?php } ?>
<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>