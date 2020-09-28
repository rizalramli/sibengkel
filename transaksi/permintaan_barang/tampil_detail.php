<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Daftar Detail Barang</h2>
        <br>
        <a href="gudang.php?halaman=v_permintaan_barang" class="btn btn-success notika-btn-success">Kembali</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Stock Saat Ini</th>
                    <th>Satuan</th>
                    <th>Jumlah Perminatan</th>
                    <th>Harga Pokok</th>
                    <th>Sub Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // mengambil ID
                $id = $_GET['id'];

                $query = mysqli_query($koneksi, "SELECT * FROM detail_permintaan JOIN barang USING(kode_barang) JOIN merk USING(kode_merk) JOIN satuan USING(kode_satuan) JOIN jenis_barang USING(kode_jenis) WHERE kode_permintaan='$id' ORDER BY kode_detail_permintaan ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_barang'] ?></td>
                    <td><?= $data['nama_barang'] ?></td>
                    <td><?= $data['nama_jenis'] ?></td>
                    <td><?= $data['nama_merk'] ?></td>
                    <td><?= $data['stock'] ?></td>
                    <td><?= $data['nama_satuan'] ?></td>
                    <td><?= $data['jumlah_barang'] ?></td>
                    <td style="text-align: right;"><?= format_ribuan($data['harga_pokok']) ?></td>
                    <td style="text-align: right;"><?= format_ribuan($data['sub_total_harga']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Stock Saat Ini</th>
                    <th>Satuan</th>
                    <th>Jumlah Perminatan</th>
                    <th>Harga Pokok</th>
                    <th>Sub Total Harga</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>