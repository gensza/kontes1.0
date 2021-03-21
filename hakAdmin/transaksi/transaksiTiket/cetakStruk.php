<?php
include "../../koneksi.php";
$np = $_GET['np'];
$result = $koneksi->query("SELECT user.nama_user, data_pesanan.jumlah_tiket, data_pesanan.total_harga FROM data_pesanan INNER JOIN user ON data_pesanan.id_user = user.id_user WHERE no_pesanan = '$np'");
$data = mysqli_fetch_array($result);
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
?>
<body onload="window.print()">
	<p1>Tiket Lomba</p1><br>
	<p2>Cahaya Enterprise</p2><br>
	<p3><?php echo $date; ?></p3><br><br>
	<p8>No Trx</p8><p81>:<?php echo $np; ?></p81><br>
	<p4>Admin</p4><p41>:<?php echo $data['nama_user']; ?></p42><br>
	<p5>Jumlah</p5><p51>:<?php echo $data['jumlah_tiket']; ?></p51><br>
	<p6>Harga</p6><p61>:Rp <?php echo number_format($data['total_harga'],0,',','.') ?></p61><br><hr><br><br>
	<p7>List Tiket</p7><br><br>
<?php 
	$query = $koneksi->query("SELECT data_pesanandetail.id_pesanandetail, jadwal_kontes.jenis_burung, jadwal_kontes.sesi, jadwal_kontes.harga, data_pesanandetail.no_gantungan FROM data_pesanandetail INNER JOIN jadwal_kontes ON data_pesanandetail.id_jadwalkontes = jadwal_kontes.id_jadwalkontes WHERE no_pesanan = '$np'");
	while ($d = mysqli_fetch_array($query)){
		?>
		<p12>Kode</p12><p121>:<?php echo $d['id_pesanandetail']; ?></p121><br>
		<p9>Kelas</p9><p91>:<?php echo $d['jenis_burung']; ?></p91><p92> <?php echo $d['sesi']; ?></p92><br>
		<p10>Harga</p10><p101>:Rp <?php echo number_format($d['harga'],0,',','.') ?></p102><br>
		<p11>No Gant</p11><p111>:<?php echo $d['no_gantungan']; ?></p111><br>
		<p13>Pemilik</p13><p131>:</p131><br>
		<p14>Burung</p14><p141>:</p141><br>
		<p15>Alamat</p15><p151>:</p151><br><br><hr>
		<?php
	}
	if($data['jumlah_tiket'] == 0){
		echo "<script>
			location.reload();
		</script>";
	}
 ?>
</body>
<style type="text/css">
	body{
		font-family: "Lucida Console", Courier, monospace;
		font-size: 20px;
	}
	p1, p2, p3 {
		font-weight: bold;
	}
	p1 {
		margin-left: 50px;
	}
	p2 {
		margin-left: 15px;
		line-height: 22px;
	}
	p3 {
		margin-left: 15px;
		line-height: 22px;
	}
	p41{
		margin-left: 25px;
	}
	p51 {
		margin-left: 13px;
	}
	p61 {
		margin-left: 25px;
	}
	p81 {
		margin-left: 13px;
	}
	p121 {
		margin-left: 45px;
	}
	p91 {
		margin-left: 33px;
	}
	p101 {
		margin-left: 33px;
	}
	p111 {
		margin-left: 9px;
	}
	p131{
		margin-left: 9px;
	}
	p141{
		margin-left: 21px;
	}
	p151 {
		margin-left: 21px;
	}
	p101, p121, p131, p141, p151, p81, p42, p51 ,p61 {
		line-height: 20px;
	}
	p9, p10, p11, p12, p13, p14, p15, p4, p5, p6, p8 {
		line-height: 26px;
	}
	hr {
		width: 320px;
		float: left;
	}
</style>