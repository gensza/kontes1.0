<?php
	include "koneksi.php";
	function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
	$date = tgl_indo(date('Y-m-d'));
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$html = '
	<!DOCTYPE html>
	<html>
	<head>
		<title>laporan Registrasi</title>
	</head>
	<body>
		<div>
			<h1>Cahaya Enterprise</h1>
			<h3>Jl.Perairan 2. Setu parigi, pondok Aren -  Tangsel</h3>
			<h3>'.$date.'</h3>
			<hr>
			<h1>Laporan Registrasi</h1>
		</div>
		<table border="1" cellpadding="10" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Burung</th>
                <th>Harga Tiket</th>
                <th>Jumlah Peserta</th>
                <th>Total Pendapatan</th>
              </tr>
            </thead>';
            $no = 1; 
              $result = $koneksi->query("SELECT jadwal_kontes.id_jadwalkontes, jadwal_kontes.jenis_burung, jadwal_kontes.sesi, jadwal_kontes.harga, kelas_kontes.jumlah_tiket, kelas_kontes.stok_tiket FROM jadwal_kontes INNER JOIN kelas_kontes ON jadwal_kontes.id_jadwalkontes = kelas_kontes.id_jadwalkontes");
              while ($row = mysqli_fetch_array($result)) {
              	$jp = $row['jumlah_tiket']-$row['stok_tiket'];
              	$tp = $jp*$row['harga'];
              	$html .= '
              	<tr>
                  <td>'.$no++.'</td>
                  <td>'.$row["jenis_burung"]."&nbsp;".$row["sesi"].'</td>
                  <td>'.number_format($row["harga"],0,',','.').'</td>
                  <td>'.$jp.'</td>
                  <td>'.number_format($tp,0,',','.').'</td>
                </tr>
              	';
              }
    $html .= '</table>
	</body>
	</html>
';
$mpdf->WriteHTML($html);
$mpdf->Output('Laporan-Registrasi.pdf',\Mpdf\Output\Destination::INLINE);