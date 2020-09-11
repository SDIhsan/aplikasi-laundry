<?php 
	$page = 'dashboard';
	$title = 'Dashboard';
	require_once('_header.php');
	if($_SESSION['level'] == 'admin'){
		$qol = mysqli_query($koneksi,"SELECT COUNT(outlet_id) AS jumlah_outlet FROM outlet");
		$outlet = mysqli_fetch_assoc($qol);
		$qpel = mysqli_query($koneksi,"SELECT COUNT(pelanggan_id) AS jumlah_pelanggan FROM pelanggan");
		$pelanggan = mysqli_fetch_assoc($qpel);
		$qu = mysqli_query($koneksi,"SELECT COUNT(user_id) AS jumlah_user FROM user");
		$user = mysqli_fetch_assoc($qu);
		$qpkt = mysqli_query($koneksi,"SELECT COUNT(paket_id) AS jumlah_paket FROM paket");
		$paket = mysqli_fetch_assoc($qpkt);
		$qt = mysqli_query($koneksi,"SELECT COUNT(transaksi_id) AS jumlah_transaksi FROM transaksi");
		$transaksi = mysqli_fetch_assoc($qt);
		$qptotal = mysqli_query($koneksi,"SELECT SUM(transaksi_totalbayar) AS hasil_total FROM transaksi WHERE transaksi_status = 'Terbayar'");
		$ptotal = mysqli_fetch_assoc($qptotal);
		$qpt = mysqli_query($koneksi,"SELECT SUM(transaksi_totalbayar) AS hasil_tahun FROM transaksi WHERE transaksi_status = 'Terbayar' AND YEAR(transaksi_tglbayar) = YEAR(NOW())");
		$ptahun = mysqli_fetch_assoc($qpt);
		$qpb = mysqli_query($koneksi,"SELECT SUM(transaksi_totalbayar) AS hasil_bulan FROM transaksi WHERE transaksi_status = 'Terbayar' AND MONTH(transaksi_tglbayar) = MONTH(NOW())");
		$pbulan = mysqli_fetch_assoc($qpb);
		$qpm = mysqli_query($koneksi,"SELECT SUM(transaksi_totalbayar) AS hasil_minggu FROM transaksi WHERE transaksi_status = 'Terbayar' AND WEEK(transaksi_tglbayar) = WEEK(NOW())");
		$pminggu = mysqli_fetch_assoc($qpm);
	}else{
		$sol = $_SESSION['outlet'];
		$qol = mysqli_query($koneksi,"SELECT COUNT(outlet_id) AS jumlah_outlet FROM outlet WHERE outlet_id = '$sol'");
		$outlet = mysqli_fetch_assoc($qol);
		$qpel = mysqli_query($koneksi,"SELECT COUNT(pelanggan_id) AS jumlah_pelanggan FROM pelanggan WHERE pelanggan_outlet = '$sol'");
		$pelanggan = mysqli_fetch_assoc($qpel);
		$qpkt = mysqli_query($koneksi,"SELECT COUNT(paket_id) AS jumlah_paket FROM paket WHERE paket_outlet = '$sol'");
		$paket = mysqli_fetch_assoc($qpkt);
		$qt = mysqli_query($koneksi,"SELECT COUNT(transaksi_id) AS jumlah_transaksi FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE u.user_outlet = '$sol'");
		$transaksi = mysqli_fetch_assoc($qt);
		$qptotal = mysqli_query($koneksi,"SELECT SUM(transaksi_totalbayar) AS hasil_total FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE t.transaksi_status = 'Terbayar' && u.user_outlet = '$sol'");
		$ptotal = mysqli_fetch_assoc($qptotal);
		$qpt = mysqli_query($koneksi,"SELECT SUM(transaksi_totalbayar) AS hasil_tahun FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE t.transaksi_status = 'Terbayar' AND YEAR(transaksi_tglbayar) = YEAR(NOW()) && u.user_outlet = '$sol'");
		$ptahun = mysqli_fetch_assoc($qpt);
		$qpb = mysqli_query($koneksi,"SELECT SUM(transaksi_totalbayar) AS hasil_bulan FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE t.transaksi_status = 'Terbayar' AND MONTH(transaksi_tglbayar) = MONTH(NOW()) && u.user_outlet = '$sol'");
		$pbulan = mysqli_fetch_assoc($qpb);
		$qpm = mysqli_query($koneksi,"SELECT SUM(transaksi_totalbayar) AS hasil_minggu FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE t.transaksi_status = 'Terbayar' AND WEEK(transaksi_tglbayar) = WEEK(NOW()) && u.user_outlet = '$sol'");
		$pminggu = mysqli_fetch_assoc($qpm);
	}
