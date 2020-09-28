<?php
// mengambil ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM customer WHERE kode_customer='$id'");

if (isset($_POST['update'])) {
  $kode_customer = $_POST['kode_customer'];
  $nama_customer = ucfirst(addslashes($_POST['nama_customer']));
  $alamat = ucfirst($_POST['alamat']);
  $no_telp = $_POST['no_telp'];

  $update = mysqli_query($koneksi, "UPDATE customer SET nama_customer='$nama_customer',alamat='$alamat',no_telp='$no_telp' WHERE kode_customer='$kode_customer'");
  if ($update) {
    echo "<script>alert('Data Berhasil Terupdate'); window.location = 'cs.php?halaman=v_customer'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Update Database'); window.location = 'cs.php?halaman=edit_customer&id=" . $id . "'</script>";
  }
}

?>

<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Edit Customer</h2>
  </div>

  <?php
  foreach ($query as $data) {
    ?>

  <form action="" method="post">

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama Customer</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="hidden" name="kode_customer" class="form-control" value="<?= $data['kode_customer'] ?>">
            <input type="text" name="nama_customer" class="form-control" placeholder="Isi form nama customer"
              required="" maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')"
              value="<?= $data['nama_customer'] ?>" oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">No telp</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="no_telp" onkeypress="return hanyaAngka(event)" class="form-control"
              placeholder="Isi form No telp" required="" maxlength="20"
              oninvalid="this.setCustomValidity('Nomor Telephone Wajib Diisi & Harus Angka')"
              oninput="setCustomValidity('')" value="<?= $data['no_telp'] ?>">
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
    </div>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="cs.php?halaman=v_customer" class="btn btn-danger">Kembali</a>

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