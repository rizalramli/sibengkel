<?php 
if(!$success):
?>
<div class="form-element-list">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="basic-tb-hd">
          <div class="row" style="margin-bottom:27px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="widget-tabs-int">
                    <div class="widget-tabs-list">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Penggajian Pegawai</a></li>
                            <li><a data-toggle="tab" href="#menu2">Penggajian Mekanik</a></li>
                        </ul>
                        <div class="tab-content tab-custom-st">
                            <div id="home" class="tab-pane fade in active">
                                <div class="tab-ctn">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-group">
                                  <h2 class="text-center">Form Penggajian Pegawai</h2>
                                  <form action="?halaman=v_detail_penggajian" method="post">
                                    <div class="bootstrap-select fm-cmp-mg">
                                      <select name="kode_pegawai" id="cari_kode_pegawai" class="selectpicker" data-live-search="true">
                                        <option value="">Cari Pegawai</option>
                                        <?php
                                        // $query_pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY kode_pegawai ASC");
                                        $query_pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE kode_pegawai NOT IN (SELECT kode_pegawai FROM detail_penggajian WHERE MONTH(tanggal_penggajian) = MONTH(CURRENT_DATE()) AND YEAR(tanggal_penggajian) = YEAR(CURRENT_DATE())) ORDER BY nama_pegawai ASC") ;
                                        while ($data_pegawai = mysqli_fetch_array($query_pegawai)) {
                                          ?>

                                        <option value="<?= $data_pegawai['kode_pegawai'] ?>"><?= $data_pegawai['nama_pegawai'] ?></option>

                                        <?php } ?>

                                      </select>
                                    </div>
                                  </div>
                                  <label for="">Lama Kerja</label>
                                  <div class="form-group">
                                    <div class="nk-int-st">
                                      <input type="text" name="lama_kerja" class="form-control" placeholder="Isi form lama kerja" required="" maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')">
                                    </div>
                                  </div>
                                  <label for="">Lama Lembur</label>
                                  <div class="form-group">
                                    <div class="nk-int-st">
                                      <input type="text" name="lama_lembur" class="form-control" placeholder="Isi form lama lembur" required="" maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="nk-int-st">
                                      <button type="submit" name="gaji_karyawan" class="btn btn-primary">Simpan</button>    
                                      <a href="?halaman=v_penggajian" class="btn btn-danger">Kembali</a>
                                    </div>
                                  </div>
                                </div>
                                </form>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="tab-ctn">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <form action="?halaman=v_detail_penggajian" method="post">
                                    <div class="form-group">
                                    <h2 class="text-center">Form Penggajian Mekanik</h2>
                                      <div class="bootstrap-select fm-cmp-mg">
                                        <select name="kode_mekanik" class="selectpicker" data-live-search="true">

                                          <option value="">Cari Mekanik</option>

                                          <?php
                                          $query_mekanik = mysqli_query($koneksi, "SELECT * FROM mekanik WHERE kode_mekanik NOT IN (SELECT kode_mekanik FROM detail_penggajian_m WHERE MONTH(tanggal_penggajian) = MONTH(CURRENT_DATE()) AND YEAR(tanggal_penggajian) = YEAR(CURRENT_DATE())) ORDER BY nama_mekanik ASC") ;
                                          
                                          while ($data_mekanik = mysqli_fetch_array($query_mekanik)) {
                                            ?>

                                          <option value="<?= $data_mekanik['kode_mekanik'] ?>"><?= $data_mekanik['nama_mekanik'] ?></option>

                                          <?php } ?>

                                        </select>
                                      </div>
                                    </div>
                                    <label for="">Lama Kerja</label>
                                    <div class="form-group">
                                      <div class="nk-int-st">
                                        <input type="text" name="lama_kerja2" class="form-control" placeholder="Isi form lama kerja" required="" maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')">
                                      </div>
                                    </div>
                                    <label for="">Lama Lembur</label>
                                    <div class="form-group">
                                      <div class="nk-int-st">
                                        <input type="text" name="lama_lembur2" class="form-control" placeholder="Isi form lama lembur" required="" maxlength="50" oninvalid="this.setCustomValidity('Nama Wajib Diisi')" oninput="setCustomValidity('')">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="nk-int-st">
                                        <button type="submit" name="gaji_mekanik" class="btn btn-primary">Simpan</button>    
                                        <a href="?halaman=v_penggajian" class="btn btn-danger">Kembali</a>
                                      </div>
                                    </div>
                                    </form>
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
    </div>
</div>

<!-- untuk ajax -->
<script src="assets/template2/js/vendor/jquery-3.3.1.min.js"></script>
<?php endif?>