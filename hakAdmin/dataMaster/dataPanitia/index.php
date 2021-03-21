<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Admin</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item"><a href="#">Data Admin</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="col-lg-12"><br>
         <button type="button" id="bt" data-target="#modal-tambahPanitia" role="button" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Admin</button><br>       
            <table id="example" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th id="th1">No</th>
                  <th id="th1">Nama</th>
                  <th id="th1">Alamat</th>
                  <th id="th1">No&nbsp;Telepon</th> 
                  <th id="th1">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1; 
                $result = mysqli_query($koneksi,"SELECT * FROM user WHERE level_user = 'admin'");
                while ($row = mysqli_fetch_array($result)) {
                  $id = $row['id_user'];
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama_user']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['no_telepon']; ?></td>
                    <td>
                      <a href="?page=editPanitia&id=<?php echo base64_encode($id) ?>" class="btn btn-warning btn-sm" title="edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                      <button onclick="Swal.fire({
                          title: 'Hapus Data Panitia ?',
                          showCancelButton: true,
                          confirmButtonColor: 'red',
                          cancelButtonColor: 'green',
                          confirmButtonText: 'Ya, Hapus'
                      }).then((result) => {
                          if (result.value) {
                            window.location.href='dataMaster/dataPanitia/proses.php?aksi=hapus&id=<?php echo base64_encode($id) ?>';
                          }
                      })" class="btn btn-danger btn-sm" title="hapus"><i class="fas fa-trash-alt"></i></button>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </section>
</div>