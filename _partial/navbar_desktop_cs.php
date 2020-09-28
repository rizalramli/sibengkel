<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">

                    <li class="<?php 
                    if ($_GET['halaman'] == "dashboard") {echo 'active';}
                    ?>"><a href="?halaman=dashboard"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li class="<?php 
                    if ($_GET['halaman'] == "add_work_order") {echo 'active';}
                    ?>"><a href="?halaman=add_work_order"><i class="fas fa-user-clock"></i> Work Order</a>
                    </li>

                    <li class="<?php 
                    if ($_GET['halaman'] == "v_customer") {echo 'active';}
                    if ($_GET['halaman'] == "add_customer") {echo 'active';}
                    if ($_GET['halaman'] == "edit_customer") {echo 'active';}
                    ?>"><a href="?halaman=v_customer"><i class="fas fa-user-edit"></i> Data Customer</a>
                    </li>

                    
                    <li class="<?php 
                    if ($_GET['halaman'] == "laporan_transaksi") {echo 'active';}
                    ?>">
                        <a href="?halaman=laporan_transaksi"><i class="fas fa-print"></i> Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>