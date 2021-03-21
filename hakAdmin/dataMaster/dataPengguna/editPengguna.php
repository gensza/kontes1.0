<?php 
$id = base64_decode($_GET['id']);
$result = $koneksi->query("SELECT * FROM user WHERE id_user = '$id'");
$data = mysqli_fetch_array($result);
 ?>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Edit Data Pengguna</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
          <div class="breadcrumb-item"><a href="#">Edit Data Pengguna</a></div>
          <div class="breadcrumb-item">Edit</div>
        </div>
      </div>
      <div class="section-body">
        <div class="card">
          <div class="card-body">
	  	    <div class="row">
	          <div class="col-12 col-md-12 col-lg-6">
	            <form action="dataMaster/dataPengguna/proses.php?aksi=edit" method="POST">
	              <div class="card-body">
	                <div class="form-group">
	                  <label>Nama Pengguna</label>
	                  <input type="text" name="id" hidden="" value="<?php echo $id ?>">
	                  <input type="text" class="form-control" name="nama" value="<?php echo $data['nama_user'] ?>">
	                </div>
	                <div class="form-group">
	                  <label>Nama Burung</label>
	                  <input type="text" class="form-control" name="nama_burung" value="<?php echo $data['nama_burung'] ?>">
	                </div>
	                <div class="form-group">
	                  <label>Alamat</label>
	                  <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat'] ?>">
	                </div>
	                <div class="form-group">
	                  <label>No Telepon</label>
	                  <input type="text" class="form-control" name="no_telepon" value="<?php echo $data['no_telepon'] ?>">
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