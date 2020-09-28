<?php
//Proses menghapus data
if (isset($_GET['penggajian_pegawai'])) {
    $id = $_GET['penggajian_pegawai'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM detail_penggajian WHERE kode_detail_penggajian='$id'");
    if ($query_hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'admin.php?halaman=v_penggajian'</script>";
    }
}
if (isset($_GET['penggajian_mekanik'])) {
    $id2 = $_GET['penggajian_mekanik'];
    $query_hapus2 = mysqli_query($koneksi, "DELETE FROM detail_penggajian_m WHERE kode_detail_pm='$id2'");
    if ($query_hapus2) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location = 'admin.php?halaman=v_penggajian'</script>";
    }
}
?>
<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Data Penggajian</h2>
        <br>
        <a href="admin.php?halaman=add_penggajian" class="btn btn-success notika-btn-success">Lakukan Penggajian</a>
    </div>
    <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="widget-tabs-int">
                    <div class="widget-tabs-list">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Daftar Penggajian Pegawai</a></li>
                            <li><a data-toggle="tab" href="#menu2">Daftar Penggajian Mekanik</a></li>
                        </ul>
                        <div class="tab-content tab-custom-st">
                            <div id="home" class="tab-pane fade in active">
                                <div class="tab-ctn">
                                    <div class="data-table-list">
                                    <div class="table-responsive">
                                    <table id="data-table-basic" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th align="right">Nama</th>
                                                <th align="right">Lama Kerja</th>
                                                <th align="right">Lama Lembur</th>
                                                <th align="right">Periode</th>
                                                <th align="right">Total Gaji</th>
                                                <th align="right">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM detail_penggajian JOIN pegawai USING(kode_pegawai) ORDER BY kode_detail_penggajian DESC");
                                            foreach ($query as $data) {
                                                ?>
                                            <tr>
                                                <td><?= $data['nama_pegawai'] ?></td>
                                                <td><?= $data['lama_kerja'] ?></td>
                                                <td><?= $data['lama_lembur'] ?></td>
                                                <td><?= date('F Y', strtotime($data['tanggal_penggajian'])); ?></td>
                                                <td align="right"><?= format_ribuan($data['total_gaji']) ?></td>
                                                <td align="center">
                                                    <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_penggajian&penggajian_pegawai=<?= $data['kode_detail_penggajian'] ?>" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th align="right">Nama</th>
                                                <th align="right">Lama Kerja</th>
                                                <th align="right">Lama Lembur</th>
                                                <th align="right">Periode</th>
                                                <th align="right">Total Gaji</th>
                                                <th align="right">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="tab-ctn">
                                    <div class="data-table-list">
                                        <div class="table-responsive">
                                        <table id="data-table-basic2" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th align="right">Nama</th>
                                                <th align="right">Lama Kerja</th>
                                                <th align="right">Lama Lembur</th>
                                                <th align="right">Periode</th>
                                                <th align="right">Total Gaji</th>
                                                <th align="right">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query2 = mysqli_query($koneksi, "SELECT * FROM detail_penggajian_m JOIN mekanik USING(kode_mekanik) ORDER BY kode_detail_pm DESC");
                                            foreach ($query2 as $data2) {
                                                ?>
                                            <tr>
                                                <td><?= $data2['nama_mekanik'] ?></td>
                                                <td><?= $data2['lama_kerja'] ?></td>
                                                <td><?= $data2['lama_lembur'] ?></td>
                                                <td><?= date('F Y', strtotime($data2['tanggal_penggajian'])); ?></td>
                                                <td align="right"><?= format_ribuan($data2['total_gaji']) ?></td>
                                                <td align="center">
                                                    <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=v_penggajian&penggajian_mekanik=<?= $data2['kode_detail_pm'] ?>" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th align="right">Nama</th>
                                                <th align="right">Lama Kerja</th>
                                                <th align="right">Lama Lembur</th>
                                                <th align="right">Periode</th>
                                                <th align="right">Total Gaji</th>
                                                <th align="right">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
</div>
