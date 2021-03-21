<html>
<head>
    <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
include "../../koneksi.php";
session_start();
if(@$_SESSION['admin']){
  $sesi = $_SESSION['admin'];
}else if(@$_SESSION['korlap']){
  $sesi = $_SESSION['korlap'];
}
$konten = $_POST['konten'];
$ekstensi_diperbolehkan = array('png','jpg');
$file_konten = $_FILES['file']['name'];
$x = explode('.', $file_konten);
$ekstensi = strtolower(end($x));
$ukuran = $_FILES['file']['size'];
$file_tmp = $_FILES['file']['tmp_name'];
if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
    if($ukuran < 5044070){          
        move_uploaded_file($file_tmp, '../../../stisla/assets/img/konten/'.$file_konten);
        $result = mysqli_query($koneksi,"UPDATE informasi SET id_user = '$sesi', isi_informasi = '$konten', file = '$file_konten' WHERE id_informasi = '1'");
        if($result){
        	echo "<script>
                Swal.fire({
                  icon: 'success',
                  title: 'Informasi Kontes Berhasil Diperbarui !'
                })
                </script>";
                echo "<meta http-equiv='refresh' content='3; url=../../?page=dashboard'>";
		}else{
			echo "<script>
				alert('Konten GAGAL Diperbarui !');window.location.href='../../?page=dashboard'
					</script>";
		}
	}else{
		echo "<script>
        		Swal.fire({
                  icon: 'warning',
                  title: 'Ukuran Gambar Terlalu Besar, Max 5mb !'
                }).then(function(){
                    window.location.href='../../?page=dashboard';
                    });
                </script>";
   	}
}else{
	echo "<script>
		Swal.fire({
          icon: 'warning',
          title: 'upload Gambar Dengan Ekstensi .jpg / .png !'
        }).then(function(){
          window.location.href='../../?page=dashboard';
                });
        </script>";
}