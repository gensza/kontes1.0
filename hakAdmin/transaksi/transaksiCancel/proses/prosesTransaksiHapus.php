<html>
<head>
	<script src="../../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
include '../../../koneksi.php';
$np = base64_decode($_GET['np']);
$query = $koneksi->query("DELETE FROM data_pembayaran WHERE no_pesanan = '$np'");
if($query){
	$result = $koneksi->query("DELETE FROM data_pesanan WHERE no_pesanan = '$np'");
	if($result){
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Pesanan Cancel $np Berhasil Dihapus !'
				})
				</script>";
				echo "<meta http-equiv='refresh' content='3; url=../../../?page=transaksiCancel'>";
		}else{
			echo "<script>
				Swal.fire({
				  title: 'Pesanan Cancel $np GAGAL Dihapus !'
				})
				</script>";
				echo "<meta http-equiv='refresh' content='3; url=../../../?page=transaksiCancel'>";
		}
}
?>
</body>
</html>