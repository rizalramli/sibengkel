<?php
// mengambil ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM jenis_pegawai WHERE kode_jenis_p='$id'");
$data = mysqli_fetch_array($query);

//Proses Update Data Hak akses 
if (isset($_POST['update'])) {
    $kode_jenis_p = $_POST['kode_jenis_p'];
    $nama_jenis_p = ucfirst($_POST['nama_jenis_p']);

    $update = mysqli_query($koneksi, "UPDATE jenis_pegawai SET nama_jenis_p='$nama_jenis_p' WHERE kode_jenis_p='$kode_jenis_p'");
    if ($update) {
        echo "<script>alert('Data Berhasil Terupdate'); window.location = 'admin.php?halaman=v_jenis_pegawai'</script>";
    } else {
        echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'admin.php?halaman=edit_jenis_pegawai&id=" .$id."'</script>";
    }
}
?>
<div class="form-element-list">
    <div class="basic-tb-hd">
        <h2>Form Edit Jenis Pegawai</h2>
    </div>

    <form action="" method="post">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="">Nama Jenis Pegawai</label>
                <div class="form-group">
                    <div class="nk-int-st">
                        <input type="hidden" name="kode_jenis_p" class="form-control"
                            placeholder="Isi form nama jenis pegawai" readonly="" value="<?= $data['kode_jenis_p'] ?>">
                        <input type="text" name="nama_jenis_p" class="form-control"
                            placeholder="Isi form nama jenis pegawai" required="" maxlength="30"
                            oninvalid="this.setCustomValidity('Nama Jenis Wajib Diisi')" oninput="setCustomValidity('')"
                            value="<?= $data['nama_jenis_p'] ?>">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="admin.php?halaman=v_jenis_pegawai" class="btn btn-danger">Kembali</a>
    </form>

</div>