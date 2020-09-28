<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Laporan Transaksi</h2>
        <br>
        <div class="row">
            <form action="halaman_print/print_laporan_transaksi.php" method="POST" target="_blank">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
                        <label>Dari Tanggal</label>
                        <div class="input-group date nk-int-st">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="tgl_mulai" placeholder="Isi form tanggal awal" required="" oninvalid="this.setCustomValidity('Tanggal Wajib Diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
                        <label>Sampai Tanggal</label>
                        <div class="input-group date nk-int-st">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="tgl_akhir" placeholder="Isi form tanggal akhir" required="" oninvalid="this.setCustomValidity('Tanggal Wajib Diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for=""></label>
                        <div class="input-group date nk-int-st">
                            <button type="submit" name="kirim" class="btn btn-primary"><i class="notika-icon notika-print"></i> Print Laporan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <br>
        <h2>Laporan Laba Rugi</h2>
        <br>
        <div class="row">
            <form action="halaman_print/laba_rugi.php" method="POST" target="_blank">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
                        <label>Dari Tanggal</label>
                        <div class="input-group date nk-int-st">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="tgl_mulai" placeholder="Isi form tanggal awal" required="" oninvalid="this.setCustomValidity('Tanggal Wajib Diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
                        <label>Sampai Tanggal</label>
                        <div class="input-group date nk-int-st">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="tgl_akhir" placeholder="Isi form tanggal akhir" required="" oninvalid="this.setCustomValidity('Tanggal Wajib Diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for=""></label>
                        <div class="input-group date nk-int-st">
                            <button type="submit" name="kirim" class="btn btn-primary"><i class="notika-icon notika-print"></i> Print Laporan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th>No Faktur</th>
                    <th>Nama Customer</th>
                    <th>Kasir</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Harga</th>
                    <th>Total Bayar</th>
                    <th>Total Kembalian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN customer USING (kode_customer) JOIN pegawai USING(kode_pegawai) ORDER BY tgl_transaksi DESC");
                foreach ($query as $data) {
                    $tgl_transaksi = $data['tgl_transaksi'];
                    $tanggal = date('d/m/Y H:i:s', strtotime($tgl_transaksi));
                    ?>
                <tr>
                    <td><?= $data['no_faktur_penjualan'] ?></td>
                    <td><?= $data['nama_customer'] ?></td>
                    <td><?= $data['nama_pegawai'] ?></td>
                    <td><?= $tanggal ?></td>
                    <td style="text-align: right;"><?= format_ribuan($data['total_harga']) ?></td>
                    <td style="text-align: right;"><?= format_ribuan($data['bayar']) ?></td>
                    <td style="text-align: right;"><?= format_ribuan($data['kembalian']) ?></td>

                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No Faktur</th>
                    <th>Yang Melayani</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Harga</th>
                    <th>Total Bayar</th>
                    <th>Total Kembalian</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>