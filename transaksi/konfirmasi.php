<?php 
    $page = 'transaksi';
    $title = 'Konfirmasi Pembayaran';
    require_once('../_header.php');
    $kode = "CIL" . date('Ymdsi');
    $id = $_GET['id'];
    $id_outlet = $_SESSION['outlet'];
    $id_user = $_SESSION['id_user'];

    $dtransv = query("SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS pl ON o.order_pelanggan = pl.pelanggan_id JOIN outlet AS ol ON pl.pelanggan_outlet = ol.outlet_id JOIN paket AS p ON o.order_paket = p.paket_id WHERE t.transaksi_order = '$id'");

?>

<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Pembayaran</h1>
</div>
<?php if (isset($_POST['konfirm'])) : 
    if($_POST['jumlah'] >= $_POST['total']) :
    ?>    
      <?php if (konfirm_trans($_POST) > 0) : 
        //  Statement 1 
        $_SESSION['psn'] = 'Pembayaran Berhasil!!!';
        echo "<script>location.href='transaksi.php';</script>";
    else : ?>
    <!-- Statement 2 -->
        <div class="alert alert-danger px-6" role="alert" id="psn">
            Pembayaran Gagal!!!
        </div>
    <?php endif;
      elseif($_POST['jumlah'] <= $_POST['total']) : ?>
      <div class="alert alert-danger px-6" role="alert" id="psn">
            Pembayaran Gagal!!! Total Bayar Kurang!!!
        </div>
      <?php
         endif; ?>      
   <?php endif ?>
<!-- Content Row -->
<div class="row justify-content-center">
  <div class="col-lg-10 mb-4 p-1">
	<!-- Approach -->
	<div class="card border-left-info shadow mb-4">
	  <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Form Pembayaran</h6>
        <a href="<?= url('transaksi/list.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
	  </div>
	  <div class="card-body">
        <form action="" method="POST" class="form-input">
            <?php
            foreach($dtransv as $dt) : ?>
            <input type="hidden" name="user" value="<?= $id_user ?>">
            <div class="form-group px-3">
                <label for="">Kode Invoice</label>
                <input type="text" class="form-control" name="kode" value="<?= $dt['transaksi_order'] ?>" readonly>
            </div>
            
            <div class="form-group px-3">
                <label for="">Outlet</label>
                <input type="text" class="form-control" name="outletnama" value="<?= $dt['outlet_nama'] ?>" readonly>
                <input type="hidden" name="outlet" value="<?= $dt['outlet_id'] ?>">
            </div>
            <div class="form-group px-3">
                <label for="">Pelanggan</label>
                <input type="text" class="form-control" name="pelanggan" value="<?= $dt['pelanggan_nama']; ?>" readonly>
                <input type="hidden" name="plg" value="<?= $dt['pelanggan_id'] ?>">
            </div>
            <div class="form-group px-3">
                <label for="">Paket</label>
                <input type="text" class="form-control" name="paket" value="<?= $dt['paket_nama']; ?>" readonly>
                <input type="hidden" name="plg" value="<?= $dt['paket_id'] ?>">
            </div>
            <div class="form-group px-3">
                <label for="">Total</label>
                <input type="hidden" name="total" value="<?= $dt['transaksi_totalbiaya'] ?>">
                <input type="text" class="form-control" name="totalbiaya" value="<?= 'Rp' . number_format($dt['transaksi_totalbiaya'],0,'','.') ?>" readonly>
            </div>
            <div class="form-group px-3">
                <label for="">Keterangan</label>
                <textarea type="text" class="form-control" name="ket"><?= $dt['transaksi_ket'] ?></textarea>
            </div>
            <div class="form-group px-3">
                <label for="">Tanggal Bayar</label>
                <input type="date" class="form-control" name="tglbayar" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group px-3">
                <label for="">Jumlah Bayar</label>
                <input type="number" class="form-control" name="jumlah" value="0">
            </div>
            
            <div class="form-footer pt-4 px-3 mt-4 border-top">
              <button type="reset" class="btn btn-secondary btn-default"><i class="fas fa-fw fa-sync-alt"></i> Reset</button>
              <button type="submit" class="btn btn-primary btn-default" name="konfirm"><i class="fas fa-fw fa-save"></i> Confirm</button>
            </div>
            <?php endforeach; ?>           
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
