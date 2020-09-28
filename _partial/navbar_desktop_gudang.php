<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">

                    <li class="<?php 
                    if ($_GET['halaman'] == "dashboard") {echo 'active';}
                    ?>">
                        <a href="?halaman=dashboard"><i class="fas fa-home"></i> Dashboard</a>
                    </li>

                    <li class="<?php 
                    if ($_GET['halaman'] == "v_permintaan_barang") {echo 'active';}
                    if ($_GET['halaman'] == "add_permintaan_barang") {echo 'active';}
                    if ($_GET['halaman'] == "v_detail_permintaan_barang") {echo 'active';}
                    ?>">
                        <a href="?halaman=v_permintaan_barang"><i class="fas fa-cube"></i> Order Barang/Sparepart</a>
                    </li>

                    <li class="<?php 
                    if ($_GET['halaman'] == "v_daftarBarang") {echo 'active';}
                    if ($_GET['halaman'] == "add_daftarBarang") {echo 'active';}
                    if ($_GET['halaman'] == "edit_daftarBarang") {echo 'active';}
                    if ($_GET['halaman'] == "v_jenisBarang") {echo 'active';}
                    if ($_GET['halaman'] == "add_jenisBarang") {echo 'active';}
                    if ($_GET['halaman'] == "edit_jenisBarang") {echo 'active';}
                    if ($_GET['halaman'] == "v_merkBarang") {echo 'active';}
                    if ($_GET['halaman'] == "add_merkBarang") {echo 'active';}
                    if ($_GET['halaman'] == "edit_merkBarang") {echo 'active';}
                    if ($_GET['halaman'] == "v_satuanBarang") {echo 'active';}
                    if ($_GET['halaman'] == "add_satuanBarang") {echo 'active';}
                    if ($_GET['halaman'] == "edit_satuanBarang") {echo 'active';}
                    ?>">
                        <a data-toggle="tab" href="#Forms"><i class="fas fa-paste"></i> Data Barang</a>
                    </li>

                    <li class="<?php 
                    if ($_GET['halaman'] == "laporan_transaksi") {echo 'active';}
                    ?>">
                        <a href="?halaman=laporan_transaksi"><i class="fas fa-print"></i> Laporan</a>
                    </li>
                </ul>
                <div class="tab-content custom-menu-content">
                    <div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX <?php 
                    if ($_GET['halaman'] == "v_daftarBarang") {echo 'active';}
                    if ($_GET['halaman'] == "add_daftarBarang") {echo 'active';}
                    if ($_GET['halaman'] == "edit_daftarBarang") {echo 'active';}
                    if ($_GET['halaman'] == "v_jenisBarang") {echo 'active';}
                    if ($_GET['halaman'] == "add_jenisBarang") {echo 'active';}
                    if ($_GET['halaman'] == "edit_jenisBarang") {echo 'active';}
                    if ($_GET['halaman'] == "v_merkBarang") {echo 'active';}
                    if ($_GET['halaman'] == "add_merkBarang") {echo 'active';}
                    if ($_GET['halaman'] == "edit_merkBarang") {echo 'active';}
                    if ($_GET['halaman'] == "v_satuanBarang") {echo 'active';}
                    if ($_GET['halaman'] == "add_satuanBarang") {echo 'active';}
                    if ($_GET['halaman'] == "edit_satuanBarang") {echo 'active';}
                    ?>">
                        <ul class="notika-main-menu-dropdown">

                            <li><a href="?halaman=v_daftarBarang">Daftar Barang</a>
                            </li>

                            <li><a href="?halaman=v_jenisBarang">Jenis Barang</a>
                            </li>

                            <li><a href="?halaman=v_merkBarang">Merk Barang</a></li>

                            <li><a href="?halaman=v_satuanBarang">Satuan Barang</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>