<html>
<head>
    <script src="../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
include '../../koneksi.php';
$nama = $_POST['nama_institusi'];
$bio = $_POST['bio'];
$ekstensi_diperbolehkan = array('png','jpg');
$logoins = $_FILES['logo']['name'];
$x = explode('.', $logoins);
$ekstensi = strtolower(end($x));
$ukuran = $_FILES['logo']['size'];
$file_tmp = $_FILES['logo']['tmp_name']; 
if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
    if($ukuran < 5044070){          
        move_uploaded_file($file_tmp, '../../stisla/assets/img/konten/'.$logoins);
        $result = mysqli_query($koneksi,"UPDATE informasi SET nama_enterprise = '$nama', logo = '$logoins', bio = '$bio' WHERE id_informasi = '1'");
        if($result){
            echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Update Profile Enterprise Berhasil !'
            })
            </script>";
            echo "<meta http-equiv='refresh' content='3; url=../../hakAdmin/?page=dashboard'>";
        }else{
            echo "<script>alert('Update GAGAL');window.location.href='../../hakAdmin/?page=dashboard'</script>";
        }
    }else{
        echo "<script>
        Swal.fire({
                  icon: 'warning',
                  title: 'Ukuran Gambar Terlalu Besar, Max 5mb !'
                }).then(function(){
                    window.location.href='../../hakAdmin/?page=dashboard';
                    });
                </script>";
        }
}else{
    echo "<script>
    Swal.fire({
              icon: 'warning',
              title: 'upload Gambar Dengan Ekstensi .jpg / .png !'
            }).then(function(){
                    window.location.href='../../hakAdmin/?page=dashboard';
                    });
            </script>";
    }
?>
</body>
</html>