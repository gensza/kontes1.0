<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Kontes Selesai</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Kontes Selesai</a></div>
      </div>
    </div>

<div class="s ection-body">
  <div class="card col-md-6 col-lg-6">
    <div class="card-body">
      <p>Jika anda akan mengakhiri kontes !</p>
      <ul>
        <li>Semua data akan dikalkulasikan dan disimpan pada laporan keuangan</li>
        <li>Kemudian semua data kontes akan terhapus, kecuali data laporan keuangan, data konten dan data user</li>
        <li>Data laporan keuangan yang sudah tersimpan akan ditampilkan pada tabel form laporan keuangan</li>
        <li>Tanggal laporan yang disimpan adalah tanggal ketika mengakhiri kontes</li>
      </ul>
      <button onclick="Swal.fire({
                          title: 'Yakin akan mengakhiri Kontes ?',
                          showCancelButton: true,
                          confirmButtonColor: 'red',
                          cancelButtonColor: 'green',
                          confirmButtonText: 'Ya, akhiri'
                      }).then((result) => {
                          if (result.value) {
                            window.location.href='laporanKeuangan/prosesHapusData.php';
                          }
                      })" class="btn btn-danger float-right">Kontes Selesai</button>
    </div>
  </div>
</div>

  </section>
</div>