<?php
include "koneksi.php";
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM jadwal_kontes WHERE id_jadwalkontes = '$id'");
$cekQuery = mysqli_fetch_array($query);
$jb = $cekQuery['jenis_burung'];
$sesi = $cekQuery['sesi'];
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
		<title>Data Penilaian Kontes</title>
	</head>
	<body>
		<div>
			<h1>Cahaya Enterprise</h1>
			<h3>Jl.Perairan 2. Setu parigi, pondok Aren -  Tangsel</h3>
			<h3>'.$date.'</h3>
			<hr>
			<h1>Data Penilaian Kontes</h1>
			<h2 style="color: red">'.$jb.'&nbsp;'.$sesi.'</h2>
		</div>
		<table border="1" cellpadding="10" cellspacing="0">
            <thead>
              <tr>
                <th>Juara</th>
                <th>No Gantungan</th>
                <th>Point</th>
                <th>Nama Pemilik</th>
                <th>Nama Burung</th>
                <th>Alamat</th>
              </tr>
            </thead>';
            $no = 1; 
              $result = $koneksi->query("SELECT penilaian_kontes.no_juara, data_pesanandetail.no_gantungan, penilaian_kontes.point, penilaian_kontes.id_jadwalkontes, data_pesanandetail.nama_pemilik, data_pesanandetail.nama_burung, data_pesanandetail.alamat FROM penilaian_kontes INNER JOIN data_pesanandetail ON penilaian_kontes.id_pesanandetail = data_pesanandetail.id_pesanandetail WHERE penilaian_kontes.id_jadwalkontes = '$id'");
              while ($data = mysqli_fetch_array($result)){
              	$html .= '
              	<tr>
                  <td style="text-align: center">'.$data['no_juara'].'</td>
                  <td style="text-align: center">'.$data['no_gantungan'].'</td>
                  <td style="text-align: center">'.$data['point'].'</td>
                  <td>'.$data['nama_pemilik'].'</td>
                  <td>'.$data['nama_burung'].'</td>
                  <td>'.$data['alamat'].'</td>
                </tr>
              	';
              }
    $html .= '</table>
	</body>
	</html>
';
$mpdf->WriteHTML($html);
$mpdf->Output('Penilaian-Kontes.pdf',\Mpdf\Output\Destination::INLINE);