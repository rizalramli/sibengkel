<?php
//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM jenis_barang WHERE kode_jenis='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'gudang.php?halaman=v_jenisBarang'</script>";
    }
}
?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Jenis Barang</h2>
        <br>
        <a href="gudang.php?halaman=add_jenisBarang" class="btn btn-success notika-btn-success">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Jenis Barang</th>
                    <th>Nama Jenis Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT kode_jenis,nama_jenis FROM jenis_barang ORDER BY kode_jenis ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_jenis'] ?></td>
                    <td><?= $data['nama_jenis'] ?></td>
                    <td>
                        <a href="?halaman=edit_jenisBarang&id=<?= $data['kode_jenis']; ?>"" class=" btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_jenisBarang&hapus=<?= $data['kode_jenis']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Jenis Barang</th>
                    <th>Nama Jenis Barang</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>