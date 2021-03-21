<link rel="stylesheet" type="text/css" href="../css/style1.css">
<?php
include "../../koneksi.php";
if($_POST['rowid']) {
  $np = $_POST['rowid'];
  $result = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE no_pesanan = '$np'");
  $data = mysqli_fetch_array($result);
?>
<div >
  <table class="table table-sm table-striped border" id="tsm" border="1">
    <thead>
      <tr>
        <th>No</th>
        <th>Kelas Kontes</th>
        <th>No Gant</th>
        <th>Nama Pemilik</th>
        <th>Nama Burung</th>
        <th>Alamat</th>
      </tr>
  	</thead>
  	<tbody>
      <?php
      $no = 1; 
      $result = mysqli_query($koneksi,"SELECT jadwal_kontes.jenis_burung, jadwal_kontes.sesi, data_pesanandetail.no_gantungan, data_pesanandetail.nama_pemilik, data_pesanandetail.nama_burung, data_pesanandetail.alamat FROM data_pesanandetail INNER JOIN jadwal_kontes on data_pesanandetail.id_jadwalkontes = jadwal_kontes.id_jadwalkontes WHERE no_pesanan = '$np'");
      while ($row = mysqli_fetch_array($result)) {
      	?>
      	<tr>
        	<td id="tsm"><?php echo $no++; ?></td>
        	<td><?php echo $row['jenis_burung']." ".$row['sesi']; ?></td>
        	<td id="tsm"><?php echo $row['no_gantungan']; ?></td>
        	<td><?php echo $row['nama_pemilik']; ?></td>
        	<td><?php echo $row['nama_burung']; ?></td>
        	<td><?php echo $row['alamat']; ?></td>
        <?php
      	}
      ?>
    </tbody>
  </table>
</div>
<?php } ?>