<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Jadwal Kontes</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Jadwal Kontes</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="col-lg-12"><br>
         <button type="button" id="bt" title="tambah jadwal" data-target="#modal-tambahJadwal" role="button" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i></button>&nbsp;
         <a href="../cetakJadwal.php" target="_Blank" id="bt" title="cetak jadwal" class="btn btn-danger"><i class="fa fa-print"></i></a>
            <table id="example" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th id="th1">No</th>
                  <th id="th1">Jenis&nbsp;Burung</th>
                  <th id="th1">Sesi</th>
                  <th id="th1">Harga&nbsp;Tiket</th>
                  <th id="th1">Jumlah&nbsp;Tiket</th>
                  <th id="th1">Stok&nbsp;Tiket</th>
                  <th id="th1">Start</th> 
                  <th id="th1">Aksi</th>
                </tr> 
              </thead>
              <tbody>
                <?php
                $no = 1; 
                $result = mysqli_query($koneksi,"SELECT jadwal_kontes.id_jadwalkontes, jadwal_kontes.jenis_burung, jadwal_kontes.sesi, jadwal_kontes.harga,kelas_kontes.jumlah_tiket, kelas_kontes.stok_tiket, jadwal_kontes.waktu FROM jadwal_kontes INNER JOIN kelas_kontes ON jadwal_kontes.id_jadwalkontes = kelas_kontes.id_jadwalkontes");
                while ($row = mysqli_fetch_array($result)) {
                  $id = $row['id_jadwalkontes'];
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['jenis_burung']; ?></td>
                    <td><?php echo $row['sesi']; ?></td>
                    <td>Rp.<?php echo $row['harga']; ?></td>
                    <td><?php echo $row['jumlah_tiket']; ?></td>
                    <td><?php echo $row['stok_tiket']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td>
                      <a href="?page=editJadwal&id=<?php echo base64_encode($id) ?>" class="btn btn-warning btn-sm" title="edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                      <button onclick="Swal.fire({
                          title: 'Hapus Jadwal Lomba ?',
                          showCancelButton: true,
                          confirmButtonColor: 'red',
                          cancelButtonColor: 'green',
                          confirmButtonText: 'Ya, Hapus'
                      }).then((result) => {
                          if (result.value) {
                            window.location.href='jadwalLomba/proses/prosesHapus.php?id=<?php echo base64_encode($id) ?>';
                          }
                      })" class="btn btn-danger btn-sm" title="hapus"><i class="fas fa-trash-alt"></i></button>
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


