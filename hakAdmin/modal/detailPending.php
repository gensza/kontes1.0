<?php
include "../koneksi.php";
if($_POST['rowid']) {
  $np = $_POST['rowid'];
  $result = mysqli_query($koneksi,"SELECT * FROM data_pembayaran WHERE no_pesanan = '$np'");
  $data = mysqli_fetch_array($result);
?>
<form action="" method="" enctype="multipart/form-data">
  <div class="card-body border col-lg-12">
    <div class="form-group">
      <label>No.Pesanan</label>
      <input type="text" id="tf" style="" class="form-control" name="no_pesanan" value="<?php echo $data['no_pesanan'] ?>" readonly>
    </div>
    <div class="form-group">
      <label>Dari Bank</label>
      <input type="text" id="tf" class="form-control" name="dari_bank"  value="<?php echo $data['dari_bank'] ?>" readonly>
    </div>
    <div class="form-group">
      <label>No.Rekening</label>
      <input type="number" id="tf" class="form-control" name="norek" value="<?php echo $data['norek'] ?>" readonly>
    </div>
    <div class="form-group">
      <label>Atas Nama</label>
      <input type="text" id="tf" class="form-control" name="atas_nama" value="<?php echo $data['atas_nama'] ?>" readonly>
    </div>
    <div class="form-group">
      <label>Ke Bank</label>
      <input type="text" id="tf" class="form-control" name="ke_bank" value="<?php echo $data['ke_bank'] ?>" readonly>
    </div>
    <div class="form-group">
      <label>Nominal Yang Ditransfer</label>
      <input type="text" id="tf" class="form-control" name="nominal" value="<?php echo $data['nominal'] ?>" readonly>
    </div>
    <div class="form-group">
      <label>Tanggal & Waktu Pembayaran</label>
      <input type="text" id="tf" class="form-control" name="nominal" value="<?php echo $data['tgl_pembayaran'] ?>" readonly>
    </div>
    <div class="form-group">
      <label>Foto/Screenshot Bukti Transfer</label>
      <div class="card-body border col-lg-12">
       <div class="imgWrap">
            <a href="../stisla/assets/img/buktitf/<?php echo $data['bukti_tf'] ?>"><img src="../stisla/assets/img/buktitf/<?php echo $data['bukti_tf'] ?>" id="imgView" class="card-img-top img-fluid"></a>
       </div>
      </div>
    </div>
  </div>
</form>
<?php } ?>