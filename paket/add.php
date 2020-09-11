<?php 
  $page = 'paket';
  $title = 'Add Paket';
    require_once('../_header.php');
    $doutl = query("SELECT * FROM outlet");
    $dolpkt = query("SELECT * FROM outlet WHERE EXISTS (SELECT user_outlet FROM user WHERE outlet.outlet_id = user.user_outlet)");
?>
 
<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Add Paket</h1>
</div>
<?php if (isset($_POST['add'])) : ?>
      <?php if (add_paket($_POST) > 0) :
         //  Statement 1 
        $_SESSION['psn'] = 'Data Paket Berhasil Ditambahkan!!!';
        echo "<script>location.href='paket.php';</script>";
         else : ?>
         <!-- Statement 2 -->
          <div class="alert alert-danger px-6" role="alert" id="psn">
            Data Paket Gagal Ditambahkan!!!
          </div>
      <?php endif ?>      
   <?php endif ?>

<!-- Content Row -->
<div class="row justify-content-center">
  <div class="col-lg-10 mb-4 p-1">
	<!-- Approach -->
    <div class="card border-left-success shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between">
          <h6 class="m-0 font-weight-bold text-success">Form Add Paket</h6>
          <a href="<?= url('paket/paket.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
      </div>
      <div class="card-body">
          <form action="" method="post" class="form-input">
              <div class="form-group px-3">
                  <label for="">Nama Paket</label>
                  <input type="text" class="form-control" name="paket" placeholder="Nama Paket" required autocomplete="off">
              </div>
              <div class="form-group px-3">
                <label for="outlet">Outlet</label>
                <select class="form-control" id="outlet" name="outlet" required autocomplete="off">
                  <option value="">-- Choose --</option>
                  <?php
                  foreach($dolpkt as $op) : ?>
                    <option value="<?= $op['outlet_id']; ?>"><?= $op['outlet_nama'] ?></option>
                  <?php
                  endforeach; ?>
                </select>
              </div>
              <div class="form-group px-3">
                <label for="jenis">Jenis Paket</label>
                <input type="text" class="form-control" name="jenis" placeholder="Jenis Paket" required autocomplete="off">
              </div>
              <div class="form-group px-3">
                  <label for="">Tarif</label>
                  <input type="number" class="form-control" name="tarif" placeholder="Tarif" required autocomplete="off">
              </div>            
              <div class="form-group px-3">
                  <label for="">Keterangan</label>
                  <textarea type="text" class="form-control" name="ket"></textarea>
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
