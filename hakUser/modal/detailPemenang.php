<?php 
include "../../koneksi.php";
if($_POST['rowid']) { 
$id = $_POST['rowid'];
$sql = mysqli_query($koneksi,"SELECT * FROM jadwal_kontes WHERE id_jadwalkontes = '$id'");
$row = mysqli_fetch_array($sql);
?>
  <h4 id="tc"><b><?php echo $row['jenis_burung']; ?>  <?php echo $row['sesi']; ?></b></h4>
</div>
  <table class="table table-sm table-striped border" border="1">
    <thead>
      <tr> 
        <th>Juara</th>
        <th>No Gant</th>
        <th>Point</th>
        <th>Nama Pemilik</th>
        <th>Nama Burung</th>
        <th>Alamat</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $result = mysqli_query($koneksi,"SELECT penilaian_kontes.no_juara, data_pesanandetail.no_gantungan, penilaian_kontes.point, penilaian_kontes.id_jadwalkontes, data_pesanandetail.nama_pemilik, data_pesanandetail.nama_burung, data_pesanandetail.alamat FROM penilaian_kontes INNER JOIN data_pesanandetail ON penilaian_kontes.id_pesanandetail = data_pesanandetail.id_pesanandetail WHERE penilaian_kontes.id_jadwalkontes = '$id' ORDER BY penilaian_kontes.no_juara ASC");
      while ($data = mysqli_fetch_array($result)){
        ?>
        <tr>
          <td id="tsm"><b><?php echo $data['no_juara']; ?></b></td>
          <td id="tsm"><?php echo $data['no_gantungan']; ?></td>
          <td id="tsm"><?php echo $data['point']; ?></td>
          <td><?php echo $data['nama_pemilik']; ?></td>
          <td><?php echo $data['nama_burung']; ?></td>
          <td><?php echo $data['alamat']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
  </table>
<?php } ?>