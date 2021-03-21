<!-- <html>
<head>
    <script src="../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
</html> -->
<?php
include '../../koneksi.php';
$no_pesanan = $_POST['np'];
// $dari_bank = $_POST['dari_bank'];
// $norek = $_POST['norek'];
// $atas_nama = $_POST['atas_nama'];
// $ke_bank = $_POST['ke_bank'];
// $nominal = $_POST['nominal'];
$date = date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d H:i:s');
// $ekstensi_diperbolehkan = array('png','jpg');
// $buktitf = $_FILES['file']['name'];
// $x = explode('.', $buktitf);
// $ekstensi = strtolower(end($x));
// $ukuran = $_FILES['file']['size'];
// $file_tmp = $_FILES['file']['tmp_name'];
// if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
//     if($ukuran < 5044070){
//         move_uploaded_file($file_tmp, '../../stisla/assets/img/buktitf/'.$buktitf);
        $query = mysqli_query($koneksi,"INSERT INTO data_pembayaran VALUES(null,'$no_pesanan','test','1111','test','test','10000','$date','test')");
        if($query){
            $result = mysqli_query($koneksi,"UPDATE data_pesanan SET status_pesanan = 'Pending' WHERE no_pesanan = '$no_pesanan'");
            // if($result){
            //     echo "<script>
            //     Swal.fire({
            //     icon: 'success',
            //     title: 'Konfirmasi Transfer Berhasil !'
            //     });
            //     </script>";
            //     echo "<meta http-equiv='refresh' content='3; url=../../?page=infoPesanan'>";
            // }else{
            //     echo "<script>alert('Konfirmasi Transfer GAGAL');window.location.href='../../?page=infoPesanan'</script>";
            // }
        }
//     }else{
//         echo "<script>
//         Swal.fire({
//             icon: 'warning',
//             title: 'Ukuran Gambar Terlalu Besar, Max 5mb !'
//             }).then(function(){
//                 window.location.href='../../?page=infoPesanan';
//                 });
//                 </script>";
//         }
// }else{
//     echo "<script>
//     Swal.fire({
//             icon: 'warning',
//             title: 'upload Gambar Dengan Ekstensi .jpg / .png !'
//             }).then(function(){
//                 window.location.href='../../?page=infoPesanan';
//                 });
//             </script>";
//     }
?>