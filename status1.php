<?php
error_reporting(0);
include "koneksi.php";
$status = $koneksi->query("SELECT * FROM data_pesanan WHERE status_pesanan = 'pending'");
while($statusoke = mysqli_fetch_array($status)){
    $cariNp = $statusoke['no_pesanan'];

    $api_key = "SB-Mid-server-VMsA_7ywxROjYOuFI_kEjqq-";
    $password = "";
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/$cariNp/status",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERPWD => $api_key.':'.$password,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/json",
            "Content-Type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $response2 = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    $jsonArrayResponse = json_decode($response);

    // $encode = json_encode($response,true);
    $decode = json_decode($response,true);
    $dataStatus = $decode['transaction_status'];
    $np = $decode['order_id'];

    if($dataStatus == 'settlement'){
        mysqli_query($koneksi,"UPDATE data_pesanan SET status_pesanan = 'Lunas' WHERE no_pesanan = '$np'");
    }

}
?>