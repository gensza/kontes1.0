<div class="main-content">
<section class="section">
  <div class="section-header">
    <h1>Transaksi Batal</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
      <div class="breadcrumb-item"><a href="#">Transaksi Cancel</a></div>
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
            <th id="th1">No.Pesanan</th>
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
          $result = mysqli_query($koneksi,"SELECT data_pesanan.no_pesanan, user.nama_user, data_pesanan.jumlah_tiket, data_pesanan.total_harga, data_pesanan.tgl_pesan, data_pesanan.status_pesanan FROM data_pesanan INNER JOIN user ON data_pesanan.id_user =  user.id_user WHERE status_pesanan = 'Cancel' OR status_pesanan = 'Expired' ORDER BY tgl_pesan DESC");
            while ($row = mysqli_fetch_array($result)) {
              $np = $row['no_pesanan'];
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row['no_pesanan']?></td>
              <td><?php echo $row['nama_user'] ?></td>
              <td><?php echo $row['jumlah_tiket'] ?> Tiket</td>
              <td>Rp. <?php echo $row['total_harga']; ?></td>
              <td><?php echo $row['tgl_pesan']; ?></td>
              <td><?php echo $row['status_pesanan']; ?></td>
              <td>
                <button onclick="Swal.fire({
                          title: 'Pesanan Cancel <?php echo $np ?> Akan Dihapus ?',
                          showCancelButton: true,
                          confirmButtonColor: 'red',
                          cancelButtonColor: 'green',
                          confirmButtonText: 'Ya, Hapus'
                      }).then((result) => {
                          if (result.value) {
                            window.location.href='transaksi/transaksiCancel/proses/prosesTransaksiHapus.php?np=<?php echo base64_encode($np) ?>';
                          }
                      })" class="badge badge-danger">Hapus</button>
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