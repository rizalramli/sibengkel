<?php  
 //load_data.php  
include '../../koneksi/koneksi.php'; 
 $output = ''; 
 if(isset($_POST["kode_customer"]))  
 {  
      if($_POST["kode_customer"] != '')  
      {  
           $sql = "SELECT * FROM customer WHERE kode_customer = '".$_POST["kode_customer"]."'"; 
            $result = mysqli_query($koneksi, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="basic-tb-hd">
        <h2 class="text-center">Data Customer</h2>
      </div>
      <div class="contact-inner">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">Nama Customer</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="nama_customer" class="form-control" placeholder="Isi form nama customer"  value="'.$row["nama_customer"].'" readonly>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">Alamat</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="alamat" class="form-control" placeholder="Isi form alamat customer" value="'.$row["alamat"].'" readonly>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">No Hp</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="no_telp" class="form-control" placeholder="Isi form no hp" value="'.$row["no_telp"].'" readonly>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="basic-tb-hd">
        <h2 class="text-center">Data Mobil</h2>
      </div>
      <div class="contact-inner">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">No Plat</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="no_plat" class="form-control" placeholder="isi form plat nomer">
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">Nama Kendaraan</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="nama_kendaraan" class="form-control" placeholder="isi form nama kendaraan">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style="margin-top: 20px;" class="row">
          <div class="col-md-12">
            <button type="submit" name="simpan" class="btn btn-primary btn-block">Simpan</button>
          </div>
        </div>
    </div>';  
      }   
      } else if($_POST["kode_customer"] == '') {
        $output .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="basic-tb-hd">
        <h2 class="text-center">Data Customer</h2>
      </div>
      <div class="contact-inner">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">Nama Customer</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="nama_customer" class="form-control" placeholder="Isi form nama customer" value="">
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">Alamat</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="alamat" class="form-control" placeholder="Isi form alamat customer">
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">No Hp</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="no_telp" class="form-control" placeholder="Isi form no hp">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="basic-tb-hd">
        <h2 class="text-center">Data Mobil</h2>
      </div>
      <div class="contact-inner">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">No Plat</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="no_plat" class="form-control" placeholder="isi form plat nomer">
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="">Nama Kendaraan</label>
            <div class="form-group">
              <div class="nk-int-st">
                <input type="text" name="nama_kendaraan" class="form-control" placeholder="isi form nama kendaraan">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style="margin-top: 20px;" class="row">
          <div class="col-md-12">
            <button type="submit" name="simpan" class="btn btn-primary btn-block">Simpan</button>
          </div>
        </div>
    </div>';
      }
     
      echo $output;  
 }  
 ?>  