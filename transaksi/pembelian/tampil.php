<div class="data-table-list">
  <div class="basic-tb-hd">
    <h2>Data Permintaan Pemasokan</h2>
  </div>
  <div class="table-responsive">
    <table id="data-table-basic" class="table table-striped">
      <thead>
        <tr>
          <th>Kode Permintaan</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM permintaan_barang WHERE status='0' ORDER BY kode_permintaan ASC");
        foreach ($query as $data) {
          $tgl = $data['tgl_permintaan'];
          $tanggal = date('d/m/Y H:i:s', strtotime($tgl));
          ?>
        <tr>
          <td><?= $data['kode_permintaan'] ?></td>
          <td><?= $tanggal ?></td>
          <td>
            <a href="?halaman=add_transaksi_pembelian&id=<?= $data['kode_permintaan'] ?>" class="btn btn-primary">Pilih</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Kode Permintaan</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>