<?php

//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM mekanik WHERE kode_mekanik='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'admin.php?halaman=v_mekanik'</script>";
    }
}

?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Data Tabel Mekanik</h2>
        <br>
        <a href="admin.php?halaman=add_mekanik" class="btn btn-success notika-btn-success">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Mekanik</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM mekanik ORDER BY kode_mekanik ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_mekanik'] ?></td>
                    <td><?= $data['nama_mekanik'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['no_telp'] ?></td>
                    <td>
                        <a href="?halaman=edit_mekanik&id=<?= $data['kode_mekanik'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_mekanik&hapus=<?= $data['kode_mekanik'] ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Mekanik</th>
                    <th>Nama mekanik</th>
                    <th>Alamat</th>
                    <th>No telp</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>