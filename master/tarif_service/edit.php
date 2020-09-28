<?php
// mengambil ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT kode_service,nama_service,tarif_harga FROM service WHERE kode_service='$id'");
$data = mysqli_fetch_array($query);

//Proses Update Data Hak akses
if (isset($_POST['update'])) {
    $kode_service = $_POST['kode_service'];
    $nama_service = ucfirst($_POST['nama_service']);
    $harga = $_POST['tarif_harga'];
    $harga_string =  preg_replace("/[^0-9]/", "", $harga);
    $tarif_harga = (int) $harga_string;
    $update = mysqli_query($koneksi, "UPDATE service SET nama_service='$nama_service',tarif_harga='$tarif_harga' WHERE kode_service='$kode_service'");
    if ($update) {
        echo "<script>alert('Data Berhasil Terupdate'); window.location = 'kasir.php?halaman=v_tarifService'</script>";
    } else {
        echo "<script>alert('Terjadi Kesalahan Update Database'); window.location = 'kasir.php?halaman=edit_tarifService&id=" .$id."'</script>";
    }
}
?>
<div class="form-element-list">
    <div class="basic-tb-hd">
        <h2>Form Edit Tarif Service</h2>
    </div>

    <form action="" method="post">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="">Nama Service</label>
                <div class="form-group">
                    <div class="nk-int-st">
                        <input type="hidden" name="kode_service" class="form-control"
                            placeholder="Isi form tarif service" readonly="" value="<?= $data['kode_service'] ?>">
                        <input type="text" name="nama_service" class="form-control" placeholder="Isi Form Nama Service"
                            required="" maxlength="30" oninvalid="this.setCustomValidity('Nama Wajib Diisi')"
                            oninput="setCustomValidity('')" value="<?= $data['nama_service'] ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="">Tarif Harga</label>
                <div class="form-group">
                    <div class="nk-int-st">
                        <input type="text" id="rupiah" name="tarif_harga" class="form-control"
                            placeholder="Isi form Tarif Harga" required=""
                            oninvalid="this.setCustomValidity('Tarif Service Wajib Diisi')"
                            oninput="setCustomValidity('')" value="<?= format_ribuan($data['tarif_harga']) ?>">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="kasir.php?halaman=v_tarifService" class="btn btn-danger">Kembali</a>
    </form>
    <script type="text/javascript">
        var rupiah = document.getElementById('rupiah');
        rupiah.addEventListener('keyup', function (e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value);
        });
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? +rupiah : '');
        }
    </script>

</div>