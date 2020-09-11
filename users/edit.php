<?php 
  $title = 'Edit User';
  $page = 'users';
  require_once('../_header.php');
  $level = $_GET['level'];

  if ($level == 'admin') {
  $doutl = query("SELECT * FROM outlet");
  } elseif ($level == 'kasir') {
  $doutl = query("SELECT * FROM outlet WHERE EXISTS (SELECT user_outlet FROM user WHERE outlet.outlet_id = user.user_outlet AND user.user_level = 'owner')");
  } elseif ($level == 'owner') {
  $doutl = query("SELECT * FROM outlet WHERE NOT EXISTS (SELECT user_outlet FROM user WHERE outlet.outlet_id = user.user_outlet)");
  };
  $doa = query("SELECT * FROM outlet");
  $dok = query("SELECT * FROM outlet WHERE EXISTS (SELECT user_outlet FROM user WHERE outlet.outlet_id = user.user_outlet AND user.user_level = 'owner')");
  $dono = query("SELECT * FROM outlet WHERE NOT EXISTS (SELECT user_outlet FROM user WHERE outlet.outlet_id = user.user_outlet)");
  
  $id = $_GET['id'];
  $du = query("SELECT * FROM user WHERE user_id = '$id'")[0];
?>

<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
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
	<div class="card border-left-warning shadow mb-4">
	  <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-warning">Form Edit User</h6>
        <a href="<?= url('users/user.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
	  </div>
	  <div class="card-body">
        <form action="" method="post" class="form-input">
        <input type="hidden" name="id" value="<?= $du['user_id'] ?>">
            <div class="form-group px-3">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?=$du['user_nama']?>" placeholder="Nama" required autocomplete="off">
            </div>
            <div class="form-group px-3">
                <label for="">Username</label>
                <input type="text" class="form-control" name="uname" value="<?=$du['user_uname']?>" placeholder="Username" required autocomplete="off">
            </div>
            <div class="form-group px-3">
              <div class="row">
                <div class="col-6">
                  <label for="">Password</label>
                  <input type="password" class="form-control" name="pass" placeholder="Password" minlength="5">
                </div>
                <div class="col-6">
                  <label for="">Re-Password</label>
                  <input type="password" class="form-control" name="repass" placeholder="Re-Password" minlength="5">
                </div>
              </div>
            </div>
            <div class="form-group px-3">
              <div class="row">
                <div class="col-6">
                  <label for="">Nomor Telepon</label>
                  <input type="number" class="form-control" name="notelp" value="<?=$du['user_notelp']?>" placeholder="Nomor Telepon" required autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "15">
                </div>
                <div class="col-6">
                  <label for="">Email</label>
                  <input type="email" class="form-control" name="email" value="<?=$du['user_email']?>" placeholder="Email" required autocomplete="off">
                </div>
              </div>
            </div>
            
            <div class="form-group px-3" id="outall">
              <label for="outlet">Outlet</label>
              <select class="form-control" id="outlet" name="outlet">
                <option value="">-- Choose --</option>
                <?php
                foreach($doutl as $dol) : ?>
                  <option value="<?= $dol['outlet_id']; ?>" <?php if($dol['outlet_id'] == $du['user_outlet']){ echo 'selected';} ?>><?= $dol['outlet_nama'] ?></option>
                <?php
                endforeach; ?>
              </select>
            </div>
              <div class="form-group px-3" id="admin" style="display: none;">
              <label for="outlet">Outlet</label>
              <select class="form-control" id="outlet" name="outlet">
                <option value="">-- Choose --</option>
                <?php
                foreach($doa as $oa) : ?>
                  <option value="<?= $oa['outlet_id']; ?>" <?php if($oa['outlet_id'] == $du['user_outlet']){ echo 'selected';} ?>><?= $oa['outlet_nama'] ?></option>
                <?php
                endforeach; ?>
              </select>
            </div>
            <div class="form-group px-3" id="kasir" style="display: none;">
              <label for="outlet">Outlet</label>
              <select class="form-control" id="outlet" name="outlet">
                <option value="">-- Choose --</option>
                <?php
                foreach($dok as $ok) : ?>
                  <option value="<?= $ok['outlet_id']; ?>" <?php if($ok['outlet_id'] == $du['user_outlet']){ echo 'selected';} ?>><?= $ok['outlet_nama'] ?></option>
                <?php
                endforeach; ?>
              </select>
            </div> 
            <div class="form-group px-3" id="owner" style="display: none;">
              <label for="outlet">Outlet</label>
              <select class="form-control" id="outlet" name="outlet">
                <option value="">-- Choose --</option>
                <?php
                foreach($dono as $no) : ?>
                  <option value="<?= $no['outlet_id']; ?>" <?php if($no['outlet_id'] == $du['user_outlet']){ echo 'selected';} ?>><?= $no['outlet_nama'] ?></option>
                <?php
                endforeach; ?>
              </select>
            </div> 
            <div class="form-group px-3">
              <label for="level">Level</label>
              <select class="form-control" id="level" name="level" required autocomplete="off">
                <option value="">-Choose-</option>
                <option value="admin" <?php if($du['user_level'] == 'admin'){ echo 'selected';} ?>>Administrator</option>
                <option value="kasir" <?php if($du['user_level'] == 'kasir'){ echo 'selected';} ?>>Kasir</option>
                <option value="owner" <?php if($du['user_level'] == 'owner'){ echo 'selected';} ?>>Owner</option>
              </select>
            </div>
            <div class="form-footer pt-4 px-3 mt-4 border-top">
              <button type="reset" class="btn btn-secondary btn-default"><i class="fas fa-fw fa-sync-alt"></i> Reset</button>
              <button type="submit" class="btn btn-primary btn-default" name="update"><i class="fas fa-fw fa-save"></i> Update</button>
            </div> 
        </form>
	  </div>
	</div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<script>   
              $('#level').on('change', function() {
                if(this.value == ''){
                  $('#admin').hide();
                  $('#kasir').hide();
                  $('#owner').hide();
                  $('#outall').show();
                }else if(this.value == 'admin'){
                  $('#admin').show();
                  $('#kasir').hide();
                  $('#owner').hide();
                  $('#outall').hide();
                }else if(this.value == 'kasir'){
                  $('#admin').hide();
                  $('#kasir').show();
                  $('#owner').hide();
                  $('#outall').hide();
                }else if(this.value == 'owner'){
                  $('#admin').hide();
                  $('#kasir').hide();
                  $('#owner').show();
                  $('#outall').hide();
                }
              }); 
            </script>
<?php 
	require_once('../_footer.php');
?>
