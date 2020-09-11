<?php 
  $title = 'Add User';
  $page = 'users';
  require_once('../_header.php');
  if($_POST['level'] == 'admin'){
    $au = 'Administator';
    $doutl = query("SELECT * FROM outlet");
  }elseif ($_POST['level'] == 'kasir'){
    $au = 'Kasir';
    $doutl = query("SELECT * FROM outlet WHERE EXISTS (SELECT user_outlet FROM user WHERE outlet.outlet_id = user.user_outlet AND user.user_level = 'owner')");
  }elseif ($_POST['level'] == 'owner'){
    $au = 'Owner';
    $doutl = query("SELECT * FROM outlet WHERE NOT EXISTS (SELECT user_outlet FROM user WHERE outlet.outlet_id = user.user_outlet)");
  }
?>

<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Add User</h1>
</div>
<?php if (isset($_POST['add'])) : ?>
      <?php if (add_user($_POST) > 0) : 
      //  Statement 1 
      $_SESSION['psn'] = 'Data User Berhasil Ditambahkan!!!';
      echo "<script>location.href='user.php';</script>";
       else : ?>
       <!-- Statement 2 -->
        <div class="alert alert-danger px-6" role="alert" id="psn">
          Data User Gagal Ditambahkan!!!
        </div>
      <?php endif ?>      
   <?php endif ?>

<!-- Content Row -->
<div class="row justify-content-center">
  <div class="col-lg-10 mb-4 p-1">
	<!-- Approach -->
	<div class="card border-left-success shadow mb-4">
	  <div class="card-header py-3 d-flex justify-content-between">
      <h6 class="m-2 font-weight-bold text-success">Form Add User <?= $au; ?></h6>
      <a href="<?= url('users/user.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
	  </div>
	  <div class="card-body">
        <form action="" method="post" class="form-input">
        <input type="hidden" name="level" value="<?= $_POST['level'] ?>">
            <div class="form-group px-3">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama" required autocomplete="off">
            </div>
            <div class="form-group px-3">
                <label for="">Username</label>
                <input type="text" class="form-control" name="uname" placeholder="Username" required autocomplete="off">
            </div>
            <div class="form-group px-3">
              <div class="row">
                <div class="col-6">
                  <label for="">Password</label>
                  <input type="password" class="form-control" name="pass" placeholder="Password" required autocomplete="off" minlength="5">
                </div>
                <div class="col-6">
                  <label for="">Re-Password</label>
                  <input type="password" class="form-control" name="repass" placeholder="Re-Password" required autocomplete="off" minlength="5">
                </div>
              </div>
            </div>
            <div class="form-group px-3">
              <div class="row">
                <div class="col-6">
                  <label for="">Nomor Telepon</label>
                  <input type="number" class="form-control" name="notelp" placeholder="Nomor Telepon" required autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "15">
                </div>
                <div class="col-6">
                  <label for="">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off">
                </div>
              </div>
            </div>          
            <div class="form-group px-3">
              <label for="outlet">Outlet</label>
              <select class="form-control" name="outlet">
                <option value="">-- Choose --</option>
                <?php
                foreach($doutl as $dol) : ?>
                  <option value="<?= $dol['outlet_id']; ?>"><?= $dol['outlet_nama'] ?></option>
                <?php
                endforeach; ?>
              </select>
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
