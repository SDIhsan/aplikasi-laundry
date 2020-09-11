<?php 
  $page = 'pelanggan';
  $title = 'Edit Pelanggan';
  require_once('../_header.php');
  if (isset($_GET['id'])){
    $id = $_GET['id'];
  };
   $dplg = query("SELECT * FROM pelanggan WHERE pelanggan_id = '$id'")[0];
   $doutl = query("SELECT * FROM outlet");
?>

<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Detail Pelanggan</h1>
</div>
<?php if (isset($_POST['update'])) : ?>
  <?php if (update_pelanggan($_POST) > 0) :
      //  Statement 1 
      $_SESSION['psn'] = 'Data Pelanggan Berhasil Diperbaharui!!!';
      echo "<script>location.href='pelanggan.php';</script>";
  else : ?>
  <!-- Statement 2 -->
      <div class="alert alert-danger px-6" role="alert" id="psn">
          Data Pelanggan Gagal Diperbaharui!!!
      </div>
  <?php endif ?>      
<?php endif ?>

<!-- Content Row -->
<div class="row justify-content-center">
  <div class="col-lg-10 mb-4 p-1">
	<!-- Approach -->
	<div class="card border-left-info shadow mb-4">
	  <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Detail Data Pelanggan</h6>
        <a href="<?= url('pelanggan/pelanggan.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
	  </div>
	  <div class="card-body">
            <div class="form-group px-3">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $dplg['pelanggan_nama'] ?>" placeholder="Nama" readonly>
            </div>
            <div class="form-group px-3">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $dplg['pelanggan_email'] ?>" placeholder="Email" readonly>
            </div>
            <div class="form-group px-3">
              <div class="row">
                  <div class="col-6">
                    <label for="">Nomor KTP</label>
                    <input type="text" class="form-control" name="noktp" value="<?= $dplg['pelanggan_noktp'] ?>" placeholder="Nomor KTP" readonly>
                </div>
                <div class="col-6">
                    <label for="">Nomor Telepon</label>
                    <input type="text" class="form-control" name="notelp" value="<?= $dplg['pelanggan_notelp'] ?>" placeholder="Nomor Telepon" readonly>
                </div>
              </div>
            </div>
            <div class="form-group px-3">
            <div class="row">
                <div class="<?php if($_SESSION['level'] == 'admin'){ echo 'col-6';}else{ echo 'col-12';} ?>">
                  <label for="jk">Jenis Kelamin</label>
                  <input type="text" class="form-control" name="notelp" value="<?php if($dplg['pelanggan_jk'] == 'L') {echo 'Laki-laki';}elseif($dplg['pelanggan_jk'] == 'P') {echo 'Perempuan';} ?>" placeholder="Jenis Kelamin" readonly>
                </div>
                <?php 
                  if($_SESSION['level'] == 'admin') : ?>
                  <div class="col-6">
                    <label for="outlet">Outlet</label>
                    <input type="text" class="form-control" name="outlet" value="<?php
                      foreach($doutl as $dol) : 
                        if($dol['outlet_id'] == $dplg['pelanggan_outlet']){
                            echo $dol['outlet_nama'];
                        };
                      endforeach; ?>" placeholder="Outlet" readonly>
                  </div>                
                <?php endif; ?>
              </div>
            </div>
            <div class="form-group px-3">
                <label for="">Alamat</label>
                <textarea type="text" class="form-control" name="alamat" readonly><?= $dplg['pelanggan_alamat'] ?></textarea>
            </div>
            <div class="form-group px-3">
                <label for="">Dibuat</label>
                <input type="text" class="form-control" name="created" value="<?= date("d".' '."F".' '."Y" . ' ' . "h:i:s", strtotime($dplg['pelanggan_created'])) ?>" placeholder="Created" readonly>
            </div>
	  </div>
	</div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<?php 
	require_once('../_footer.php');
?>
