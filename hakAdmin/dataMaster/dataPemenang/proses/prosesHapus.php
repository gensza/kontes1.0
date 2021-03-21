<html>
<head>
	<script src="../../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
include "../../../koneksi.php";
$id = base64_decode($_GET['id']);
$result = mysqli_query($koneksi,"DELETE FROM penilaian_kontes  WHERE id_jadwalkontes = '$id'");
if($result){
	$query = $koneksi->query("UPDATE kelas_kontes SET hadiah = '0' WHERE id_jadwalkontes = '$id'");
	if($query){
	echo "<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Data Pemenang Berhasil Dihapus !'
		})
		</script>";
		echo "<meta http-equiv='refresh' content='3; url=../../../?page=dataPemenang'>";
	}else{
	echo "<script type='text/javascript'>
		  Swal.fire({
		  allowOutsideClick: false,
		  title: 'Data Pemenang GAGAl Dihapus !',
		  icon: 'error',
		  confirmButtonText: 'OKE'
		}).then(function(){
			window.location.href='../../../?page=dataPemenang';
			});
			</script>";
	}
}
?>
</body>
</html>