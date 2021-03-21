<?php 
  $id = base64_decode($_GET['id']);
  $st = base64_decode($_GET['st']);
  $result = mysqli_query($koneksi,"SELECT * FROM jadwal_kontes WHERE id_jadwalkontes = '$id'");
  $data = mysqli_fetch_array($result);
?>
<form method="POST" action="hakUser/proses/prosesPesantiket.php" class="needs-validation">
<div class="card-header border" id="ch">
  <h4>Info Tiket</h4>
</div>
<div class="card-body border">
  <div class="table-responsive">
    <table class="table table-sm">
      <thead1>
        <tr id="tr1">
          <th id="th2">Kelas Kontes</th>
          <th id="th2">: &emsp;&emsp; <?php echo $data['jenis_burung']; ?></th>
        </tr>
        <tr id="tr1">
          <th id="th2">Sesi</th>
          <th id="th2">: &emsp;&emsp; <?php echo $data['sesi']; ?>&emsp;<i id="tr">(Tersisa <?php echo $st; ?> Tiket)</i></th>
        </tr>
        <tr id="tr1">
          <th id="th2">Harga Tiket</th>
          <th id="th2">: &emsp;&emsp; <?php echo number_format($data['harga'],0,',','.'); ?></th>
        </tr>
        <tr id="tr1">
          <th id="th2">Jumlah Tiket</th>
          <th id="th2">: &emsp;&emsp;
            <select id="bil2" required>
              <option></option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
            <i id="tr">&emsp;pilih jumlah pembelian tiket !</i>
          </th>
        </tr>
      </thead1>
    </table>
  </div>
</div>                         
<div class="card-header border" id="ch">
  <h4>Detail Harga</h4>
</div>
<div class="card-body border">
  <div class="table-responsive">
    <table class="table table-sm">
      <thead1>
        <tr id="tr1">
          <th id="th2">Harga Tiket</th>
          <th id="th2">: &emsp;&emsp; <input type="text" id="bil1" readonly="" value="<?php echo $data['harga'];?>"></th>
        </tr>
         <tr id="tr1">
          <th id="th2">Jumlah Tiket</th>
          <input type="text" hidden="" id="id" name="id" value="<?php echo $id ?>">
          <input type="text" hidden="" id="st" name="st" value="<?php echo $st ?>">
          <th id="th2">: &emsp;&emsp; <input type="text" id="hasil" name="jt" readonly=""> </th>
        </tr>
        <tr id="tr1">
          <th id="th2">Total Harga</th>
          <th id="th2">: &nbsp;Rp.&nbsp;  <input type="text" name="th" id="total" readonly=""></th>
        </tr>
      </thead1>
    </table>
  </div>
</div>
<div class="card-header border" id="ch">
  <h4>Ketentuan Pembayaran</h4>
</div>
<div class="card-body border">
  <div class="table-responsive">
    <table class="table table-sm">
      <thead1>
        <tr id="tr1">
          <th id="tr">Pembayaran dapat dilakukan setelah pesan tiket dengan batas waktu 1 jam</th>
        </tr>
         <tr id="tr1">
          <th id="tr">Harga dan no.gantungan sewaktu-waktu dapat berubah</th>
        </tr>
      </thead1>
    </table>
    <input type="checkbox" name="" required=""> Dengan ini saya menyetujui dan mematuhi persyaratan serta ketentuan pembayaran dari Cahaya Enterprise.
  </div>
</div><br>
    <button type="submit" id="btn" class="btn btn-primary">LANJUTKAN</button>
</form><br>
<script>
$(window).load(function(){
$("#bil2").change(function() {
var tes = document.getElementById("bil2").value;
var id = document.getElementById("id").value;
var st = document.getElementById("st").value;
    if ($("#bil2 option:selected").val() == '2') {
        if(2 > st){
          Swal.fire({
          allowOutsideClick: false,
          title: 'Hanya '+st+' Tiket Yang Tersedia !',
          confirmButtonText: 'OKE'
        }).then(function(){
          location.reload(true);
          });
        }
    } if ($("#bil2 option:selected").val() == '3') {
        if(3 > st){
          Swal.fire({
          allowOutsideClick: false,
          title: 'Hanya '+st+ ' Tiket Yang Tersedia !',
          confirmButtonText: 'OKE'
        }).then(function(){
          location.reload(true);
          });
        }
    }
    document.getElementById("hasil").value=tes;

    var bil1 = parseInt($("#bil1").val());
    var bil2 = parseInt($("#hasil").val());

      var total = bil1 * bil2;
      $("#total").attr("value",total);
  });
}); 
</script>