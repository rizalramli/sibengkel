<?php
//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM pegawai WHERE kode_pegawai='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'admin.php?halaman=v_pegawai'</script>";
    }
}
?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>DAFTAR PEGAWAI</h2>
        <br>
        <a href="admin.php?halaman=add_pegawai" class="btn btn-success notika-btn-success">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Pegawai</th>
                    <th>Nama</th>
                    <th>Jenis Pegawai</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN jenis_pegawai USING(kode_jenis_p) ORDER BY kode_pegawai ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_pegawai'] ?></td>
                    <td><?= $data['nama_pegawai'] ?></td>
                    <td><?= $data['nama_jenis_p'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['no_telp'] ?></td>
                    <td>
                        <a href="?halaman=edit_pegawai&id=<?= $data['kode_pegawai'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_pegawai&hapus=<?= $data['kode_pegawai'] ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Pegawai</th>
                    <th>Nama</th>
                    <th>Jenis Pegawai</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>