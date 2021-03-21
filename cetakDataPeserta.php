<?php
	include "koneksi.php";
	$id = $_GET['id'];
	$data = $koneksi->query("SELECT * FROM jadwal_kontes WHERE id_jadwalkontes = '$id'");
	$dataPeserta = mysqli_fetch_array($data);
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
		<title>Data Peserta</title>
	</head>
	<body>
		<div>
			<h1>Cahaya Enterprise</h1>
			<h3>Jl.Perairan 2. Setu parigi, pondok Aren -  Tangsel</h3>
			<h3>'.$date.'</h3>
			<hr>
			<h1>Data Peserta '.$dataPeserta["jenis_burung"]."&nbsp;".$dataPeserta["sesi"].'</h1>
		</div>
		<table border="1" cellpadding="10" cellspacing="0">
            <thead>
              <tr>
                <th>No Gantungan</th>
                <th>Nama Pemilik</th>
                <th>Nama Burung</th>
                <th>Alamat</th>
              </tr>
            </thead>';
            $no = 1; 
              $result = $koneksi->query("SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$id' AND status = '1'");
              while ($row = mysqli_fetch_array($result)) {
              	$html .= '
              	<tr>
                  <td>'.$row["no_gantungan"].'</td>
                  <td>'.$row["nama_pemilik"].'</td>
                  <td>'.$row["nama_burung"].'</td>
                  <td>'.$row["alamat"].'</td>
                </tr>
              	';
              }
    $html .= '</table>
	</body>
	</html>
';
$mpdf->WriteHTML($html);
$mpdf->Output('Data-Peserta.pdf',\Mpdf\Output\Destination::INLINE);