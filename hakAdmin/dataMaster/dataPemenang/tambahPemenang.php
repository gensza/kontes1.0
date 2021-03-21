<?php 
$id = base64_decode($_GET['id']);
$sql = mysqli_query($koneksi,"SELECT * FROM jadwal_kontes WHERE id_jadwalkontes = '$id'");
$row = mysqli_fetch_array($sql);
?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Data Pemenang</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item"><a href="#">Tambah Data Pemenang</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <div class="section-body">
            <div class="card-body col-lg-7">
              <form method="POST" action="dataMaster/dataPemenang/proses/prosesTambah.php">
                <div>
                  <h4 id="tz"><b><?php echo $row['jenis_burung']; ?>  <?php echo $row['sesi']; ?></b></h4>
                </div>
              <div class="table-responsive">
               <table class="table table-sm border" border="1" id="tsm">
                  <thead>
                    <tr>
                      <th id="th1">Juara</th>
                      <th id="th1">No Gantungan</th>
                      <th id="th1">Point</th>
                      <th id="th1">Hadiah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    for($i=1;$i<=36;$i++){
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <input type="text" hidden="" name="id" value="<?php echo $id ?>">
                          <select id="opt<?php echo $i ?>" name="opt<?php echo $i ?>"> 
                          <option></option> 
                            <?php
                            $result = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$id' AND status = '1'");
                            while ($data = mysqli_fetch_array($result)){
                            ?>
                              <option><?php echo $data['no_gantungan']; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td><input type="number" id="point<?php echo $i ?>" name="point<?php echo $i ?>"></td>
                        <td>Rp. <input type="number" id="itt<?php echo $i ?>" name="itt<?php echo $i ?>"></td>
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