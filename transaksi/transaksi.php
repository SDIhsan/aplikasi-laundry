<?php 
    $title = 'Transaksi';
    $page = 'transaksi';
    require_once('../_header.php');
    $user = $_SESSION['id_user'];
    $outlet = $_SESSION['outlet'];
    if($_SESSION['level'] != 'admin') : 
        $dtv = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id WHERE p.pelanggan_outlet = '$outlet'");
    else :
        $dtv = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id");
    endif;
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Transaksi</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            <div class="align-content-right">
                <a href="<?= url('transaksi/pilih.php')?>" class="btn btn-success btn-sm text-uppercase">
                    <i class="fas fa-plus mr-1"></i> Add
                </a>
                <a href="<?= url('transaksi/list.php')?>" class="btn btn-warning btn-sm text-uppercase">
                    <i class="fas fa-check mr-1"></i> Konfirmasi Pembayaran
                </a>
            </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th style="width: 5%;">No.</th>
                <th>Tanggal</th>
                    <th>Kode Invoice</th>
                    <th>Nama Pelanggan</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Kode Invoice</th>
                    <th>Nama Pelanggan</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Total</th>
                    <th>Action</th>                   
                </tr>
                </tfoot>
                <tbody>
                <?php
                $no = 1;
                foreach($dtv as $tv) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date("d" . " " . "F" . " '" . "y", strtotime($tv['order_tglmulai'])) ?></td>
                        <td><?= $tv['order_id'] ?></td>
                        <td><?= $tv['pelanggan_nama'] ?></td>
                        <td><?= $tv['order_status'] ?></td>
                        <td><?= $tv['transaksi_status'] ?></td>
                        <td><?= 'Rp' . number_format($tv['transaksi_totalbiaya'],0,'','.'); ?></td>
                        <td style="width: 10%;">
                            <div class="form-button-action">
                                <center>
                                    <a type="button" href="<?= url('transaksi/detail.php?id=') . $tv['transaksi_order'] ?>" data-toggle="tooltip" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a type="button" href="#delModal" data-toggle="modal" data-id="<?= $tv['transaksi_order'] ?>" data-target="#delModal" class="btn btn-sm btn-danger delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </center>                
                            </div>
                        </td>
                    </tr>          
                    <?php 
                    endforeach;
                ?>         
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
