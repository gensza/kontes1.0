<html>
<head>
    <script src="../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
include '../../koneksi.php';
session_start();
if(@$_SESSION['admin']){
	$sesi = $_SESSION['admin'];
}else if(@$_SESSION['user']){
	$sesi = $_SESSION['user'];
}
$password = $_POST['password'];
$passwordBaru = $_POST['passwordBaru'];
$passwordBaru2 = $_POST['passwordBaru2'];
$sql = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$sesi'");
$cek = mysqli_num_rows($sql);
$data = mysqli_fetch_array($sql);
// jika true lakukan update password
if($passwordBaru == $passwordBaru2){
	if(password_verify($password, $data["password"])){
		$password = password_hash($passwordBaru, PASSWORD_DEFAULT);
		$sql = mysqli_query($koneksi,"UPDATE user SET password = '$password' WHERE id_user = '$sesi'");
		echo "<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Kata Sandi Berhasil Diperbarui !'
		})
		</script>";
		echo "<meta http-equiv='refresh' content='3; url=../../hakAdmin/index.php'>";
	}else{
		echo "<script type='text/javascript'>
			  Swal.fire({
			  allowOutsideClick: false,
			  title: 'Kata Sandi Lama Anda Salah !',
			  icon: 'error',
			  confirmButtonText: 'OKE'
			}).then(function(){
				window.location.href='../gantiPassword.php';
				});
		</script>";
	}
}else{
	 echo "<script>
	            Swal.fire({
	            allowOutsideClick: false,
	            title: 'Password Tidak Sama !',
	            icon: 'error',
	            confirmButtonText: 'OKE'
	          }).then(function(){
	            window.location.href='../gantiPassword.php';
	            });
	            </script>";
}
?>