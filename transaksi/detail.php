<?php 
    $page = 'transaksi';
    $title = 'Detail Transaksi';
    require_once('../_header.php');
    $kode = "CIL" . date('Ymdsi');
    $id = $_GET['id'];
    $id_outlet = $_SESSION['outlet'];
    $id_user = $_SESSION['id_user'];

    $detorder = query("SELECT * FROM orders AS o JOIN pelanggan AS pl ON o.order_pelanggan = pl.pelanggan_id JOIN user AS u ON o.order_user = u.user_id JOIN outlet AS ol ON pl.pelanggan_outlet = ol.outlet_id JOIN paket AS p ON o.order_paket = p.paket_id WHERE o.order_id = '$id'");

?>

<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Detail Order</h1>
</div>
<?php if (isset($_POST['update'])) : ?>
      <?php if (det_order($_POST) > 0) :
        //  Statement 1 
        $_SESSION['psn'] = 'Detail Order Berhasil Diperbaharui!!!';
        echo "<script>location.href='transaksi.php';</script>";
    else : ?>
    <!-- Statement 2 -->
        <div class="alert alert-danger px-6" role="alert" id="psn">
        Detail Order Gagal Diperbaharui!!!
        </div>
    <?php endif; ?>   
<?php endif ?>
<!-- Content Row -->
<div class="row justify-content-center">
  <div class="col-lg-10 mb-4 p-1">
	<!-- Approach -->
	<div class="card border-left-info shadow mb-4">
	  <div class="card-header py-3 d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-info">Form Detail Order</h6>
    <a href="<?= url('transaksi/transaksi.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
	  </div>
	  <div class="card-body">
        <form action="" method="POST" class="form-input">
            <?php
            foreach($detorder as $dor) : ?>
            <input type="hidden" name="user" value="<?= $id_user ?>">
            <div class="form-group px-3">
                <label for="">Kode Invoice</label>
                <input type="text" class="form-control" name="kode" value="<?= $dor['order_id'] ?>" readonly>
            </div>
            
            <div class="form-group px-3">
                <label for="">Outlet</label>
                <input type="text" class="form-control" name="outletnama" value="<?= $dor['outlet_nama'] ?>" readonly>
                <input type="hidden" name="outlet" value="<?= $dor['outlet_id'] ?>">
            </div>
            <div class="form-group px-3">
                <label for="">Kasir</label>
                <input type="text" class="form-control" name="user" value="<?= $dor['user_nama']; ?>" readonly>
                <input type="hidden" name="plg" value="<?= $dor['user_id'] ?>">
            </div>
            <div class="form-group px-3">
                <label for="">Pelanggan</label>
                <input type="text" class="form-control" name="pelanggan" value="<?= $dor['pelanggan_nama']; ?>" readonly>
                <input type="hidden" name="plg" value="<?= $dor['pelanggan_id'] ?>">
            </div>
            <div class="form-group px-3">
                <label for="">Paket</label>
                <input type="text" class="form-control" name="paket" value="<?= $dor['paket_nama']; ?>" readonly>
                <input type="hidden" name="plg" value="<?= $dor['paket_id'] ?>">
            </div>
            <div class="form-group px-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Tanggal Masuk</label>
                        <input type="text" class="form-control" name="tglmulai" value="<?= date("d".' '."F".' '."Y", strtotime($dor['order_tglmulai'])); ?>" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tglselesai" value="<?= date('Y-m-d',strtotime($dor['order_tglselesai'])); ?>" placeholder="Tgl Diterima">
                    </div>
                </div>
            </div>
            <div class="form-group px-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Biaya Tambahan</label>
                        <input type="text" class="form-control" name="biayatam" value="<?= 'Rp' . number_format($dor['order_biayatambahan'],0,'','.') ?>" readonly>
                    </div>
                    <div class="col-lg-6">
                    <label for="">Diskon (%)</label>
                    <input type="number" class="form-control" name="diskon" value="<?= $dor['order_diskon'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group px-3">
              <label for="status">Status Order</label>
              <select class="form-control" id="status" name="status">
                <option value="">-- Choose --</option>
                <option value="Baru" <?php if($dor['order_status'] == 'Baru'){ echo 'selected';} ?>>Baru</option>
                <option value="Proses" <?php if($dor['order_status'] == 'Proses'){ echo 'selected';} ?>>Proses</option>
                <option value="Selesai" <?php if($dor['order_status'] == 'Selesai'){ echo 'selected';} ?>>Selesai</option>
                <option value="Diambil" <?php if($dor['order_status'] == 'Diambil'){ echo 'selected';} ?>>Diambil</option>
              </select>
            </div>            
            
            <div class="form-footer pt-4 px-3 mt-4 border-top">
              <button type="reset" class="btn btn-secondary btn-default"><i class="fas fa-fw fa-sync-alt"></i> Reset</button>
              <button type="submit" class="btn btn-primary btn-default" name="update"><i class="fas fa-fw fa-save"></i> Update</button>
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
