<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

  // Membuat Kode otomatis
  $sql = mysqli_query($koneksi, "SELECT max(kode_pegawai) FROM pegawai");
  $kode_faktur = mysqli_fetch_array($sql);
  if ($kode_faktur) {
    $nilai = substr($kode_faktur[0], 2);
    $kode = (int) $nilai;
    //tambahkan sebanyak + 1
    $kode = $kode + 1;
    $auto_kode = "PG" . str_pad($kode, 3, "0",  STR_PAD_LEFT);
  } else {
    $auto_kode = "PG001";
  }

  $kode_jenis_p = $_POST['kode_jenis_p'];
  $nama_pegawai = ucfirst(addslashes($_POST['nama_pegawai']));
  $alamat = ucfirst($_POST['alamat']);
  $no_telp = $_POST['no_telp'];
  $username = $_POST['username'];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // fungsi mengenkripsi data
  $status = '0';
  $k_password = $_POST['k_password'];

  // validasi password dan konfirmasi password
  if ($k_password == $_POST["password"]) {
    $query_pegawai = mysqli_query($koneksi,"SELECT COUNT(*) as jumlah FROM pegawai WHERE username='$username'");
    $ambil = mysqli_fetch_array($query_pegawai);
    $cek_username = $ambil['jumlah'];
    if($cek_username > 0)
    {
        echo "<script>alert('Tidak Boleh Ada 2 Username yang Sama'); window.location = 'admin.php?halaman=add_pegawai'</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO pegawai (kode_pegawai,kode_jenis_p,nama_pegawai,alamat,no_telp,username,password,status_login) VALUES ('$auto_kode','$kode_jenis_p','$nama_pegawai','$alamat','$no_telp','$username','$password','$status') ");
        // validasi apakah berhasil atau gagal
        if ($query) {
        echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'admin.php?halaman=v_pegawai'</script>";
        } else {
        echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'admin.php?halaman=add_pegawai'</script>";
    }
    }

    
  } else {
    echo "<script>alert('Password dan konfirmasi password harus sama !!'); window.location = 'admin.php?halaman=add_pegawai'</script>";
  }
}
?>
<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Tambah Pegawai</h2>
  </div>
  <form action="" method="post">

    <div class="row">

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama Pegawai</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="nama_pegawai" class="form-control" placeholder="Isi form Nama Pegawai" required=""
              maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')">
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Jenis Pegawai</label>
        <div class="form-group">
          <div class="bootstrap-select fm-cmp-mg">
            <select name="kode_jenis_p" class="selectpicker" data-live-search="true" required="">

              <option value="">Please select</option>

              <?php
              $query_jenis = mysqli_query($koneksi, "SELECT * FROM jenis_pegawai ORDER BY nama_jenis_p ASC");
              while ($data_jenis = mysqli_fetch_array($query_jenis)) {
                ?>

              <option value="<?= $data_jenis['kode_jenis_p'] ?>"><?= $data_jenis['nama_jenis_p'] ?></option>

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
              maxlength="50" oninvalid="this.setCustomValidity('Username Wajib Diisi')" oninput="setCustomValidity('')">
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
              oninput="setCustomValidity('')">
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
              oninvalid="this.setCustomValidity('Alamat Wajib Diisi')" oninput="setCustomValidity('')"></textarea>
          </div>
        </div>
      </div>

    </div>

    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="admin.php?halaman=v_pegawai" class="btn btn-danger">Kembali</a>

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