<div class="card-header border" id="ch">
  <h4><i class="fas fa-clock"></i> Jadwal Kontes & Pesan Tiket</h4>
  <div class="card-header-action">                                       
  </div>                          
</div><br>
  <table id="example" class="display nowrap" style="width:100%">
    <thead>
      <tr>
        <th id="th1">No</th>
        <th id="th1">Jenis&nbsp;Burung</th>
        <th id="th1">Sesi</th>
        <th id="th1">Harga&nbsp;Tiket</th>
        <th id="th1">Stok&nbsp;Tiket</th>
        <th id="th1">Start</th> 
        <th id="th1">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $result = mysqli_query($koneksi,"SELECT jadwal_kontes.id_jadwalkontes, jadwal_kontes.jenis_burung, jadwal_kontes.sesi, jadwal_kontes.harga, kelas_kontes.stok_tiket, jadwal_kontes.waktu FROM jadwal_kontes INNER JOIN kelas_kontes ON jadwal_kontes.id_jadwalkontes = kelas_kontes.id_jadwalkontes");
      while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $row['jenis_burung']; ?></td>
          <td><?php echo $row['sesi']; ?></td>
          <td>Rp.<?php echo $row['harga']; ?></td>
          <td><?php echo $row['stok_tiket']; ?></td>
          <td><?php echo $row['waktu']; ?></td>
          <td>
            <?php 
              if($row['stok_tiket'] == 0){
                ?><i id="tr">Tiket Sudah Habis !</i><?php
              }else{
                ?><a href="hakUser/proses/prosesValidasi.php?id=<?php echo base64_encode($row['id_jadwalkontes']) ?>&st=<?php echo base64_encode($row['stok_tiket']) ?>" class=" btn btn-primary">Pesan&nbsp;Tiket</a><?php
              }
             ?>
          </td>
        </tr>
        <?php } ?>
    </tbody>
  </table>