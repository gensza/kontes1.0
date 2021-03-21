<html>
<head>
	<script src="../../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php  
include "../../../koneksi.php";
$np = base64_decode($_GET['np']);
$result = mysqli_query($koneksi,"UPDATE data_pesanan SET status_pesanan = 'Lunas' WHERE no_pesanan = '$np'");
if($result){
	echo "<script>
				Swal.fire({
				icon: 'success',
				title: 'Pesanan $np Berhasil DiKonfirmasi !'
				})
		  </script>";
		  echo "<meta http-equiv='refresh' content='3; url=../../../?page=transaksiPending'>";
}
?>
</body>
</html>