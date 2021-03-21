<script type="text/javascript">
  $(document).ready(function() {
  $("#kelasfc").change(function(){
            var idKelas = $("#kelasfc").val();
            $.ajax({
              type: "POST",
              dataType: "html",
              url: "dataMaster/dataPeserta/proses.php?aksi=cariKelas",
              data: "idKelas="+idKelas,
              success: function(msg){
                if(msg == ''){
                    Swal.fire({
                      allowOutsideClick: false,
                      title: 'Tidak Ada Peserta !',
                      confirmButtonText: 'OKE'
                    }).then(function(){
                      document.getElementById("kelasfc").value=0;
                      location.reload();
                      });
                    }else{
                    $("#dataPeserta").html(msg);                                                     
                }
              }
            });    
          });
      });
</script>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Peserta</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item"><a href="#">Data Peserta</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="col-lg-12"><br>
          <select class="form-control" id="kelasfc">
            <option value="">--Pilih Kelas Kontes--</option>
            <?php 
            $query = $koneksi->query("SELECT * FROM jadwal_kontes");
            while($sql = mysqli_fetch_array($query)){
              ?>
              <option value="<?php echo $sql['id_jadwalkontes'] ?>"><?php echo $sql['jenis_burung'].'&nbsp;'.$sql['sesi']?></option>
              <?php } ?>
          </select>
          <div class="table-responsive">
            <table class="table table-striped border">
              <thead>
                <tr>
                  <th id="th1">No</th>
                  <th id="th1">No Transaksi</th>
                  <th id="th1">Jenis Burung</th>
                  <th id="th1">No Gantungan</th> 
                  <th id="th1">Nama Pemilik</th>
                  <th id="th1">Nama Burung</th>
                  <th id="th1">Alamat</th>
                  <th id="th1">Opsi</th>
                </tr>
              </thead>
              <tbody id="dataPeserta"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="section-body">
      <div class="card col-lg-9">
        <div class="col-lg-12"><br>
            <table id="example" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th id="th1">No</th>
                  <th id="th1">Jenis Burung</th>
                  <th id="th1">Harga& Tiket</th>
                  <th id="th1">Jumlah Peserta</th> 
                  <th id="th1">Total Pendapatan</th>
                  <th id="th1">Opsi</th>
                </tr>
              </thead>
              <tbody >
                <?php
                  $no = 1;
                  $result = $koneksi->query("SELECT jadwal_kontes.id_jadwalkontes, jadwal_kontes.jenis_burung, jadwal_kontes.sesi, jadwal_kontes.harga, kelas_kontes.jumlah_tiket, kelas_kontes.stok_tiket FROM jadwal_kontes INNER JOIN kelas_kontes ON jadwal_kontes.id_jadwalkontes = kelas_kontes.id_jadwalkontes");
                  while($data = mysqli_fetch_array($result)){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['jenis_burung'].'&nbsp;'.$data['sesi']; ?></td>
                  <td><?php echo number_format($data["harga"],0,',','.') ?></td>
                  <td>
                    <?php 
                      $jp = $data['jumlah_tiket'] - $data['stok_tiket'];
                      echo $jp;
                    ?>
                  </td>
                  <td>
                    <?php
                      $tp = $jp * $data['harga'];
                      echo number_format($tp,0,',','.');
                    ?>
                  </td>
                  <td><a href="../cetakDataPeserta.php?id=<?php echo $data['id_jadwalkontes'] ?>" target="_Blank" title="cetak data peserta" class="btn btn-danger btn-sm" title="edit"><i class="fa fa-print"></i></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table><br>
          <a href="../cetakLaporanRegistrasi.php" target="_Blank" id="bt" title="cetak jadwal" style="float:right;" class="btn btn-danger"><i class="fa fa-print"></i> Laporan Registrasi</a> 
        </div>
      </div>
    </div>
  </section>
</div>