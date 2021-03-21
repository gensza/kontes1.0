<?php
$id = base64_decode($_GET['id']);
$result = mysqli_query($koneksi,"SELECT data_pesanandetail.id_jadwalkontes, data_pesanandetail.no_pesanan, jadwal_kontes.jenis_burung, data_pesanandetail.no_gantungan, data_pesanandetail.nama_pemilik, data_pesanandetail.nama_burung, data_pesanandetail.alamat FROM data_pesanandetail INNER JOIN jadwal_kontes ON data_pesanandetail.id_jadwalkontes = jadwal_kontes.id_jadwalkontes WHERE id_pesanandetail = '$id'");
$data = mysqli_fetch_array($result);
$idJadwal = $data['id_jadwalkontes'];
$query = $koneksi->query("SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$idJadwal' AND status = '0'");
?>
 <div class="main-content">
   <section class="section">
      <div class="section-header">
      <h1>Edit Data Peserta</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
          <div class="breadcrumb-item"><a href="#">Edit Data Peserta</a></div>
          <div class="breadcrumb-item">Edit</div>
        </div>
      </div>
      <div class="section-body">
        <div class="card">
          <div class="card-body">
	  	    <div class="row">
	          <div class="col-12 col-md-12 col-lg-6">
	            <form action="dataMaster/dataPeserta/proses.php?aksi=edit" method="POST">
	              <div class="card-body">
	                <div class="form-group">
	                  <label>No Pesanan</label>
	                  <input type="text" name="id" hidden="" value="<?php echo $id ?>">
	                  <input type="text" id="tk" class="form-control" name="no_pesanan" value="<?php echo $data['no_pesanan'] ?>" readonly>
	                </div>
	                <div class="form-group">
	                  <label>Jenis Burung</label>
	                  <input type="text" id="tk" class="form-control" name="jenis_burung" value="<?php echo $data['jenis_burung'] ?>" readonly>
	                </div>
	                <div class="form-group">
	                  <label>No Gantungan</label>
	                  <select class="form-control" name="no_gantungan">
	                  	<option value="<?php echo $data['no_gantungan'] ?>"><?php echo $data['no_gantungan']; ?></option>
	                  	<option value="<?php echo $data['no_gantungan'] ?>"></option>
	                  	<?php while($sql = mysqli_fetch_array($query)){ ?>
	                  		<option value="<?php echo $sql['no_gantungan']; ?>"><?php echo $sql['no_gantungan']; ?></option>
	                  	<?php } ?>
	                  </select>
	                </div>
	                <div class="form-group">
	                  <label>Nama Pemilik</label>
	                  <input type="text" class="form-control" name="nama_pemilik" value="<?php echo $data['nama_pemilik'] ?>">
	                </div>
	                <div class="form-group">
	                  <label>Nama Burung</label>
	                  <input type="text" class="form-control" name="nama_burung" value="<?php echo $data['nama_burung'] ?>">
	                </div>
	                <div class="form-group">
	                  <label>Alamat</label>
	                  <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat'] ?>">
	                </div>
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