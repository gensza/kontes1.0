<html>
<head>
	<script src="../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
</html>
<?php
include '../../koneksi.php';
session_start();
if(@$_SESSION['user']){
  $sesi = $_SESSION['user'];
}else if(@$_SESSION['admin']){
  $sesi = $_SESSION['admin'];
}
$waktu = date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('Y-m-d H:i:s', time() + 3600);
error_reporting(0);
$kode = $_POST['kode'];
$id = $_POST['id'];
$id_user = $_POST['id_user'];
$telepon = $_POST['telepon'];
$kelas = $_POST['kelas'];
$jumlah = $_POST['jumlah'];
$total = $_POST['total'];
$date =  $_POST['date'];
$opt1 = $_POST['opt1'];
$nama1 = $_POST['nama1'];
$burung1 = $_POST['burung1'];
$alamat1 = $_POST['alamat1'];
$opt2 = $_POST['opt2'];
$nama2 = $_POST['nama2'];
$burung2 = $_POST['burung2'];
$alamat2 = $_POST['alamat2'];
$opt3 = $_POST['opt3'];
$nama3 = $_POST['nama3'];
$burung3 = $_POST['burung3'];
$alamat3 = $_POST['alamat3'];
$query = mysqli_query($koneksi,"SELECT * FROM kelas_kontes WHERE id_jadwalkontes = '$id'");
$result = mysqli_query($koneksi,"SELECT * FROM data_pesanan WHERE no_pesanan = '$kode'");
$cekTiket = mysqli_fetch_array($query);
$cekKode = mysqli_fetch_array($result);
if($cekKode){
	echo "<script>
			alert('ERROR CODE ! Silahkan Pesan Ulang');window.location.href='../../?page=jadwalLomba'
			</script>";
	}else if($cekTiket['stok_tiket'] == 0){
		echo "<script>
		alert('Tiket Sudah Habis !');window.location.href='../../?page=jadwalLomba'
		</script>";
	}else{
		for($i=1;$i<=$jumlah;$i++){
			if($i == 1){
			mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '$sesi', nama_pemilik = '$nama1', nama_burung = '$burung1', alamat = '$alamat1', no_pesanan = '$kode', status = '1' WHERE no_gantungan = '$opt1' AND id_jadwalkontes = '$id'");
			}else if($i == 2){
				mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '$sesi', nama_pemilik = '$nama2', nama_burung = '$burung2', alamat = '$alamat2', no_pesanan = '$kode', status = '1' WHERE no_gantungan = '$opt2' AND id_jadwalkontes = '$id'");
			}else{
				mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '$sesi', nama_pemilik = '$nama3', nama_burung = '$burung3', alamat = '$alamat3', no_pesanan = '$kode', status = '1' WHERE no_gantungan = '$opt3' AND id_jadwalkontes = '$id'");
			}
				$query = mysqli_query($koneksi,"INSERT INTO data_pesanan VALUES('$kode','$id_user','$jumlah','$total','$date','$waktu','Belum Bayar')");
				if($query){
					$sql = mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket-$jumlah) WHERE id_jadwalkontes = '$id'");
					if($sql){
						echo "<script>
							Swal.fire({
							icon: 'success',
							title: 'Pesan Tiket Berhasil !',
							text: 'Silahkan Melakukan Pembayaran',
							confirmButtonText: 'OKE'
							})
							</script>";
							echo "<meta http-equiv='refresh' content='3; url=../../?page=infoPesanan'>";
					}else{
						echo "<script>alert('Pesan Tiket Kelas $kelas Gagal');window.location.href='../../?page=jadwalLomba'</script>";
					}

				}
				
		}
	}	
?>