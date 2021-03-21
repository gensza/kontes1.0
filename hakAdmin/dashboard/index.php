<?php
$waktu = date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('Y-m-d H:i:s');
$no = 1;
error_reporting(0);
$cekExp = mysqli_query($koneksi,"SELECT data_pesanan.no_pesanan, user.nama_user, data_pesanan.jumlah_tiket, data_pesanan.total_harga, data_pesanan.tgl_pesan, data_pesanan.expired, data_pesanan.status_pesanan FROM data_pesanan INNER JOIN user ON data_pesanan.id_user = user.id_user WHERE data_pesanan.status_pesanan = 'Belum Bayar' ORDER BY tgl_pesan DESC");
  while ($expCek = mysqli_fetch_array($cekExp)) {
    $np = $expCek['no_pesanan'];
    $jumlah_tiket = $expCek['jumlah_tiket'];
    $cariJadwal = $koneksi->query("SELECT * FROM data_pesanandetail WHERE no_pesanan = '$np'");
    $cari = mysqli_fetch_array($cariJadwal);
    $id = $cari['id_jadwalkontes'];
    if($expCek['status_pesanan']== 'Belum Bayar' AND $waktu > $expCek['expired']){
      mysqli_query($koneksi,"UPDATE data_pesanan SET jumlah_tiket = '0', total_harga = '0', status_pesanan = 'Expired' WHERE no_pesanan ='$np'");
      mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket+$jumlah_tiket) WHERE id_jadwalkontes = '$id'");
      $result = mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '0', nama_pemilik = '', nama_burung = '', alamat = '', no_pesanan = '', status = '0' WHERE no_pesanan = '$np'");
      echo "<script> 
              location.reload();
            </script>";
    }
  }
