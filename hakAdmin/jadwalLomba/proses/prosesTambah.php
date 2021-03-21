<!DOCTYPE html>
<html>
<head>
  <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
</html>
<?php
include "../../koneksi.php";
$jenis_burung = $_POST['jenis_burung'];
$sesi = $_POST['sesi'];
$harga = $_POST['harga'];
$stok_tiket = $_POST['stok_tiket'];
$waktu = $_POST['waktu'];
$cek = mysqli_query($koneksi,"SELECT * FROM jadwal_kontes WHERE jenis_burung = '$jenis_burung' AND sesi = '$sesi'");
$cekSesi = mysqli_num_rows($cek);
if($stok_tiket > 36){
	echo "<script>
        Swal.fire({
        allowOutsideClick: false,
        title: 'Maksimal 36 Gantungan !',
        icon: 'error',
        confirmButtonText: 'OKE'
      }).then(function(){
        window.location.href='../../?page=jadwalLomba';
        });
        </script>";
}else if($cekSesi){
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
	$result = mysqli_query($koneksi,"INSERT INTO jadwal_kontes VALUES(null,'$jenis_burung','$sesi','$harga','$waktu') ");
	$tampil = mysqli_query($koneksi, "SELECT LAST_INSERT_ID()");
	$r=mysqli_fetch_array($tampil);
	$id = $r[0];
	$kelas = $koneksi->query("INSERT INTO kelas_kontes VALUES (null,'$id','$stok_tiket','$stok_tiket','0')");
	for($i=1;$i<=$stok_tiket;$i++){
		$query = mysqli_query($koneksi,"INSERT INTO data_pesanandetail VALUES(null,'$i','0','','','','','$id','0','0') ");
	}
		if($query){
			echo "<script>
	          Swal.fire({
	            icon: 'success',
	            title: 'Jadwal Kontes Berhasil Dibuat !'
	          })
	          </script>";
	          echo "<meta http-equiv='refresh' content='3; url=../../?page=jadwalLomba'>";
		}else{
			echo "<script>
	            Swal.fire({
	            allowOutsideClick: false,
	            title: 'Jadwal Kontes GAGAL Dibuat!',
	            icon: 'error',
	            confirmButtonText: 'OKE'
	          }).then(function(){
	            window.location.href='../../?page=jadwalLomba';
	            });
	            </script>";
		}
	}
?>