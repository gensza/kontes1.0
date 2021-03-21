<?php
include "../koneksi.php";
$enterprise = mysqli_query($koneksi,"SELECT * FROM informasi WHERE id_informasi = '1'");
$dataEnt = mysqli_fetch_array($enterprise);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="icon" href="../stisla/assets/img/konten/<?php echo $dataEnt['logo'] ?>" type="image/png">
  <title>Daftar Akun</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Libraries -->
  <!-- Template CSS -->
  <link rel="stylesheet" href="../stisla/assets/css/style.css">
  <link rel="stylesheet" href="../stisla/assets/css/components.css">
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card">
              <div class="card card-primary">
                <div class="card-header"><h4>Daftar Akun Baru</h4></div>
                  <div class="card-body">
                    <form action="proses/prosesDaftarAkun.php" method="POST">
                      <div class="form-group">
                        <label for="nama_burung">Nama Burung</label>
                        <input id="nama_burung" type="text" class="form-control" name="nama_burung" autofocus>
                      </div>
                      <div class="form-group">
                        <label for="nama_user">Nama Pemilik</label>
                        <input id="nama_user" type="text" class="form-control" name="nama_user" autofocus required>
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input id="alamat" type="text" class="form-control" name="alamat" autofocus required>
                      </div>
                      <div class="form-group">
                        <label for="no_telepon">No.Telepon</label>
                        <input id="no_telepon" type="number" class="form-control" name="no_telepon" autofocus required>
                      </div>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control" name="username" required>
                      </div>
                      <div class="form-group">
                        <label for="password" class="d-block">Kata Sandi</label>
                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                      </div>
                      <div class="form-group">
                        <label for="password2" class="d-block">Ulang Kata Sandi</label>
                        <input id="password2" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password2" required>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Daftar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../Stisla/assets/js/stisla.js"></script>
  <!-- JS Libraies -->
  <!-- Template JS File -->
  <script src="../stisla/assets/js/scripts.js"></script>
  <script src="../stisla/assets/js/custom.js"></script>
  <!-- Page Specific JS File -->
  <script src="../stisla/assets/js/page/auth-register.js"></script>
</body>
</html>