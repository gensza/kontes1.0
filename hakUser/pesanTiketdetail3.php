<?php 
  $id = base64_decode($_GET['id']);
  $jt = base64_decode($_GET['jt']);
  $result = mysqli_query($koneksi,"SELECT * FROM jadwal_kontes WHERE id_jadwalkontes = '$id'");
  $query = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user = '$sesi'");
  $user = mysqli_fetch_array($query);
  $data = mysqli_fetch_array($result);
  $date = date_default_timezone_set('Asia/Jakarta');
  $date = date('Y-m-d H:i:s');
  $kd = '1234567890QWERTYUIOPLKJHGFDSAZXCVBNM';
  $string = 'NP';
  for ($i=0;$i<10;$i++){
    $pos = rand(0, strlen($kd)-1);
    $string .=$kd{$pos};
  }
?>
<form method="POST" action="hakUser/proses/prosesPesantiketdetail.php">
<div class="card-header border" id="ch">
  <h4>Detail Pesanan</h4>
</div>
<div class="card-body border">
  <div class="table-responsive">
    <table class="table table-sm">
      <thead1>
        <tr id="tr1">
          <th id="th2">Kode Pesanan</th>
          <input type="text" hidden="" name="id" value="<?php echo $id ?>">
          <input type="text" hidden="" name="id_user" value="<?php echo $user['id_user'] ?>">
          <input type="text" hidden="" name="date" value="<?php echo $date ?>">
          <input type="text" hidden="" name="st" value="<?php echo $st ?>">
          <th id="th2">: &emsp;&emsp; <input type="text" id="bil1" readonly="" name="kode" value="<?php echo $string ?>"></th>
        </tr>
        <tr id="tr1">
          <th id="th2">Nama Pemesan</th>
          <th id="th2">: &emsp;&emsp; <input type="text" id="bil1" readonly="" name="nama" value="<?php echo $user['nama_user'];?>"></th>
        </tr>
        <tr id="tr1">
          <th id="th2">No.Telepon</th>
          <th id="th2">: &emsp;&emsp; <input type="text" id="bil1" readonly="" name="telepon" value="<?php echo $user['no_telepon'];?>"></th>
        </tr>
        <tr id="tr1">
          <th id="th2">Kelas Kontes</th>
          <th id="th2">: &emsp;&emsp; <input type="text" id="bil1" readonly="" name="kelas" value="<?php echo $data['jenis_burung'];?> <?php echo $data['sesi'] ?>"></th>
        </tr>
        <tr id="tr1">
          <th id="th2">Jumlah Tiket</th>
          <th id="th2">: &emsp;&emsp; <input type="text" id="jml" readonly="" name="jumlah" value="<?php echo $jt;?>"></th>
          <input type="text" hidden="" id="hrg" value="<?php echo $data['harga'] ?>">
        </tr>
        <tr id="tr1">
          <th id="th2">Total Harga</th>
          <th id="th2">: &nbsp;Rp.&nbsp;  <input type="text" id="total" readonly="" name="total"></th>
        </tr>
      </thead1>
    </table>
  </div>
</div>   
<div class="card-header border" id="ch">
  <h4>Data Pemesan</h4>
