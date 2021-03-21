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
		$result= mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE id_jadwalkontes ='$idKelas' AND status = ''");
		while($data_kel=mysqli_fetch_array($result)){
		?>
		<option value="<?php echo $data_kel["no_gantungan"] ?>"><?php echo $data_kel["no_gantungan"] ?></option>
		<?php }
	break;
	case 'tambah':
		$kode = $_POST['kode'];
		$kelas = $_POST['kelas'];
		$nogan = $_POST['nogan'];
		$cs = $_POST['cs'];
		$query = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE no_pesanan = '$kode' AND id_jadwalkontes = '$kelas' AND no_gantungan = '$nogan'");
		$data = mysqli_num_rows($query);
		if($data == 1){
			}else{
				$result = mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '$sesi', nama_pemilik = '$cs', no_pesanan = '$kode', status = '1', status_trx = '1' WHERE no_gantungan = '$nogan' AND id_jadwalkontes = '$kelas'");
				if($result){
					$sql = mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket-1) WHERE id_jadwalkontes = '$kelas'");
				}
			}
	break;
	case 'hapus':
		$id = $_POST['id'];
		$id_jadwal = $_POST['id_jadwal'];
		$result = mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '0', nama_pemilik = '', no_pesanan = '', status = '0', status_trx = '0' WHERE id_pesanandetail = '$id'");
		if($result){
			$sql = mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket+1) WHERE id_jadwalkontes = '$id_jadwal'");
			}
	break;
	case 'cancel':
		$nt = $_POST['nt'];
			$query = mysqli_query($koneksi,"SELECT * FROM data_pesanandetail WHERE no_pesanan = '$nt'");
			while($data = mysqli_fetch_array($query)){
				$id_jadwal = $data['id_jadwalkontes'];
				$jumlah = count($id_jadwal);
				for($x=0;$x<$jumlah;$x++){
					$sql = mysqli_query($koneksi,"UPDATE kelas_kontes SET stok_tiket=(stok_tiket+1) WHERE id_jadwalkontes = '$id_jadwal'");
				}
			}
			if($query){
				$result = mysqli_query($koneksi,"UPDATE data_pesanandetail SET id_user = '0', nama_pemilik = '', no_pesanan = '', status = '0', status_trx = '0' WHERE no_pesanan = '$nt'");
			}
	break;
	case 'saveTransaksi':
		$nt = $_POST['nt'];
		$totalHarga = $_POST['totalHarga'];
		$date = $_POST['date'];
		$jumlahTiket = $_POST['jumlahTiket'];
		$sesi = $_POST['sesi'];
		$result = mysqli_query($koneksi,"INSERT INTO data_pesanan VALUES('$nt','$sesi','$jumlahTiket','$totalHarga','$date','$date','Lunas')");
		if($result){
			$koneksi->query("UPDATE data_pesanandetail SET status_trx = '0' WHERE no_pesanan = '$nt'");
		}
	break;
}
?>