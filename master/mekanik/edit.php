<?php
// mengambil ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM mekanik WHERE kode_mekanik='$id'");

if (isset($_POST['update'])) {
  $kode_mekanik = $_POST['kode_mekanik'];
  $nama_mekanik = ucfirst($_POST['nama_mekanik']);
  $alamat = ucfirst($_POST['alamat']);
  $no_telp = $_POST['no_telp'];

  $update = mysqli_query($koneksi, "UPDATE mekanik SET nama_mekanik='$nama_mekanik',alamat='$alamat',no_telp='$no_telp' WHERE kode_mekanik='$kode_mekanik'");
  if ($update) {
    echo "<script>window.location = 'admin.php?halaman=v_mekanik'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Update Database'); window.location = 'admin.php?halaman=edit_mekanik&id=" . $id . "'</script>";
  }
}
?>

<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Edit Mekanik</h2>
  </div>

  <?php
  foreach ($query as $data) {
    ?>

  <form action="" method="post">

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama mekanik</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="hidden" name="kode_mekanik" class="form-control" value="<?= $data['kode_mekanik'] ?>">
            <input type="text" name="nama_mekanik" class="form-control" placeholder="Isi form nama mekanik" required=""
              maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')"
              value="<?= $data['nama_mekanik'] ?>">
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">ALamat</label>
        <div class="form-group">
          <div class="nk-int-st">
            <textarea class="form-control" id="alamat" name="alamat" placeholder="Isi form Alamat" rows="3" required=""
              oninvalid="this.setCustomValidity('Alamat Wajib Diisi')"
              oninput="setCustomValidity('')"><?= $data['alamat'] ?></textarea>
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
              oninput="setCustomValidity('')" value="<?= $data['no_telp'] ?>">
          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="admin.php?halaman=v_mekanik" class="btn btn-danger">Kembali</a>

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