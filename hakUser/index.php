<?php
error_reporting(0);
$result = mysqli_query($koneksi,"SELECT * FROM informasi WHERE id_informasi = '1'");
$data = mysqli_fetch_array($result);
?>
<div class="section-body">
  <div class="card">
    <div class="card-header border" id="ch">
      <h4><i class="fas fa-home"></i> Home</h4>
    </div>
    <div class="card-body">
      <p><?php echo $data['isi_informasi'] ?></p>
    </div>
  </div>
</div>
<div class="section-body">
  <div class="card-body border col-lg-12">
    <div class="gallery gallery-fw" data-item-height="600">
      <img data-image="stisla/assets/img/konten/<?php echo $data['file'] ?>" id="imgView" class="gallery-item">
    </div>
  </div>
</div><br>
<div class="section-body">
  <div class="card-header border" id="ch">
    <h4><i class="fas fa-home"></i> Tentang <?php echo $data['nama_enterprise']; ?></h4>
  </div>
  <div class="card author-box">
    <div class="card-body">
      <div class="author-box-left">
        <img alt="image" src="stisla/assets/img/konten/<?php echo $data['logo'] ?>" class="rounded-circle author-box-picture">
        <div class="clearfix"></div>
      </div>
      <div class="author-box-details">
        <div class="author-box-name">
          <a href="#"><?php echo $data['nama_enterprise']; ?></a>
        </div>
        <div class="author-box-job">Event Organizer</div>
        <div class="author-box-description">
          <p><?php echo $data['bio']; ?></p>
        </div>
        <div class="mb-2 mt-3">
          <div class="text-small font-weight-bold">Follow <?php echo $data['nama_enterprise']; ?> on</div>
        <a href="#" class="btn btn-primary mr-1 btn-facebook">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="btn btn-info mr-1 btn-twitter">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="btn btn-danger mr-1 btn-instagram">
          <i class="fab fa-instagram"></i>
        </a>
        <?php if($_SESSION["admin"] OR $_SESSION["korlap"]){ ?>
        <div class="float-right mt-sm-0 mt-3">
          <a href="hakAdmin/index.php" class="btn btn-primary">Dashboard Admin <i class="fas fa-chevron-right"></i></a>
        </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>