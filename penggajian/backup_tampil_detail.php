<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Daftar Detail Penggajian</h2>
        <br>
        <a href="admin.php?halaman=v_penggajian" class="btn btn-success notika-btn-success">Kembali</a>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Priode Gaji</th>
                    <th>Jumlah Hari Kerja</th>
                    <th>Total Gaji</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // mengambil ID
                $id = $_GET['id'];

                $query = mysqli_query($koneksi, "SELECT * FROM detail_penggajian JOIN pegawai USING(kode_pegawai) JOIN jenis_pegawai USING(kode_jenis_p) WHERE kode_penggajian='$id' ORDER BY kode_detail_penggajian ASC");
                foreach ($query as $data) {
                    ?>
                <tr>
                    <td><?= $data['kode_pegawai'] ?></td>
                    <td><?= $data['nama_pegawai'] ?></td>
                    <td><?= $data['nama_jenis_p'] ?></td>
                    <td><?= $data['periode_gaji'] ?></td>
                    <td><?= $data['jumlah_hari_kerja'] ?></td>
                    <td style="text-align: right;"><?= format_ribuan($data['total_gaji']) ?></td>
                </tr>
                <?php }

                $query2 = mysqli_query($koneksi, "SELECT * FROM detail_penggajian_m JOIN mekanik USING(kode_mekanik) WHERE kode_penggajian='$id' ORDER BY kode_detail_pm ASC");
                foreach ($query2 as $data2) {
                    ?>
                <tr>
                    <td><?= $data2['kode_mekanik'] ?></td>
                    <td><?= $data2['nama_mekanik'] ?></td>
                    <td>Mekanik</td>
                    <td><?= $data2['periode_gaji'] ?></td>
                    <td><?= $data2['jumlah_hari_kerja'] ?></td>
                    <td style="text-align: right;"><?= format_ribuan($data2['total_gaji']) ?></td>
                </tr>
                <?php }
                ?>
            </tbody>
            <tfoot>

                <?php

                // mengambil total gaji pegawai
                $query3 = mysqli_query($koneksi, "SELECT SUM(total_penggajian) AS total FROM penggajian WHERE kode_penggajian='$id'");
                foreach ($query3 as $data3) {
                    $total =  $data3['total'];
                }

                ?>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Jumlah Total Gaji : </th>
                    <th style="text-align: right;"><?= format_ribuan($total) ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>