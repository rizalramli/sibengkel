<?php
if (isset($_POST['simpan'])) {
  //kode otomatis

  // validasi apakah ada detail
  if (isset($_POST['kode_barang2'])) {
    $sql = mysqli_query($koneksi, "SELECT max(no_faktur_penjualan) FROM penjualan");
    $kode_faktur = mysqli_fetch_array($sql);
    if ($kode_faktur) {
      $nilai = substr($kode_faktur[0], 2);
      $kode = (int) $nilai;
      //tambahkan sebanyak + 1
      $kode = $kode + 1;
      $auto_kode = "FK" . str_pad($kode, 6, "0",  STR_PAD_LEFT);
    } else {
      $auto_kode = "FK000001";
    }
    $sql2 = mysqli_query($koneksi, "SELECT max(kode_customer) FROM customer");
    $kode_faktur2 = mysqli_fetch_array($sql2);
    if ($kode_faktur2) {
      $nilai2 = substr($kode_faktur2[0], 1);
      $kode2 = (int) $nilai2;
      //tambahkan sebanyak + 1
      $kode2 = $kode2 + 1;
      $auto_kode2 = "K" . str_pad($kode2, 4, "0",  STR_PAD_LEFT);
    } else {
      $auto_kode2 = "K0001";
    }
    $no_faktur_penjualan = $auto_kode;
    $kode_customer = $auto_kode2;
    $kode_pegawai = $_SESSION['kode_pegawai'];
    date_default_timezone_set('Asia/Jakarta');
    $tgl_transaksi = date('Y-m-d H:i:s');
    $total_harga = $_POST['total_harga'];
    $total = $_POST['total'];
    $potongan_harga = $_POST['potongan_harga'];
    $bayar = $_POST['bayar'];
    $kembalian = $_POST['kembalian'];
    $status = "0";
    $query_cek_customer = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM customer WHERE nama_customer='Umum'");
    $data_customer = mysqli_fetch_array($query_cek_customer);
    $cek_customer = $data_customer['jumlah'];
    if ($bayar < $total) {
        echo "<script>alert('Transaksi gagal,Pembayaran anda kurang'); window.location = 'kasir.php?halaman=transaksi_penjualan_barang'</script>";
    }
    else if ($total < 0) {
        echo "<script>alert('Transaksi gagal,Potongan harga melebihi total harga'); window.location = 'kasir.php?halaman=transaksi_penjualan_barang'</script>";
    } 
    else if ($cek_customer == 0) {
      $query_customer = mysqli_query($koneksi, "INSERT INTO customer VALUES ('$kode_customer','Umum','-','-') ");
      $query_penjualan = mysqli_query($koneksi, "INSERT INTO penjualan VALUES ('$no_faktur_penjualan','$kode_customer','$kode_pegawai','$tgl_transaksi','$total','$potongan_harga','$bayar','$kembalian','$status')");
      // INSERT DATA DETAIL PENJUALAN BARANG
    for ($i = 0; $i < count($_POST['kode_barang2']); $i++) {
      // data - data
      $kode_barang = $_POST['kode_barang2'][$i];
      $jumlah_barang = $_POST['jumlah_barang'][$i];
      $harga_jual = $_POST['harga_jual'][$i];
      // sub total
      $sub_total_harga = $jumlah_barang * $harga_jual;

      $qq = mysqli_query($koneksi, "SELECT * FROM barang WHERE kode_barang='$kode_barang'");
      $f = mysqli_fetch_array($qq);
      $ids = $f['kode_barang'];
      $stock_sekarang = $f['stock'];
      $stock_baru = $stock_sekarang - $jumlah_barang;
      mysqli_query($koneksi, "UPDATE barang SET stock='$stock_baru' WHERE kode_barang='$ids'");

      $query_detail_barang = mysqli_query($koneksi, "INSERT INTO detail_penjualan_barang VALUES ('','$no_faktur_penjualan','$kode_barang','$jumlah_barang','$sub_total_harga') ");
    }

    echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'kasir.php?halaman=sukses'</script>";
    } else {
      $query_ambil_customer = mysqli_query($koneksi, "SELECT * FROM customer WHERE nama_customer='Umum'");
      $data_customer2 = mysqli_fetch_array($query_ambil_customer);
      $kode_customer2 = $data_customer2['kode_customer'];
      $query_penjualan = mysqli_query($koneksi, "INSERT INTO penjualan VALUES ('$no_faktur_penjualan','$kode_customer2','$kode_pegawai','$tgl_transaksi','$total_harga','$potongan_harga','$bayar','$kembalian','$status')");
      // INSERT DATA DETAIL PENJUALAN BARANG
    for ($i = 0; $i < count($_POST['kode_barang2']); $i++) {
      // data - data
      $kode_barang = $_POST['kode_barang2'][$i];
      $jumlah_barang = $_POST['jumlah_barang'][$i];
      $harga_jual = $_POST['harga_jual'][$i];
      // sub total
      $sub_total_harga = $jumlah_barang * $harga_jual;

      $qq = mysqli_query($koneksi, "SELECT * FROM barang WHERE kode_barang='$kode_barang'");
      $f = mysqli_fetch_array($qq);
      $ids = $f['kode_barang'];
      $stock_sekarang = $f['stock'];
      $stock_baru = $stock_sekarang - $jumlah_barang;
      mysqli_query($koneksi, "UPDATE barang SET stock='$stock_baru' WHERE kode_barang='$ids'");

      $query_detail_barang = mysqli_query($koneksi, "INSERT INTO detail_penjualan_barang VALUES ('','$no_faktur_penjualan','$kode_barang','$jumlah_barang','$sub_total_harga') ");
    }

    echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'kasir.php?halaman=sukses'</script>";
    }
  } else {
    echo "<script>alert('Gagal Mengirim Data , data detail harus ada !'); window.location = 'kasir.php?halaman=transaksi_penjualan_barang'</script>";
  }
}
?>
<form action="" method="post" id="transaksi_form">
  <div class="contact-info-area mg-t-30">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="contact-inner">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
              <div class="bootstrap-select fm-cmp-mg">
                <select class="selectpicker kode_barangs" name="kode_barang" id="kode_barang" data-live-search="true">
                  <option value="">Cari Barang</option>
                  <?php
                  $query_barang = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_barang ASC");
                  while ($data_barang = mysqli_fetch_array($query_barang)) {
                    ?>
                  <option value="<?= $data_barang['kode_barang'] ?>"><?= $data_barang['nama_barang'] ?></option>
                  <?php } ?>
                </select>
                <div id="tampil_barang">
                  <!-- disini load barang ketika dipilih option diatas -->
                </div>
              </div>
            </div>
            <div class="col-lg-1">
              <div class="form-group">
                <a id="btn_cart_barang" onclick="setTimeout(update_total, 100)" name="add_more"
                  class="btn btn-primary">+</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
              <label>No</label>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <label>Nama Barang</label>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
              <label>Harga</label>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
              <label>Jumlah</label>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <label>Sub Total</label>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
              <label>Aksi</label>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div id="cart_barang">
                <!-- disini isi detail -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="contact-inner">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="basic-tb-hd">
                <h2 class="text-center">Form Pembayaran</h2>
              </div>
              <table width="100%">
                <tr>
                  <td width="60%">
                    <h5>Total Harga</h5>
                  </td>
                  <td width="40%">
                    <h5><input style="text-align:right;" type="text" class="total_harga form-control" id="total_harga"
                        name="total_harga" readonly=""></h5>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 9px;">
                    <h5>Potongan Harga</h5>
                  </td>
                  <td style="padding-top: 5px">
                    <h5><input style="text-align: right;" type="text" onkeypress="return hanyaAngka(event)"
                        class="form-control" required="" id="potongan_harga" name="potongan_harga" max="9999999999"
                        onkeyup="update_kembalian()" onchange="update_kembalian()"></h5>
                    <input type="hidden" id="total" name="total">
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div style="margin-top: 30px;" class="contact-inner">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <table width="100%">
                <tr>
                  <td style="padding-top: 15px;" width="60%">
                    <h5>Bayar</h5>
                  </td>
                  <td width="40%"><input style="text-align: right;" id="bayar" name="bayar" type="text"
                      onkeypress="return hanyaAngka(event)" class="form-control" required="" max="9999999999"
                      oninvalid="this.setCustomValidity('Bayar Wajib Diisi')" oninput="setCustomValidity('')"
                      onkeyup="update_kembalian()" onchange="update_kembalian()"></td>
                </tr>
                <tr>
                  <td style="padding: 20px 0px;">
                    <h5>Kembalian</h5>
                  </td>
                  <td style="padding: 20px 0px;">
                    <h5><input style="text-align:right;" type="text" class="form-control" readonly="" id="kembalian"
                        name="kembalian"></h5>
                  </td>
                </tr>

              </table>
              <button style="width: 157px;" type="submit" name="simpan" class="btn btn-primary">Simpan</button>
              <a style="width: 157px;" href="kasir.php?halaman=v_work_order" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="assets/template2/js/vendor/jquery-3.3.1.min.js"></script>
