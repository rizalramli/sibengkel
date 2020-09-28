<?php
// Tentukan path yang tepat ke mPDF
$nama_dokumen='Laporan Transaksi'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../assets/mpdf60/'); // Tentukan folder dimana anda menyimpan folder mpdf
include(_MPDF_PATH . "mpdf.php"); // Arahkan ke file mpdf.php didalam folder mpdf
$mpdf=new mPDF('utf-8', 'A4', 10.5, 'arial'); // Membuat file mpdf baru
//Memulai proses untuk menyimpan variabel php dan html
ob_start();
include '../koneksi/koneksi.php';
include '../koneksi/function.php';
$tgl_mulai = $_POST['tgl_mulai'];
$format_mulai =  date('Y-m-d', strtotime($tgl_mulai));
$mulai = $format_mulai." 00:00:00";
$tgl_akhir = $_POST['tgl_akhir'];
$format_akhir =  date('Y-m-d', strtotime($tgl_akhir));
$akhir = $format_akhir." 00:00:00";
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak masalah.-->
<!--CONTOH Code START-->
<h2 style="text-align: center;">BENGKEL MAJU JAYA</h2>
<div style="text-align: center;font-size: 11;margin-top: -30px;">Jln Ahmad Yani No.235 Jember</div>

<hr style="color:solid black">
<table border="collapse">
    <?php 
    $dari = date('Y-m-d', strtotime($mulai));
    $sampai = date('Y-m-d', strtotime($akhir));
    ?>
    <tr>
        <td>Dari Tanggal</td>
        <td>:</td>
        <td><?= tgl_indo($dari); ?></td>
    </tr>
    <tr>
        <td>Sampai Tanggal</td>
        <td>:</td>
        <td><?= tgl_indo($sampai); ?></td>
    </tr>
</table>
<table border="1">
    <tr>
        <th style="border-left: 0">No.</th>
        <th>Faktur Penjualan</th>
        <th>Nama Customer</th>
        <th>Kasir</th>
        <th>Tanggl Transaksi</th>
        <th>Total Harga</th>
        <th>Total Bayar</th>
        <th>Kembalian</th>
    </tr>
    <?php
    
    $query = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN customer USING(kode_customer) JOIN pegawai USING(kode_pegawai) WHERE tgl_transaksi BETWEEN '$mulai' AND '$akhir'");
    $no = 1;
    foreach ($query as $data) {
        $tgl_transaksi = $data['tgl_transaksi'];
        $data_transaksi = date('Y-m-d', strtotime($tgl_transaksi));
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['no_faktur_penjualan'] ?></td>
        <td><?= $data['nama_customer'] ?></td>
        <td><?= $data['nama_pegawai'] ?></td>
        <td><?= tgl_indo($data_transaksi) ?></td>
        <td style="text-align: right"><?= format_ribuan($data['total_harga']) ?></td>
        <td style="text-align: right"><?= format_ribuan($data['bayar']) ?></td>
        <td style="text-align: right"><?= format_ribuan($data['kembalian']) ?></td>
    </tr>
    <?php } ?>
</table>
<!--CONTOH Code END-->
<?php
$mpdf->setFooter('{PAGENO}');
//penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>