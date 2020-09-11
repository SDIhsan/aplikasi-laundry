<?php 
    $page = 'outlet';
    $title = 'Outlet';
    require_once('../_header.php');
    $doutlv = query("SELECT * FROM outlet");
    $duol = query("SELECT * FROM user WHERE user_level = 'owner'");
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Outlet</h1>
    <?php if (isset($_SESSION['psn']) && $_SESSION['psn'] <> '') { ?>
        <div class="alert alert-success" role="alert" id="psn">
            <?= $_SESSION['psn']; ?>
        </div>        
    <?php }elseif (isset($_SESSION['psnd']) && $_SESSION['psnd'] <> '') { ?>
        <div class="alert alert-success" role="alert" id="psn">
            <?= $_SESSION['psnd']; ?>
        </div>
        <?php };
    $_SESSION['psn'] = '';
    $_SESSION['psnd'] = ''; ?>
    <!-- DataTales Example -->
    <div class="p-1">
    <div class="card border-left-primary shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Outlet</h6>
            <a href="<?= url('outlet/add.php')?>" class="btn btn-success btn-sm text-uppercase">
                <i class="fas fa-plus mr-1"></i> Add
            </a>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th>Nama Outlet</th>
                    <th>Nama Pemilik</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Nama Outlet</th>
                    <th>Nama Pemilik</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $no = 1;
                foreach($doutlv as $outl) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $outl['outlet_nama'] ?></td>
                    <td><?php foreach($duol as $uol) : 
                        if($uol['user_outlet'] == $outl['outlet_id']) {echo $uol['user_nama'];} else { echo '';}  
                    endforeach; ?></td>
                    <td><?= $outl['outlet_notelp'] ?></td>
                    <td><?= $outl['outlet_email'] ?></td>
                    <td><?= $outl['outlet_alamat'] ?></td>
                    <td style="width: 10%;">
                        <div class="form-button-action">
                            <center>
                                <a type="button" href="<?= url('outlet/edit.php?id=') . $outl['outlet_id'] ?>" data-toggle="tooltip" title="Edit <?= $outl['outlet_nama'] ?>" class="btn btn-sm btn-warning" data-original-title="Edit <?= $outl['outlet_nama'] ?>">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="<?= $outl['outlet_id'] ?>" class="btn btn-sm btn-danger delete" title="Delete <?= $outl['outlet_nama'] ?>" data-original-title="Delete <?= $outl['outlet_nama'] ?>">
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

</div>
<!-- /.container-fluid -->

<?php 
	require_once('../_footer.php');
?>
