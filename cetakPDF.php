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
		<title>Laporan Keuangan</title>
	</head>
	<body>
		<div>
			<h1>Cahaya Enterprise</h1>
			<h3>Jl.Perairan 2. Setu parigi, pondok Aren -  Tangsel</h3>
			<h3>'.$date.'</h3>
			<hr>
			<h1>Laporan Keuangan</h1>
		</div>
		<table border="1" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>Jenis Burung</th>
          <th>Sesi</th>
          <th>Harga Tiket</th>
          <th>Jumlah Peserta</th>
          <th>Sales</th>
          <th width="40px">Gift Out</th>
          <th width="120px">Sub Total</th>
        </tr>
      </thead>';
      $no = 1; 
        $result = $koneksi->query("SELECT jadwal_kontes.jenis_burung, jadwal_kontes.sesi, jadwal_kontes.harga, kelas_kontes.jumlah_tiket, kelas_kontes.jumlah_tiket, kelas_kontes.stok_tiket, kelas_kontes.hadiah FROM kelas_kontes INNER JOIN jadwal_kontes ON kelas_kontes.id_jadwalkontes = jadwal_kontes.id_jadwalkontes");
        while ($row = mysqli_fetch_array($result)) {
        	$jp = $row["jumlah_tiket"] - $row["stok_tiket"];
        	$total = $row["harga"] * $jp;
        	$totalDapat = $total - $row['hadiah'];
        	$html .= '
        	<tr>
            <td>'.$no++.'</td>
            <td>'.$row['jenis_burung'].'</td>
            <td>'.$row["sesi"].'</td>
            <td>'.number_format($row["harga"],0,',','.').'</td>
            <td>'.$jp.'</td>
            <td>'.number_format($total,0,',','.').'</td>
            <td>'.number_format($row["hadiah"],0,',','.').'</td>
            <td>'.number_format($totalDapat,0,',','.').'</td>
          </tr>
        	';
        	$totalHasil += $totalDapat; 
        }
    $html .= '</table>
    <table border="1" cellpadding="10" cellspacing="0">
    	<tr>
        	<th width="558px">Total Pendapatan</th>
          <th width="120px">Rp. '.number_format($totalHasil,0,',','.').'</th>
        </tr>
    </table>
	</body>
	</html>
';
$mpdf->WriteHTML($html);
$mpdf->Output('Laporan-Keuangan.pdf',\Mpdf\Output\Destination::INLINE);