<!-- Ambil Harga Barang -->
<script>
  $(document).ready(function () {
    $('#kode_barang').change(function (event) {
      event.preventDefault();
      var kode_barang = $(this).val();
      $.ajax({
        url: "transaksi/penjualan/load_data_barang.php",
        method: "POST",
        data: {
          kode_barang: kode_barang
        },
        success: function (data) {
          $('#tampil_barang').html(data);
        }
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#cart_barang').html('');
    var count1 = -1;
    var kode_barang = "";

    // menambah detail pemasokan
    function add_row(count1, kode_barang, nama_barang, harga_jual, sub_total) {

      var nomer = count1 + 1;

      $('#cart_barang').append(`

          <div id="row` + count1 + `" class="row">
          <br />
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
              <p>` + nomer + `</p>
            </div>
            <div class="">
              <input type="hidden" class="form-control" id="kode_barang2` + count1 +
        `" name="kode_barang2[]" readonly="" value="` + kode_barang + `">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control" id="nama_barang` + count1 +
        `" name="nama_barang[]" readonly="" value="` + nama_barang + `">
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
              <input style="text-align:right;" type="text" class="form-control" id="harga_jual` + count1 +
        `" name="harga_jual[]" readonly="" value="` + harga_jual + `">
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
              <div class="form-group">
                <div class="nk-int-st">
                  <input style="text-align:center;" type="text" id="jumlah_barang` + count1 + `" name="jumlah_barang[]" class="jumlah_barang form-control" placeholder="Isi form Jumlah Pesan" value="1" required="" max="32000" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')"  onkeypress="return event.keyCode != 13;">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <input style="text-align:right;" type="text" class="sub_total form-control" id="sub_total` + count1 +
        `" name="sub_total[]" readonly="" value="` + harga_jual + `">
            </div>
            
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
              <button id="` + count1 + `" name="remove" class="remove btn btn-danger" onclick="setTimeout(update_total, 100)"><i class="notika-icon notika-trash"></i></button>
            </div>
          </div>
          
        `);
    }

    // ketika click + maka akan menambah baris
    $(document).on('click', '#btn_cart_barang', function () {

      // mengambil data dari select option daftar barang
      var cari_kode_barang = document.getElementById("kode_barang");
      var value = cari_kode_barang.options[cari_kode_barang.selectedIndex].value;
      var value2 = cari_kode_barang.options[cari_kode_barang.selectedIndex].text;
      var value3 = document.getElementById("harga_jual").value;


      // validasi cari barang 
      if (value == "") {
        alert("Pilih Barang");
      } else {
        count1 = count1 + 1;
        add_row(count1, value, value2, value3, value3);

        document.getElementById("kode_barang").selectedIndex = "0";
        $('.selectpicker').selectpicker('refresh');
      }

    });

    // ketika di click - maka akan mengurangi detail pemasokan
    $(document).on('click', '.remove', function () {
      var row_no = $(this).attr("id");
      $('#row' + row_no).remove();
    });

  });
</script>
<!-- script logika -->

<script>
  $(document).on('keyup', '.jumlah_barang', function (event) {
    event.preventDefault();
    var form_data = $("#transaksi_form").serialize();
    $.ajax({
      url: "transaksi/penjualan/total_penjualan_barang.php",
      method: "POST",
      data: form_data,
      success: function (data) {
        $('.total_harga').val(data);
        update_kembalian();
      }
    });

    // start of  update value sub_total inputan
    // proses ambil index
    var get_no_id = $(this).attr("id"); //---jumlah_barang + index
    var no_id_nya = get_no_id.substring(13); //---ambil indexnya saja

    // objek yg spesifik
    var harga_jual = document.getElementById("harga_jual" + no_id_nya);
    var jumlah_barang = document.getElementById("jumlah_barang" + no_id_nya);
    var sub_total = document.getElementById("sub_total" + no_id_nya);

    var v_sub_total = parseInt(harga_jual.value) * parseInt(jumlah_barang.value);

    if (v_sub_total >= 0) {
      sub_total.value = v_sub_total;
    }
  });

  // Menghitung 
  function update_total() {
    var form_data = $("#transaksi_form").serialize();
    $.ajax({
      url: "transaksi/penjualan/total_penjualan_service.php",
      method: "POST",
      data: form_data,
      success: function (data) {
        $('.total_harga').val(data);
        update_kembalian();
      }
    });
  }

  // Menghitung kembalian
  function update_kembalian() {
    var total_harga = document.getElementById("total_harga");
    var potongan_harga = document.getElementById("potongan_harga");
    var total = document.getElementById("total");
    var bayar = document.getElementById("bayar");
    var kembalian = document.getElementById("kembalian");

    var potongan_temp = 0;

    // cek apakah kosong
    if (potongan_harga.value.length == 0) {
      potongan_temp = 0;
    } else {
      potongan_temp = potongan_harga.value;
    }

    // parsing dan perhitungan
    var v_total = parseInt(total_harga.value) - parseInt(potongan_temp);
    var v_bayar = parseInt(bayar.value);

    total.value = v_total;

    if (v_bayar >= v_total) {
      kembalian.value = bayar.value - v_total;
    } else {
      kembalian.value = null;
    }
  }
  // Menghitung kembalian
</script>
<!-- Harus angka -->
<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>