<?php
include "../../koneksi.php";
switch ($_GET['aksi'])
{
	case 'tambah':
	?>
    <!DOCTYPE html>
    <html>
    <head>
      <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
    </head>
    </html>
    <?php
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_telepon = $_POST['no_telepon'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$cekUsername = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'");
	$cek = mysqli_num_rows($cekUsername);
	if($cek == 1){
			echo "<script>
	            Swal.fire({
	            allowOutsideClick: false,
	            title: 'Username Sudah Ada !',
	            icon: 'error',
	            confirmButtonText: 'OKE'
	          }).then(function(){
	            window.location.href='../../?page=dataPanitia';
	            });
	            </script>";
	}else{
		if($password == $password2){
			$password = password_hash($password, PASSWORD_DEFAULT);
			$result = $koneksi->query("INSERT INTO user VALUES(null,'','$username','$password','$nama','$alamat','$no_telepon','admin')");
				if($result){
			        echo "<script>
			          Swal.fire({
			            icon: 'success',
			            title: 'Data Panitia Berhasil Dibuat !'
			          })
			          </script>";
			          echo "<meta http-equiv='refresh' content='3; url=../../?page=dataPanitia'>";
			    }else{
			        echo "<script>
			            Swal.fire({
			            allowOutsideClick: false,
			            title: 'Data Panitia GAGAl Dibuat !',
			            icon: 'error',
			            confirmButtonText: 'OKE'
			          }).then(function(){
			            window.location.href='../../?page=dataPanitia';
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
			            window.location.href='../../?page=dataPanitia';
			            });
			            </script>";
		}
	}
	break;
	case 'edit':
	?>
    <!DOCTYPE html>
    <html>
    <head>
      <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
    </head>
    </html>
    <?php
    $id = $_POST['id'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_telepon = $_POST['no_telepon'];
	$result = $koneksi->query("UPDATE user SET nama_user = '$nama', alamat = '$alamat', no_telepon = '$no_telepon' WHERE id_user = '$id'");
		if($result){
	        echo "<script>
	          Swal.fire({
	            icon: 'success',
	            title: 'Data Panitia Berhasil Diubah !'
	          })
	          </script>";
	          echo "<meta http-equiv='refresh' content='3; url=../../?page=dataPanitia'>";
	    }else{
	        echo "<script>
	            Swal.fire({
	            allowOutsideClick: false,
	            title: 'Data Panitia GAGAl Diubah !',
	            icon: 'error',
	            confirmButtonText: 'OKE'
	          }).then(function(){
	            window.location.href='../../?page=dataPanitia';
	            });
	            </script>";
	    }
	break;
	case 'hapus':
		?>
    <!DOCTYPE html>
    <html>
    <head>
      <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
    </head>
    </html>
    <?php
    $id = base64_decode($_GET['id']);
    $result = $koneksi->query("DELETE FROM user WHERE id_user = '$id'");
    	if($result){
	        echo "<script>
	          Swal.fire({
	            icon: 'success',
	            title: 'Data Panitia Berhasil Dihapus !'
	          })
	          </script>";
	          echo "<meta http-equiv='refresh' content='3; url=../../?page=dataPanitia'>";
	    }else{
	        echo "<script>
	            Swal.fire({
	            allowOutsideClick: false,
	            title: 'Data Panitia GAGAl Dihapus !',
	            icon: 'error',
	            confirmButtonText: 'OKE'
	          }).then(function(){
	            window.location.href='../../?page=dataPanitia';
	            });
	            </script>";
	    }
	break;
}