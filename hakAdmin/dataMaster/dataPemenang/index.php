<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Pemenang</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item"><a href="#">Data Pemenang</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>
    <div class="section-body">
      <div class="card col-lg-6">
        <div class="col-lg-12"><br>
          <table id="example" class="display nowrap" style="width:100%">
           <thead>
	        <tr>
	          <th id="th1">No</th>
	          <th id="th1">Jenis Burung</th>
	          <th id="th1">Sesi</th>
	          <th id="th1">Jumlah Peserta</th>
	          <th id="th1">Info Penilaian</th>
	        </tr>
	       </thead>
	       <tbody>
	        <?php
	        $no = 1; 
	        $result = mysqli_query($koneksi,"SELECT jadwal_kontes.id_jadwalkontes, jadwal_kontes.jenis_burung, jadwal_kontes.sesi, kelas_kontes.jumlah_tiket, kelas_kontes.stok_tiket FROM jadwal_kontes INNER JOIN kelas_kontes ON jadwal_kontes.id_jadwalkontes = kelas_kontes.id_jadwalkontes");
	        while ($row = mysqli_fetch_array($result)) {
	          ?>
	          <tr>
	            <td><?php echo $no++; ?></td>
	            <td><?php echo $row['jenis_burung']; ?></td>
	            <td><?php echo $row['sesi']; ?></td>
	            <td>
		          <?php
	              $count = $row['jumlah_tiket'] - $row['stok_tiket'];
	              echo $count; 
               	  ?>
	            </td>
	            <td>
	              <a href='#modalDetailPemenang' id='custId' data-toggle='modal' data-id="<?php echo $row['id_jadwalkontes'] ?>" class="btn btn-info btn-sm" title="detail"><i class="fas fa-info-circle"></i></a>&nbsp;
                  <a href="dataMaster/dataPemenang/proses/prosesValidasi.php?id=<?php echo base64_encode($row['id_jadwalkontes']) ?>" class="btn btn-warning btn-sm" title="input"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                  <a href="../cetakPemenang.php?id=<?php echo $row['id_jadwalkontes'] ?>" target="_Blank" title="cetak pemenang" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></a>
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