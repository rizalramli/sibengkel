<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="#"><img src="assets/template2/img/logo/logo.png" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="header-top-menu">
                    <ul class="nav navbar-nav notika-top-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle"><span><?= $_SESSION['username'] ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="modal"
                                data-target="#myModaltwo"><span><i class="fa fa-power-off"
                                        aria-hidden="true"></i></span></a>
                        </li>

                        <div class="modal fade" id="myModaltwo" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Yakin Untuk Melakukan logout ?</h4>
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="logout.php" class="btn btn-default">Yes</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>