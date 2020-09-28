<?php
if (isset($_GET['id'])) {
    // mengambil ID kode_permintaan
    $id = $_GET['id'];

    // query ambil tabel detail permintaan
    $query_tampil_detail = mysqli_query($koneksi, "SELECT * FROM detail_permintaan JOIN barang USING(kode_barang) JOIN merk USING(kode_merk) JOIN satuan USING(kode_satuan) JOIN jenis_barang USING(kode_jenis) WHERE kode_permintaan='$id' ORDER BY kode_detail_permintaan ASC");

    // query ambil total / sub total
    $ambil_sub_total = mysqli_query($koneksi, "SELECT SUM(sub_total_harga) AS sub_total FROM detail_permintaan WHERE kode_permintaan='$id'");

    foreach ($ambil_sub_total as $ambil_data) {
        $sub_total =  $ambil_data['sub_total'];
    }
}
?>

<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

    // validasi apakah ada detail
    if (isset($_POST['kode_barang'])) {

        // Membuat Kode otomatis
        $sql = mysqli_query($koneksi, "SELECT max(no_faktur_pembelian) FROM pembelian");
        $kode_faktur = mysqli_fetch_array($sql);
        if ($kode_faktur) {
            $nilai = substr($kode_faktur[0], 3);
            $kode = (int) $nilai;
            //tambahkan sebanyak + 1
            $kode = $kode + 1;
            $auto_kode = "NFP" . str_pad($kode, 6, "0",  STR_PAD_LEFT);
        } else {
            $auto_kode = "NFP000001";
        }

        // mengupdate data tgl_last_log_in di database
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        // data table pemebelian
        $no_faktur_pembelian = $auto_kode;
        $kode_pegawai = $_SESSION['kode_pegawai'];
        $kode_suplier = $_POST['kode_suplier'];
        $tgl_transaksi = $now;
        $sub_total = $_POST['sub_total'];
        $potongan = $_POST['potongan'];
        $total_harga = $_POST['total_harga'];
        $bayar = $_POST['bayar'];
        $kembalian = $_POST['kembalian'];
        $status = 1;
        if ($bayar < $total_harga) {
          echo "<script>alert('Transaksi gagal,Pembayaran anda kurang'); window.location = 'kasir.php?halaman=add_transaksi_pembelian&id=" . $id . "'</script>";
        } 
        else if ($total_harga < 0) {
            echo "<script>alert('Transaksi gagal,Potongan harga melebihi total harga'); window.location = 'kasir.php?halaman=add_transaksi_pembelian&id=" . $id . "'</script>";
        } else {
            // proses input data tramsaksi ke dalam database
        $query = mysqli_query($koneksi, "INSERT INTO pembelian VALUES ('$no_faktur_pembelian','$kode_pegawai','$kode_suplier','$tgl_transaksi','$sub_total','$potongan','$total_harga','$bayar','$kembalian','$status') ");
        if ($query) {

            $kode_permintaan = $_GET['id'];

            $query_detail = mysqli_query($koneksi, "INSERT INTO purchase_order (no_faktur_pembelian,kode_permintaan) VALUES ('$no_faktur_pembelian','$kode_permintaan') ");
            if ($query_detail) {

                // update status
                mysqli_query($koneksi, "UPDATE permintaan_barang SET status='1' WHERE kode_permintaan='$kode_permintaan'");

                // perulangan update stok
                foreach ($query_tampil_detail as $data) {
                    $kode_barang_update = $data['kode_barang'];
                    $jumlah_barang_update = $data['jumlah_barang'];
                    $stock_lama = $data['stock'];

                    $stock_baru = $stock_lama +  $jumlah_barang_update;

                    // update stok
                    mysqli_query($koneksi, "UPDATE barang SET stock='$stock_baru' WHERE kode_barang='$kode_barang_update'");
                }

                echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'kasir.php?halaman=sukses_pembelian'</script>";
            } else {
                echo "<script>alert('Terjadi Kesalahan Input Detail Database'); window.location = 'kasir.php?halaman=add_transaksi_pembelian&id=" . $id . "'</script>";
            }
        } else {
            echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'kasir.php?halaman=add_transaksi_pembelian&id=" . $id . "'</script>";
        }
        } 
        
    } else {
        echo "<script>alert('Gagal Mengirim Data , data detail harus ada !'); window.location = 'kasir.php?halaman=add_transaksi_pembelian&id=" . $id . "'</script>";
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
                                    <select id="cari_kode_suplier" name="kode_suplier" required="" class="selectpicker" data-live-search="true">

                                        <option value="">Cari Suplier</option>

                                        <?php
                                        $query_suplier = mysqli_query($koneksi, "SELECT * FROM suplier ORDER BY kode_suplier ASC");
                                        while ($data_suplier = mysqli_fetch_array($query_suplier)) {
                                            ?>

                                        <option value="<?= $data_suplier['kode_suplier'] ?>"><?= $data_suplier['nama_suplier'] ?></option>

                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                        <label>No</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Kode Barang</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Nama Barang</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Jumlah Barang</label>
                    </div>
                </div>

                <div id="span_product_details">
                    <!-- disini isi detail -->
                    <?php
                    $index = 0;
                    foreach ($query_tampil_detail as $data) {
                        $index++;
                        ?>
                    <br />
                    <div id="row" class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <p><?= $index ?></p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control" id="kode_barang<?= $index ?>" name="kode_barang[]" readonly="" value="<?= $data['kode_barang'] ?>">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control" id="nama_barang<?= $index ?>" name="nama_barang[]" readonly="" value="<?= $data['nama_barang'] ?>">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <input type="text" class="form-control" id="jumlah_barang<?= $index ?>" name="jumlah_barang[]" readonly="" value="<?= $data['jumlah_barang'] ?>">
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="contact-inner">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="basic-tb-hd">
                                <h2 class="text-center">Form Pembayaran</h2>
                            </div>
                            <table width="100%">
                                <tr>
                                    <td width="60%">
                                        <h5>Sub Total</h5>
                                    </td>
                                    <td width="40%">
                                        <input style="text-align: right;" type="number" class="form-control" id="sub_total_hrg" name="sub_total" readonly="" value="<?= $sub_total ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="60%">
                                        <h5>Potongan Harga</h5>
                                    </td>
                                    <td style="text-align: right;  padding-top: 10px;"><input style="text-align: right;" type="text" onkeypress="return hanyaAngka(event)" class="form-control" required="" id="potongan" name="potongan" max="9999999999" onkeyup="update()" onchange="update()"></td>
                                </tr>
                                        <input type="hidden" class="form-control" id="total" name="total_harga" readonly="">
                                    
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
                                    <td width="40%" style="text-align: right;"><input style="text-align: right;" type="text" onkeypress="return hanyaAngka(event)" class="form-control" required="" id="bayar" name="bayar" required="" max="9999999999" oninvalid="this.setCustomValidity('Bayar Wajib Diisi')" oninput="setCustomValidity('')" onkeyup="update()" onchange="update()"></td>
                                </tr>
                                <tr>
                                    <td width="60%">
                                        <h5>Kembalian</h5>
                                    </td>
                                    <td width="40%" style="text-align: right;  padding-top: 10px;">
                                        <input style="text-align: right;" type="number" class="form-control" id="kembalian" name="kembalian" readonly="">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <br>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <button onclick="return confirm('Yakin ingin Melakukan Pemasokan ?')" id="action" type="submit" name="simpan" class="btn btn-primary col-md-12">Simpan</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <a href="kasir.php?halaman=v_transaksi_pembelian" class="btn btn-danger col-md-12">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<!-- untuk ajax -->
<script src="assets/template2/js/vendor/jquery-3.3.1.min.js"></script>

<script>
    // Menghitung kembalian
    function update() {
        var sub_total_hrg = document.getElementById("sub_total_hrg");
        var potongan = document.getElementById("potongan");
        var total = document.getElementById("total");
        var bayar = document.getElementById("bayar");
        var kembalian = document.getElementById("kembalian");

        var potongan_temp = 0;

        // cek apakah kosong
        if (potongan.value.length == 0) {
            potongan_temp = 0;
        } else {
            potongan_temp = potongan.value;
        }

        // parsing dan perhitungan
        var v_total = parseInt(sub_total_hrg.value) - parseInt(potongan_temp);
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
<!-- Harus Angka -->
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
</script>