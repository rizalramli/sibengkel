<?php
//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus_detail = mysqli_query($koneksi, "DELETE FROM detail_permintaan WHERE kode_permintaan='$id'");
    $query_hapus = mysqli_query($koneksi, "DELETE FROM permintaan_barang WHERE kode_permintaan='$id'");
    if ($query_hapus_detail) {
        if ($query_hapus) {
            echo "<script>alert('Data Berhasil Dihapus'); window.location = 'gudang.php?halaman=v_permintaan_barang'</script>";
        }
    }
}
?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Data Permintaan Barang dan Spare Part</h2>
        <br>
        <a href="gudang.php?halaman=add_permintaan_barang" class="btn btn-success notika-btn-success">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Permintaan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM permintaan_barang WHERE status='0' ORDER BY kode_permintaan ASC");
                foreach ($query as $data) {
                    $tgl = $data['tgl_permintaan'];
                    $tanggal = date('d/m/Y H:i:s', strtotime($tgl));

                    ?>
                <tr>
                    <td><?= $data['kode_permintaan'] ?></td>
                    <td><?= $tanggal ?></td>
                    <td>
                        <a href="?halaman=v_detail_permintaan_barang&id=<?= $data['kode_permintaan'] ?>" class="btn btn-primary">Detail</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_permintaan_barang&hapus=<?= $data['kode_permintaan']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Permintaan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>