</div>
<div class="card-body border">
  <div class="table-responsive">
    <table class="table table-sm" id="tsm" border="1">
      <tr>
        <th id="th2">No</th>
        <th id="th2">No.gantungan</th>
        <th id="th2">Nama Pemilik</th>
        <th id="th2">Nama Burung</th>
        <th id="th2">Alamat</th>
      </tr>
    <tbody>
      <tr id="div1">
        <td><b>1</b></td>
        <td> <select id="opt1" name="opt1" required="">
                    <option></option>
                <?php
                $db_detail = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$id' AND status ='0' ORDER BY no_gantungan ASC");
                while($g = mysqli_fetch_array($db_detail)){
                    ?><option><?php echo $g['no_gantungan'] ?></option><?php
                  }
                 ?>
              </select></td>
        <td><input type="text" id="form1" name="nama1" readonly="" value="<?php echo $user['nama_user'] ?>"></td>
        <td><input type="text" id="form1" name="burung1" readonly="" value="<?php echo $user['nama_burung'] ?>"></td>
        <td><input type="text" id="form1" name="alamat1" readonly="" value="<?php echo $user['alamat'] ?>"></td>
      </tr>
      <tr id="div2">
        <td><b>2</b></td>
        <td> <select id="opt2" name="opt2" required="">
                    <option></option>
               <?php
                $db_detail = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$id' AND status ='0' ORDER BY no_gantungan ASC");
                while($g = mysqli_fetch_array($db_detail)){
                    ?><option><?php echo $g['no_gantungan'] ?></option><?php
                  }
                 ?>
              </select></td>
        <td><input type="text" id="form2" name="nama2" required=""></td>
        <td><input type="text" id="form2" name="burung2" required=""></td>
        <td><input type="text" id="form2" name="alamat2" required=""></td>
      </tr>
      <tr id="div3">
        <td><b>3</b></td>
        <td> <select id="opt3" name="opt3" required="">
                    <option></option>
               <?php
                $db_detail = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$id' AND status ='0' ORDER BY no_gantungan ASC");
                while($g = mysqli_fetch_array($db_detail)){
                    ?><option><?php echo $g['no_gantungan'] ?></option><?php
                  }
                 ?>
              </select></td>
        <td><input type="text" id="form1" name="nama3" required=""></td>
        <td><input type="text" id="form1" name="burung3" required=""></td>
        <td><input type="text" id="form1" name="alamat3" required=""></td>
      </tr>
    </tbody>
    </table>
  </div>
</div><br>
<button type="submit" id="btn" class="btn btn-primary" value="LANJUTKAN">PESAN</button>
</form><br>
<input type="text" hidden="" id="jt" name="" value="<?php echo $jt ?>">
<script>
var bil1 = parseInt($("#jml").val());
var bil2 = parseInt($("#hrg").val());
  var total = bil1 * bil2;
  $("#total").attr("value",total);
$(window).load(function(){
$("#opt1").change(function() {
var opt1 = document.getElementById("opt1").value;
var opt2 = document.getElementById("opt2").value;
var opt3 = document.getElementById("opt3").value;                                    
  if(opt1 == opt2){
        Swal.fire({
          allowOutsideClick: false,
          title: 'Gantungan Tidak Boleh Sama !',
          confirmButtonText: 'OKE'
        }).then(function(){
          document.getElementById("opt1").value=0;
          });
    }else if(opt1 == opt3){
      Swal.fire({
          allowOutsideClick: false,
          title: 'Gantungan Tidak Boleh Sama !',
          confirmButtonText: 'OKE'
        }).then(function(){
          document.getElementById("opt1").value=0;
          });
    }
    });
  });
$(window).load(function(){
$("#opt2").change(function() {
var opt1 = document.getElementById("opt1").value;
var opt2 = document.getElementById("opt2").value;
var opt3 = document.getElementById("opt3").value;
  if(opt2 == opt1){
    Swal.fire({
          allowOutsideClick: false,
          title: 'Gantungan Tidak Boleh Sama !',
          confirmButtonText: 'OKE'
        }).then(function(){
          document.getElementById("opt2").value=0;
          });
  }else if(opt2 == opt3){
    Swal.fire({
          allowOutsideClick: false,
          title: 'Gantungan Tidak Boleh Sama !',
          confirmButtonText: 'OKE'
        }).then(function(){
          document.getElementById("opt2").value=0;
          });
  }
  });
});
$(window).load(function(){
$("#opt3").change(function() {
var opt1 = document.getElementById("opt1").value;
var opt2 = document.getElementById("opt2").value;
var opt3 = document.getElementById("opt3").value;
  if(opt3 == opt2){
    Swal.fire({
          allowOutsideClick: false,
          title: 'Gantungan Tidak Boleh Sama !',
          confirmButtonText: 'OKE'
        }).then(function(){
          document.getElementById("opt3").value=0;
          });
  }else if(opt3 == opt1){
    Swal.fire({
          allowOutsideClick: false,
          title: 'Gantungan Tidak Boleh Sama !',
          confirmButtonText: 'OKE'
        }).then(function(){
          document.getElementById("opt3").value=0;
          });
  }
  });
});
</script>