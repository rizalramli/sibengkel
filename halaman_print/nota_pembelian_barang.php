<?php
include '../koneksi/koneksi.php';
include '../koneksi/function.php';
$query = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pegawai USING(kode_pegawai) JOIN suplier USING(kode_suplier) ORDER BY no_faktur_pembelian DESC LIMIT 1");
$data = mysqli_fetch_array($query);
$id = $data['no_faktur_pembelian'];
$query2 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_barang FROM detail_permintaan JOIN purchase_order USING(kode_permintaan) WHERE no_faktur_pembelian = '$id'");
$data2 = mysqli_fetch_array($query2);
$query3 = mysqli_query($koneksi, "SELECT * FROM detail_permintaan JOIN barang USING(kode_barang) JOIN purchase_order USING(kode_permintaan) WHERE no_faktur_pembelian='$id'");
$tgl_transaksi = $data['tgl_transaksi'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Nota Pembelian</title>
	<link href="_partial/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="_partial/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<hr>
				<div class="row">
					<div class="col col-md-3 mt-1">
						<img src="../assets/template2/img/logo/print.jpg" width="230" alt="logo.png">
					</div>
					<div class="col col-md-5" style="margin-left:-40px ">
						<strong style="font-size:30">Bengkel Karoseri Cemerlang Jaya</strong><br>
						<address style="font-size: 15">Jalan Palembang-Jambi,km 120 srigunung,sungai lilin, Muba <br>
							HP / WA : 0852-7396-8334 </address>
					</div>
					<div class="col-md-4 text-right">
						<h4><b>TANDA BUKTI</b></h4>
					</div>
				</div>
				<hr style="border-width: 3px">
				<div class="row">
					<div class="col col-md-12">
						<table class="table table-sm table-borderless" width="100">
							<tr>
								<th width="11%">Suplier</th>
								<th width="1%">:</th>
								<th><?= $data['nama_suplier'] ?></th>
								<th width="11%">Kasir</th>
								<th width="1%">:</th>
								<th><?= $data['nama_pegawai'] ?></th>
							</tr>
							<tr>
								<th>Tanggal</th>
								<th>:</th>
								<?php
								$tanggal = date('d/m/Y H:i:s', strtotime($tgl_transaksi));
								?>
								<th><?= $tanggal ?></th>
								<th>Total Harga</th>
								<th>:</th>
								<th><?= format_ribuan($data['total_harga']) ?></th>
							</tr>
							<tr>
								<th> Sub Total</th>
								<th>:</th>
								<th><?= format_ribuan($data['sub_total']) ?></th>
								<th>Bayar</th>
								<th>:</th>
								<th><?= format_ribuan($data['bayar']) ?></th>
							</tr>
							<tr>
								<th>Potongan</th>
								<th>:</th>
								<th><?= format_ribuan($data['potongan']) ?></th>
								<th>Kembalian</th>
								<th>:</th>
								<th><?= format_ribuan($data['kembalian']) ?></th>
							</tr>
						</table>
						<table style="padding: 0;margin: 0;" class="table table-sm" width="100%">
							<thead>
								<?php
								if ($data2['jumlah_barang']) {
									echo '<tr>
											<th width="7%" scope="col">NO</th>
											<th width="35%" scope="col">NAMA BARANG</th>
											<th width="10%" scope="col">QTY</th>
											<th width="24%" scope="col">HARGA BARANG</th>
											<th width="24%" style="text-align:center" scope="col">TOTAL HARGA</th>
									</tr>';
								}
								?>

							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($query3 as $data3) {
									$kali = $data3['jumlah_barang'] * $data3['harga_pokok'];
									?>
									<tr>
										<td width="7%" scope="row"><?= $no++ ?></td>
										<td width="35%"><?= $data3['nama_barang'] ?></td>
										<td width="10%"><?= $data3['jumlah_barang'] ?></td>
										<td width="24%" style="text-align:right"><?= format_ribuan($data3['harga_pokok']) ?></td>
										<td width="24%" style="text-align:right"><?= format_ribuan($kali) ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>