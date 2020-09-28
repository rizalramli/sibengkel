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
                    if ($_GET['halaman'] == "transaksi_penjualan_barang") {echo 'active';}
                    if ($_GET['halaman'] == "v_work_order") {echo 'active';}
                    if ($_GET['halaman'] == "v_data_transaksi") {echo 'active';}
                    if ($_GET['halaman'] == "detail_transaksi") {echo 'active';}
                    if ($_GET['halaman'] == "sukses") {echo 'active';}
                    ?>">
                        <a data-toggle="tab" href="#Forms1"><i class="fas fa-cash-register"></i> Transaksi Penjualan</a>
                    </li>

                    <li class="<?php 
                    if ($_GET['halaman'] == "v_transaksi_pembelian") {echo 'active';}
                    if ($_GET['halaman'] == "v_suplier") {echo 'active';}
                    if ($_GET['halaman'] == "add_suplier") {echo 'active';}
                    if ($_GET['halaman'] == "edit_suplier") {echo 'active';}
                    if ($_GET['halaman'] == "v_data_transaksi_pembelian") {echo 'active';}
                    if ($_GET['halaman'] == "add_transaksi_pembelian") {echo 'active';}
                    if ($_GET['halaman'] == "sukses_pembelian") {echo 'active';}

                    ?>">
                        <a data-toggle="tab" href="#Forms2"><i class="fas fa-truck"></i> Pemasokan Barang</a>
                    </li>

                    <li class="<?php 
                    if ($_GET['halaman'] == "v_tarifService") {echo 'active';}
                    if ($_GET['halaman'] == "add_tarifService") {echo 'active';}
                    if ($_GET['halaman'] == "edit_tarifService") {echo 'active';}
                    ?>">
                        <a href="?halaman=v_tarifService"><i class="fas fa-tools"></i> Data Service</a>
                    </li>

                    <li class="<?php 
                    if ($_GET['halaman'] == "laporan_transaksi") {echo 'active';}
                    ?>">
                        <a href="?halaman=laporan_transaksi"><i class="fas fa-print"></i> Laporan</a>
                    </li>

                </ul>

                <div class="tab-content custom-menu-content">

                    <div id="Forms1" class="tab-pane notika-tab-menu-bg animated flipInX
                    <?php 
                    if ($_GET['halaman'] == "transaksi_penjualan_barang") {echo 'active';}
                    if ($_GET['halaman'] == "v_work_order") {echo 'active';}
                    if ($_GET['halaman'] == "v_data_transaksi") {echo 'active';}
                    if ($_GET['halaman'] == "detail_transaksi") {echo 'active';}
                    if ($_GET['halaman'] == "sukses") {echo 'active';}

                    ?> ">
                        <ul class="notika-main-menu-dropdown">

                            <li><a href="?halaman=transaksi_penjualan_barang">Transaksi Penjualan</a>
                            </li>
                            <li><a href="?halaman=v_work_order">Transaksi Penjualan + Service</a>
                            </li>

                            <li><a href="?halaman=v_data_transaksi">Data Transaksi Penjualan</a>
                            </li>

                        </ul>
                    </div>

                    <div id="Forms2" class="tab-pane notika-tab-menu-bg animated flipInX
                    <?php 
                    if ($_GET['halaman'] == "v_transaksi_pembelian") {echo 'active';}
                    if ($_GET['halaman'] == "v_suplier") {echo 'active';}
                    if ($_GET['halaman'] == "add_suplier") {echo 'active';}
                    if ($_GET['halaman'] == "edit_suplier") {echo 'active';}
                    if ($_GET['halaman'] == "v_data_transaksi_pembelian") {echo 'active';}
                    if ($_GET['halaman'] == "add_transaksi_pembelian") {echo 'active';}
                    if ($_GET['halaman'] == "sukses_pembelian") {echo 'active';}
                    
                    ?>">
                        <ul class="notika-main-menu-dropdown">

                            <li><a href="?halaman=v_transaksi_pembelian">Transaksi Pemasokan</a>
                            </li>

                            <li><a href="?halaman=v_suplier">Data Suplier</a>
                            </li>

                            <li><a href="?halaman=v_data_transaksi_pembelian">Data Transaksi Pemasokan</a>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>