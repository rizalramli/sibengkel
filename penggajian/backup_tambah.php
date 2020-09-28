<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

  // validasi apakah ada detail
  if (isset($_POST['kode_pegawai']) || isset($_POST['kode_mekanik'])) {

    // Membuat Kode otomatis
    $sql = mysqli_query($koneksi, "SELECT max(kode_penggajian) FROM penggajian");
    $kode_faktur = mysqli_fetch_array($sql);
    if ($kode_faktur) {
      $nilai = substr($kode_faktur[0], 3);
      $kode = (int) $nilai;
      //tambahkan sebanyak + 1
      $kode = $kode + 1;
      $auto_kode = "PGJ" . str_pad($kode, 6, "0",  STR_PAD_LEFT);
    } else {
      $auto_kode = "PGJ000001";
    }

    // mengupdate data tgl_last_log_in di database
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');

    // data table permintaan
    $kode_penggajian = $auto_kode;
    $kode_pegawai = $_SESSION['kode_pegawai'];
    $tgl_transaksi = $now;
    $total_penggajian = $_POST['total_penggajian'];
    $bayar = $_POST['bayar'];
    $kembalian = $_POST['kembalian'];
    $status = 1;

    if ($bayar < $total_penggajian) {
      echo "<script>alert('Penggajian gagal,Pembayaran anda kurang'); window.location = 'admin.php?halaman=add_penggajian'</script>";
    } else {
        // proses input data tramsaksi ke dalam database
    $query = mysqli_query($koneksi, "INSERT INTO penggajian VALUES ('$kode_penggajian','$kode_pegawai','$tgl_transaksi','$total_penggajian','$bayar','$kembalian','$status') ");
    if ($query) {
      // proses input data detail tramsaksi ke dalam database
      if (isset($_POST['kode_pegawai'])) {
        for ($i = 0; $i < count($_POST['kode_pegawai']); $i++) {

          // data - data
          $kode_pegawai = $_POST['kode_pegawai'][$i];
          $periode_gaji = $_POST['periode_gaji'][$i];
          $jumlah_hari_kerja = $_POST['jumlah_hari_kerja'][$i];
          $total_gaji = $_POST['total_gaji'][$i];

          $query_detail = mysqli_query($koneksi, "INSERT INTO detail_penggajian (kode_penggajian,kode_pegawai,periode_gaji,jumlah_hari_kerja,total_gaji) VALUES ('$kode_penggajian','$kode_pegawai','$periode_gaji','$jumlah_hari_kerja','$total_gaji') ");
        }

        // validasi dan link
        if ($query_detail) {
          echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'admin.php?halaman=v_penggajian'</script>";
        } else {
          echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'admin.php?halaman=add_penggajian'</script>";
        }
      }

      // proses input data detail tramsaksi ke dalam database
      if (isset($_POST['kode_mekanik'])) {
        for ($i = 0; $i < count($_POST['kode_mekanik']); $i++) {

          // data - data
          $kode_mekanik = $_POST['kode_mekanik'][$i];
          $periode_gaji_m = $_POST['periode_gaji_m'][$i];
          $jumlah_hari_kerja_m = $_POST['jumlah_hari_kerja_m'][$i];
          $total_gaji_m = $_POST['total_gaji_m'][$i];

          $query_detail2 = mysqli_query($koneksi, "INSERT INTO detail_penggajian_m (kode_penggajian,kode_mekanik,periode_gaji,jumlah_hari_kerja,total_gaji) VALUES ('$kode_penggajian','$kode_mekanik','$periode_gaji_m','$jumlah_hari_kerja_m','$total_gaji_m') ");
        }

        // validasi dan link
        if ($query_detail2) {
          echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'admin.php?halaman=v_penggajian'</script>";
        } else {
          echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'admin.php?halaman=add_penggajian'</script>";
        }
      }
    } else {
      echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'admin.php?halaman=add_penggajian'</script>";
    }
    }
    
  } else {
    echo "<script>alert('Gagal Mengirim Data , data detail harus ada !'); window.location = 'admin.php?halaman=add_penggajian'</script>";
  }
}
?>
<div class="form-element-list">
  <form id="transaksi_form" method="post">

    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">

        <div class="basic-tb-hd">

          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <div class="bootstrap-select fm-cmp-mg">
                  <select id="cari_kode_pegawai" class="selectpicker" data-live-search="true">

                    <option value="">Cari Pegawai</option>

                    <?php
                    $query_pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY kode_pegawai ASC");
                    while ($data_pegawai = mysqli_fetch_array($query_pegawai)) {
                      ?>

                    <option value="<?= $data_pegawai['kode_pegawai'] ?>"><?= $data_pegawai['nama_pegawai'] ?></option>

                    <?php } ?>

                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
              <div class="form-group">
                <a id="add_more1" name="add_more1" class="btn btn-primary">+</a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <div class="bootstrap-select fm-cmp-mg">
                  <select id="cari_kode_mekanik" class="selectpicker" data-live-search="true">

                    <option value="">Cari Mekanik</option>

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
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
              <div class="form-group">
                <a id="add_more2" name="add_more2" class="btn btn-primary">+</a>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <label>Kode</label>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <label>Nama</label>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <label>Priode Gaji</label>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <label>Jumlah Hari Kerja</label>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <label>Total Gaji</label>
          </div>
        </div>

        <div id="span_product_details">
          <!-- disini isi detail -->

        </div>

      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <div class="contact-inner">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="basic-tb-hd">
                <h2 class="text-center">Form Penggajian</h2>
              </div>
              <table width="100%">
                <tr>
                  <td width="60%">
                    <h5>Total</h5>
                  </td>
                  <td width="40%" style="text-align: right;">
                    <input type="number" class="form-control" id="total_penggajian" name="total_penggajian" readonly="">
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="contact-inner">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <table width="100%">
                <tr>
                  <td width="60%">
                    <h5>Bayar</h5>
                  </td>
                  <td width="40%" style="text-align: right;"><input type="number" class="form-control" id="bayar" name="bayar" required="" max="9999999999" oninvalid="this.setCustomValidity('Bayar Wajib Diisi')" oninput="setCustomValidity('')" onkeyup="update()" onchange="update()"></td>
                </tr>
                <tr>
                  <td width="60%">
                    <h5>Kembalian</h5>
                  </td>
                  <td width="40%" style="text-align: right;  padding-top: 10px;">
                    <input type="number" class="form-control" id="kembalian" name="kembalian" readonly="">
                  </td>
                </tr>

              </table>
            </div>
          </div>

          <div class="row">
            <br>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <button id="action" onclick="return confirm('Yakin ingin Melakukan Penggajian ?')" type="submit" name="simpan" class="btn btn-primary col-md-12">Simpan</button>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <a href="admin.php?halaman=v_penggajian" class="btn btn-danger col-md-12">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </form>
