<?php
// Ketika tombil simpan di Klik
if (isset($_POST['simpan'])) {

    // Membuat Kode otomatis
    $sql = mysqli_query($koneksi, "SELECT max(kode_service) FROM service");
    $kode_faktur = mysqli_fetch_array($sql);
    if ($kode_faktur) {
        $nilai = substr($kode_faktur[0], 2);
        $kode = (int) $nilai;
        //tambahkan sebanyak + 1
        $kode = $kode + 1;
        $auto_kode = "SV" . str_pad($kode, 2, "0",  STR_PAD_LEFT);
    } else {
        $auto_kode = "SV01";
    }

    $nama_service = ucfirst($_POST['nama_service']);
    $harga = $_POST['tarif_harga'];
    $harga_string =  preg_replace("/[^0-9]/", "", $harga);
    $tarif_harga = (int) $harga_string;
    $query = mysqli_query($koneksi, "INSERT INTO service (kode_service,nama_service,tarif_harga) VALUES ('$auto_kode','$nama_service','$tarif_harga') ");
    if ($query) {
        echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'kasir.php?halaman=v_tarifService'</script>";
    } else {
        echo "<script>alert('Terjadi Kesalahan Input Database'); window.location = 'kasir.php?halaman=add_tarifService'</script>";
    }
}
?>
<div class="form-element-list">
    <div class="basic-tb-hd">
        <h2>Form Tambah Tarif Service</h2>
    </div>

    <form action="" method="post">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="">Nama Service</label>
                <div class="form-group">
                    <div class="nk-int-st">
                        <input type="text" name="nama_service" class="form-control" placeholder="Isi form nama service"
                            required="" maxlength="30" oninvalid="this.setCustomValidity('Nama Wajib Diisi')"
                            oninput="setCustomValidity('')">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="">Tarif Service</label>
                <div class="form-group">
                    <div class="nk-int-st">
                        <input type="text" id="rupiah" name="tarif_harga" class="form-control"
                            placeholder="Isi form tarif service" required=""
                            oninvalid="this.setCustomValidity('Tarif Service Wajib Diisi')"
                            oninput="setCustomValidity('')">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
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