<?php 
  $page = 'outlet';
  $title = 'Add Outlet';
  require_once('../_header.php');
?>

<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Add Outlet</h1>
</div>
<?php if (isset($_POST['add'])) : ?>
      <?php if (add_outlet($_POST) > 0) :
        //  Statement 1 
        $_SESSION['psn'] = 'Data Outlet Berhasil Ditambahkan!!!';
        echo "<script>location.href='outlet.php';</script>";
         else : ?>
         <!-- Statement 2 -->
          <div class="alert alert-danger px-6" role="alert" id="psn">
            Data Outlet Gagal Ditambahkan!!!
          </div>
      <?php endif ?>      
   <?php endif ?>

<!-- Content Row -->
<div class="row justify-content-center">
  <div class="col-lg-10 mb-4 p-1">
	<!-- Approach -->
    <div class="card border-left-success shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-success">Form Add Outlet</h6>
        <a href="<?= url('outlet/outlet.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
      </div>
      <div class="card-body">
          <form action="" method="post" class="form-input">
              <div class="form-group px-3">
                  <label for="">Nama Oulet</label>
                  <input type="text" class="form-control" name="outlet" placeholder="Outlet" required autocomplete="off">
              </div>
              <div class="form-group px-3">
                  <label for="">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off">
              </div>
              <div class="form-group px-3">
                  <label for="">Nomor Telepon</label>
                  <input type="number" class="form-control" name="notelp" placeholder="Nomor Telepon" required autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "15">
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
