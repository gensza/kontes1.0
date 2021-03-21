<?php 
$np = base64_decode($_GET['np']);

$api_key = "SB-Mid-server-VMsA_7ywxROjYOuFI_kEjqq-";
    $password = "";
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/$np/status",
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
    $bc = $decode['biller_code'];
    $bk = $decode['bill_key'];
?>
<div class="card" id="mt">
  <div>
    <div class="card-header border col-lg-6" id="ch">
      <h4>Detail Pembayaran</h4>
      <div class="card-header-action">                                       
      </div>                          
    </div>
      <div class="card-body border col-lg-6">
        <div class="form-group">
          <label>Biller Code</label>
          <input type="text" id="np" style="" class="form-control" name="np" value="<?php echo $bc ?>" readonly>
        </div>
        <div class="form-group">
          <label>Bill Key</label>
          <input type="text" class="form-control" value="<?php echo $bk ?>" readonly>
        </div><hr>
        <div class="card-footer text-right">
          <a href="?page=infoPesanan" class="btn btn-primary">Back</a>
        </div>
      </div>
  </div>
</div>