?>
 <!-- Begin Page Content -->
 <div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>
	<!-- Content Row -->
	<div class="row">
	<?php if($_SESSION['level'] == 'admin') : ?>
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-2 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Outlet</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $outlet['jumlah_outlet'] ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-store-alt fa-2x text-gray-300"></i>
			</div>
			</div>
		</div>
		</div>
	</div>
	<?php endif; ?>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pelanggan</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pelanggan['jumlah_pelanggan'] ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-user fa-2x text-gray-300"></i>
			</div>
			</div>
		</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="<?php if($_SESSION['level'] == 'admin'){ echo 'col-xl-2';}else{ echo 'col-xl-3';} ?> col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Paket</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $paket['jumlah_paket'] ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-box fa-2x text-gray-300"></i>
			</div>
			</div>
		</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Transaksi</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $transaksi['jumlah_transaksi'] ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
			</div>
			</div>
		</div>
		</div>
	</div>

	<?php if($_SESSION['level'] == 'admin') : ?>
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-2 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah User</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user['jumlah_user'] ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-users fa-2x text-gray-300"></i>
			</div>
			</div>
		</div>
		</div>
	</div>
	<?php endif; ?>

	<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pendapatan Minggu Ini</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp' . number_format($pminggu['hasil_minggu'],0, '', '.'); ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-wallet fa-2x text-gray-300"></i>
			</div>
			</div>
		</div>
		</div>
	</div>
	<?php if($_SESSION['level'] != 'kasir') : ?>
		
	
	<!-- Earnings (Monthly) Card Example -->
	<div class="<?php if($_SESSION['level'] == 'owner'){ echo 'col-xl-4';}else{ echo 'col-xl-3';}; ?> col-md-6 mb-4">
		<div class="card border-left-secondary shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Pendapatan Bulan <?= date('F') ?></div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp' . number_format($pbulan['hasil_bulan'],0, '', '.'); ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-wallet fa-2x text-gray-300"></i>
			</div>
			</div>
		</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="<?php if($_SESSION['level'] == 'owner'){ echo 'col-xl-4';}else{ echo 'col-xl-3';}; ?> col-md-6 mb-4">
		<div class="card border-left-dark shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Pendapatan Tahun <?= date('Y') ?></div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp' . number_format($ptahun['hasil_tahun'],0, '', '.'); ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-wallet fa-2x text-gray-300"></i>
			</div>
			</div>
		</div>
		</div>
	</div>
	<?php endif; ?>

	
	<?php if($_SESSION['level'] != 'kasir') : ?>
	<!-- Earnings (Monthly) Card Example -->
	<div class="<?php if($_SESSION['level'] == 'owner'){ echo 'col-xl-4';}else{ echo 'col-xl-3';}; ?> col-md-6 mb-4">
		<div class="card border-left-light shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-black text-uppercase mb-1">Total Pendapatan</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp' . number_format($ptotal['hasil_total'],0, '', '.'); ?></div>
			</div>
			<div class="col-auto">
				<i class="fas fa-wallet fa-2x text-gray-300"></i>
			</div>
			</div>
		</div>
		</div>
	</div>
	<?php endif; ?>
	</div>

	<!-- Content Row -->
	<?php
		if($_SESSION['level'] == 'admin'){
			$jan = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '01'");
			$jn = mysqli_fetch_assoc($jan);
			$feb = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '02'");
			$fb = mysqli_fetch_assoc($feb);
			$mar = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '03'");
			$mr = mysqli_fetch_assoc($mar);
			$apr = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '04'");
			$ap = mysqli_fetch_assoc($apr);
			$mei = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '05'");
			$me = mysqli_fetch_assoc($mei);
			$jun = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '06'");
			$jn = mysqli_fetch_assoc($jun);
			$jul = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '07'");
			$jl = mysqli_fetch_assoc($jul);
			$ags = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '08'");
			$ag = mysqli_fetch_assoc($ags);
			$spt = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '09'");
			$sp = mysqli_fetch_assoc($spt);
			$okt = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '10'");
			$ok = mysqli_fetch_assoc($okt);
			$nov = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '11'");
			$no = mysqli_fetch_assoc($nov);
			$des = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '12'");
			$ds = mysqli_fetch_assoc($des);
			
			$t0 = date('Y');
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi WHERE YEAR(transaksi_tglbayar) = '$t0'");
			$ts = mysqli_fetch_assoc($tahunsekarang);
			$t1 = $t0 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi WHERE YEAR(transaksi_tglbayar) = '$t1'");
			$t1s = mysqli_fetch_assoc($tahunsekarang);
			$t2 = $t1 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi WHERE YEAR(transaksi_tglbayar) = '$t2'");
			$t2s = mysqli_fetch_assoc($tahunsekarang);
			$t3 = $t2 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi WHERE YEAR(transaksi_tglbayar) = '$t3'");
			$t3s = mysqli_fetch_assoc($tahunsekarang);
			$t4 = $t3 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi WHERE YEAR(transaksi_tglbayar) = '$t4'");
			$t4s = mysqli_fetch_assoc($tahunsekarang);
			$t5 = $t4 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi WHERE YEAR(transaksi_tglbayar) = '$t5'");
			$t5s = mysqli_fetch_assoc($tahunsekarang);
		}else{
			$sol = $_SESSION['outlet'];
			$jan = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '01' && u.user_outlet = '$sol'");
			$jn = mysqli_fetch_assoc($jan);
			$feb = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '02' && u.user_outlet = '$sol'");
			$fb = mysqli_fetch_assoc($feb);
			$mar = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '03' && u.user_outlet = '$sol'");
			$mr = mysqli_fetch_assoc($mar);
			$apr = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '04' && u.user_outlet = '$sol'");
			$ap = mysqli_fetch_assoc($apr);
			$mei = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '05' && u.user_outlet = '$sol'");
			$me = mysqli_fetch_assoc($mei);
			$jun = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '06' && u.user_outlet = '$sol'");
			$jn = mysqli_fetch_assoc($jun);
			$jul = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '07' && u.user_outlet = '$sol'");
			$jl = mysqli_fetch_assoc($jul);
			$ags = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '08' && u.user_outlet = '$sol'");
			$ag = mysqli_fetch_assoc($ags);
			$spt = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '09' && u.user_outlet = '$sol'");
			$sp = mysqli_fetch_assoc($spt);
			$okt = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '10' && u.user_outlet = '$sol'");
			$ok = mysqli_fetch_assoc($okt);
			$nov = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '11' && u.user_outlet = '$sol'");
			$no = mysqli_fetch_assoc($nov);
			$des = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS jumlah FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = YEAR(NOW()) AND MONTH(transaksi_tglbayar) = '12' && u.user_outlet = '$sol'");
			$ds = mysqli_fetch_assoc($des);
			
			$t0 = date('Y');
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = '$t0' && u.user_outlet = '$sol'");
			$ts = mysqli_fetch_assoc($tahunsekarang);
			$t1 = $t0 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = '$t1' && u.user_outlet = '$sol'");
			$t1s = mysqli_fetch_assoc($tahunsekarang);
			$t2 = $t1 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = '$t2' && u.user_outlet = '$sol'");
			$t2s = mysqli_fetch_assoc($tahunsekarang);
			$t3 = $t2 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = '$t3' && u.user_outlet = '$sol'");
			$t3s = mysqli_fetch_assoc($tahunsekarang);
			$t4 = $t3 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = '$t4' && u.user_outlet = '$sol'");
			$t4s = mysqli_fetch_assoc($tahunsekarang);
			$t5 = $t4 - 1;
			$tahunsekarang = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_totalbayar),0) AS total FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN user AS u ON o.order_user = u.user_id WHERE YEAR(transaksi_tglbayar) = '$t5' && u.user_outlet = '$sol'");
			$t5s = mysqli_fetch_assoc($tahunsekarang);
		}
	?>
	<div class="row">
	<!-- Area Chart -->
	<div class="col-xl-12 col-lg-7">
		<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header gradient-skyline py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-light">Pendapatan Per Bulan Tahun <?= date('Y') ?></h6>
		</div>
		<!-- Card Body -->
		<div class="card-body">
			<div class="chart-area">
			<canvas id="myAreaChart"></canvas>
			</div>
		</div>
		</div>
	</div>
	</div>
	<div class="row">
	<!-- Area Chart -->
	<div class="col-xl-12 col-lg-7">
		<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header gradient-orange py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-light">Pendapatan Per Tahun Dari Tahun <?= $t5 ?> - <?= $t0 ?></h6>
		</div>
		<!-- Card Body -->
		<div class="card-body">
			<div class="chart-area">
			<canvas id="myChart"></canvas>
			</div>
		</div>
		</div>
	</div>
	</div>
