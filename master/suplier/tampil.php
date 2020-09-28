<?php

//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM suplier WHERE kode_suplier='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'kasir.php?halaman=v_suplier'</script>";
    }
}

?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Data Tabel Suplier</h2>
        <br>
        <a href="kasir.php?halaman=add_suplier" class="btn btn-success notika-btn-success">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Suplier</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kontak Person</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM suplier ORDER BY kode_suplier ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_suplier'] ?></td>
                    <td><?= $data['nama_suplier'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['kontak_person'] ?></td>
                    <td><?= $data['telp'] ?></td>
                    <td>
                        <a href="?halaman=edit_suplier&id=<?= $data['kode_suplier'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_suplier&hapus=<?= $data['kode_suplier'] ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Suplier</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kontak Person</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>