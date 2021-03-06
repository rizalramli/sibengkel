<?php

// mengambil ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN jenis_pegawai USING(kode_jenis_p) WHERE kode_pegawai='$id'");

if (isset($_POST['update'])) {
  $kode_pegawai = $_POST['kode_pegawai'];
  $kode_jenis_p = $_POST['kode_jenis_p'];
  $nama_pegawai = ucfirst(addslashes($_POST['nama_pegawai']));
  $alamat = ucfirst($_POST['alamat']);
  $no_telp = $_POST['no_telp'];
  $username = $_POST['username'];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // fungsi mengenkripsi data
  $k_password = $_POST['k_password'];

  // validasi password dan konfirmasi password
  if ($k_password == $_POST["password"]) {

    
    $query_pegawai = mysqli_query($koneksi,"SELECT * FROM pegawai WHERE kode_pegawai='$kode_pegawai'");
    $ambil = mysqli_fetch_array($query_pegawai);
    $cek_username = $ambil['username'];
    $query_count = mysqli_query($koneksi,"SELECT COUNT(*) AS jumlah FROM pegawai WHERE username='$username'");
    $ambil_count = mysqli_fetch_array($query_count);
    $cek_count = $ambil_count['jumlah'];
    if ($cek_username == $username) {
        $update = mysqli_query($koneksi, "UPDATE pegawai SET kode_jenis_p='$kode_jenis_p',nama_pegawai='$nama_pegawai',alamat='$alamat',no_telp='$no_telp',username='$username',password='$password' WHERE kode_pegawai='$kode_pegawai'");
        // validasi apakah berhasil atau gagal
        if ($update) {
          echo "<script>alert('Data Berhasil Terupdate'); window.location = 'admin.php?halaman=v_pegawai'</script>";
        } else {
          echo "<script>alert('Terjadi Kesalahan Update Database'); window.location = 'admin.php?halaman=edit_pegawai&id=" .$id."'</script>";
        }
    } else if ($cek_count > 0) {
          echo "<script>alert('Tidak Boleh Ada 2 Username yang Sama'); window.location = 'admin.php?halaman=edit_pegawai&id=" .$id."'</script>";
    } else {
        $update = mysqli_query($koneksi, "UPDATE pegawai SET kode_jenis_p='$kode_jenis_p',nama_pegawai='$nama_pegawai',alamat='$alamat',no_telp='$no_telp',username='$username',password='$password' WHERE kode_pegawai='$kode_pegawai'");
        // validasi apakah berhasil atau gagal
        if ($update) {
          echo "<script>alert('Data Berhasil Terupdate'); window.location = 'admin.php?halaman=v_pegawai'</script>";
        } else {
          echo "<script>alert('Terjadi Kesalahan Update Database'); window.location = 'admin.php?halaman=edit_pegawai&id=" .$id."'</script>";
        }
    }
    
  } else {
    echo "<script>alert('Password dan konfirmasi password harus sama !!'); window.location = 'admin.php?halaman=edit_pegawai&id=" .$id."'</script>";
  }

}


?>
<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Edit Pegawai</h2>
  </div>
  <?php
  foreach ($query as $data) {
    ?>


  <form action="" method="post">

    <div class="row">

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama Pegawai</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="hidden" name="kode_pegawai" class="form-control" value="<?= $data['kode_pegawai'] ?>">
            <input type="text" name="nama_pegawai" class="form-control" placeholder="Isi form Nama Pegawai" required=""
              maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')"
              value="<?= $data['nama_pegawai'] ?>">
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Jenis Pegawai</label>
        <div class="form-group">
          <div class="bootstrap-select fm-cmp-mg">
            <select name="kode_jenis_p" class="selectpicker" data-live-search="true" required="">

              <?php
                $query_jenis = mysqli_query($koneksi, "SELECT * FROM jenis_pegawai ORDER BY nama_jenis_p ASC");
                foreach ($query_jenis as $data_jenis) {
                  ?>
              <option value="<?php echo $data_jenis["kode_jenis_p"]; ?>" <?php if ($data['kode_jenis_p'] == $data_jenis["kode_jenis_p"]) {
                                                                                echo "selected";
                                                                              } ?>>
                <?php echo $data_jenis["nama_jenis_p"]; ?>
              </option>
              <?php } ?>

            </select>
          </div>
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Username</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="username" class="form-control" placeholder="Isi form Username" required=""
              maxlength="50" oninvalid="this.setCustomValidity('Username Wajib Diisi')" oninput="setCustomValidity('')"
              value="<?= $data['username'] ?>">
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Password</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="password" name="password" class="form-control" placeholder="Isi form Password" required=""
              maxlength="60" oninvalid="this.setCustomValidity('Password Wajib Diisi')" oninput="setCustomValidity('')">
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

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Konfirmasi Password</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="password" name="k_password" class="form-control" placeholder="Isi form Konfirmasi Password"
              required="" maxlength="60" oninvalid="this.setCustomValidity('Konfirmasi Password Wajib Diisi')"
              oninput="setCustomValidity('')">
          </div>
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
    <a href="admin.php?halaman=v_pegawai" class="btn btn-danger">Kembali</a>

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