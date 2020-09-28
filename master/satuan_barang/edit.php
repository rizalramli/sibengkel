<?php
// mengambil ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT kode_satuan,nama_satuan FROM satuan WHERE kode_satuan='$id'");
$data = mysqli_fetch_array($query);

//Proses Update Data Hak akses 
if (isset($_POST['update'])) {
    $kode_satuan = $_POST['kode_satuan'];
    $nama_satuan = ucfirst($_POST['nama_satuan']);

    $update = mysqli_query($koneksi, "UPDATE satuan SET nama_satuan='$nama_satuan' WHERE kode_satuan='$kode_satuan'");
    if ($update) {
        echo "<script>alert('Data Berhasil Terupdate'); window.location = 'gudang.php?halaman=v_satuanBarang'</script>";
    } else {
        echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'gudang.php?halaman=edit_satuanBarang&id=" . $id . "'</script>";
    }
}
?>
<div class="form-element-list">
    <div class="basic-tb-hd">
        <h2>Form Edit Satuan Barang</h2>
    </div>

    <form action="" method="post">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="">Nama Satuan Barang</label>
                <div class="form-group">
                    <div class="nk-int-st">
                        <input type="hidden" name="kode_satuan" class="form-control"
                            placeholder="Isi form nama satuan barang" readonly="" value="<?= $data['kode_satuan'] ?>">
                        <input type="text" name="nama_satuan" class="form-control"
                            placeholder="Isi form nama kode barang" required="" maxlength="20"
                            oninvalid="this.setCustomValidity('Nama Satuan Wajib Diisi')"
                            oninput="setCustomValidity('')" value="<?= $data['nama_satuan'] ?>">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="gudang.php?halaman=v_satuanBarang" class="btn btn-danger">Kembali</a>
    </form>

</div>