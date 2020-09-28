<?php
//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // ambil kode_permintaan di table purcase order
    $po = mysqli_query($koneksi, "SELECT kode_permintaan FROM purchase_order WHERE no_faktur_pembelian='$id'");
    foreach ($po as $ambil_data_po) {
        $kode_permintaan =  $ambil_data_po['kode_permintaan'];
    }

    // update status
    mysqli_query($koneksi, "UPDATE pembelian SET status='0' WHERE no_faktur_pembelian='$id'");
    // update status
    mysqli_query($koneksi, "UPDATE permintaan_barang SET status='0' WHERE kode_permintaan='$kode_permintaan'");

    echo "<script>alert('Data Berhasil Dihapus'); window.location = 'kasir.php?halaman=v_data_transaksi_pembelian'</script>";
}
?>

<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Data Transaksi Pemasokan</h2>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Pemasokan</th>
                    <th>Suplier</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN suplier USING(kode_suplier) WHERE status ='1' ORDER BY no_faktur_pembelian ASC");
                foreach ($query as $data) {
                    $tgl = $data['tgl_transaksi'];
                    $tanggal = date('d/m/Y H:i:s', strtotime($tgl));
                    ?>
                <tr>
                    <td><?= $data['no_faktur_pembelian'] ?></td>
                    <td><?= $data['nama_suplier'] ?></td>
                    <td><?= $tanggal ?></td>
                    <td>
                        <a href="?halaman=detail_transaksi_pembelian&id=<?= $data['no_faktur_pembelian'] ?>" class="btn btn-primary">Lihat Detail</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_data_transaksi_pembelian&hapus=<?= $data['no_faktur_pembelian']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Pemasokan</th>
                    <th>Suplier</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>