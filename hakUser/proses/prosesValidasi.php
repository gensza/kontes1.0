<html>
<head>
	<script src="../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
session_start();
include '../../koneksi.php';
$id = $_GET['id'];
$st = $_GET['st'];
if(!isset($_SESSION["login"])){
	echo "<script type='text/javascript'>
		   Swal.fire({
					  allowOutsideClick: false,
					  title: 'ANDA BELUM LOGIN !',
					  icon: 'error',
					  confirmButtonText: 'OKE'
					}).then(function(){
						window.location.href='../../login.php';
						});
			 </script>";
}else{
   	header("Location: ../../?page=pesanTiket&id=$id&st=$st");
}
?> 