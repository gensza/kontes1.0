<?php
error_reporting(0);
session_start();
if(@$_SESSION['admin']){
  $sesi = $_SESSION['admin'];
}else if(@$_SESSION['korlap']){
  $sesi = $_SESSION['korlap'];
}
  include "../../koneksi.php";
  $date = date_default_timezone_set('Asia/Jakarta');
  $date = date('Y-m-d H:i:s');
  $sql = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_user = '$sesi' AND status_trx = '1'");
  $nt = mysqli_num_rows($sql);
  $ntrx = mysqli_fetch_array($sql);
  $query = mysqli_query($koneksi,"SELECT COUNT(*) AS np FROM data_pesanandetail WHERE id_user = '$sesi' AND status_trx = '1'");
    while($data = mysqli_fetch_array($query)){
    $np = $data['np'];
  }
  $trx = $ntrx['no_pesanan'];
  ?>
  <div>
    <table class="table table-sm table-striped border" border="1">
      <thead>
        <tr>
          <th id="tsm">No</th>
          <th>Kelas&nbsp;Lomba</th>
          <th width="10%">No&nbsp;Gant</th>
          <th>Price</th>
          <th>Aksi</th>
        </tr>
        <tbody id="tb">
          <?php
            $no = 1;
            $total = 0;
            $result = mysqli_query($koneksi,"SELECT jadwal_kontes.jenis_burung, data_pesanandetail.no_gantungan, jadwal_kontes.harga, data_pesanandetail.id_pesanandetail, data_pesanandetail.id_jadwalkontes, jadwal_kontes.sesi FROM data_pesanandetail INNER JOIN jadwal_kontes on data_pesanandetail.id_jadwalkontes = jadwal_kontes.id_jadwalkontes WHERE id_user = '$sesi' AND status_trx = '1' AND status = '1'");
            while ($data = mysqli_fetch_array($result)){
              ?> 
              <tr>
                <td id="tsm"><?php echo $no++ ?></td>
                <td><?php echo $data['jenis_burung'].'&nbsp'.$data['sesi']; ?></td>
                <td id="tsm"><?php echo $data['no_gantungan']; ?></td>
                <td><?php echo $data['harga']; ?></td>
                <td>
                  <form id="formTampil" method="POST">
                  <input type="text" hidden="" name="id" value="<?php echo $data['id_pesanandetail'] ?>">
                  <input type="text" hidden="" name="id_jadwal" value="<?php echo $data['id_jadwalkontes'] ?>">
                  <button id="hapus" type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                  </form>
                </td>
              </tr>
              <?php
              $total += $data['harga'];
            }
           ?>   
        </tbody>
      </thead>
    </table>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="text-right">
            <p>Invoice <b><?php echo $trx ?></b></p>
          </div>
          <div class="text-right">
            <h1><b>Rp. <?php echo number_format($total,0,',','.') ?></b></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="row" style="float: right;">
            <button class="btn btn-danger" id="cancel" value="<?php echo $trx ?>"><i class="fas fa-redo-alt"></i> cancel</button>&emsp;
            <form id="formSave" method="POST">
              <input type="text" hidden="" name="nt" value="<?php echo $trx ?>">
              <input type="text" hidden="" name="totalHarga" value="<?php echo $total ?>">
              <input type="text" hidden="" name="date" value="<?php echo $date ?>">
              <input type="text" hidden="" name="jumlahTiket" value="<?php echo $np ?>">
              <input type="text" hidden="" name="sesi" value="<?php echo $sesi ?>">
                <?php 
                  if($nt > 0){
                    ?>
                    <button class="btn btn-primary" id="saveTransaksi" onclick="window.open('transaksi/transaksiTiket/cetakStruk.php?np=<?php echo $trx ?>','mywindow','width=350px , height=450px')"><i class="fas fa-paper-plane"></i> Save Transaksi</button>
                    <?php
                  }else{
                  }
                ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>