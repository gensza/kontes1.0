<?php
include "koneksi.php";
$np = $_GET['np'];
$waktu = date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('Y-m-d H:i:s');

$query = mysqli_query($koneksi,"UPDATE data_pesanan SET status_pesanan = 'Pending' WHERE no_pesanan = '$np'");
if($query){
  header("Location: index.php?page=infoPesanan");
}else{
  echo "<script>alert('gagal')</script>";
}

// $api_key = "SB-Mid-server-VMsA_7ywxROjYOuFI_kEjqq-";
// $password = "";
// $curl = curl_init();

// curl_setopt_array($curl, array(
// 	CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/$np/status",
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_USERPWD => $api_key.':'.$password,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 30,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "GET",
// 	CURLOPT_HTTPHEADER => array(
// 		"Accept: application/json",
// 		"Content-Type: application/json"
// 	),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);
// $response2 = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// curl_close($curl);

// $jsonArrayResponse = json_decode($response);

// // $encode = json_encode($response,true);
// $decode = json_decode($response,true);
// $data = $decode['transaction_status'];
// $np = $decode['order_id'];
?>