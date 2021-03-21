<!DOCTYPE html>
<html>
	<head>
		<script src="../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
	</head>
</html>
<?php
include '../../koneksi.php';
$nama_burung = $_POST['nama_burung'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$nama = $_POST['nama_user'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$cekUsername = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'");
$cek = mysqli_num_rows($cekUsername);
if($cek){
	echo "<script type='text/javascript'>
		  Swal.fire({
		  allowOutsideClick: false,
		  title: 'Username Sudah Ada !',
		  icon: 'error',
		  confirmButtonText: 'OKE'
		}).then(function(){
			window.location.href='../../akun/daftarAkun.php';
			});
			</script>";
		}else{
			if($password == $password2){
			$password = password_hash($password, PASSWORD_DEFAULT);
				$query = mysqli_query($koneksi,"INSERT INTO user VALUES ('','$nama_burung','$username','$password','$nama','$alamat','$no_telepon','user')");
				if ($query) {
					echo "<script>
						Swal.fire({
						  icon: 'success',
						  title: 'Akun berhasil Didaftarkan !'
						})
						</script>";
						echo "<meta http-equiv='refresh' content='3; url=../../login.php'>";
				}else{
					echo "<script type='text/javascript'>
					  Swal.fire({
					  allowOutsideClick: false,
					  title: 'Akun GAGAL Didaftarkan !',
					  icon: 'error',
					  confirmButtonText: 'OKE'
					}).then(function(){
						window.location.href='../../akun/daftarAkun.php';
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
			            window.location.href='../../akun/daftarAkun.php';
			            });
			        </script>";
		}
	}	
?>