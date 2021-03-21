<!DOCTYPE html>
<html>
<head>
  <script src="../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
</html>
<?php
error_reporting(0);
$waktu = date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('Y-m-d H:i:s');
include "../koneksi.php";
$kelasKontes = $koneksi->query("SELECT jadwal_kontes.sesi, kelas_kontes.id_kelaskontes, jadwal_kontes.jenis_burung, jadwal_kontes.harga, kelas_kontes.jumlah_tiket, kelas_kontes.stok_tiket, kelas_kontes.hadiah  FROM kelas_kontes INNER JOIN jadwal_kontes ON kelas_kontes.id_jadwalkontes = jadwal_kontes.id_jadwalkontes");
while($cariid = mysqli_fetch_array($kelasKontes)){
	$sesi = $cariid['sesi'];
	$harga = $cariid['harga'];
	$ikk = $cariid['id_kelaskontes'];
	$jb = $cariid['jenis_burung'];
	$jp = $cariid['jumlah_tiket'] - $cariid['stok_tiket'];
	$hslhp = $jp * $cariid['harga'];
	$hadiah = $cariid['hadiah'];
	$tp = $hslhp - $hadiah;
	if($ikk > 0){
		$simpan = $koneksi->query("INSERT INTO laporan_keuangan VALUES(null,'$ikk','$jb $sesi','$harga','$waktu','$jp','$hslhp','$hadiah','$tp')");
	}
}
	if($ikk > 0){
		$koneksi->query("DELETE FROM penilaian_kontes");
		$koneksi->query("DELETE FROM data_pembayaran");
		$koneksi->query("DELETE FROM data_pesanandetail");
		$koneksi->query("DELETE FROM data_pesanan");
		$koneksi->query("DELETE FROM kelas_kontes");
		$koneksi->query("DELETE FROM jadwal_kontes");
		echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Kontes Selesai !'
				})
				</script>";
				echo "<meta http-equiv='refresh' content='3; url=../?page=laporanKeuangan'>";
	}else{
		echo "<script>
				Swal.fire({
				  icon: 'error',
				  title: 'GAGAL Input Laporan / Jadwal Kontes Kosong !'
				}).then(function(){
					window.location.href='../?page=laporanKeuangan';
					});
				</script>";
	}
?>