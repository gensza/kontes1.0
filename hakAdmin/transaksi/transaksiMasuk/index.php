<?php
$waktu = date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('Y-m-d H:i:s');
$no = 1;
error_reporting(0);
$cekExp = mysqli_query($koneksi,"SELECT data_pesanan.no_pesanan, user.nama_user, data_pesanan.jumlah_tiket, data_pesanan.total_harga, data_pesanan.tgl_pesan, data_pesanan.expired, data_pesanan.status_pesanan FROM data_pesanan INNER JOIN user ON data_pesanan.id_user = user.id_user WHERE data_pesanan.status_pesanan = 'Belum Bayar' ORDER BY tgl_pesan DESC");
  while ($expCek = mysqli_fetch_array($cekExp)) {
    $np = $expCek['no_pesanan'];
    $jumlah_tiket = $expCek['jumlah_tiket'];
    $cariJadwal = $koneksi->query("SELECT * FROM data_pesanandetail WHERE no_pesanan = '$np'");
    $cari = mysqli_fetch_array($cariJadwal);
    $id = $cari['id_jadwalkontes'];
    if($expCek['status_pesanan']== 'Belum Bayar' AND $waktu > $expCek['expired']){
      mysqli_query($koneksi,"UPDATE data_pesanan SET jumlah_tiket = '0', total_harga = '0', status_pesanan = 'Expired' WHERE no_pesanan ='$np'");
      mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket+$jumlah_tiket) WHERE id_jadwalkontes = '$id'");
      $result = mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '0', nama_pemilik = '', nama_burung = '', alamat = '', no_pesanan = '', status = '0' WHERE no_pesanan = '$np'");
      echo "<script> 
              location.reload();
            </script>";
    }
  }
?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Transaksi Masuk</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
        <div class="breadcrumb-item"><a href="#">Transaksi Masuk</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="col-lg-12"><br>
            <table id="example" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th id="th1">No</th>
                  <th id="th1">No Pesanan</th>
                  <th id="th1">Pemesan</th>
                  <th id="th1">Jumlah Tiket</th> 
                  <th id="th1">Total Harga</th>
                  <th id="th1">Tanggal Pesan</th>
                  <th id="th1">Status</th>
                  <th id="th1">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $result = mysqli_query($koneksi,"SELECT data_pesanan.no_pesanan, user.nama_user, data_pesanan.jumlah_tiket, data_pesanan.total_harga, data_pesanan.tgl_pesan, data_pesanan.status_pesanan FROM data_pesanan INNER JOIN user ON data_pesanan.id_user =  user.id_user WHERE status_pesanan = 'Belum Bayar' ORDER BY tgl_pesan DESC");
                  while ($row = mysqli_fetch_array($result)) {
                    $np = $row['no_pesanan'];
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['no_pesanan']?></td>
                    <td><?php echo $row['nama_user'] ?></td>
                    <td><?php echo $row['jumlah_tiket'] ?> Tiket
                      <br><a href='#modalDetailTiket' id='custId' data-toggle='modal' data-id="<?php echo $row['no_pesanan'] ?>"><button>Detail</button></a>
                    </td>
                    <td>Rp. <?php echo $row['total_harga']; ?></td>
                    <td><?php echo $row['tgl_pesan']; ?></td>
                    <td><?php echo $row['status_pesanan']; ?></td>
                    <td>
                      <button onclick="Swal.fire({
                          title: 'Pesanan <?php echo $np ?> Akan Dibatalkan ?',
                          showCancelButton: true,
                          confirmButtonColor: 'red',
                          cancelButtonColor: 'green',
                          confirmButtonText: 'Ya, Batalkan'
                      }).then((result) => {
                          if (result.value) {
                            window.location.href='transaksi/transaksiMasuk/proses/prosesCancelTransaksi.php?np=<?php echo base64_encode($np) ?>';
                          }
                      })" class="badge badge-danger">Batalkan</button>
                    </td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </section>
</div>
</body>
</html>
