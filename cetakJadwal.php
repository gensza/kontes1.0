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
		<title>Jadwal Kontes</title>
	</head>
	<body>
		<div>
			<h1>Cahaya Enterprise</h1>
			<h3>Jl.Perairan 2. Setu parigi, pondok Aren -  Tangsel</h3>
			<h3>'.$date.'</h3>
			<hr>
			<h1>Jadwal Kontes</h1>
		</div>
		<table border="1" cellpadding="10" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Burung</th>
                <th>Sesi</th>
                <th>Harga Tiket</th>
                <th>Jumlah Tiket</th>
                <th width="40px">Start</th>
              </tr>
            </thead>';
            $no = 1; 
              $result = $koneksi->query("SELECT jadwal_kontes.id_jadwalkontes, jadwal_kontes.jenis_burung, jadwal_kontes.sesi, jadwal_kontes.harga, jadwal_kontes.waktu, kelas_kontes.jumlah_tiket, kelas_kontes.stok_tiket FROM jadwal_kontes INNER JOIN kelas_kontes ON jadwal_kontes.id_jadwalkontes = kelas_kontes.id_jadwalkontes");
              while ($row = mysqli_fetch_array($result)) {
              	$html .= '
              	<tr>
                  <td>'.$no++.'</td>
                  <td>'.$row['jenis_burung'].'</td>
                  <td>'.$row["sesi"].'</td>
                  <td>'.number_format($row["harga"],0,',','.').'</td>
                  <td>'.$row["jumlah_tiket"].'</td>
                  <td>'.$row["waktu"].'</td>
                </tr>
              	';
              }
    $html .= '</table>
	</body>
	</html>
';
$mpdf->WriteHTML($html);
$mpdf->Output('Jadwal-Kontes.pdf',\Mpdf\Output\Destination::INLINE);