<?php 
    $page = 'transaksi';
    $title = 'List Transaksi';
    require_once('../_header.php');
    $outlet = $_SESSION['outlet'];
    if($_SESSION['level'] == 'admin'){
        $dtv = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id WHERE t.transaksi_status = 'Belum'");
    }else{
        $dtv = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id WHERE t.transaksi_status = 'Belum' AND p.pelanggan_outlet = '$outlet'");
    }
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Konfirmasi Pembayaran</h1>

    <!-- DataTales Example -->
    <div class="card border-left-warning shadow mb-2">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-warning">Data Order</h6>
            <a href="<?= url('transaksi/transaksi.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
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
                        <td><?= 'Rp' . number_format($tv['transaksi_totalbiaya'],0,'','.') ?></td>
                        <td style="width: 10%;">
                            <div class="form-button-action">
                                <center>
                                    <a type="button" href="<?= url('transaksi/konfirmasi.php?id=') . $tv['order_id'] ?>" data-toggle="tooltip" class="btn btn-sm btn-info">
                                        <i class="fa fa-check"></i> Pilih
                                    </a>
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
