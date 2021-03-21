<?php
$np = base64_decode($_GET['np']);
$nama = $_GET['nama'];

require_once dirname(__FILE__) . '/../midtrans/Midtrans.php';
// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-VMsA_7ywxROjYOuFI_kEjqq-';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$waktu = date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('Y-m-d H:i:s');
$result = mysqli_query($koneksi,"SELECT * FROM data_pesanan WHERE no_pesanan = '$np'");
$data = mysqli_fetch_array($result);
$sql = $koneksi->query("SELECT * FROM user WHERE id_user = $sesi");
$datasql = mysqli_fetch_array($sql);
//   if($waktu > $data['expired']){
//     echo "<script>alert('Expired!, Pesanan Anda Dibatalkan.');
//     window.location.href='?page=infoPesanan';
//     </script>";
//   }
  $params = array(
    'transaction_details' => array(
        'order_id' => $np,
        'gross_amount' => $data['total_harga'],
    ),
    'customer_details' => array(
        'first_name' => $datasql['nama_user'],
        'email' => 'zaverna@example.com',
        'phone' => $datasql['no_telepon'],
    ),
  );
  $snapToken = \Midtrans\Snap::getSnapToken($params);
?>
<div class="card" id="mt">
  <div>
    <div class="card-header border col-lg-6" id="ch">
      <h4>Konfirmasi Transfer</h4>
      <button onclick="sweetAlert()" id="oc" class="btn btn-danger btn-sm">Batalkan Pesanan</button>
      <div class="card-header-action">                                       
      </div>                          
    </div>
        <div class="card-body border col-lg-6">
        <h6 style="color:red">Untuk sementara gunakan metode pembayaran bank Mandiri !</h6>
          <div class="form-group">
            <label>No.Pesanan</label>
           	<input type="text" id="np" style="" class="form-control" name="np" value="<?php echo $data['no_pesanan'] ?>" readonly>
          </div>
          <div class="form-group">
            <label>Nama Pemesan</label>
            <input type="text" class="form-control" value="<?php echo $nama ?>" readonly>
          </div>
          <div class="form-group">
            <label>Jumlah Tiket</label>
            <input type="number" class="form-control" value="<?php echo $data['jumlah_tiket'] ?>" readonly>
          </div>
          <div class="form-group">
            <label>Total Pembayaran</label>
            <input type="number" class="form-control" value="<?php echo $data['total_harga'] ?>" readonly>
          </div>
          <!-- <div class="form-group">
            <label>Ke Bank</label>
            <select class="form-control" name="ke_bank" required="">
              <option></option>
              <option value="mandiri">Mandiri | 1640015484692 | Cahaya Enterprise</option>
              <option value="bca">BCA | 2373036755 | Cahaya Enterprise</option>
            </select>
          </div>
          <div class="form-group">
            <label>Nominal Yang Ditransfer</label>
           	<input type="text" id="tf" class="form-control" name="nominal" value="" readonly>
          </div>
          <div class="form-group">
            <label>Foto/Screenshot Bukti Transfer</label>
            <div class="custom-file">
                <input type="file" id="inputFile" name="file" class="imgFile custom-file-input" aria-describedby="inputGroupFileAddon01" required="">
                <label class="custom-file-label" for="inputFile">Pilih Gambar</label>
            </div>
            <div class="card-body border col-lg-12">
             <div class="imgWrap">
                <img src="stisla/assets/img/camera.png" id="imgView" class="card-img-top img-fluid">
             </div>
            </div>
          </div>--><hr>
        <div class="card-footer text-right">
          <button id="pay-button" type="submit" class="btn btn-primary">Konfirmasi</button>
        </div>
      </div>
    
  </div>
</div>
<script type="text/javascript">
// $("#inputFile").change(function(event) {  
//   fadeInAdd();
//   getURL(this);    
// });
// $("#inputFile").on('click',function(event){
//   fadeInAdd();
// });
// function getURL(input) {    
//   if (input.files && input.files[0]) {   
//     var reader = new FileReader();
//     var filename = $("#inputFile").val();
//     filename = filename.substring(filename.lastIndexOf('\\')+1);
//     reader.onload = function(e) {
//       debugger;      
//       $('#imgView').attr('src', e.target.result);
//       $('#imgView').hide();
//       $('#imgView').fadeIn(500);      
//       $('.custom-file-label').text(filename);             
//     }
//     reader.readAsDataURL(input.files[0]);    
//   }
//   $(".alert").removeClass("loadAnimate").hide();
//   }
//   function fadeInAdd(){
//     fadeInAlert();  
// }
// function fadeInAlert(text){
//   $(".alert").text(text).addClass("loadAnimate");  
// }
function sweetAlert(){
Swal.fire({
  title: 'Pesanan Akan Dibatalkan ?',
  showCancelButton: true,
  confirmButtonColor: 'red',
  cancelButtonColor: 'green',
  confirmButtonText: 'Ya, Batalkan'
}).then((result) => {
  if (result.value) {
    window.location.href='hakUser/proses/prosesHapusPesanan.php?np=<?php echo base64_encode($np) ?>';
  }
})
}
</script>
<script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      // For example trigger on button clicked, or any time you need
      payButton.addEventListener('click', function () {
        snap.pay('<?php echo $snapToken ?>', {
          onPending: function(result){
            window.location.href = "status.php?np=<?php echo $np ?>";
          }
        }); // Replace it with your transaction token
      });
    </script>
