<?php 
  include "../koneksi.php";
  $result = $koneksi->query("SELECT * FROM informasi WHERE id_informasi = '1'");
  $data = mysqli_fetch_array($result);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="icon" href="../stisla/assets/img/konten/<?php echo $data['logo'] ?>" type="image/png">
  <title>Enterprise</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../stisla/node_modules/weathericons/css/weather-icons.min.css">
  <link rel="stylesheet" href="../stisla/node_modules/weathericons/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="../stisla/node_modules/summernote/dist/summernote-bs4.css">
  <!-- JS Libraries -->
  <script src="../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/ajax.js"></script>
  <!-- Template CSS -->
  <link rel="stylesheet" href="../stisla/assets/css/style.css">
  <link rel="stylesheet" href="../stisla/assets/css/components.css">
  <link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card">
              <form method="POST" action="proses/prosesEditInstitusi.php" enctype="multipart/form-data">
                <div class="card-header">
                  <h4>Edit Profile Enterprise</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Nama Enterprise</label>
                        <input type="text" name="nama_institusi" class="form-control" value="<?php echo $data['nama_enterprise'] ?>">
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Logo Enterprise</label>
                        <input type="file" name="logo" class="form-control" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-12">
                        <label>Bio</label>
                        <textarea name="bio" class="summernote-simple"><?php echo $data['bio']; ?></textarea>
                      </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                  <button id="cpw" type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="../js/popper.min.js"></script>
  <script src="../js/jquery.nicescroll.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../assets/js/stisla.js"></script>
   <!-- JS Libraies -->
  <script src="../stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="../stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
  <script src="../stisla/node_modules/summernote/dist/summernote-bs4.js"></script>
  <!-- Template JS File -->
  <script src="../stisla/assets/js/scripts.js"></script>
  <script src="../stisla/assets/js/custom.js"></script>
  <!-- Page Specific JS File -->
  <script src="../stisla/assets/js/page/modules-datatables.js"></script>
</body>
</html>