<?php 
include "../../../koneksi.php";
$id = base64_decode($_GET['id']);
$result = mysqli_query($koneksi,"SELECT * FROM penilaian_kontes WHERE id_jadwalkontes = '$id'");
$data = mysqli_num_rows($result);
$idec = base64_encode($id);
if($data > 0){
	header("Location: ../../../?page=editPemenang&id=$idec");
}else{
	header("Location: ../../../?page=tambahPemenang&id=$idec");
}