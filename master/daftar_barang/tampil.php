<?php
//Proses menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE kode_barang='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'gudang.php?halaman=v_daftarBarang'</script>";
    }
}
?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Daftar Barang</h2>
        <br>
        <a href="gudang.php?halaman=add_daftarBarang" class="btn btn-success notika-btn-success">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Stock</th>
                    <th>Satuan</th>
                    <th>Harga Pokok</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM barang JOIN merk USING(kode_merk) JOIN satuan USING(kode_satuan) JOIN jenis_barang USING(kode_jenis) ORDER BY kode_barang ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_barang'] ?></td>
                    <td><?= $data['nama_barang'] ?></td>
                    <td><?= $data['nama_jenis'] ?></td>
                    <td><?= $data['nama_merk'] ?></td>
                    <td><?= $data['stock'] ?></td>
                    <td><?= $data['nama_satuan'] ?></td>
                    <td style="text-align: right"><?= format_ribuan($data['harga_pokok']) ?></td>
                    <td style="text-align: right;"><?= format_ribuan($data['harga_jual']) ?></td>
                    <td>
                        <a href="?halaman=edit_daftarBarang&id=<?= $data['kode_barang'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_daftarBarang&hapus=<?= $data['kode_barang'] ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Stock</th>
                    <th>Satuan</th>
                    <th>Harga Pokok</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>