<?php

//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM customer WHERE kode_customer='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'cs.php?halaman=v_customer'</script>";
    }
}

?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Data Tabel Customer</h2>
        <br>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Customer</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM customer ORDER BY kode_customer ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_customer'] ?></td>
                    <td><?= $data['nama_customer'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['no_telp'] ?></td>
                    <td>
                        <a href="?halaman=edit_customer&id=<?= $data['kode_customer'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_customer&hapus=<?= $data['kode_customer'] ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Customer</th>
                    <th>Nama Customer</th>
                    <th>Alamat</th>
                    <th>No telp</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>