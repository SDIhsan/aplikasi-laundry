<?php 
    $page = 'paket';
    $title = 'Paket';
    require_once('../_header.php');
    $dpktv = query("SELECT * FROM paket AS p JOIN outlet AS o ON p.paket_outlet = o.outlet_id");
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Paket</h1>
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
    <div class="card border-left-primary shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Paket</h6>
            <a href="<?= url('paket/add.php')?>" class="btn btn-success btn-sm text-uppercase">
                <i class="fas fa-plus mr-1"></i> Add
            </a>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th>Nama Paket</th>
                    <th>Jenis</th>
                    <th>Tarif</th>
                    <th>Outlet</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Nama Paket</th>
                    <th>Jenis</th>
                    <th>Tarif</th>
                    <th>Outlet</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $no = 1;
                foreach($dpktv as $pkt) : ?>
                <tr>                    
                    <td><?= $no++ ?></td>
                    <td><?= $pkt['paket_nama'] ?></td>                    
                    <td><?= $pkt['paket_jenis'] ?></td>
                    <td><?= 'Rp' . number_format($pkt['paket_tarif'],0,'','.'); ?></td>
                    <td><?= $pkt['outlet_nama'] ?></td>
                    <td><?= $pkt['paket_ket'] ?></td>
                    <td style="width: 10%;">
                        <div class="form-button-action">
                            <center>
                                <a type="button" href="<?= url('paket/edit.php?id=') . $pkt['paket_id'] ?>" data-toggle="tooltip" title="Edit <?= $pkt['paket_nama'] ?>" class="btn btn-sm btn-warning" data-original-title="Edit <?= $pkt['paket_nama'] ?>">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" href="#delModal" data-toggle="modal" data-id="<?= $pkt['paket_id'] ?>" data-target="#delModal" class="btn btn-sm btn-danger delete" title="Delete <?= $pkt['paket_nama'] ?>" data-original-title="Delete <?= $pkt['paket_nama'] ?>">
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
