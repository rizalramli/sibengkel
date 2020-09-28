<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

  // Membuat Kode otomatis
  $sql = mysqli_query($koneksi, "SELECT max(kode_barang) FROM barang");
  $kode_faktur = mysqli_fetch_array($sql);
  if ($kode_faktur) {
    $nilai = substr($kode_faktur[0], 1);
    $kode = (int) $nilai;
    //tambahkan sebanyak + 1
    $kode = $kode + 1;
    $auto_kode = "B" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
  } else {
    $auto_kode = "B0001";
  }

  $kode_merk = $_POST['kode_merk'];
  $kode_satuan = $_POST['kode_satuan'];
  $kode_jenis = $_POST['kode_jenis'];
  $nama_barang = ucfirst($_POST['nama_barang']);
  $stock = $_POST['stock'];
  $stock_limit = $_POST['stock_limit'];
  $harga2 = $_POST['harga_pokok'];
  $harga_string2 =  preg_replace("/[^0-9]/", "", $harga2);
  $harga_pokok = (int) $harga_string2;
  $harga = $_POST['harga_jual'];
  $harga_string =  preg_replace("/[^0-9]/", "", $harga);
  $harga_jual = (int) $harga_string;
  $query = mysqli_query($koneksi, "INSERT INTO barang VALUES ('$auto_kode','$kode_merk','$kode_satuan','$kode_jenis','$nama_barang','$stock','$stock_limit','$harga_pokok','$harga_jual') ");
  if ($query) {
    echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'gudang.php?halaman=v_daftarBarang'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'gudang.php?halaman=add_daftarBarang'</script>";
  }
}
?>
<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Tambah Barang</h2>
  </div>
  <form action="" method="post">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama Barang</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" name="nama_barang" class="form-control" placeholder="Isi form nama barang" required="" maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <label for="">Jenis Barang</label>
        <div class="form-group">
          <div class="bootstrap-select fm-cmp-mg">
            <select name="kode_jenis" class="selectpicker" data-live-search="true" required="">

              <option value="">Please select</option>

              <?php
              $query_jenis = mysqli_query($koneksi, "SELECT * FROM jenis_barang ORDER BY kode_jenis ASC");
              while ($data_jenis = mysqli_fetch_array($query_jenis)) {
                ?>

              <option value="<?= $data_jenis['kode_jenis'] ?>"><?= $data_jenis['nama_jenis'] ?></option>

              <?php } ?>

            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <label for="">Merk Barang</label>
        <div class="form-group">
          <div class="bootstrap-select fm-cmp-mg">
            <select name="kode_merk" class="selectpicker" data-live-search="true" required="">

              <option value="">Please select</option>

              <?php
              $query_merk = mysqli_query($koneksi, "SELECT * FROM merk ORDER BY kode_merk ASC");
              while ($data_merk = mysqli_fetch_array($query_merk)) {
                ?>

              <option value="<?= $data_merk['kode_merk'] ?>"><?= $data_merk['nama_merk'] ?></option>

              <?php } ?>

            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Stock Barang</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" onkeypress="return hanyaAngka(event)" name="stock" class="form-control" placeholder="Isi form stock barang" required="" max="99999" oninvalid="this.setCustomValidity('Stock Wajib Diisi & Harus Angka')" oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <label for="">Stock Limit Barang</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" onkeypress="return hanyaAngka(event)" name="stock_limit" class="form-control" placeholder="Isi form stock limit barang" required="" max="99999" oninvalid="this.setCustomValidity('Stock Limit Wajib Diisi & Harus Angka')" oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <label for="">Satuan Barang</label>
        <div class="form-group">
          <div class="bootstrap-select fm-cmp-mg">
            <select name="kode_satuan" class="selectpicker" data-live-search="true" required="">

              <option value="">Please select</option>

              <?php
              $query_satuan = mysqli_query($koneksi, "SELECT * FROM satuan ORDER BY kode_satuan ASC");
              while ($data_satuan = mysqli_fetch_array($query_satuan)) {
                ?>

              <option value="<?= $data_satuan['kode_satuan'] ?>"><?= $data_satuan['nama_satuan'] ?></option>

              <?php } ?>

            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Harga Pokok</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" id="rupiah2" name="harga_pokok" class="form-control" placeholder="Isi form harga pokok barang" required="" oninvalid="this.setCustomValidity('Harga Pokok Wajib Diisi & Harus Angka')" oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Harga Jual</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" id="rupiah" name="harga_jual" class="form-control" placeholder="Isi form harga jual barang" required="" oninvalid="this.setCustomValidity('Harga Jual Wajib Diisi & Harus Angka')" oninput="setCustomValidity('')">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="gudang.php?halaman=v_daftarBarang" class="btn btn-danger">Kembali</a>
      </div>

    </div>
  </form>
  <script type="text/javascript">
        var rupiah = document.getElementById('rupiah');
        rupiah.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value);
        });
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? + rupiah : '');
        }
    </script>
    <script type="text/javascript">
        var rupiah2 = document.getElementById('rupiah2');
        rupiah2.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah2.value = formatRupiah(this.value);
        });
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah2          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah2 += separator + ribuan.join('.');
            }
            rupiah2 = split[1] != undefined ? rupiah2 + ',' + split[1] : rupiah2;
            return prefix == undefined ? rupiah2 : (rupiah2 ? + rupiah2 : '');
        }
    </script>

</div>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
</script>