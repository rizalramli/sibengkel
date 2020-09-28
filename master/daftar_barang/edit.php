<?php
// mengambil ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM barang JOIN merk USING(kode_merk) JOIN satuan USING(kode_satuan) JOIN jenis_barang USING(kode_jenis) WHERE kode_barang='$id'");

if (isset($_POST['update'])) {
  $kode_barang = $_POST['kode_barang'];
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

  $update = mysqli_query($koneksi, "UPDATE barang SET kode_merk='$kode_merk',kode_satuan='$kode_satuan',kode_jenis='$kode_jenis',nama_barang='$nama_barang',stock='$stock',stock_limit='$stock_limit',harga_pokok='$harga_pokok',harga_jual='$harga_jual' WHERE kode_barang='$kode_barang'");
  if ($update) {
    echo "<script>alert('Data Berhasil Terupdate'); window.location = 'gudang.php?halaman=v_daftarBarang'</script>";
  } else {
    echo "<script>alert('Terjadi Kesalahan Update Database'); window.location = 'gudang.php?halaman=edit_daftarBarang&id=" .$id."'</script>";
  }
}

?>
<div class="form-element-list">
  <div class="basic-tb-hd">
    <h2>Form Edit Barang</h2>
  </div>
  <?php
  foreach ($query as $data) {
    ?>
  <form action="" method="post">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Nama Barang</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="hidden" name="kode_barang" class="form-control" placeholder="Isi form nama barang" value="<?= $data['kode_barang'] ?>">
            <input type="text" name="nama_barang" class="form-control" placeholder="Isi form nama barang" required="" maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')" value="<?= $data['nama_barang'] ?>">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <label for="">Jenis Barang</label>
        <div class="form-group">
          <div class="bootstrap-select fm-cmp-mg">
            <select name="kode_jenis" class="selectpicker" data-live-search="true" required="">
              <?php
                $query_jenis = mysqli_query($koneksi, "SELECT * FROM jenis_barang ORDER BY kode_jenis ASC");
                foreach ($query_jenis as $data_jenis) {
                  ?>
              <option value="<?php echo $data_jenis["kode_jenis"]; ?>" <?php if ($data['kode_jenis'] == $data_jenis["kode_jenis"]) {
                                                                              echo "selected";
                                                                            } ?>>
                <?php echo $data_jenis["nama_jenis"]; ?>
              </option>
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
              <?php
                $query_merk = mysqli_query($koneksi, "SELECT * FROM merk ORDER BY kode_merk ASC");
                foreach ($query_merk as $data_merk) {
                  ?>
              <option value="<?php echo $data_merk["kode_merk"]; ?>" <?php if ($data['kode_merk'] == $data_merk["kode_merk"]) {
                                                                            echo "selected";
                                                                          } ?>>
                <?php echo $data_merk["nama_merk"]; ?>
              </option>
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
            <input type="text" onkeypress="return hanyaAngka(event)" name="stock" class="form-control" placeholder="Isi form stock barang" required="" max="99999" oninvalid="this.setCustomValidity('Stock Wajib Diisi & Harus Angka')" oninput="setCustomValidity('')" value="<?= $data['stock'] ?>">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <label for="">Stock Limit Barang</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" onkeypress="return hanyaAngka(event)" name="stock_limit" class="form-control" placeholder="Isi form stock limit barang" required="" max="99999" oninvalid="this.setCustomValidity('Stock Limit Barang Wajib Diisi & Harus Angka')" oninput="setCustomValidity('')" value="<?= $data['stock_limit'] ?>">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <label for="">Satuan Barang</label>
        <div class="form-group">
          <div class="bootstrap-select fm-cmp-mg">
            <select name="kode_satuan" class="selectpicker" data-live-search="true" required="">
              <?php
                $query_satuan = mysqli_query($koneksi, "SELECT * FROM satuan ORDER BY kode_satuan ASC");
                foreach ($query_satuan as $data_satuan) {
                  ?>
              <option value="<?php echo $data_satuan["kode_satuan"]; ?>" <?php if ($data['kode_satuan'] == $data_satuan["kode_satuan"]) {
                                                                                echo "selected";
                                                                              } ?>>
                <?php echo $data_satuan["nama_satuan"]; ?>
              </option>
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
            <input type="text" id="rupiah2" name="harga_pokok" class="form-control" placeholder="Isi form harga pokok barang" required="" oninvalid="this.setCustomValidity('Harga Pokok Wajib Diisi')" oninput="setCustomValidity('')" value="<?= format_ribuan($data['harga_pokok']) ?>">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Harga Jual</label>
        <div class="form-group">
          <div class="nk-int-st">
            <input type="text" id="rupiah" name="harga_jual" class="form-control" placeholder="Isi form harga jual barang" required=""  oninvalid="this.setCustomValidity('Harga Jual Wajib Diisi')" oninput="setCustomValidity('')" value="<?= format_ribuan($data['harga_jual']) ?>">
          </div>
        </div>
      </div>
    </div>
    <div class="row">

    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button type="submit" name="update" class="btn btn-primary">Update</button>
      <a href="gudang.php?halaman=v_daftarBarang" class="btn btn-danger">Kembali</a>
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
    <script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
</script>

</div>
<?php } ?>
