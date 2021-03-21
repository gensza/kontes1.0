<?php
session_start();
include "koneksi.php";
if(!@$_SESSION['admin'] AND !@$_SESSION['korlap']){
  header('Location: ../?page=index');
}else if(@$_SESSION['admin']){
  $sesi = $_SESSION['admin'];
}else if(@$_SESSION['korlap']){
  $sesi = $_SESSION['korlap'];
}
$enterprise = mysqli_query($koneksi,"SELECT * FROM informasi WHERE id_informasi = '1'");
$dataEnt = mysqli_fetch_array($enterprise);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="icon" href="../stisla/assets/img/konten/<?php echo $dataEnt['logo'] ?>" type="image/png">
  <title><?php echo $dataEnt['nama_enterprise']; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="../stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">-->
  <!--<link rel="stylesheet" href="../stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">-->
    <!-- CSS Libraries -->
  <link rel="stylesheet" href="../stisla/node_modules/weathericons/css/weather-icons.min.css">
  <link rel="stylesheet" href="../stisla/node_modules/weathericons/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="../stisla/node_modules/summernote/dist/summernote-bs4.css">
  <!-- JS Libraries -->
  <script src="../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <!-- Template CSS -->
  <link rel="stylesheet" href="../stisla/assets/css/style.css">
  <link rel="stylesheet" href="../stisla/assets/css/components.css">
  <link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </div>
        <?php if(isset($_SESSION["login"])){ 
          $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user = '$sesi'");
          $data = mysqli_fetch_array($sql);?>  
          <div class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../stisla/assets/img/konten/<?php echo $dataEnt['logo'] ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $data['nama_user']; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="../akun/profile.php" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="../akun/institusi.php" class="dropdown-item has-icon">
                <i class="fas fa-landmark"></i> Enterprise
              </a>
              <div class="avatar-item">
                <a href="../akun/gantiPassword.php" class="dropdown-item has-icon">
                  <i class="fas fa-wrench"></i> Ubah password
                </a>
              </div>
              <div class="dropdown-divider"></div>
              <a onclick="sweetAlertLG()" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </div>
        <?php } ?>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a>Cahaya Enterprise</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a>MENU</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu Utama</li>
              <li class="nav-item dropdown">
                <a href="?page=dashboard" class="nav-link"><i class="fas fa-th-large"></i><span>Dashboard</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="?page=jadwalLomba" class="nav-link"><i class="fas fa-clipboard"></i> <span>Jadwal Kontes</span></a>
              </li>
                <li class="nav-item dropdown">
                  <a href="?page=transaksiTiket" class="nav-link"><i class="fas fa-cash-register"></i></i> <span>Transaksi</span></a>
                </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-address-card"></i> <span>Data Master</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="?page=dataPanitia">Data Admin</a></li>
                  <li><a class="nav-link" href="?page=dataPengguna">Data user</a></li>
                  <li><a class="nav-link" href="?page=dataPeserta">Data Peserta</a></li>
                  <li><a class="nav-link" href="?page=dataPemenang">Data Pemenang</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder-open"></i><span>Data Transaksi</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="?page=transaksiMasuk">Transaksi Masuk</a></li>
                  <li><a class="nav-link" href="?page=transaksiPending">Transaksi Pending</a></li>
                  <li><a class="nav-link" href="?page=transaksiLunas">Transaksi Lunas</a></li>
                  <li><a class="nav-link" href="?page=transaksiCancel">Transaksi Batal</a></li>
                </ul>
              </li>
              <?php 
                if(@$_SESSION['korlap']){
                  ?>
                <li><a class="nav-link" href="?page=laporanKeuangan"><i class="fas fa-book"></i> <span>Laporan Keuangan</span></a></li>
                <?php } ?>
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="../?page=index" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Lihat Web User
              </a>
            </div>
          </ul>
        </aside>
      </div>
    <!-- Main Content -->
       <?php 
       if(isset($_GET['page'])){
        $page = $_GET['page'];
        switch ($page) {
          case 'dashboard':
            include "dashboard/index.php";
            break;
          case 'dataPanitia':
            include "dataMaster/dataPanitia/index.php";
            break;
          case 'editPanitia':
            include "dataMaster/dataPanitia/editPanitia.php";
            break;
          case 'dataPengguna':
            include "dataMaster/dataPengguna/index.php";
            break;
          case 'editPengguna':
            include "dataMaster/dataPengguna/editPengguna.php";
            break;
          case 'editPeserta':
            include "dataMaster/dataPeserta/editPeserta.php";
            break;
          case 'dataPeserta':
            include "dataMaster/dataPeserta/index.php";
            break;
          case 'dataPemenang':
            include "dataMaster/dataPemenang/index.php";
            break;
          case 'tambahPemenang':
            include "dataMaster/dataPemenang/tambahPemenang.php";
            break;
          case 'editPemenang':
            include "dataMaster/dataPemenang/editPemenang.php";
            break;
          case 'jadwalLomba':
            include "jadwalLomba/index.php";
            break;
          case 'editJadwal':
            include "jadwalLomba/editJadwal.php";
            break;
          case 'transaksiTiket':
            include "transaksi/transaksiTiket/index.php";
            break;
          case 'transaksiMasuk':
            include "transaksi/transaksiMasuk/index.php";
            break;
          case 'transaksiPending':
            include "transaksi/transaksiPending/index.php";
            break;
          case 'transaksiLunas':
            include "transaksi/transaksiLunas/index.php";
            break;
          case 'transaksiCancel':
            include "transaksi/transaksiCancel/index.php";
            break;
          case 'laporanKeuangan':
            include "laporanKeuangan/laporanKeuangan.php";
            break;
          case 'kontesSelesai':
            include "laporanKeuangan/kontesSelesai.php";
            break;
          default:
            echo "Halaman Tidak Tersedia";
            break;
          }
       }else{
        include "dashboard/index.php";
       }
      ?>
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
<!-- MODAL Tambah PANITIA -->
<div class="modal fade" id="modal-tambahPanitia">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Panitia</h4>
      </div>
      <div class="card">
        <form action="dataMaster/dataPanitia/proses.php?aksi=tambah" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" required="">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" class="form-control" name="alamat" required="">
            </div>
            <div class="form-group">
              <label>No Telepon</label>
              <input type="number" class="form-control" name="no_telepon">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="username" required="">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" required="">
            </div>
            <div class="form-group">
              <label>Ulangi Password</label>
              <input type="password" class="form-control" name="password2" required="">
            </div>
          </div>                   
          <div class="card-footer text-right">
            <a href="" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> 
