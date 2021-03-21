<div class="card-header border" id="ch">
  <h4><i class="fas fa-trophy"></i> Pemenang Kontes</h4>
  <div class="card-header-action">                                       
  </div>                          
</div><br>
  <table id="example" class="display nowrap" style="width:100%">
    <thead>
      <tr>
        <th id="th1">No</th>
        <th id="th1">Jenis Burung</th>
        <th id="th1">Sesi</th>
        <th id="th1">Jumlah Peserta</th>
        <th id="th1">Info Pemenang</th>
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
              <a href='#modalDetailPemenang' id='custId' data-toggle='modal' data-id="<?php echo $row['id_jadwalkontes'] ?>"><button class="btn btn-warning">Detail</button></a>
          </td>
        </tr>
        <?php } ?>
    </tbody>
  </table>