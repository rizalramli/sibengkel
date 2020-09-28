<?php
//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM jenis_pegawai WHERE kode_jenis_p='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'admin.php?halaman=v_jenis_pegawai'</script>";
    }
}
?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Jenis Pegawai</h2>
        <br>
        <a href="admin.php?halaman=add_jenis_pegawai" class="btn btn-success notika-btn-success">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Jenis Pegawai</th>
                    <th>Nama Jenis Pegawai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM jenis_pegawai ORDER BY kode_jenis_p ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_jenis_p'] ?></td>
                    <td><?= $data['nama_jenis_p'] ?></td>
                    <td>
                        <a href="?halaman=edit_jenis_pegawai&id=<?= $data['kode_jenis_p'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_jenis_pegawai&hapus=<?= $data['kode_jenis_p']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Jenis Pegawai</th>
                    <th>Nama Jenis Pegawai</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>