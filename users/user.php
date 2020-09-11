<?php 
    $page = 'users';
    $title = 'Users';
    require_once('../_header.php');
    $duv = query("SELECT * FROM user");
    $outl = query("SELECT * FROM outlet");
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <?php if (isset($_SESSION['psn']) && $_SESSION['psn'] <> '') { ?>
        <div class="alert alert-success" role="alert" id="psn">
            <?= $_SESSION['psn']; ?>
        </div>        
    <?php }elseif (isset($_SESSION['psnd']) && $_SESSION['psnd'] <> '') { ?>
        <div class="alert alert-success" role="alert" id="psn">
            <?= $_SESSION['psnd']; ?>
        </div>
        <?php };
    $_SESSION['psn'] = ''; ?>
    <!-- DataTales Example -->
    <div class="card border-left-primary shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
            <a href="#lvlUser" class="btn btn-success btn-sm text-uppercase" data-toggle="modal" data-target="#lvlUser">
                <i class="fas fa-plus mr-1"></i> Add
            </a>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <?php if($_SESSION['level'] == 'admin') :
                    echo '<th>Outlet</th>';
                    endif; ?>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <?php if($_SESSION['level'] == 'admin') :
                    echo '<th>Outlet</th>';
                    endif; ?>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $no = 1;
                foreach($duv as $uv) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $uv['user_nama'] ?></td>
                    <td><?= $uv['user_uname'] ?></td>
                    <td><?= $uv['user_email'] ?></td>
                    <td><?= $uv['user_notelp'] ?></td>
                    <?php if($_SESSION['level'] == 'admin') :
                    echo "<td>"; 
                    foreach($outl as $o) : 
                        if($o['outlet_id'] == $uv['user_outlet']){
                            echo $o['outlet_nama'];
                        }
                    endforeach;
                    echo "</td>";
                    endif; ?>
                    <td style="width: 9%;"><?= $uv['user_level'] ?></td>
                    <td style="width: 12%;">
                        <div class="form-button-action">
                            <center>
                                <a type="button" href="<?= url('users/detail.php?id=') . $uv['user_id'] ?>" data-toggle="tooltip" title="Detail <?= $uv['user_nama'] ?>" class="btn btn-sm btn-info" data-original-title="Detail <?= $uv['user_nama'] ?>">
                                    <i class="fa fa-info"></i>
                                </a>
                                <a type="button" href="<?= url('users/edit.php?level=') . $uv['user_level'] . '&' . 'id=' . $uv['user_id']?>" data-toggle="tooltip" title="Edit <?= $uv['user_nama'] ?>" class="btn btn-sm btn-warning" data-original-title="Edit <?= $uv['user_nama'] ?>">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" href="#delModal" data-toggle="modal" data-id="<?= $uv['user_id'] ?>" data-target="#delModal" class="btn btn-sm btn-danger delete" title="Delete <?= $uv['user_nama'] ?>" data-original-title="Delete <?= $uv['user_nama'] ?>">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </center>                  
                        </div>
                    </td>
                </tr>          
                <?php endforeach; ?>       
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<!-- /.container-fluid -->
<div class="modal fade" id="lvlUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Level User!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= url('users/add.php') ?>" method="POST" class="form-input">                    
                <div class="modal-body">
                    <label for="level">Level User :</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="admin" id="admin" type="radio" name="level" required>
                        <label class="custom-control-label" for="admin">Administrator</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="owner" id="owner" type="radio" name="level" required>
                        <label class="custom-control-label" for="owner">Owner</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="kasir" id="kasir" type="radio" name="level" required>
                        <label class="custom-control-label" for="kasir">Kasir</label>
                    </div>
                </div>
                <div class="modal-body">Klik "Lanjut" jika ingin melanjutkan!</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Lanjut</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
	require_once('../_footer.php');
?>
