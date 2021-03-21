<html>
<head>
	<script src="../../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
error_reporting(0);
include "../../../koneksi.php";
$id = $_POST['id'];
for($i=1;$i<=36;$i++){
	$opt[$i] = $_POST['opt'.$i];
	$itt[$i] = $_POST['itt'.$i];
	$point[$i] = $_POST['point'.$i];

	if($opt[$i] > 0 AND $itt[$i] > 0 AND $point[$i] > 0){
	$result = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$id' AND no_gantungan = '$opt[$i]'");
	$data = mysqli_fetch_array($result);
	$ipd = $data['id_pesanandetail'];
	$insert = $koneksi->query("INSERT INTO penilaian_kontes VALUES(null,'$ipd','$id','$i','$point[$i]','$itt[$i]')");
	}
}
	$query = $koneksi->query("SELECT * FROM penilaian_kontes WHERE id_jadwalkontes = '$id'");
            while($sql = mysqli_fetch_array($query)){
              		$hadiah += $sql["hadiah"];
            }
        $sql = $koneksi->query("UPDATE kelas_kontes SET hadiah = '$hadiah' WHERE id_jadwalkontes = '$id'");
        if($sql){
        	echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Data Pemenang Berhasil Ditambahkan !'
				})
				</script>";
				echo "<meta http-equiv='refresh' content='3; url=../../../?page=dataPemenang'>";
        }else{
        	echo "<script>
				Swal.fire({
				  icon: 'error',
				  title: 'Data Pemenang GAGAL Ditambahkan !'
				})
				</script>";
				echo "<meta http-equiv='refresh' content='3; url=../../../?page=dataPemenang'>";
        }         
?>
</body>
</html>