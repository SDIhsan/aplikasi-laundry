<?php 
  $title = 'Edit User';
  $page = 'users';
  require_once('../_header.php');
  $outl = query("SELECT * FROM outlet");
  
  $id = $_GET['id'];
    $du = query("SELECT * FROM user WHERE user_id = '$id'")[0];
?>

<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Detail User</h1>
</div>
<?php if (isset($_POST['update'])) : ?>
      <?php if (update_user($_POST) > 0) : 
        //  Statement 1 
            $_SESSION['psn'] = 'Data User Berhasil Diperbaharui!!!';
            echo "<script>location.href='user.php';</script>";
        else : ?>
        <!-- Statement 2 -->
            <div class="alert alert-danger px-6" role="alert" id="psn">
                Data User Gagal Diperbaharui!!!
            </div>
        <?php endif ?>      
      <?php endif ?>
<!-- Content Row -->
<div class="row justify-content-center">
  <div class="col-lg-10 mb-4 p-1">
	<!-- Approach -->
	<div class="card border-left-info shadow mb-4">
	  <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Detail Data User</h6>
        <a href="<?= url('users/user.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
	  </div>
	  <div class="card-body">
            <div class="form-group px-3">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $du['user_nama'] ?>" placeholder="Nama" readonly>
            </div>
            <div class="form-group px-3">
                <label for="">Username</label>
                <input type="text" class="form-control" name="uname" value="<?= $du['user_uname'] ?>" placeholder="Username" readonly>
            </div>
            <div class="form-group px-3">
              <div class="row">
                <div class="col-6">
                  <label for="">Nomor Telepon</label>
                  <input type="number" class="form-control" name="notelp" value="<?= $du['user_notelp'] ?>" placeholder="Nomor Telepon" readonly>
                </div>
                <div class="col-6">
                  <label for="">Email</label>
                  <input type="email" class="form-control" name="email" value="<?= $du['user_email'] ?>" placeholder="Email" readonly>
                </div>
              </div>
            </div>
            <div class="form-group px-3">
              <div class="row">
                <div class="col-6">
                  <label for="">Outlet</label>                  
                  <input type="text" class="form-control" name="outlet" value="<?php
                  foreach($outl as $o) : 
                    if($o['outlet_id'] == $du['user_outlet']){
                        echo $o['outlet_nama'];
                    };
                endforeach;
                  ?>" placeholder="" readonly>
                </div>
                <div class="col-6">
                  <label for="">Level</label>
                  <?php
                  if($du['user_level'] == 'kasir'){
                      $lvl = 'Kasir';
                  }elseif($du['user_level'] == 'owner'){
                      $lvl = 'Owner';
                    }else{
                        $lvl = 'Administrator';
                    } ?>
                  <input type="text" class="form-control" name="level" value="<?= $lvl ?>" placeholder="Level" readonly>
                </div>
              </div>
            </div>
            <div class="form-group px-3">
                <label for="">Dibuat</label>
                <input type="text" class="form-control" name="created" value="<?= date("d".' '."F".' '."Y" . ' ' . "h:i:s", strtotime($du['user_created'])) ?>" placeholder="Created" readonly>
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
