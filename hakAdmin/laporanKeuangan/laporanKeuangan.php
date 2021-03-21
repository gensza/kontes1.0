<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan Keuangan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Laporan Keuangan</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>
	<div class="section-body">
      <div class="card">
        <div class="col-lg-12"><br>
        <a href="../cetakPDF.php" target="_Blank" id="bt" title="cetak jadwal" class="btn btn-danger"><i class="fa fa-print"></i> Cetak Laporan</a>&nbsp;
        <a href="?page=kontesSelesai" id="bt" class="btn btn-success"><i class="fas fa-circle-notch"></i> Kontes Selesai ?</a>
            <table id="example" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th id="th1">No</th>
                  <th id="th1">Tanggal Laporan</th>
                  <th id="th1">Jenis Burung</th> 
                  <th id="th1">Harga Tiket</th>
                  <th id="th1">Jumlah Peserta</th>
                  <th id="th1">Pendapatan</th>
                  <th id="th1">Pengeluaran hadiah</th>
                  <th id="th1">Total Pendapatan</th>
                </tr>
              </thead>
              <tbody >
                <?php
                $no = 1;
                $result = $koneksi->query("SELECT * FROM laporan_keuangan ORDER BY tanggal_laporan DESC");
                while($data = mysqli_fetch_array($result)){
                 ?>
                 <tr>
                   <td><?php echo $no++; ?></td>
                   <td><?php echo $data['tanggal_laporan']; ?></td>
                   <td><?php echo $data['jenis_burung']; ?></td>
                   <td><?php echo $data['harga_tiket']; ?></td>
                   <td><?php echo $data['jumlah_peserta']; ?></td>
                   <td><?php echo number_format($data['hasil_penjualan'],0,',','.') ?></td>
                   <td><?php echo number_format($data['pengeluaran_hadiah'],0,',','.') ?></td>
                   <td><?php echo number_format($data['total_pendapatan'],0,',','.') ?></td>
                 </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </section>
</div>