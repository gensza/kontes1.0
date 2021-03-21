<?php
session_start();
include "koneksi.php";
if(@$_SESSION['admin']){
$sesi = $_SESSION['admin'];
}else if(@$_SESSION['user']){
$sesi = $_SESSION['user'];
}else if(@$_SESSION['korlap']){
$sesi = $_SESSION['korlap'];
}
$enterprise = mysqli_query($koneksi,"SELECT * FROM informasi WHERE id_informasi = '1'");
$dataEnt = mysqli_fetch_array($enterprise);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-CSCOZAbGv9tMkLGW"></script>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="icon" href="stisla/assets/img/konten/<?php echo $dataEnt['logo'] ?>" type="image/png">
  <title>CAHAYA ENTERPRISE</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">-->
  <!--<link rel="stylesheet" href="stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">-->
  <link rel="stylesheet" href="stisla/node_modules/chocolat/dist/css/chocolat.css">
  <!-- JS Libraries -->
  <script src="stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <!-- Template CSS -->
  <link rel="stylesheet" href="stisla/assets/css/style.css">
  <link rel="stylesheet" href="stisla/assets/css/components.css">
  <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
        <a href="index.html" class="navbar-brand sidebar-gone-hide"><?php echo $dataEnt['nama_enterprise']; ?></a>
        <div class="navbar-nav">
          <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        </div>
        <div class="nav-collapse">
          <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
          </a>
        </div>
      </div>
        <?php if(isset($_SESSION["login"])){ 
          $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user = '$sesi'");
          $data = mysqli_fetch_array($sql);?>
          <div class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="stisla/assets/img/avatar/avatar-2.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $data['nama_user']; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="akun/profile.php" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="avatar-item">
                <a href="akun/gantiPassword.php" class="dropdown-item has-icon">
                  <i class="fas fa-wrench"></i> Ubah password
                </a>
              </div>
              <div class="dropdown-divider"></div>
              <a onclick="sweetAlertLG()" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i>Logout
              </a>
            </div>
          </div>
        <?php }
          if(!isset($_SESSION["login"])){ ?>
          <a href="login.php"><button class="btn btn-outline-light" id="lg" ><b>Login</b></button></a>
        <?php } ?>
      </nav>
      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a href="?page=index" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
            </li>
            <li class="nav-item active">
              <a href="?page=pemenangLomba" class="nav-link"><i class="fas fa-trophy"></i><span>Pemenang Kontes</span></a>
            </li>
            <li class="nav-item active">
              <a href="?page=jadwalLomba" class="nav-link"><i class="fas fa-clock"></i><span>Jadwal Kontes & Pesan tiket</span></a>
            </li>
            <?php if(isset($_SESSION["login"])){ ?>
            <li class="nav-item active">
              <a href="?page=infoPesanan" class="nav-link"><i class="fas fa-receipt"></i><span>Pesanan Saya</span></a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a href="" class="nav-link" hidden=""><i class="far fa-heart"></i><span>Konfirmasi Bayar</span></a>
            </li>
          </ul>
        </div>
      </nav>
     <!-- Main Content -->
    <div class="main-content">
      <section class="section">
        <div class="section-body">
          <div class="card col-lg-12">
            <!--<div class="card-body"> -->
               <?php 
               if(isset($_GET['page'])){
                $page = $_GET['page'];
                switch ($page) {
                  case 'index':
                    include "hakUser/index.php";
                    break;
                  case 'jadwalLomba':
                    include "hakUser/jadwalLomba.php";
                    break;
                  case 'pemenangLomba':
                    include "hakUser/pemenangLomba.php";
                    break;
                  case 'pesanTiket':
                    include "hakUser/pesanTiket.php";
                    break;
                  case 'pesanTiketdetail1':
                    include "hakUser/pesanTiketdetail1.php";
                    break;
                  case 'pesanTiketdetail2':
                    include "hakUser/pesanTiketdetail2.php";
                    break;
                  case 'pesanTiketdetail3':
                    include "hakUser/pesanTiketdetail3.php";
                    break;
                  case 'infoPesanan':
                    include "hakUser/infoPesanan.php";
                    break;
                  case 'konfirmasiBayar':
                    include "hakUser/konfirmasiBayar.php";
                    break;
                  case 'konfirmasiBayarPending':
                    include "hakUser/konfirmasiBayarPending.php";
                    break;
                  default:
                    echo "Halaman Tidak Tersedia";
                    break;
                  }
               }else{
                include "hakUser/index.php";
               }
              ?>
            <!--</div>-->
          </div>
        </div>
      </section>
    </div>
      <footer class="main-footer" style="background-color: #6777ef">
        <div class="footer-left" style="color: white">
          &emsp;Copyright &copy; 2020 <div class="bullet"></div> By <?php echo $dataEnt['nama_enterprise']; ?>
        </div>
        <div class="footer-right" style="color: white">
            1.0 &emsp;
        </div>
      </footer>
  </div>
</div>
<!-- MODAL detail TIKET-->
<div class="modal fade" id="modalDetailTiket" role="dialog">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><b>Detail Tiket</b></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="fetched-data"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
        </div>
    </div>
  </div>
</div>
<!-- MODAL detail PEMENANG-->
<div class="modal fade" id="modalDetailPemenang" role="dialog">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b>Penilaian Kontes</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="fetched-data"></div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
      $('#modalDetailTiket').on('show.bs.modal', function (e) {
          var rowid = $(e.relatedTarget).data('id');
          //menggunakan fungsi ajax untuk pengambilan data
          $.ajax({
              type : 'post',
              url : 'hakUser/modal/detailTiket.php',
              data :  'rowid='+ rowid,
              success : function(data){
              $('.fetched-data').html(data);//menampilkan data ke dalam modal
              }
          });
       });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#modalDetailPemenang').on('show.bs.modal', function (e) {
          var rowid = $(e.relatedTarget).data('id');
          //menggunakan fungsi ajax untuk pengambilan data
          $.ajax({
              type : 'post',
              url : 'hakUser/modal/detailPemenang.php',
              data :  'rowid='+ rowid,
              success : function(data){
              $('.fetched-data').html(data);//menampilkan data ke dalam modal
              }
          });
       });
  });
</script>
<script type="text/javascript">
function sweetAlertLG(){
Swal.fire({
  title: 'Yakin Akan Logout ?',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Logout'
}).then((result) => {
  if (result.value) {
    window.location.href='proses/prosesLogout.php';
  }
})
}
</script>
<script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
    } );
</script>
  <!-- General JS Scripts -->
  <!--<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>-->
  <script src="js/jquery.nicescroll.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="stisla/assets/js/stisla.js"></script>
  <!-- JS Libraies -->
  <!--<script src="stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>-->
  <!--<script src="stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>-->
  <!--<script src="stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>-->
  <script src="stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <!-- Page Specific JS File -->
  <!--<script src="stisla/assets/js/page/modules-datatables.js"></script>  -->
  <!-- Template JS File -->
  <script src="stisla/assets/js/scripts.js"></script>
  <script src="stisla/assets/js/custom.js"></script>
</body>
</html>