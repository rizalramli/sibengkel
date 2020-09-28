<?php
//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM satuan WHERE kode_satuan='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'gudang.php?halaman=v_satuanBarang'</script>";
    }
}
?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Satuan Barang</h2>
        <br>
        <a href="gudang.php?halaman=add_satuanBarang" class="btn btn-success notika-btn-success">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Satuan Barang</th>
                    <th>Nama Satuan Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT kode_satuan,nama_satuan FROM satuan ORDER BY kode_satuan ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_satuan'] ?></td>
                    <td><?= $data['nama_satuan'] ?></td>
                    <td>
                        <a href="?halaman=edit_satuanBarang&id=<?= $data['kode_satuan']; ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_satuanBarang&hapus=<?= $data['kode_satuan']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Satuan Barang</th>
                    <th>Nama Satuan Barang</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>