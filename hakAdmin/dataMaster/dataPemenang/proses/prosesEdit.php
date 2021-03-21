<html>
<head>
	<script src="../../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
error_reporting(0);
include "../../../koneksi.php";
$id = $_POST['id'];
$iddp = $_POST['iddp'];
$opt = $_POST['opt'];
$itt = $_POST['itt'];
$point = $_POST['point'];
for($x=0;$x<count($opt);$x++){
		$cariid = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$id' AND no_gantungan = '$opt[$x]'");
		$data = mysqli_fetch_array($cariid);
		$ipd = $data['id_pesanandetail'];
		$result= mysqli_query($koneksi,"UPDATE penilaian_kontes SET id_pesanandetail = '$ipd', point = '$point[$x]', hadiah = '$itt[$x]' WHERE id_penilaian = '$iddp[$x]'");
}
	if($result){
		$query = $koneksi->query("SELECT * FROM penilaian_kontes WHERE id_jadwalkontes = $id ");
              	while($sql = mysqli_fetch_array($query)){
              		$hadiah += $sql["hadiah"];
              	}
        $sql = $koneksi->query("UPDATE kelas_kontes SET hadiah = '$hadiah' WHERE id_jadwalkontes = '$id'");
	}
		if($sql){
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Data Pemenang Berhasil Diperbarui !'
				})
				</script>";
				echo "<meta http-equiv='refresh' content='3; url=../../../?page=dataPemenang'>";
		}else{
			echo "<script type='text/javascript'>
				  Swal.fire({
				  allowOutsideClick: false,
				  title: 'Data Pemenang GAGAl Diperbarui !',
				  icon: 'error',
				  confirmButtonText: 'OKE'
				}).then(function(){
					window.location.href='../../../?page=dataPemenang';
					});
					</script>";
		}
?>
</body>
</html>