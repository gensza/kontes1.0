<?php
include "../../koneksi.php";
session_start();
if(@$_SESSION['admin']){
  $sesi = $_SESSION['admin'];
}else if(@$_SESSION['korlap']){
  $sesi = $_SESSION['korlap'];
}
switch ($_GET['aksi'])
{
	case 'cariKelas':
		$idKelas = $_POST['idKelas'];
    $no = 1;
    $result = mysqli_query($koneksi,"SELECT data_pesanandetail.id_pesanandetail, data_pesanandetail.no_pesanan, jadwal_kontes.jenis_burung, data_pesanandetail.no_gantungan, data_pesanandetail.nama_pemilik, data_pesanandetail.nama_burung, data_pesanandetail.alamat FROM data_pesanandetail INNER JOIN jadwal_kontes ON data_pesanandetail.id_jadwalkontes = jadwal_kontes.id_jadwalkontes WHERE data_pesanandetail.id_jadwalkontes ='$idKelas' AND status = '1'");
      while ($row = mysqli_fetch_array($result)){
        $id = $row['id_pesanandetail'];
      ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row['no_pesanan']?></td>
        <td><?php echo $row['jenis_burung'] ?></td>
        <td><?php echo $row['no_gantungan'] ?></td>
        <td><?php echo $row['nama_pemilik']; ?></td>
        <td><?php echo $row['nama_burung']; ?></td>
        <td><?php echo $row['alamat']; ?></td>
        <td>
          <div class="row">
          <a href="?page=editPeserta&id=<?php echo base64_encode($id) ?>" class="btn btn-warning btn-sm" title="edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;
          <button onclick="Swal.fire({
                title: 'Hapus Peserta <?php echo $row['no_pesanan'] ?> ?',
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'green',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.value) {
                  window.location.href='dataMaster/dataPeserta/proses.php?aksi=hapus&id=<?php echo base64_encode($id) ?>';
                }
            })" class="btn btn-danger btn-sm" title="hapus"><i class="fas fa-trash-alt"></i></button>
          </div>
        </td>
      </tr>
    <?php }
	break;
  case 'edit':
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
    </head>
    </html>
    <?php
    $id = $_POST['id'];
    $no_gantungan = $_POST['no_gantungan'];
    $nama_pemilik = $_POST['nama_pemilik'];
    $nama_burung = $_POST['nama_burung'];
    $alamat = $_POST['alamat'];
    $sql = $koneksi->query("SELECT * FROM data_pesanandetail WHERE id_pesanandetail = '$id'");
    $cek = mysqli_fetch_array($sql);
    $no_pesanan = $cek['no_pesanan'];
    $idJadwal = $cek['id_jadwalkontes'];
    $query = $koneksi->query("UPDATE data_pesanandetail SET id_user = '0', nama_pemilik = '', nama_burung = '', alamat = '', no_pesanan = '', status = '0', status_trx = '0' WHERE id_pesanandetail = '$id'");
    if($query){
      $result = $koneksi->query("UPDATE data_pesanandetail SET id_user = '$sesi', nama_pemilik = '$nama_pemilik', nama_burung = '$nama_burung', alamat = '$alamat', no_pesanan = '$no_pesanan', status = '1' WHERE id_jadwalkontes = '$idJadwal' AND no_gantungan = '$no_gantungan'");
      if($result){
        echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Data Peserta Berhasil Diperbarui !'
          })
          </script>";
          echo "<meta http-equiv='refresh' content='3; url=../../?page=dataPeserta'>";
      }else{
        echo "<script>
            Swal.fire({
            allowOutsideClick: false,
            title: 'Data Peserta GAGAl Diperbarui !',
            icon: 'error',
            confirmButtonText: 'OKE'
          }).then(function(){
            window.location.href='../../?page=dataPeserta';
            });
            </script>";
      }
    }
  break;
  case 'hapus':
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <script src="../../../stisla/sweetalert2/dist/sweetalert2.all.min.js"></script>
    </head>
    </html>
    <?php
    error_reporting();
    $id = base64_decode($_GET['id']);
    $sql = $koneksi->query("SELECT * FROM data_pesanandetail WHERE id_pesanandetail = '$id'");
    $cek = mysqli_fetch_array($sql);
    $idJadwal = $cek['id_jadwalkontes'];
    $no_pesanan = $cek['no_pesanan'];
    $no_gantungan = $cek['no_gantungan'];
    $harga = $koneksi->query("SELECT * FROM jadwal_kontes WHERE id_jadwalkontes = '$idJadwal'");
    $cekHarga = mysqli_fetch_array($harga);
    $harga = $cekHarga['harga'];
    $mysql = $koneksi->query("UPDATE data_pesanan SET jumlah_tiket = (jumlah_tiket - 1), total_harga = (total_harga-$harga) WHERE no_pesanan = '$no_pesanan'");
      if($mysql){
        $status = $koneksi->query("SELECT * FROM data_pesanan WHERE no_pesanan = '$no_pesanan'");
        $cekStatus = mysqli_fetch_array($status);
        if($cekStatus['jumlah_tiket'] == 0){
          $koneksi->query("UPDATE data_pesanan SET status_pesanan = 'Cancel' WHERE no_pesanan = '$no_pesanan'");
        }
        $query = $koneksi->query("UPDATE kelas_kontes SET stok_tiket = (stok_tiket + 1) WHERE id_jadwalkontes = '$idJadwal'");
        if($query){
          $result = $koneksi->query("UPDATE data_pesanandetail SET id_user = '0', nama_pemilik = '', nama_burung = '', alamat = '', no_pesanan = '', status = '0', status_trx = '0' WHERE id_pesanandetail = '$id'");
          if($result){
              echo "<script>
                Swal.fire({
                  icon: 'success',
                  title: 'Data Peserta Berhasil Dihapus !'
                })
                </script>";
                echo "<meta http-equiv='refresh' content='3; url=../../?page=dataPeserta'>";
          }else{
              echo "<script type='text/javascript'>
                Swal.fire({
                allowOutsideClick: false,
                title: 'Data Peserta GAGAL Dihapus !',
                icon: 'error',
                confirmButtonText: 'OKE'
              }).then(function(){
                window.location.href='../../?page=dataPeserta';
                });
                </script>"; 
          }
        }
      }
  break;
}