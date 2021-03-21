<!DOCTYPE html>
<html>
<head>
  <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
</html>
<?php 
include "../../koneksi.php";
$id = $_POST['id'];
$jenis_burung = $_POST['jenis_burung'];
$sesi = $_POST['sesi'];
$harga = $_POST['harga'];
$waktu = $_POST['waktu'];
$cek = mysqli_query($koneksi,"SELECT * FROM jadwal_kontes WHERE jenis_burung = '$jenis_burung' AND sesi = '$sesi' AND NOT id_jadwalkontes = '$id'");
$cekSesi = mysqli_num_rows($cek);
if($cekSesi){
	echo "<script>
        Swal.fire({
        allowOutsideClick: false,
        title: 'Sesi Yang Dibuat Sudah Ada !',
        icon: 'error',
        confirmButtonText: 'OKE'
      }).then(function(){
        window.location.href='../../?page=jadwalLomba';
        });
        </script>";
}else{
	$result = mysqli_query($koneksi,"UPDATE jadwal_kontes SET jenis_burung = '$jenis_burung', sesi = '$sesi', harga = '$harga', waktu = '$waktu' WHERE id_jadwalkontes = '$id' ");
		if($result){
			echo "<script>
	          Swal.fire({
	            icon: 'success',
	            title: 'Jadwal Kontes Berhasil Diperbarui !'
	          })
	          </script>";
	          echo "<meta http-equiv='refresh' content='3; url=../../?page=jadwalLomba'>";
		}else{
			  echo "<script>
	            Swal.fire({
	            allowOutsideClick: false,
	            title: 'Jadwal Kontes GAGAL Diperbarui !',
	            icon: 'error',
	            confirmButtonText: 'OKE'
	          }).then(function(){
	            window.location.href='../../?page=jadwalLomba';
	            });
	            </script>";
		}
	}
?>