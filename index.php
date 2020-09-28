<!doctype html>
<?php

session_start();

// membuat kode unik untuk user
$session_id =  session_id();

// jika mengakses login maka acount lama di logout
if (isset($_SESSION['kode_pegawai'])) {
  header('location:logout.php');
} else {

  include "koneksi/koneksi.php";

  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // menyeleksi data admin dengan username dan password yang sesuai
    $query = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN jenis_pegawai USING(kode_jenis_p) WHERE username='$username'");

    // menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($query);
    $data = mysqli_fetch_array($query);
    $kode_pegawai = $data['kode_pegawai'];

    if ($cek > 0) {
      if (password_verify($_POST['password'], $data['password'])) {

        // timestamp sekarang
        date_default_timezone_set('Asia/Jakarta'); // setting waktu
        $now_login = date('Y-m-d H:i:s');

        // mengambil nilai dari database
        $kode_pegawai = $data['kode_pegawai'];
        $session_id_db = $data['session_id'];
        $last_login_db = $data['last_login'];

        // logika validasi

        // jika session nya sama dan telah melakukan logout maka user boleh masuk
        if ($session_id_db == $session_id || $session_id_db == 'kosong') {

          # berhasil login dan update last_login

          $_SESSION['username'] = $data['username'];
          $_SESSION['akses'] = $data['nama_jenis_p'];
          $_SESSION['kode_pegawai'] = $data['kode_pegawai'];

          // mengambil session_id
          $_SESSION['session_id'] = session_id();

          mysqli_query($koneksi, "UPDATE pegawai SET status_login='1' , session_id = '$session_id' , last_login = '$now_login' WHERE kode_pegawai='$kode_pegawai'");

          if ($_SESSION['akses'] == "Admin") {
            header("location:admin.php?halaman=dashboard");
          } else if ($_SESSION['akses'] == "Kasir") {
            header("location:kasir.php?halaman=dashboard");
          } else if ($_SESSION['akses'] == "Gudang") {
            header("location:gudang.php?halaman=dashboard");
          } else if ($_SESSION['akses'] == "Cs") {
            header("location:cs.php?halaman=dashboard");
          }
        } else {

          // jika session nya berbeda dan tidak melakukan logout maka user tidak boleh masuk jika belum lebih dari 20 menit

          // validasi waktu
          $start_date = new DateTime($last_login_db);
          $since_start = $start_date->diff(new DateTime($now_login));

          // mencari selisih hari
          $selisih_hari = $since_start->days;

          // jika berbeda hari maka akan berhasil login
          if ($selisih_hari > 0) {

            # berhasil login dan update last_login

            $_SESSION['username'] = $data['username'];
            $_SESSION['akses'] = $data['nama_jenis_p'];
            $_SESSION['kode_pegawai'] = $data['kode_pegawai'];

            // mengambil session_id
            $_SESSION['session_id'] = session_id();

            mysqli_query($koneksi, "UPDATE pegawai SET status_login='1' , session_id = '$session_id' , last_login = '$now_login' WHERE kode_pegawai='$kode_pegawai'");

            if ($_SESSION['akses'] == "Admin") {
              header("location:admin.php?halaman=dashboard");
            } else if ($_SESSION['akses'] == "Kasir") {
              header("location:kasir.php?halaman=dashboard");
            } else if ($_SESSION['akses'] == "Gudang") {
              header("location:gudang.php?halaman=dashboard");
            } else if ($_SESSION['akses'] == "Cs") {
              header("location:cs.php?halaman=dashboard");
            }
          } else { // jika berada di hari yang sama akan divalidasi jam

            // jika pada jam yang sama maka akan divalidasi menit
            $selisih_jam = $since_start->h;
            if ($selisih_jam == 0) {

              // validasi menit
              $selisih_menit = $since_start->i;
              if ($selisih_menit >= 5) {

                // jika lebih dari 20 menit maka akan berhasil login

                # berhasil login dan update last_login

                $_SESSION['username'] = $data['username'];
                $_SESSION['akses'] = $data['nama_jenis_p'];
                $_SESSION['kode_pegawai'] = $data['kode_pegawai'];

                // mengambil session_id
                $_SESSION['session_id'] = session_id();

                mysqli_query($koneksi, "UPDATE pegawai SET status_login='1' , session_id = '$session_id' , last_login = '$now_login' WHERE kode_pegawai='$kode_pegawai'");

                if ($_SESSION['akses'] == "Admin") {
                  header("location:admin.php?halaman=dashboard");
                } else if ($_SESSION['akses'] == "Kasir") {
                  header("location:kasir.php?halaman=dashboard");
                } else if ($_SESSION['akses'] == "Gudang") {
                  header("location:gudang.php?halaman=dashboard");
                } else if ($_SESSION['akses'] == "Cs") {
                  header("location:cs.php?halaman=dashboard");
                }
              } else {

                # gagal dan melakukan logout
                echo "<script>alert('Akun anda sedang digunakan / Anda lupa logout (tunggu 5 menit)'); window.location = 'index.php'</script>";
              }
            } else {

              // jika pada jam yang berbeda maka akan berhasil login

              # berhasil login dan update last_login

              $_SESSION['username'] = $data['username'];
              $_SESSION['akses'] = $data['nama_jenis_p'];
              $_SESSION['kode_pegawai'] = $data['kode_pegawai'];

              // mengambil session_id
              $_SESSION['session_id'] = session_id();

              mysqli_query($koneksi, "UPDATE pegawai SET status_login='1' , session_id = '$session_id' , last_login = '$now_login' WHERE kode_pegawai='$kode_pegawai'");

              if ($_SESSION['akses'] == "Admin") {
                header("location:admin.php?halaman=dashboard");
              } else if ($_SESSION['akses'] == "Kasir") {
                header("location:kasir.php?halaman=dashboard");
              } else if ($_SESSION['akses'] == "Gudang") {
                header("location:gudang.php?halaman=dashboard");
              } else if ($_SESSION['akses'] == "Cs") {
                header("location:cs.php?halaman=dashboard");
              }
            }
          }
        }
      } else {
        echo "<script>alert('password anda salah'); window.location = 'index.php'</script>";
      }
    } else {
      echo "<script>alert('usernmae anda salah'); window.location = 'index.php'</script>";
    }
  }
}

