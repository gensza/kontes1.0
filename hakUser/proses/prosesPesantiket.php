<?php 
  $id = $_POST['id'];
  $jt = $_POST['jt'];
  $st = $_POST['st'];
  $iden = base64_encode($id);
  $jten = base64_encode($jt);
  $sten = base64_encode($st);
  if($jt == 0){
  	echo "<script>alert('Pilih Jumlah Tiket !');window.location.href='../../?page=pesanTiket&id=$iden&st=$sten'</script>";
  }else if($jt == 1){
  	header("Location: ../../?page=pesanTiketdetail1&id=$iden&jt=$jten");
  }else if($jt == 2){
  	header("Location: ../../?page=pesanTiketdetail2&id=$iden&jt=$jten");
  }else{
  	header("Location: ../../?page=pesanTiketdetail3&id=$iden&jt=$jten");
  }	
 ?>