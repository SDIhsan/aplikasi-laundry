<?php 
    $page = 'transaksi';
    $title = 'Add Transaksi';
    require_once('../_header.php');
    $kode = "CIL" . date_create('now', timezone_open('Asia/Jakarta'))->format('YmdHis');
    $id = $_GET['id'];
    $id_outlet = $_SESSION['outlet'];
    $id_user = $_SESSION['id_user'];
    
    $doutq = "SELECT * FROM outlet WHERE outlet_id ='$id_outlet'";
    $dp = mysqli_query($koneksi, $doutq);
    $dout = mysqli_fetch_assoc($dp);

    $doutl = query('SELECT * FROM outlet');

    $dplgq = "SELECT * FROM pelanggan AS p INNER JOIN outlet AS o ON p.pelanggan_outlet = o.outlet_id WHERE p.pelanggan_id ='$id'";
    $dapel = mysqli_query($koneksi, $dplgq);
    $dplg = mysqli_fetch_assoc($dapel);

    $idol = $dplg['pelanggan_outlet'];
    $pkt = query("SELECT * FROM paket WHERE paket_outlet = '$idol'");

?>

<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">Add Transaksi</h1>
</div>
<?php if (isset($_POST['add'])) : ?>
    <?php if (add_trans($_POST) > 0) : 
        //  Statement 1 
        $_SESSION['psn'] = 'Data Order Berhasil Ditambahkan!!!';
        echo "<script>location.href='transaksi.php';</script>";
    else : ?>
    <!-- Statement 2 -->
        <div class="alert alert-danger px-6" role="alert" id="psn">
            Data Order Gagal Ditambahkan!!!
        </div>
    <?php endif ?>      
 <?php endif ?>
<!-- Content Row -->
<div class="row justify-content-center">
  <div class="col-lg-10 mb-4 p-1">
	<!-- Approach -->
	<div class="card border-left-success shadow mb-4">
	  <div class="card-header py-3 d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-success">Form Add Transaksi</h6>
    <a href="<?= url('transaksi/pilih.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
	  </div>
	  <div class="card-body">
        <form action="" method="POST" class="form-input">
            <input type="hidden" name="user" value="<?= $id_user ?>">
            <div class="form-group px-3">
                <label for="">Kode Invoice</label>
                <input type="text" class="form-control" name="kode" value="<?= $kode ?>" readonly>
            </div>            
            <div class="form-group px-3">
                <label for="">Outlet</label>
                <input type="text" class="form-control" name="outletnama" value="<?= $dplg['outlet_nama'] ?>" readonly>
                <input type="hidden" name="outlet" value="<?= $dplg['outlet_id'] ?>">
            </div>
            <div class="form-group px-3">
                <label for="">Pelanggan</label>
                <input type="text" class="form-control" name="pelanggan" value="<?= $dplg['pelanggan_nama']; ?>" readonly>
                <input type="hidden" name="plg" value="<?= $dplg['pelanggan_id'] ?>">
            </div>
            <div class="form-group px-3">
              <label for="paket">Paket</label>
              <select class="form-control" id="paket" name="paket" required autocomplete="off">
                <option value="">-- Choose --</option>
                <?php
                foreach($pkt as $p) : ?>
                  <option value="<?= $p['paket_id']; ?>"><?= $p['paket_nama'] . ' | ' . $p['paket_jenis'] ?></option>
                <?php
                endforeach; ?>
              </select>
            </div>
            <div class="form-group px-3">
                <label for="">Jumlah</label>
                <input type="number" class="form-control" name="qty" placeholder="Jumlah" required autocomplete="off">
            </div>
            <div class="form-group px-3">
                <label for="">Tanggal Diterima</label>
                <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tglmulai" required autocomplete="off">
            </div>
            <div class="form-group px-3">
                <label for="">Tanggal Selesai</label>
                <input type="date" class="form-control" name="tglselesai" required autocomplete="off">
            </div>
            <div class="form-group px-3">
                <label for="">Biaya Tambahan</label>
                <input type="number" class="form-control" name="biayatambahan" value="0">
            </div>
            <div class="form-group px-3">
                <label for="">Diskon (%)</label>
                <input type="number" class="form-control" name="diskon" value="0">
            </div>
            <div class="form-group px-3">
                <label for="">Keterangan</label>
                <textarea type="text" class="form-control" name="ket"></textarea>
            </div>
            <div class="form-footer pt-4 px-3 mt-4 border-top">
              <button type="reset" class="btn btn-secondary btn-default"><i class="fas fa-fw fa-sync-alt"></i> Reset</button>
              <button type="submit" class="btn btn-primary btn-default" name="add"><i class="fas fa-fw fa-save"></i> Submit</button>
            </div>           
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