?>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Login Register | Notika - Notika Admin Template</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <!-- Google Fonts
		============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/bootstrap.min.css">
  <!-- font awesome CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/font-awesome.min.css">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/owl.carousel.css">
  <link rel="stylesheet" href="assets/template2/css/owl.theme.css">
  <link rel="stylesheet" href="assets/template2/css/owl.transitions.css">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/animate.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/normalize.css">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/scrollbar/jquery.mCustomScrollbar.min.css">
  <!-- wave CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/wave/waves.min.css">
  <!-- Notika icon CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/notika-custom-icon.css">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/main.css">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/style.css">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="assets/template2/css/responsive.css">
  <!-- modernizr JS
		============================================ -->
  <script src="assets/template2/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
  <!-- Login Register area Start-->
  <div class="login-content">
    <!-- Login -->
    <div class="nk-block toggled" id="l-login">
      <h2 style="color:white">SISTEM INFORMASI BENGKEL</h2>
      <div class="logo-area">
        <a href="#"><img src="assets/template2/img/logo/logo.png" alt="" /></a>
      </div>
      <br>
      <div class="nk-form">
        <form method="POST" action="">
          <div class="input-group">
            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
            <div class="nk-int-st">
              <input type="text" name="username" class="form-control" placeholder="Username" required="" maxlength="50"
                oninvalid="this.setCustomValidity('Username Wajib Diisi')" oninput="setCustomValidity('')">
            </div>
          </div>
          <div class="input-group mg-t-15">
            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
            <div class="nk-int-st">
              <input type="password" name="password" class="form-control" placeholder="Password" required=""
                maxlength="60" oninvalid="this.setCustomValidity('Password Wajib Diisi')"
                oninput="setCustomValidity('')">
            </div>
          </div>
          <!-- <?php echo  $session_id; ?> -->
          <button type="submit" name="login" class="btn btn-login btn-success btn-float"><i
              class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
      </div>
      </form>
    </div>
  </div>
  <!-- Login Register area End-->
  <!-- jquery
		============================================ -->
  <script src="assets/template2/js/vendor/jquery-1.12.4.min.js"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="assets/template2/js/bootstrap.min.js"></script>
  <!-- wow JS
		============================================ -->
  <script src="assets/template2/js/wow.min.js"></script>
  <!-- price-slider JS
		============================================ -->
  <script src="assets/template2/js/jquery-price-slider.js"></script>
  <!-- owl.carousel JS
		============================================ -->
  <script src="assets/template2/js/owl.carousel.min.js"></script>
  <!-- scrollUp JS
		============================================ -->
  <script src="assets/template2/js/jquery.scrollUp.min.js"></script>
  <!-- meanmenu JS
		============================================ -->
  <script src="assets/template2/js/meanmenu/jquery.meanmenu.js"></script>
  <!-- counterup JS
		============================================ -->
  <script src="assets/template2/js/counterup/jquery.counterup.min.js"></script>
  <script src="assets/template2/js/counterup/waypoints.min.js"></script>
  <script src="assets/template2/js/counterup/counterup-active.js"></script>
  <!-- mCustomScrollbar JS
		============================================ -->
  <script src="assets/template2/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <!-- sparkline JS
		============================================ -->
  <script src="assets/template2/js/sparkline/jquery.sparkline.min.js"></script>
  <script src="assets/template2/js/sparkline/sparkline-active.js"></script>
  <!-- flot JS
		============================================ -->
  <script src="assets/template2/js/flot/jquery.flot.js"></script>
  <script src="assets/template2/js/flot/jquery.flot.resize.js"></script>
  <script src="assets/template2/js/flot/flot-active.js"></script>
  <!-- knob JS
		============================================ -->
  <script src="assets/template2/js/knob/jquery.knob.js"></script>
  <script src="assets/template2/js/knob/jquery.appear.js"></script>
  <script src="assets/template2/js/knob/knob-active.js"></script>
  <!--  Chat JS
		============================================ -->
  <script src="assets/template2/js/chat/jquery.chat.js"></script>
  <!--  wave JS
		============================================ -->
  <script src="assets/template2/js/wave/waves.min.js"></script>
  <script src="assets/template2/js/wave/wave-active.js"></script>
  <!-- icheck JS
		============================================ -->
  <script src="assets/template2/js/icheck/icheck.min.js"></script>
  <script src="assets/template2/js/icheck/icheck-active.js"></script>
  <!--  todo JS
		============================================ -->
  <script src="assets/template2/js/todo/jquery.todo.js"></script>
  <!-- Login JS
		============================================ -->
  <script src="assets/template2/js/login/login-action.js"></script>
  <!-- plugins JS
		============================================ -->
  <script src="assets/template2/js/plugins.js"></script>
  <!-- main JS
		============================================ -->
  <script src="assets/template2/js/main.js"></script>
</body>

</html>