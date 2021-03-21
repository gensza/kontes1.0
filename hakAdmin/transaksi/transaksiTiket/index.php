<?php
  $result = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user = '$sesi'");
  $query = mysqli_query($koneksi,"SELECT * FROM user");
  $data = mysqli_fetch_array($result);
  $date = date_default_timezone_set('Asia/Jakarta');
  $date =  date('d-m-Y');
  $kd = '1234567890QWERTYUIOPLKJHGFDSAZXCVBNM';
  $string = 'NT';
  for ($i=0;$i<10;$i++){
    $pos = rand(0, strlen($kd)-1);
    $string .=$kd{$pos};
  }
?>
<script type="text/javascript">

      function loadData() {
        $.ajax({
            url: 'transaksi/transaksiTiket/tampil.php',
            type: 'get',
            success: function(data) {
                $('#tampilData').html(data);
            }
        });
      }
        $(document).ready(function() { 
            loadData();
            $("#kelas").change(function(){
            var idKelas = $("#kelas").val();
            $.ajax({
              type: "POST",
              dataType: "html",
              url: "transaksi/transaksiTiket/proses.php?aksi=cariKelas",
              data: "idKelas="+idKelas,
              success: function(msg){
                if(msg == ''){
                    Swal.fire({
                      allowOutsideClick: false,
                      title: 'Tiket Sudah Habis !',
                      confirmButtonText: 'OKE'
                    }).then(function(){
                      document.getElementById("kelas").value=0;
                      document.getElementById("nogan").value=0;
                      });
                    }else{
                    $("#nogan").html(msg);                                                     
                }
              }
            });    
          });
            $("#tambah").click(function(){
              var data = $("#form").serialize();
              $.ajax({
                type: "POST",
                url: "transaksi/transaksiTiket/proses.php?aksi=tambah",
                data: data,
                success: function() {
                  loadData();
                }
              });
            });
            $("#tampilData").on("click", "#formTampil", function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'transaksi/transaksiTiket/proses.php?aksi=hapus',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        loadData();
                    }
                });
            });
            $("#tampilData").on("click", "#cancel", function() {
                var nt = $(this).attr("value");
                $.ajax({
                    url: 'transaksi/transaksiTiket/proses.php?aksi=cancel',
                    type: 'POST',
                    data: {
                        nt: nt
                    },
                    success: function() {
                        loadData();
                    }
                });
            });
            $("#tampilData").on("click", "#formSave", function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'transaksi/transaksiTiket/proses.php?aksi=saveTransaksi',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        Swal.fire({
                          icon: 'success',
                          title: 'Pesan Tiket Berhasil !',
                          text: 'Silahkan Melakukan Pembayaran',
                          confirmButtonText: 'OKE'
                          }).then(function(){
                          location.reload();
                        });
                        loadData();
                    }
                });
            });
        })
</script>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Transaksi Tiket</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-body">
            <form method="POST" id="form">
            <div class="form-group row">
              <label>Date</label>
              <input id="l1" class="form-control form-control-sm" type="text" value="&nbsp;<?php echo $date ?>" readonly>
            </div>
            <div class="form-group row">
              <label>Admin</label>
              <input id="l2" class="form-control form-control-sm" type="text" value="&nbsp;<?php echo $data['nama_user'] ?>" readonly>
            </div>
            <div class="form-group row">
              <label>Customer</label>
              <input id="l3" class="form-control form-control-sm" type="text" name="cs" value="&nbsp;">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              <label>Kelas</label>
              <select class="form-control-sm" id="kelas" name="kelas" required="">
                <option value="">-PILIH-</option>
                  <?php 
                    $sql = mysqli_query($koneksi,"SELECT * FROM jadwal_kontes");
                    while ($kls = mysqli_fetch_array($sql)){
                      ?><option value="<?php echo $kls['id_jadwalkontes'] ?>"><?php echo $kls['jenis_burung'].'&nbsp;'.$kls['sesi']?></option><?php
                    }
                  ?>
              </select>
            </div>
            <div class="form-group row">
              <label>Gantungan</label>
              <select class="form-control-sm" id="nogan" name="nogan"></select>
            </div>
            <div class="text-right">
              <input type="text" hidden="" name="admin" value="<?php echo $sesi ?>">
              <input type="text" hidden="" name="kode" value="<?php echo $string ?>">
              <a id="tambah" type="submit" class="btn btn-primary fas fa-cart-plus"> Add</a>
                <!-- <button type="submit" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Add</button> -->
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    <div id="tampilData"></div>
  </section>
</div>