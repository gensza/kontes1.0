<?php 
  include "../koneksi.php";
  session_start();
  if(@$_SESSION['admin']){
    $sesi = $_SESSION['admin'];
  }else if(@$_SESSION['user']){
    $sesi = $_SESSION['user'];
  }
  $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user = '$sesi'");
  $enterprise = mysqli_query($koneksi,"SELECT * FROM informasi WHERE id_informasi = '1'");
  $dataEnt = mysqli_fetch_array($enterprise);
  $data = mysqli_fetch_array($sql);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="icon" href="../stisla/assets/img/konten/<?php echo $dataEnt['logo'] ?>" type="image/png">
  <title>Profile</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../stisla/node_modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="../stisla/node_modules/summernote/dist/summernote-bs4.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../stisla/assets/css/style.css">
  <link rel="stylesheet" href="../stisla/assets/css/components.css">
  <link rel="stylesheet" type="text/css" href="../css/style1.css">
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card">    
              <form method="post" action="proses/prosesEditProfile.php" class="needs-validation" novalidate="">
                <div class="card-header">
                  <h4>Profile</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6 col-12">
                      <label>Nama Burung</label>
                      <input type="text" name="nama_burung" class="form-control" value="<?php echo $data['nama_burung'];?>" required="">
                      <div class="invalid-feedback">
                        Nama Burung Harap di Isi !
                      </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>Nama Pemilik</label>
                      <input type="text" name="nama_user" class="form-control" value="<?php echo $data['nama_user'];?>" required="">
                      <div class="invalid-feedback">
                        Nama Pemilik Harap di Isi !
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 col-12">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control" value="<?php echo $data['username'];?>" required="">
                      <div class="invalid-feedback">
                        Nama Pengguna Harap di Isi !
                      </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>Alamat</label>
                      <input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat'];?>" required="">
                      <div class="invalid-feedback">
                        Nama Pengguna Harap di Isi !
                      </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>No.Telepon</label>
                      <input type="number" name="no_telepon" class="form-control" value="<?php echo $data['no_telepon'];?>" required="">
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            <hr>
            <div class="card" style="padding:10px;">
            <div class="card-header">
                  <h4>Riwayat Pesanan</h4>
                </div><br>
            <table id="example" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th id="th1">No</th>
                  <th id="th1">No.Pesanan</th>
                  <th id="th1">Pemesan</th>
                  <th id="th1">Jumlah&nbsp;Tiket</th> 
                  <th id="th1">Total&nbsp;Harga</th>
                  <th id="th1">Tgl&nbsp;Pesan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                error_reporting(0);
                $result = mysqli_query($koneksi,"SELECT data_pesanan.no_pesanan, user.nama_user, data_pesanan.jumlah_tiket, data_pesanan.total_harga, data_pesanan.tgl_pesan, data_pesanan.expired, data_pesanan.status_pesanan FROM data_pesanan INNER JOIN user ON data_pesanan.id_user = user.id_user WHERE data_pesanan.id_user = '$sesi' ORDER BY tgl_pesan DESC");
                  while ($row = mysqli_fetch_array($result)) {
                    $np = $row['no_pesanan'];
                    $jumlah_tiket = $row['jumlah_tiket'];
                    $cariJadwal = $koneksi->query("SELECT * FROM data_pesanandetail WHERE no_pesanan = '$np'");
                    $cari = mysqli_fetch_array($cariJadwal);
                    $id = $cari['id_jadwalkontes'];
                    if($row['status_pesanan']== 'Belum Bayar' AND $waktu > $row['expired']){
                      mysqli_query($koneksi,"UPDATE data_pesanan SET jumlah_tiket = '0', total_harga = '0', status_pesanan = 'Expired' WHERE no_pesanan ='$np'");
                      mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket+$jumlah_tiket) WHERE id_jadwalkontes = '$id'");
                      $result = mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '0', nama_pemilik = '', nama_burung = '', alamat = '', no_pesanan = '', status = '0' WHERE no_pesanan = '$np'");
                      echo "<script> 
                              location.reload();
                            </script>";
                    }
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['no_pesanan']?></td>
                    <td><?php echo $row['nama_user'] ?></td>
                    <td><?php echo $row['jumlah_tiket'] ?></td>
                    <td>Rp. <?php echo number_format($row['total_harga'],0,',','.'); ?></td>
                    <td><?php echo $row['tgl_pesan']; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
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
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>
  <!-- JS Libraies -->
  <script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>
  <!-- Page Specific JS File -->
</body>
</html>