<!DOCTYPE html>
<html>
	<head>
		<script src="../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
	</head>
</html>
<?php 
include "../../koneksi.php";
session_start();
if(@$_SESSION['admin']){
	$sesi = $_SESSION['admin'];
}else if(@$_SESSION['user']){
	$sesi = $_SESSION['user'];
}
$nmBurung = $_POST['nama_burung'];
$nmPemilik = $_POST['nama_user'];
$nmPengguna = $_POST['username'];
$alamat	= $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$sql = mysqli_query($koneksi,"UPDATE user SET nama_burung='$nmBurung', nama_user='$nmPemilik', username='$nmPengguna', alamat='$alamat', no_telepon = '$no_telepon' WHERE id_user = '$sesi'");
if($sql){
	echo "<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Profile Berhasil Diperbarui !'
		})
		</script>";
		echo "<meta http-equiv='refresh' content='3; url=../../hakAdmin/index.php'>";
}else{
	echo "<script type='text/javascript'>
				  Swal.fire({
				  allowOutsideClick: false,
				  title: 'Profile GAGAL Diperbarui !',
				  icon: 'error',
				  confirmButtonText: 'OKE'
				}).then(function(){
					window.location.href='../../akun/profile.php';
					});
			</script>";
}
?>