<!-- MODAL Tambah PENGGUNA -->
<div class="modal fade" id="modal-tambahPengguna">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pengguna</h4>
      </div>
      <div class="card">
        <form action="dataMaster/dataPengguna/proses.php?aksi=tambah" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" required="">
            </div>
            <div class="form-group">
              <label>Nama Burung</label>
              <input type="text" class="form-control" name="nama_burung" required="">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" class="form-control" name="alamat" required="">
            </div>
            <div class="form-group">
              <label>No Telepon</label>
              <input type="number" class="form-control" name="no_telepon">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="username" required="">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" required="">
            </div>
            <div class="form-group">
              <label>Ulangi Password</label>
              <input type="password" class="form-control" name="password2" required="">
            </div>
          </div>                   
          <div class="card-footer text-right">
            <a href="" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- MODAL Tambah JAdwal -->
<div class="modal fade" id="modal-tambahJadwal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Jadwal Kontes</h4>
      </div>
      <div class="card">
        <form action="jadwalLomba/proses/prosesTambah.php" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Jenis Burung</label>
              <input type="text" class="form-control" name="jenis_burung" required="">
            </div>
            <div class="form-group">
              <label>Sesi</label>
              <input type="text" class="form-control" name="sesi" required="">
            </div>
            <div class="form-group">
              <label>Harga Tiket</label>
              <input type="number" class="form-control" name="harga" required="">
            </div>
            <div class="form-group">
              <label>Stok Tiket</label>
              <input type="number" class="form-control" name="stok_tiket" required="">
            </div> 
            <div class="form-group">
              <label>Waktu</label>
              <input type="time" class="form-control" name="waktu" required="">
            </div>              
          </div>                   
          <div class="card-footer text-right">
            <a href="" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> 
<!-- MODAL TAMBAH TIKET-->
<div class="modal fade" id="modal-tambahTiket">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Tiket</h4>
      </div>
      <div class="card">
        <form action="jadwalLomba/proses/prosesTambahTiket.php" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Tambah Stok Tiket</label>
              <input type="text" hidden="" name="id" value="<?php echo $id ?>">
              <input type="text" hidden="" name="stok_tiket" value="<?php echo $stok_tiket ?>">
              <input type="number" class="form-control" name="jumlah_tambah" required="">
            </div>              
          </div>                   
          <div class="card-footer text-right">
            <a href="" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>    
<!-- MODAL Hapus TIKET-->
<div class="modal fade" id="modal-hapusTiket">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Tiket</h4>
      </div>
      <div class="card">
        <form action="jadwalLomba/proses/prosesHapusTiket.php" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Hapus Stok Tiket</label>
              <input type="text" hidden="" name="id" value="<?php echo $id ?>">
              <input type="text" hidden="" name="stok_tiket" value="<?php echo $stok_tiket ?>">
               <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th id="th1">No.Gantungan</th> 
                      <th id="th1">Hapus</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $result = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_jadwalkontes = '$id' AND status = '0'");
                    while ($row = mysqli_fetch_array($result)){
                    ?>
                      <tr>
                        <td><?php echo $row['no_gantungan']; ?></td>
                        <td><input type="checkbox" name="pilih[]" value="<?php echo $row['id_pesanandetail']; ?>"></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
               </div>
              </div>
             </div>              
            </div>                   
            <div class="card-footer text-right">
            <a href="" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-success">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>      
<!-- MODAL detail pesanan-->
<div class="modal fade" id="modalDetail" role="dialog">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b>Detail Pesanan</b></h3>
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
        <h3 class="modal-title"><b>Data Pemenang</b></h3>
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
              url : 'modal/detailTiket.php',
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
      $('#modalDetail').on('show.bs.modal', function (e) {
          var rowid = $(e.relatedTarget).data('id');
          //menggunakan fungsi ajax untuk pengambilan data
          $.ajax({
              type : 'post',
              url : 'modal/detailPending.php',
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
              url : 'modal/detailPemenang.php',
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
    window.location.href='../proses/prosesLogout.php';
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
  <script src="../js/popper.min.js"></script>
  <script src="../js/jquery.nicescroll.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../assets/js/stisla.js"></script>
   <!-- JS Libraies -->
  <!--<script src="../stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>-->
  <!--<script src="../stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>-->
  <!--<script src="../stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>-->
  <script src="../stisla/node_modules/summernote/dist/summernote-bs4.js"></script>
  <!-- Template JS File -->
  <script src="../stisla/assets/js/scripts.js"></script>
  <script src="../stisla/assets/js/custom.js"></script>
    <!-- Page Specific JS File -->
  <!--<script src="../stisla/assets/js/page/modules-datatables.js"></script>-->
</body>
</html>