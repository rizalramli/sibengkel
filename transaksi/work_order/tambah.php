<?php
 function isi_customer($koneksi)  
 {  
      $output = '';  
      $sql = "SELECT * FROM customer ORDER BY kode_customer ASC";  
      $result = mysqli_query($koneksi, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["kode_customer"].'">'.$row["nama_customer"].'</option>';  
      }  
      return $output;  
 }
// Membuat Kode otomatis
$sql = mysqli_query($koneksi, "SELECT max(kode_customer) FROM customer");
$kode_faktur = mysqli_fetch_array($sql);
if ($kode_faktur) {
  $nilai = substr($kode_faktur[0], 1);
  $kode = (int) $nilai;
  //tambahkan sebanyak + 1
  $kode = $kode + 1;
  $auto_kode = "K" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
} else {
  $auto_kode = "K0001";
}
$sql2 = mysqli_query($koneksi, "SELECT max(kode_wo) FROM work_order");
$kode_faktur2 = mysqli_fetch_array($sql2);
if ($kode_faktur2) {
  $nilai2 = substr($kode_faktur2[0], 2);
  $kode2 = (int) $nilai2;
  //tambahkan sebanyak + 1
  $kode2 = $kode2 + 1;
  $auto_kode2 = "WO" . str_pad($kode2, 4, "0",  STR_PAD_LEFT);
} else {
  $auto_kode2 = "WO0001";
}
if (isset($_POST['simpan'])) {
  $kode_customer = $_POST['kode_customer'];
  $kode_mekanik = $_POST['kode_mekanik'];
  $nama_customer = ucfirst(addslashes($_POST['nama_customer']));
  $alamat = ucfirst($_POST['alamat']);
  $no_telp = $_POST['no_telp'];
  $no_plat = strtoupper($_POST['no_plat']);
  $nama_kendaraan = ucfirst($_POST['nama_kendaraan']);
  $status_wo = "0";
  date_default_timezone_set('Asia/Jakarta');
  $tgl_wo = date('Y-m-d H:i:s');
  if ($kode_customer == '') {
      $cek_kendaraan = mysqli_query($koneksi,"SELECT COUNT(*) AS jumlah FROM kendaraan WHERE no_plat='$no_plat'");
      $data_kendaraan = mysqli_fetch_array($cek_kendaraan);
      $count = $data_kendaraan['jumlah'];
      if ($count > 0) {
        $query_customer = mysqli_query($koneksi, "INSERT INTO customer VALUES ('$auto_kode','$nama_customer','$alamat','$no_telp') ");
        $query_order = mysqli_query($koneksi, "INSERT INTO work_order VALUES ('$auto_kode2','$auto_kode','$kode_mekanik','$no_plat','$tgl_wo','$status_wo') "); 
      } else {
        $query_mobil = mysqli_query($koneksi, "INSERT INTO kendaraan (no_plat,nama_kendaraan) VALUES ('$no_plat','$nama_kendaraan') ");
        $query_customer = mysqli_query($koneksi, "INSERT INTO customer VALUES ('$auto_kode','$nama_customer','$alamat','$no_telp') ");
        $query_order = mysqli_query($koneksi, "INSERT INTO work_order VALUES ('$auto_kode2','$auto_kode','$kode_mekanik','$no_plat','$tgl_wo','$status_wo') ");  
      }
      echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'cs.php?halaman=add_work_order'</script>";
  } else {
    if ($count > 0) {
      $query_order = mysqli_query($koneksi, "INSERT INTO work_order VALUES ('$auto_kode2','$kode_customer','$kode_mekanik','$no_plat','$tgl_wo','$status_wo') ");
      echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'cs.php?halaman=add_work_order'</script>";
    } else {
      $query_mobil2 = mysqli_query($koneksi, "INSERT INTO kendaraan (no_plat,nama_kendaraan) VALUES ('$no_plat','$nama_kendaraan') ");
      $query_order = mysqli_query($koneksi, "INSERT INTO work_order VALUES ('$auto_kode2','$kode_customer','$kode_mekanik','$no_plat','$tgl_wo','$status_wo') ");
      echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'cs.php?halaman=add_work_order'</script>";
    }
    
  }
}
?>
<form action="" method="POST">
  <div class="contact-info-area mg-t-30">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
          <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
            <h2>Cari Customer Jika Pernah Datang</h2>
          </div>
          <div class="bootstrap-select fm-cmp-mg">
            <select id="kode_customer" name="kode_customer" class="selectpicker" data-live-search="true">
              <option value="">Please select</option>
              <?php echo isi_customer($koneksi); ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="contact-inner">
          <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
            <h2>Cari Mekanik</h2>
          </div>
          <div class="bootstrap-select fm-cmp-mg">
            <select name="kode_mekanik" class="selectpicker" data-live-search="true" required="">
              <option value="">Please select</option>
              <?php
              $query_mekanik = mysqli_query($koneksi, "SELECT * FROM mekanik ORDER BY kode_mekanik ASC");
              while ($data_mekanik = mysqli_fetch_array($query_mekanik)) {
                ?>
              <option value="<?= $data_mekanik['kode_mekanik'] ?>"><?= $data_mekanik['nama_mekanik'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="contact-info-area mg-t-30">
    <div class="row" id="tampil_customer">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="basic-tb-hd">
          <h2 class="text-center">Data Customer</h2>
        </div>
        <div class="contact-inner">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="">Nama Customer</label>
              <div class="form-group">
                <div class="nk-int-st">
                  <input type="text" name="nama_customer" class="form-control" placeholder="Isi form nama customer"
                    required="" maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')"
                    oninput="setCustomValidity('')">
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="">No Telp</label>
              <div class="form-group">
                <div class="nk-int-st">
                  <input type="text" onkeypress="return hanyaAngka(event)" name="no_telp" class="form-control"
                    placeholder="Isi form No telp" required="" maxlength="20"
                    oninvalid="this.setCustomValidity('Nomor Telephone Wajib Diisi & Harus Angka')"
                    oninput="setCustomValidity('')">
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="">Alamat</label>
              <div class="form-group">
                <div class="nk-int-st">
                  <textarea class="form-control" id="alamat" name="alamat" placeholder="Isi form Alamat" rows="3"
                    required="" oninvalid="this.setCustomValidity('Alamat Wajib Diisi')"
                    oninput="setCustomValidity('')"></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="basic-tb-hd">
          <h2 class="text-center">Data Mobil</h2>
        </div>
        <div class="contact-inner">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="">No Plat</label>
              <div class="form-group">
                <div class="nk-int-st">
                  <input type="text" name="no_plat" class="form-control" placeholder="Isi form nomor plat" required=""
                    maxlength="15" oninvalid="this.setCustomValidity('Nomor Plat Wajib Diisi')"
                    oninput="setCustomValidity('')">
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="">Nama Kendaraan</label>
              <div class="form-group">
                <div class="nk-int-st">
                  <input type="text" name="nama_kendaraan" class="form-control" placeholder="Isi form nama kendaraan"
                    required="" maxlength="15" oninvalid="this.setCustomValidity('Nama Kendaraan Wajib Diisi')"
                    oninput="setCustomValidity('')">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="margin-top: 20px;" class="row">
          <div class="col-md-12">
            <button type="submit" name="simpan" class="btn btn-primary btn-block">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="assets/template2/js/vendor/jquery-3.3.1.min.js"></script>
<!--Load barang ketika di klik select option (FORM work order)  -->
<script>
  $(document).ready(function () {
    $('#kode_customer').change(function () {
      var kode_customer = $(this).val();
      $.ajax({
        url: "transaksi/work_order/load_data_customer.php",
        method: "POST",
        data: {
          kode_customer: kode_customer
        },
        success: function (data) {
          $('#tampil_customer').html(data);
        }
      });
    });
  });
</script>
<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>