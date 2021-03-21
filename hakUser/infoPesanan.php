<?php
  include 'status1.php';
  $waktu = date_default_timezone_set('Asia/Jakarta'); 
  $waktu = date('Y-m-d H:i:s');
  // var_dump($data);
  // var_dump($np);
//   if($data = 'pending'){
//     $query = mysqli_query($koneksi,"UPDATE data_pesanan SET status_pesanan = 'Pending' WHERE no_pesanan = '$np'");
//         if($query){
//       $result = mysqli_query($koneksi,"INSERT INTO data_pembayaran VALUES(null,'$np','test','1111','test','test','10000','$waktu','test')");
//   }else{
//     echo "gagal";
//   }
// }
?>
<!--<div class="card-body">-->
    <!-- <div class="row" id="mt">
      <div class="col-lg-2"></div>
      <div class="col-lg-4">
        <img class="img-fluid" src="stisla/assets/img/mandiri.png" alt="" style="width:100%;">
        <div>
        <p>No Rekening &nbsp; : &nbsp; 1640015484692<br>Atas Nama &nbsp;&emsp;: &nbsp; Cahaya Enterprise</p>
        </div>
      </div>
      <div class="col-lg-4">
        <img class="img-fluid" src="stisla/assets/img/bca.png" alt="" style="width:100%;">
        <div class="offer_text">
          <p>No Rekening &nbsp; : &nbsp; 2373036755<br>Atas Nama &emsp; : &nbsp; Cahaya Enterprise</p>
        </div>
      </div>
    </div><hr> --><br>
     <h4><b>Note !</b></h4>
     <h6><p id="lh">> Setelah berhasil melakukan pemesanan tiket, klik opsi konfirmasi untuk melakukan pembayaran.</p>
      <p id="lh">> Silahkan transfer menggunakan metode pembayaran yang telah disediakan</p>
      <p id="lh">> pembayaran akan di cek otomatis oleh sistem</p> 
      <p id="lh">> Apabila dalam waktu 1 jam anda tidak melakukan transfer, maka pesanan anda akan otomatis dibatalkan oleh sistem.</p></h6>
<!--</div>-->
<div class="card-header border" id="ch">
  <h4><i class="fas fa-cart-plus"></i> Pesanan Saya</h4>
  <div class="card-header-action"></div>                          
</div><br>
    <table id="example" class="display nowrap" style="width:100%">
      <thead>
        <tr>
          <th id="th1">No</th>
          <th id="th1">No.Pesanan</th>
          <th id="th1">Pemesan</th>
          <th id="th1">Jumlah&nbsp;Tiket</th> 
          <th id="th1">Total&nbsp;Harga</th>
          <th id="th1">Tgl&nbsp;Pesan</th>
          <th id="th1">Expired</th>
          <th id="th1">Status</th>
          <th id="th1">Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        error_reporting(0);
        $result = mysqli_query($koneksi,"SELECT data_pesanan.no_pesanan, user.nama_user, data_pesanan.jumlah_tiket, data_pesanan.total_harga, data_pesanan.tgl_pesan, data_pesanan.expired, data_pesanan.status_pesanan FROM data_pesanan INNER JOIN user ON data_pesanan.id_user = user.id_user WHERE data_pesanan.id_user = '$sesi' ORDER BY tgl_pesan DESC");
          while ($row = mysqli_fetch_array($result)) {
            $np = $row['no_pesanan'];
            $jumlah_tiket = $row['jumlah_tiket'];
            $cariJadwal = $koneksi->query("SELECT * FROM data_pesanandetail WHERE no_pesanan = '$np'");
            $cari = mysqli_fetch_array($cariJadwal);
            $id = $cari['id_jadwalkontes'];
            if($row['status_pesanan']== 'Belum Bayar' AND $waktu > $row['expired']){
              mysqli_query($koneksi,"UPDATE data_pesanan SET jumlah_tiket = '0', total_harga = '0', status_pesanan = 'Expired' WHERE no_pesanan ='$np'");
              mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket+$jumlah_tiket) WHERE id_jadwalkontes = '$id'");
              $result = mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '0', nama_pemilik = '', nama_burung = '', alamat = '', no_pesanan = '', status = '0' WHERE no_pesanan = '$np'");
              echo "<script> 
                      location.reload();
                    </script>";
            }
          ?>
          <tr>
          	<td><?php echo $no++; ?></td>
          	<td><?php echo $row['no_pesanan']?></td>
          	<td><?php echo $row['nama_user'] ?></td>
            <td><?php echo $row['jumlah_tiket'] ?> Tiket
              <br><a href='#modalDetailTiket' id='custId' data-toggle='modal' data-id="<?php echo $row['no_pesanan'] ?>"><button>Detail</button></a>
            </td>
            <td>Rp. <?php echo number_format($row['total_harga'],0,',','.'); ?></td>
            <td><?php echo $row['tgl_pesan']; ?></td>
            <td><?php echo $row['expired']; ?></td>
            <td><?php echo $row['status_pesanan']; ?></td>
            <td>
              <?php 
                if($row['status_pesanan']== 'Belum Bayar'){
                  ?><a href="?page=konfirmasiBayar&np=<?php echo base64_encode($row['no_pesanan'])?>&nama=<?php echo $row['nama_user']?>" class="badge badge-primary">Konfirmasi</a><?php
                }else if($row['status_pesanan']== 'Pending'){
                  ?><a href="?page=konfirmasiBayarPending&np=<?php echo base64_encode($row['no_pesanan'])?>" class="badge badge-warning">Pending</a><?php
                }else if($row['status_pesanan']== 'Lunas'){
                  ?><button onclick="window.open('hakAdmin/transaksi/transaksiTiket/cetakStruk.php?np=<?php echo $row['no_pesanan'] ?>','mywindow','width=350px , height=450px')" class="badge badge-success">Cetak</button><?php
                }else if($row['status_pesanan']== 'Expired'){
                }
               ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>