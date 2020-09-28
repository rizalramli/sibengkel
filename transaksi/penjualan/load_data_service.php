<?php
//load_data.php  
include '../../koneksi/koneksi.php';
$output = '';
if (isset($_POST["kode_service"])) {
     if ($_POST["kode_service"] != '') {
          $sql = "SELECT * FROM service WHERE kode_service = '" . $_POST["kode_service"] . "'";
          $result = mysqli_query($koneksi, $sql);
          while ($row = mysqli_fetch_array($result)) {
               $output .= '
           <input type="hidden" name="nama_service" value="' . $row["nama_service"] . '">
           <input type="hidden" id="tarif_harga" name="tarif_harga" value="' . $row["tarif_harga"] . '">
           ';
          }
     }

     echo $output;
}
