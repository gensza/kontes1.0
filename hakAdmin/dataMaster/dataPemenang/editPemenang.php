<?php
$id = base64_decode($_GET['id']);
$sql = mysqli_query($koneksi,"SELECT * FROM jadwal_kontes WHERE id_jadwalkontes = '$id'");
$row = mysqli_fetch_array($sql);
?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Data Pemenang</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data</a></div>
        <div class="breadcrumb-item"><a href="#">Edit Data Pemenang</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <div class="section-body">
            <div class="card-body col-lg-7">
              <h4 id="tc"><b><?php echo $row['jenis_burung']; ?>  <?php echo $row['sesi']; ?></b></h4>
              <div class="text-right" id="bt">
                <button onclick="sweetAlert()" class="badge badge-danger">Hapus</button>
              </div>
              <form method="POST" action="dataMaster/dataPemenang/proses/prosesEdit.php">
                <div class="table-responsive">
                  <table class="table table-sm border" border="1" id="tsm">
                    <thead>
                      <tr>
                        <th id="th1">Juara</th>
                        <th id="th1">No Gant</th>
                        <th id="th1">Point</th>
                        <th id="th1">Hadiah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($koneksi,"SELECT penilaian_kontes.id_penilaian, data_pesanandetail.no_gantungan, penilaian_kontes.point, penilaian_kontes.hadiah FROM penilaian_kontes INNER JOIN data_pesanandetail ON penilaian_kontes.id_pesanandetail = data_pesanandetail.id_pesanandetail WHERE data_pesanandetail.id_jadwalkontes = '$id'");
                      $no = 1;
                        while ($dp = mysqli_fetch_array($query)){              
                        ?>
                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td>
                            <input type="text" hidden="" name="id" value="<?php echo $id ?>">
                            <input type="text" hidden="" name="iddp[]" value="<?php echo $dp['id_penilaian'] ?>">
                            <select id="opt1" name="opt[]" required> 
                              <option><?php echo $dp['no_gantungan']; ?></option> 
                              <option></option>
                                <?php
                                $result = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$id' AND status = '1'");
                                while ($data = mysqli_fetch_array($result)){
                                ?>
                                  <option><?php echo $data['no_gantungan']; ?></option>
                                <?php } ?>
                            </select>
                          </td>
                          <td><input type="number" id="point1" name="point[]" value="<?php echo $dp['point'] ?>" required></td>
                          <td>Rp. <input type="number" id="itt1" name="itt[]" value="<?php echo $dp['hadiah'] ?>" required></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
function sweetAlert(){
Swal.fire({
  title: 'Hapus Data Pemenang ?',
  showCancelButton: true,
  confirmButtonColor: 'red',
  cancelButtonColor: 'green',
  confirmButtonText: 'Ya, Hapus'
}).then((result) => {
  if (result.value) {
    window.location.href='dataMaster/dataPemenang/proses/prosesHapus.php?id=<?php echo base64_encode($id) ?>';
  }
})
}
</script>