</div>

<!-- untuk ajax -->
<script src="assets/template2/js/vendor/jquery-3.3.1.min.js"></script>

<!-- script logika -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#span_product_details').html('');
    var count1 = -1;
    var count2 = -1;

    // menambah detail 
    function add_row(count1, kode_pegawai, nama_pegawai) {

      var nomer = count1 + 1;

      $('#span_product_details').append(`

        <div id="row` + count1 + `" class="row">
          <br />
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <input type="text" class="form-control" id="kode_pegawai` + count1 + `" name="kode_pegawai[]" readonly="" value="` + kode_pegawai + `">
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <input type="text" class="form-control" id="nama_pegawai` + count1 + `" name="nama_pegawai[]" readonly="" value="` + nama_pegawai + `">
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <select id="periode_gaji` + count1 + `" name="periode_gaji[]" class="form-control selectpicker" data-live-search="true" required="" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')">

              <option value="">Priode</option>

              <option value="Januari">Januari</option>
              <option value="Februari">Februari</option>
              <option value="Maret">Maret</option>

              <option value="April">April</option>
              <option value="Mei">Mei</option>
              <option value="Juni">Juni</option>

              <option value="Juli">Juli</option>
              <option value="Agustus">Agustus</option>
              <option value="September">September</option>

              <option value="Oktober">Oktober</option>
              <option value="Nopember">Nopember</option>
              <option value="Desember">Desember</option>

            </select>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <input type="number" class="form-control" id="jumlah_hari_kerja` + count1 + `" name="jumlah_hari_kerja[]" required="" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" value="">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <input type="number" class="form-control gaji" id="total_gaji` + count1 + `" name="total_gaji[]" max="9999999999" required="" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" value="">
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
            <a id="` + count1 + `" name="remove" class="remove btn btn-danger remove_gaji">-</a>
          </div>
        </div>
        
      `);
    }

    // menambah detail 
    function add_row2(count2, kode_mekanik, nama_mekanik) {

      var nomer = count2 + 1;

      $('#span_product_details').append(`

        <div id="row2` + count2 + `" class="row">
          <br />
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <input type="text" class="form-control" id="kode_mekanik` + count2 + `" name="kode_mekanik[]" readonly="" value="` + kode_mekanik + `">
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <input type="text" class="form-control" id="nama_mekanik` + count2 + `" name="nama_mekanik[]" readonly="" value="` + nama_mekanik + `">
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <select id="periode_gaji_m` + count2 + `" name="periode_gaji_m[]" class="form-control selectpicker" data-live-search="true" required="" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')">

              <option value="">Priode</option>

              <option value="Januari">Januari</option>
              <option value="Februari">Februari</option>
              <option value="Maret">Maret</option>

              <option value="April">April</option>
              <option value="Mei">Mei</option>
              <option value="Juni">Juni</option>

              <option value="Juli">Juli</option>
              <option value="Agustus">Agustus</option>
              <option value="September">September</option>

              <option value="Oktober">Oktober</option>
              <option value="Nopember">Nopember</option>
              <option value="Desember">Desember</option>

            </select>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <input type="number" class="form-control" id="jumlah_hari_kerja_m` + count2 + `" name="jumlah_hari_kerja_m[]" required="" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" value="">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <input type="number" class="form-control gaji" id="total_gaji_m` + count2 + `" name="total_gaji_m[]" max="9999999999" required="" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" value="">
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
            <a id="` + count2 + `" name="remove" class="remove2 btn btn-danger remove_gaji">-</a>
          </div>
        </div>
        
      `);
    }

    // ketika click + maka akan menambah baris
    $(document).on('click', '#add_more1', function() {

      // mengambil data dari select option 
      var cari_kode_pegawai = document.getElementById("cari_kode_pegawai");
      var value = cari_kode_pegawai.options[cari_kode_pegawai.selectedIndex].value;
      var value2 = cari_kode_pegawai.options[cari_kode_pegawai.selectedIndex].text;

      // validasi cari 
      if (value == "") {
        alert("Pilih Pegawai");
      } else {
        count1 = count1 + 1;
        add_row(count1, value, value2);

        document.getElementById("cari_kode_pegawai").selectedIndex = "0";
        $('.selectpicker').selectpicker('refresh');
      }

    });

    // ketika click + maka akan menambah baris
    $(document).on('click', '#add_more2', function() {

      // mengambil data dari select option 
      var cari_kode_mekanik = document.getElementById("cari_kode_mekanik");
      var value = cari_kode_mekanik.options[cari_kode_mekanik.selectedIndex].value;
      var value2 = cari_kode_mekanik.options[cari_kode_mekanik.selectedIndex].text;

      // validasi cari 
      if (value == "") {
        alert("Pilih Mekanik");
      } else {
        count2 = count2 + 1;
        add_row2(count2, value, value2);

        document.getElementById("cari_kode_mekanik").selectedIndex = "0";
        $('.selectpicker').selectpicker('refresh');
      }

    });

    // ketika di click - maka akan mengurangi detail pegawai
    $(document).on('click', '.remove', function() {
      var row_no = $(this).attr("id");
      $('#row' + row_no).remove();
    });

    // ketika di click - maka akan mengurangi detail mekanik
    $(document).on('click', '.remove2', function() {
      var row_no = $(this).attr("id");
      $('#row2' + row_no).remove();
    });

    // mengambil total harga
    $(document).on('keyup', '.gaji', function(event) {
      event.preventDefault();
      var form_data = $("#transaksi_form").serialize();
      $.ajax({
        url: "penggajian/ambil_total.php",
        method: "POST",
        data: form_data,
        success: function(data) {
          $('#total_penggajian').val(data);
        }
      });
    });
    $(document).on('change', '.gaji', function(event) {
      event.preventDefault();
      var form_data = $("#transaksi_form").serialize();
      $.ajax({
        url: "penggajian/ambil_total.php",
        method: "POST",
        data: form_data,
        success: function(data) {
          $('#total_penggajian').val(data);
        }
      });
    });
    $(document).on('click', '.remove_gaji', function(event) {
      event.preventDefault();
      var form_data = $("#transaksi_form").serialize();
      $.ajax({
        url: "penggajian/ambil_total.php",
        method: "POST",
        data: form_data,
        success: function(data) {
          $('#total_penggajian').val(data);
        }
      });
    });
    // end of mengambil total harga

  });

  // Menghitung kembalian
  function update() {
    var total_penggajian = document.getElementById("total_penggajian");
    var bayar = document.getElementById("bayar");
    var kembalian = document.getElementById("kembalian");

    // parsing dan perhitungan
    var v_total = parseFloat(total_penggajian.value);
    var v_bayar = parseFloat(bayar.value);

    if (v_bayar >= v_total) {
      kembalian.value = v_bayar - v_total;
    } else {
      kembalian.value = null;
    }
  }
  // end of Menghitung kembalian
</script>
<!-- script logika -->