$result = $koneksi->query("SELECT * FROM informasi WHERE id_informasi = '1'");
$statusBB = $koneksi->query("SELECT COUNT(*) AS jumlah_pesanan FROM data_pesanan WHERE status_pesanan = 'Belum Bayar'");
$statusP = $koneksi->query("SELECT COUNT(*) AS jumlah_pesanan FROM data_pesanan WHERE status_pesanan = 'Pending'");
$statusL = $koneksi->query("SELECT COUNT(*) AS jumlah_pesanan FROM data_pesanan WHERE status_pesanan = 'Lunas'");
$jadwal = $koneksi->query("SELECT COUNT(*) AS jumlah_jadwal FROM jadwal_kontes");
$peserta = $koneksi->query("SELECT COUNT(*) AS jumlah_peserta FROM data_pesanandetail WHERE status = '1'");
$pemenang = $koneksi->query("SELECT COUNT(*) AS jumlah_pemenang FROM penilaian_kontes");
$query = $koneksi->query("SELECT kelas_kontes.jumlah_tiket, kelas_kontes.stok_tiket, jadwal_kontes.harga, kelas_kontes.hadiah FROM jadwal_kontes INNER JOIN kelas_kontes ON jadwal_kontes.id_jadwalkontes = kelas_kontes.id_jadwalkontes");
$data = mysqli_fetch_array($result);
$cekBB = mysqli_fetch_array($statusBB);
$cekP = mysqli_fetch_array($statusP);
$cekL = mysqli_fetch_array($statusL);
$cekJadwal = mysqli_fetch_array($jadwal);
$cekPeserta = mysqli_fetch_array($peserta);
$cekPemenang = mysqli_fetch_array($pemenang);
$total = $cekBB['jumlah_pesanan'] + $cekP['jumlah_pesanan'] + $cekL['jumlah_pesanan'];
$totalSales = 0;
$hadiah = 0;
while ($row = mysqli_fetch_array($query)){
  $jp = $row["jumlah_tiket"] - $row["stok_tiket"];
  $sales = $row["harga"] * $jp;
  $totalSales += $sales;
  $hadiah += $row['hadiah'];
}
function hari_ini(){
  $hari = date ("D");
  switch($hari){
    case 'Sun':
      $hari_ini = "Minggu";
    break;
    case 'Mon':     
      $hari_ini = "Senin";
    break;
    case 'Tue':
      $hari_ini = "Selasa";
    break;
    case 'Wed':
      $hari_ini = "Rabu";
    break;
    case 'Thu':
      $hari_ini = "Kamis";
    break;
    case 'Fri':
      $hari_ini = "Jumat";
    break;
    case 'Sat':
      $hari_ini = "Sabtu";
    break;
    default:
      $hari_ini = "Tidak di ketahui";   
    break;
  }
  return "<b>" . $hari_ini . "</b>";
}
function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
$date = tgl_indo(date('Y-m-d'));
?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">Dashboard</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-stats">
            <div class="card-stats-title">
              <?php echo hari_ini().',&nbsp;'.$date; ?>
            </div>
            <div class="card-stats-items">
              <div class="card-stats-item">
                <div class="card-stats-item-count"><?php echo $cekBB['jumlah_pesanan']; ?></div>
                <div class="card-stats-item-label"><a href="?page=transaksiMasuk">Trx Masuk <i class="fas fa-chevron-right"></i></a></div>
              </div>
              <div class="card-stats-item">
                <div class="card-stats-item-count"><?php echo $cekP['jumlah_pesanan']; ?></div>
                <div class="card-stats-item-label"><a href="?page=transaksiPending">Trx Pending <i class="fas fa-chevron-right"></i></a></div>
              </div>
              <div class="card-stats-item">
                <div class="card-stats-item-count"><?php echo $cekL['jumlah_pesanan']; ?></div>
                <div class="card-stats-item-label"><a href="?page=transaksiLunas">Trx Lunas <i class="fas fa-chevron-right"></i></a></div>
              </div>
            </div>
          </div>
          <div class="card-icon shadow-primary bg-info">
            <i class="fas fa-archive"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Orders</h4>
            </div>
            <div class="card-body">
              <?php echo $total; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistic-2">
            <div class="imgWrap">
              <img src="../stisla/assets/img/pendapatan.jpg" height="95" width="100%">
            </div>
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Sales</h4>
            </div>
            <div class="card-body">
              <h6>Rp. <?php echo number_format($totalSales,0,',','.') ?></h6>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistic-2">
            <div class="imgWrap">
              <img src="../stisla/assets/img/hadiah.jpg" height="95" width="100%">
            </div>
          <div class="card-icon shadow-primary bg-success">
            <i class="fas fa-gift"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Gift Out</h4>
            </div>
            <div class="card-body">
              <h6>Rp. <?php echo number_format($hadiah,0,',','.') ?></h6>
            </div>
          </div>
        </div>
      </div>
    </div>        
    <div class="row">
      <div class="col-lg-4 col-md-12 col-sm-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-clipboard"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jadwal Kontes</h4>
            </div>
            <div class="card-body">
              <?php echo $cekJadwal['jumlah_jadwal']; ?>
              <div class="card-stats-item-label"><a href="?page=jadwalLomba"><h6>info<i class="fas fa-chevron-right"></i></h6></a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Data Peserta</h4>
            </div>
            <div class="card-body">
              <?php echo $cekPeserta['jumlah_peserta']; ?>
              <div class="card-stats-item-label"><a href="?page=dataPeserta"><h6>info<i class="fas fa-chevron-right"></i></h6></a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-trophy"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Data Pemenang</h4>
            </div>
            <div class="card-body">
              <?php echo $cekPemenang['jumlah_pemenang']; ?>
              <div class="card-stats-item-label"><a href="?page=dataPemenang"><h6>info<i class="fas fa-chevron-right"></i></h6></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <form method="POST" action="dashboard/proses/prosesEditDashboard.php" enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
              <h4>Title Content</h4>
            </div>
            <div class="card-body pb-0">
              <div class="form-group">
                <label>Content Halaman Home User</label>
                <textarea class="summernote-simple" name="konten"><?php echo $data['isi_informasi']; ?></textarea>
              </div>
              <div class="form-group">
                <label>Foto Halaman Home User</label>
                  <div class="custom-file">
                    <input type="file" id="inputFile" name="file" class="imgFile custom-file-input" aria-describedby="inputGroupFileAddon01" required="">
                    <label class="custom-file-label" for="inputFile">Pilih Gambar</label>
                  </div>
                <div class="card-body border col-lg-12">
                 <div class="imgWrap">
                      <img src="../stisla/assets/img/camera.png" id="imgView" class="card-img-top img-fluid">
                 </div>
                </div>
              </div>
            </div>
            <div class="card-footer pt-0">
              <button class="btn btn-primary float-right" type="submit">Simpan</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card author-box">
          <div class="card-body">
            <div class="author-box-left">
              <img alt="image" src="../stisla/assets/img/konten/<?php echo $data['logo'] ?>" class="rounded-circle author-box-picture">
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
              <div class="mb-2 mt-3"><div class="text-small font-weight-bold">Follow <?php echo $data['nama_institusi']; ?> on</div></div>
              <a href="#" class="btn btn-primary mr-1 btn-facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="btn btn-info mr-1 btn-twitter">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="btn btn-danger mr-1 btn-instagram">
                <i class="fab fa-instagram"></i>
              </a>
              <div class="w-100 d-sm-none"></div>
              <div class="float-right mt-sm-0 mt-3">
                <a href="../akun/institusi.php" class="btn btn-primary">Edit <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
$("#inputFile").change(function(event) {  
  fadeInAdd();
  getURL(this);    
});
$("#inputFile").on('click',function(event){
  fadeInAdd();
});
function getURL(input) {    
  if (input.files && input.files[0]) {   
    var reader = new FileReader();
    var filename = $("#inputFile").val();
    filename = filename.substring(filename.lastIndexOf('\\')+1);
    reader.onload = function(e) {
      debugger;      
      $('#imgView').attr('src', e.target.result);
      $('#imgView').hide();
      $('#imgView').fadeIn(500);      
      $('.custom-file-label').text(filename);             
    }
    reader.readAsDataURL(input.files[0]);    
  }
  $(".alert").removeClass("loadAnimate").hide();
  }
  function fadeInAdd(){
    fadeInAlert();  
}
function fadeInAlert(text){
  $(".alert").text(text).addClass("loadAnimate");  
}
</script>