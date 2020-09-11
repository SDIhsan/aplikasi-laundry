<?php 
    $page = 'pelanggan';
    $title = 'Pelanggan';
    require_once('../_header.php');
    if($_SESSION['level'] == 'admin') {
        $dplgv = query("SELECT * FROM pelanggan AS p JOIN outlet AS o ON p.pelanggan_outlet = o.outlet_id");
    }else{
        $outlet = $_SESSION['outlet'];
        $dplgv = query("SELECT * FROM pelanggan AS p JOIN outlet AS o ON p.pelanggan_outlet = o.outlet_id WHERE p.pelanggan_outlet = '$outlet'");
    }
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pelanggan</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
            <a href="<?= url('pelanggan/add.php')?>" class="btn btn-success btn-sm text-uppercase">
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
                    <th>Nomor KTP</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <?php if($_SESSION['level'] == 'admin') :
                    echo '<th>Outlet</th>';
                    endif; ?>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Nomor KTP</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <?php if($_SESSION['level'] == 'admin') : 
                    echo '<th>Outlet</th>';
                    endif; ?>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $no = 1;
                foreach($dplgv as $plg) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $plg['pelanggan_nama'] ?></td>
                    <td><?= $plg['pelanggan_noktp'] ?></td>
                    <td><?= $plg['pelanggan_email'] ?></td>
                    <td><?= $plg['pelanggan_notelp'] ?></td>
                    <td><?= $plg['pelanggan_alamat'] ?></td>
                    <?php if($_SESSION['level'] == 'admin') :
                    echo "<td>" . $plg['outlet_nama'] . "</td>";
                    endif; ?>
                    <td style="width: 12%;">
                        <div class="form-button-action">
                            <center>
                                <a type="button" href="<?= url('pelanggan/detail.php?id=') . $plg['pelanggan_id'] ?>" data-toggle="tooltip" title="Detail <?= $plg['pelanggan_nama'] ?>" class="btn btn-sm btn-info" data-original-title="Detail <?= $plg['pelanggan_nama'] ?>">
                                    <i class="fa fa-info"></i>
                                </a>
                                <a type="button" href="<?= url('pelanggan/edit.php?id=') . $plg['pelanggan_id'] ?>" data-toggle="tooltip" title="Edit <?= $plg['pelanggan_nama'] ?>" class="btn btn-sm btn-warning" data-original-title="Edit <?= $plg['pelanggan_nama'] ?>">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" href="#delModal" data-toggle="modal" data-id="<?= $plg['pelanggan_id'] ?>" data-target="#delModal" class="btn btn-sm btn-danger delete" title="Delete <?= $plg['pelanggan_nama'] ?>" data-original-title="Delete <?= $plg['pelanggan_nama'] ?>">
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

<?php 
	require_once('../_footer.php');
?>
