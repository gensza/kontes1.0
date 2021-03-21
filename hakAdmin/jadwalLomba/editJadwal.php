<?php 
$id = base64_decode($_GET['id']);
$result = mysqli_query($koneksi,"SELECT jadwal_kontes.id_jadwalkontes, jadwal_kontes.jenis_burung, jadwal_kontes.sesi, jadwal_kontes.harga,kelas_kontes.jumlah_tiket, kelas_kontes.stok_tiket, jadwal_kontes.waktu FROM jadwal_kontes INNER JOIN kelas_kontes ON jadwal_kontes.id_jadwalkontes = kelas_kontes.id_jadwalkontes WHERE jadwal_kontes.id_jadwalkontes = '$id'");
$data = mysqli_fetch_array($result);
$stok_tiket = $data['stok_tiket'];
?>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
      <h1>Edit Jadwal Lomba</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Jadwal</a></div>
          <div class="breadcrumb-item"><a href="#">Edit Jadwal Lomba</a></div>
          <div class="breadcrumb-item">Edit</div>
        </div>
      </div>
      <div class="section-body">
        <div class="card">
          <div class="card-body">
	  	    <div class="row">
	          <div class="col-12 col-md-12 col-lg-6">
	            <form action="jadwalLomba/proses/prosesEdit.php" method="POST">
	              <div class="card-body">
	                <div class="form-group">
	                  <label>Jenis Burung</label>
	                  <input type="text" class="form-control" name="jenis_burung" value="<?php echo $data['jenis_burung'] ?>">
	                </div>
	                <div class="form-group">
	                  <label>Sesi</label>
	                  <input type="text" name="id" hidden="" value="<?php echo $id ?>">
	                  <input type="text" class="form-control" name="sesi" value="<?php echo $data['sesi'] ?>">
	                </div>
	                <div class="form-group">
	                  <label>Harga Tiket</label>
	                  <input type="number" class="form-control" name="harga" value="<?php echo $data['harga'] ?>">
	                </div>
	                <div class="form-group">
	                  <label>Jumlah Tiket</label>
	                  <input type="number" id="tk" class="form-control" value="<?php echo $data['jumlah_tiket'] ?>" readonly>
	                </div>
	                <div class="row">
                      	<div class="form-group col-10">
                          <label>Stok Tiket</label>
		                  <input type="number" id="tk" class="form-control" name="stok_tiket" value="<?php echo $stok_tiket ?>" readonly>
                     	</div>
	                 	<div class="form-group">
	                   	  <button type="button" id="pl" data-target="#modal-tambahTiket" role="button" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i></button>
		                  <button type="button" id="pl" data-target="#modal-hapusTiket" role="button" data-toggle="modal"><i class="fa fa-minus" aria-hidden="true"></i></button>
	                  	</div>
                  	</div>
                  	<div class="form-group">
	                  <label>Waktu</label>
	                  <input type="time" class="form-control" name="waktu" value="<?php echo $data['waktu'] ?>">
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