</div>

<script type="text/javascript">
	function number_format(number, decimals, dec_point, thousands_sep) {
		// *     example: number_format(1234.56, 2, ',', ' ');
		// *     return: '1 234,56'
		number = (number + '').replace('.', '').replace(' ', '');
		var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
			var k = Math.pow(10, prec);
				return '' + Math.round(n * k) / k;
			};
			// Fix for IE parseFloat(0.55).toFixed(0) = 0;
			s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
			if (s[0].length > 3) {
				s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
			}
			if ((s[1] || '').length < prec) {
				s[1] = s[1] || '';
				s[1] += new Array(prec - s[1].length + 1).join('0');
			}
			return s.join(dec);
		}
// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Pendapatan",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
		data: [<?= $jn['jumlah'] .','. $fb['jumlah'] .','. $mr['jumlah'] .','. $ap['jumlah'] .','. $me['jumlah'] .','. $jn['jumlah'] .','. $jl['jumlah'] .','. $ag['jumlah'] .','. $sp['jumlah'] .','. $ok['jumlah'] .','. $no['jumlah'] .','. $ds['jumlah'] ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
var ctx = document.getElementById("myChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [<?= $t5 .','. $t4 .','. $t3 .','. $t2 .','. $t1 .','. $t0 ?>],
    datasets: [{
      label: "Pendapatan",
      lineTension: 0.3,
      backgroundColor: "rgba(231, 74, 59, 0.05)",
      borderColor: "#f7b733",
      pointRadius: 3,
      pointBackgroundColor: "#f7b733",
      pointBorderColor: "#f7b733",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "#ee0979",
      pointHoverBorderColor: "#ee0979",
      pointHitRadius: 10,
      pointBorderWidth: 2,
		data: [<?= $t5s['total'] .','. $t4s['total'] .','. $t3s['total'] .','. $t2s['total'] .','. $t1s['total'] .','. $ts['total'] ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
</script>
<!-- /.container-fluid -->
<?php 
	require_once('_footer.php');
?>
