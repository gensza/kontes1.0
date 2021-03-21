<!DOCTYPE html>
<html>
<head>
  <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
</html>
<?php 
include "../../koneksi.php";
$id = base64_decode($_GET['id']);
$sql = mysqli_query($koneksi,"SELECT * FROM kelas_kontes WHERE id_jadwalkontes = '$id'");
$data = mysqli_fetch_array($sql);
	if($data['stok_tiket'] < $data['jumlah_tiket']){
		  echo "<script>
	            Swal.fire({
	            allowOutsideClick: false,
	            title: 'GAGAL Dihapus, Sudah Ada Peserta !',
	            icon: 'error',
	            confirmButtonText: 'OKE'
	          }).then(function(){
	            window.location.href='../../?page=jadwalLomba';
	            });
	            </script>";
	}else{
		$mysql = $koneksi->query("DELETE FROM penilaian_kontes WHERE id_jadwalkontes = '$id'");
		if($mysql){
			$query = mysqli_query($koneksi,"DELETE FROM data_pesanandetail WHERE id_jadwalkontes ='$id'");
	  		if($query){
				$result = mysqli_query($koneksi,"DELETE FROM kelas_kontes WHERE id_jadwalkontes ='$id'");
				$hpsKelas = $koneksi->query("DELETE FROM jadwal_kontes WHERE id_jadwalkontes ='$id'");
				if($result){
					echo "<script>
			          Swal.fire({
			            icon: 'success',
			            title: 'Jadwal Kontes Berhasil Dihapus !'
			          })
			          </script>";
			          echo "<meta http-equiv='refresh' content='3; url=../../?page=jadwalLomba'>";
				}else{
					  echo "<script>
			            Swal.fire({
			            allowOutsideClick: false,
			            title: 'Jadwal Kontes GAGAL Dihapus !',
			            icon: 'error',
			            confirmButtonText: 'OKE'
			          }).then(function(){
			            window.location.href='../../?page=jadwalLomba';
			            });
			            </script>";
				}
			}
		}
	}
?>