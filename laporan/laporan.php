<?php 
    $page = 'laporan';
    $title = 'Laporan';
    require_once('../_header.php');
    $outlet = $_SESSION['outlet'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laporan</h1>

    <!-- DataTales Example -->
    <div class="card border-left-primary shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Transaksi</h6>
            <div>
                <form action="cetak.php" target="_blank" method="POST">
                    <div class="input-group">                                    
                            <input value="<?= $_POST['tgl_awal'] ?>" type="hidden" name="tgl_awal" class="form-control">
                            <input value="<?= $_POST['tgl_akhir'] ?>" type="hidden" name="tgl_akhir" class="form-control">
                            <input value="<?= $_SESSION['level'] ?>" type="hidden" name="level" class="form-control">
                            <?php
                            if($_SESSION['level'] != 'admin'){ ?>
                                <input value="<?= $outlet ?>" type="hidden" name="outlet" class="form-control">
                            <?php
                            } ?>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-default" name="cetak"><i class="fas fa-download"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card-body">
                <div class="col-10">
                    <form action="" method="POST">
                        <div class="input-group">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Tanggal</span>
                                    </div>
                                    <input value="<?= $_POST['tgl_awal'] ?>" type="date" name="tgl_awal" class="form-control">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">s/d</span>
                                    </div>
                                    <input value="<?= $_POST['tgl_akhir'] ?>" type="date" name="tgl_akhir" class="form-control">
                                    <div class="input-group-prepend">
                                        <input type="submit" class="btn btn-primary" style="border-radius: 0rem 0.35rem 0.35rem 0rem;" name="submit" id="submit">
                                    </div>
                                </div>
                                <br>
                                <h6 style="color: red;">*Silahkan untuk klik kirim untuk preview data dan sebelum mencetak!!!</h6>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <?php if (isset($_POST['submit'])) : ?>
      <?php if (($_POST) > 0) :
        $mulai = $_POST['tgl_awal'];
        $akhir = $_POST['tgl_akhir'];
        //  Statement 1 
        
        if($_SESSION['level'] == 'admin') :
            if($mulai != null) {
                $datatrans = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai >= '$mulai'");
            }elseif($akhir != null) {
                $datatrans = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai <= '$akhir'");
            }elseif($mulai != null && $akhir != null) {
                $datatrans = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai BETWEEN '$mulai' AND '$akhir'");
            }else {
                $datatrans = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id");
            }
            
        else :
            if($mulai != null) {
                $datatrans = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai >= '$mulai' && ol.outlet_id = '$outlet'");
            }elseif($akhir != null) {
                $datatrans = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai <= '$akhir' && ol.outlet_id = '$outlet'");
            }elseif($mulai != null && $akhir != null) {
                $datatrans = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai BETWEEN '$mulai' AND '$akhir' && ol.outlet_id = '$outlet'");
            }else {
                $datatrans = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE ol.outlet_id = '$outlet'");
            }
            
        endif;
        ?>

        <hr class="sidebar-divider d-none d-md-block">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th>Kode Invoice</th>
                        <?php if($_SESSION['level'] != 'admin') {
                            echo '<th>Tanggal Order</th>';
                        } ?>
                        <th>Nama Pelanggan</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <?php if($_SESSION['level'] == 'admin') {
                            echo '<th>Outlet</th>';
                        } ?>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Kode Invoice</th>
                        <?php if($_SESSION['level'] != 'admin') {
                            echo '<th>Tanggal Order</th>';
                        } ?>
                        <th>Nama Pelanggan</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <?php if($_SESSION['level'] == 'admin') {
                            echo '<th>Outlet</th>';
                        } ?>                        
                        <th>Total</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    $no = 1;
                    foreach($datatrans as $t) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $t['order_id'] ?></td>
                        <?php if($_SESSION['level'] != 'admin') {
                            echo '<td>' . date("d".' '."F".' '."Y", strtotime($t['order_tglmulai'])) . '</td>';
                        } ?>
                        <td><?= $t['pelanggan_nama'] ?></td>
                        <td><?= $t['order_status'] ?></td>
                        <td><?= $t['transaksi_status'] ?></td>
                        <?php if($_SESSION['level'] == 'admin') {
                            echo '<td>' . $t['outlet_nama'] . '</td>';
                        } ?>
                        <td><?= 'Rp' . number_format($t['transaksi_totalbiaya'], 0 , '', '.'); ?></td>
                    </tr>          
                    <?php endforeach; ?>         
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        //  endif; ?>
            
      <?php endif ?>      
   <?php endif ?>
    
</div>

</div>
<!-- /.container-fluid -->

<?php 
	require_once('../_footer.php');
?>
