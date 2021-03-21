<!DOCTYPE html>
<html>
<head>
  <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
</html>
<?php
include "../../koneksi.php"; 
$jumlah_tambah = $_POST['jumlah_tambah'];
$id = $_POST['id'];
$query = mysqli_query($koneksi,"SELECT MAX(no_gantungan) AS akhir FROM data_pesanandetail WHERE id_jadwalkontes = '$id'");
$sql = mysqli_fetch_array($query);
$akhir = $sql['akhir'];
if($jumlah_tambah > 0){
	$result = mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket+$jumlah_tambah), jumlah_tiket=(jumlah_tiket+$jumlah_tambah) WHERE id_jadwalkontes = '$id'");
	if($result){
	for($i=1;$i<=$jumlah_tambah;$i++){
		$hsl = $i+$akhir;
		$query = mysqli_query($koneksi,"INSERT INTO data_pesanandetail VALUES(null,'$hsl','0','','','','','$id','0','0') ");
	}
	if($query){
			echo "<script>
	          Swal.fire({
	            icon: 'success',
	            title: 'Tambah Stok Tiket Berhasil !'
	          })
	          </script>";
	          echo "<meta http-equiv='refresh' content='3; url=../../?page=jadwalLomba'>";
	}else{
		echo "<script>
            Swal.fire({
            allowOutsideClick: false,
            title: 'GAGAL Tambah Stok Tiket !',
            icon: 'error',
            confirmButtonText: 'OKE'
          }).then(function(){
            window.location.href='../../?page=jadwalLomba';
            });
            </script>";
		}
	}
}else{
	echo "<script>
        Swal.fire({
        allowOutsideClick: false,
        title: 'GAGAL Tambah Stok Tiket !',
        icon: 'error',
        confirmButtonText: 'OKE'
      }).then(function(){
        window.location.href='../../?page=jadwalLomba';
        });
        </script>";
}
?>