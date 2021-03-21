<html>
<head>
	<script src="../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
include '../../koneksi.php';
$np = base64_decode($_GET['np']);
$data = mysqli_query($koneksi,"SELECT * FROM data_pesanan WHERE no_pesanan = '$np'");
$mysql = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE no_pesanan = '$np'");
$jt = mysqli_fetch_array($data);
$d = mysqli_fetch_array($mysql);
$id = $d['id_jadwalkontes'];
$jumlah_tiket = $jt['jumlah_tiket'];
$query = mysqli_query($koneksi,"UPDATE data_pesanan SET jumlah_tiket = '0', total_harga = '0', status_pesanan = 'Cancel' WHERE no_pesanan ='$np'");
if($query){
	$sql = mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket+$jumlah_tiket) WHERE id_jadwalkontes = '$id'");
	if($sql){
			$result = mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '0', nama_pemilik = '', nama_burung = '', alamat = '', no_pesanan = '', status = '0' WHERE no_pesanan = '$np'");
		if($result){
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Pesanan Anda Berhasil Dibatalkan !'
				})
				</script>";
				echo "<meta http-equiv='refresh' content='3; url=../../?page=infoPesanan'>";
		}else{
			echo "<script>
				alert('Pesanan Anda Tidak Berhasil Dibatalkan !');window.location.href='../../?page=infoPesanan'
				</script>";
		}
	}
} 
 ?>
</body>
</html>