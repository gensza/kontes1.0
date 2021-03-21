<?php session_start();?>
<html>
    <head>
    	<script src="../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
    </head>
</html>
<?php
include '../koneksi.php';
$username = $_POST['username'];
$password = $_POST['password'];
$sql = mysqli_query($koneksi,"SELECT * FROM user WHERE username ='$username'");
$data = mysqli_fetch_array($sql);
$cek = mysqli_num_rows($sql);
if($cek == 1){
	if(password_verify($password, $data["password"])){
		$_SESSION['login']=true;
			if($data['level_user'] == "admin"){
				@$_SESSION['admin'] = $data['id_user'];
				header("Location:../hakAdmin/index.php");
			}else if($data['level_user'] == "korlap"){
				@$_SESSION['korlap'] = $data['id_user'];
				header("location:../hakAdmin/index.php");
			}else if($data['level_user'] == "user"){
				@$_SESSION['user'] = $data['id_user'];
				header("location:../index.php");
			}
	}else{
		echo "<script type='text/javascript'>
			  Swal.fire({
			  allowOutsideClick: false,
			  title: 'PASSWORD SALAH !',
			  icon: 'error',
			  confirmButtonText: 'OKE'
			}).then(function(){
				window.location.href='../login.php';
				});
	 			</script>";
		}
}else{
	echo "<script type='text/javascript'>
		  Swal.fire({
		  allowOutsideClick: false,
		  title: 'USERNAME SALAH !',
		  icon: 'error',
		  confirmButtonText: 'OKE'
		}).then(function(){
			window.location.href='../login.php';
			});
		 	</script>";
}
?>