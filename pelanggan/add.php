<?php 
  $page = 'pelanggan';
  $title = 'Add Pelanggan';
  require_once('../_header.php');
  $doutl = query("SELECT * FROM outlet");
  $dolp = query("SELECT * FROM outlet WHERE EXISTS (SELECT user_outlet FROM user WHERE outlet.outlet_id = user.user_outlet)");
?>

<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Add Pelanggan</h1>
</div>
<?php if (isset($_POST['add'])) : ?>
      <?php if (add_pelanggan($_POST) > 0) : 
        //  Statement 1 
        $_SESSION['psn'] = 'Data Pelanggan Berhasil Ditambahkan!!!';
        echo "<script>location.href='pelanggan.php';</script>";
         else : ?>
         <!-- Statement 2 -->
          <div class="alert alert-danger px-6" role="alert" id="psn">
            Data Pelanggan Gagal Ditambahkan!!!
          </div>
      <?php 
      endif ?>      
   <?php endif ?>

<!-- Content Row -->
<div class="row justify-content-center">
  <div class="col-lg-10 mb-4 p-1">
	<!-- Approach -->
    <div class="card border-left-success shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-success">Form Add Pelanggan</h6>
        <a href="<?= url('pelanggan/pelanggan.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
      </div>
      <div class="card-body">
          <form action="" method="POST" class="form-input">
              <div class="form-group px-3">
                  <label for="">Nama</label>
                  <input type="text" class="form-control" name="nama" placeholder="Nama" required autocomplete="off">
              </div>
              <div class="form-group px-3">
                  <label for="">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off">
              </div>
              <div class="form-group px-3">
                <div class="row">
                  <div class="col-6">
                    <label for="">Nomor KTP</label>
                    <input type="number" class="form-control" name="noktp" placeholder="Nomor KTP" required autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "28">
                  </div>
                  <div class="col-6">
                      <label for="">Nomor Telepon</label>
                      <input type="number" class="form-control" name="notelp" placeholder="Nomor Telepon" required autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "15">
                  </div>
                </div>
              </div>
              <div class="form-group px-3">
                <div class="row">
                  <div class="<?php if($_SESSION['level'] == 'admin') { echo 'col-6';} else{ echo 'col-12';} ?>">
                    <label for="jk">Jenis Kelamin</label>
                    <select class="form-control" id="jk" name="jk" required autocomplete="off">
                      <option value="">-- Choose --</option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                  <?php 
                  if($_SESSION['level'] == 'admin') : ?>
                  <div class="col-6">
                    <label for="outlet">Outlet</label>
                    <select class="form-control" id="outlet" name="outlet" required autocomplete="off">
                      <option value="">-- Choose --</option>
                      <?php
                      foreach($dolp as $olp) : ?>
                        <option value="<?= $olp['outlet_id']; ?>"><?= $olp['outlet_nama'] ?></option>
                      <?php
                      endforeach; ?>
                    </select>
                  </div>
                
                <?php
                else : ?>
                    <input type="hidden" class="form-control" name="outlet" value="<?= $_SESSION['outlet']; ?>" placeholder="Outlet">
                <?php endif; ?>
                </div>
              </div>
              <div class="form-group px-3">
                  <label for="">Alamat</label>
                  <textarea type="text" class="form-control" name="alamat" required autocomplete="off"></textarea>
              </div>
              <div class="form-footer pt-4 px-3 mt-4 border-top">
                <button type="reset" class="btn btn-secondary btn-default"><i class="fas fa-fw fa-sync-alt"></i> Reset</button>
                <button type="submit" class="btn btn-primary btn-default" name="add"><i class="fas fa-fw fa-save"></i> Submit</button>
              </div>           
          </form>
      </div>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<?php 
	require_once('../_footer.php');
?>
