<?php
//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM service WHERE kode_service='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'kasir.php?halaman=v_tarifService'</script>";
    }
}
?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Tarif Service</h2>
        <br>
        <a href="kasir.php?halaman=add_tarifService" class="btn btn-success notika-btn-success">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Service</th>
                    <th>Nama Service</th>
                    <th>Tarif Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM service ORDER BY kode_service ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_service'] ?></td>
                    <td><?= $data['nama_service'] ?></td>
                    <td style="text-align: right;"><?= format_ribuan($data['tarif_harga']) ?></td>
                    <td>
                        <a href="?halaman=edit_tarifService&id=<?= $data['kode_service']; ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_tarifService&hapus=<?= $data['kode_service']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Service</th>
                    <th>Nama Service</th>
                    <th>Tarif Harga</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>