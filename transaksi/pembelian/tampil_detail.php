<?php
if (isset($_GET['id'])) {
    // mengambil ID no_faktur_pembelian
    $id = $_GET['id'];

    // query ambil tabel pembelian
    $ambil_pembelian = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pegawai USING(kode_pegawai) JOIN suplier USING(kode_suplier) WHERE no_faktur_pembelian='$id'");
    foreach ($ambil_pembelian as $ambil_data) {
        $nama_pegawai =  $ambil_data['nama_pegawai'];
        $nama_suplier =  $ambil_data['nama_suplier'];
        $tgl_transaksi =  $ambil_data['tgl_transaksi'];
        $sub_total =  $ambil_data['sub_total'];
        $potongan =  $ambil_data['potongan'];
        $total_harga =  $ambil_data['total_harga'];
        $bayar =  $ambil_data['bayar'];
        $kembalian =  $ambil_data['kembalian'];
        $status =  $ambil_data['status'];
    }

    // ambil kode_permintaan di table purcase order
    $po = mysqli_query($koneksi, "SELECT kode_permintaan FROM purchase_order WHERE no_faktur_pembelian='$id'");
    foreach ($po as $ambil_data_po) {
        $kode_permintaan =  $ambil_data_po['kode_permintaan'];
    }

    // query ambil tabel detail permintaan
    $query_tampil_detail = mysqli_query($koneksi, "SELECT * FROM detail_permintaan JOIN barang USING(kode_barang) JOIN merk USING(kode_merk) JOIN satuan USING(kode_satuan) JOIN jenis_barang USING(kode_jenis) WHERE kode_permintaan='$kode_permintaan' ORDER BY kode_detail_permintaan ASC");
}
?>
<div class="container">

    <div style="margin-bottom: 20px;">
        <a href="?halaman=v_data_transaksi_pembelian" class="btn btn-primary btn-lg">Kembali</a>
    </div>
    <table class="table table-borderless" width="100">
        <tr>
            <th width="11%">Suplier</th>
            <th width="1%">:</th>
            <th><?= $nama_suplier ?></th>

            <th width="11%">Kasir</th>
            <th width="1%">:</th>
            <th><?= $nama_pegawai ?></th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th>:</th>
            <?php 
            $tanggal = date('d/m/Y H:i:s', strtotime($tgl_transaksi));
            ?>
            <th><?= $tanggal ?></th>

            <th>Total Harga</th>
            <th>:</th>
            <th><?= format_ribuan($total_harga) ?></th>
        </tr>

        <tr>
            <th> Sub Total Harga</th>
            <th>:</th>
            <th><?= format_ribuan($sub_total) ?></th>

            <th>Bayar</th>
            <th>:</th>
            <th><?= format_ribuan($bayar) ?></th>
        </tr>

        <tr>
            <th>Potongan</th>
            <th>:</th>
            <th><?= format_ribuan($potongan) ?></th>

            <th>Kembalian</th>
            <th>:</th>
            <th><?= format_ribuan($kembalian) ?></th>
        </tr>
    </table>
    <table class="table table-borderless" width="100%">
        <thead>
            <tr>
                <th width="7%" scope="col">NO</th>
                <th width="35%" scope="col">NAMA BARANG</th>
                <th width="10%" scope="col">QTY</th>
                <th width="10%" scope="col">HARGA POKOK</th>
                <th width="18%" scope="col">SATUAN</th>
                <th width="20%" style="text-align:center" scope="col">TOTAL HARGA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($query_tampil_detail as $data) {
                ?>
            <tr>
                <th width="7%" scope="row"><?= $no++ ?></th>
                <td width="35%"><?= $data['nama_barang'] ?></td>
                <td width="10%"><?= $data['jumlah_barang'] ?></td>
                <td width="10%" style="text-align:right"><?= $data['harga_pokok'] ?></td>
                <td width="18%"><?= $data['nama_satuan'] ?></td>
                <td width="20%" style="text-align:right"><?= $data['sub_total_harga'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- untuk ajax -->
<script src="assets/template2/js/vendor/jquery-3.3.1.min.js"></script>