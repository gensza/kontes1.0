<!DOCTYPE html>
<html>
<head>
  <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
</html>
<?php 
include "../../koneksi.php";
error_reporting(0);
$id = $_POST['id'];
$tiket = $_POST['pilih'];
$jumlah_dipilih = count($tiket);
if($jumlah_dipilih == 0){
	echo "<script>
        Swal.fire({
        allowOutsideClick: false,
        title: 'Pilih No.Gantungan Untuk Dihapus !',
        icon: 'error',
        confirmButtonText: 'OKE'
      }).then(function(){
        window.location.href='../../?page=jadwalLomba';
        });
        </script>";
}else{
	for($x=0;$x<$jumlah_dipilih;$x++){
	$query = mysqli_query($koneksi,"DELETE FROM data_pesanandetail WHERE id_pesanandetail='$tiket[$x]'");
	}
	$result = mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket-$jumlah_dipilih), jumlah_tiket=(jumlah_tiket-$jumlah_dipilih) WHERE id_jadwalkontes = '$id'");
		if($result){
			echo "<script>
		          Swal.fire({
		            icon: 'success',
		            title: 'Hapus Tiket Berhasil !'
		          })
		          </script>";
		          echo "<meta http-equiv='refresh' content='3; url=../../?page=jadwalLomba'>";
		}else{
			echo "<script>
	            Swal.fire({
	            allowOutsideClick: false,
	            title: 'Hapus Tiket GAGAL !',
	            icon: 'error',
	            confirmButtonText: 'OKE'
	          }).then(function(){
	            window.location.href='../../?page=jadwalLomba';
	            });
	            </script>";
		}		
}
?>