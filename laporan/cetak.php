<?php
$title = 'Cetak Laporan';
require '../_functions.php';

if(isset($_POST['tgl_awal']) AND isset($_POST['tgl_akhir'])){
$mulai = $_POST['tgl_awal'];
$akhir = $_POST['tgl_akhir'];
}
if(isset($_POST['outlet'])){
    $outlet = $_POST['outlet'];
}
if(isset($_POST['level'])){
    $level = $_POST['level'];
}
if($level != 'admin'){
    if($mulai != null) {
        $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai >= '$mulai' && ol.outlet_id = '$outlet'");
    }elseif($akhir != null) {
        $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai <= '$akhir' && ol.outlet_id = '$outlet'");
    }elseif($mulai != null && $akhir != null) {
        $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai BETWEEN '$mulai' AND '$akhir' && ol.outlet_id = '$outlet'");
    }else {
        $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE ol.outlet_id = '$outlet'");
    }    
    $ol = query("SELECT * FROM outlet WHERE outlet_id = '$outlet'");
}elseif($level == 'admin'){
    if($mulai != null) {
        $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai >= '$mulai'");
    }elseif($akhir != null) {
        $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai <= '$akhir'");
    }elseif($mulai != null && $akhir != null) {
        $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai BETWEEN '$mulai' AND '$akhir'");
    }else {
        $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id");
    }
}
setlocale(LC_ALL, 'id_id');
setlocale(LC_TIME, 'id_ID.utf8');
?>
<!DOCTYPE html>
<html>

<head>
    <title>APLAUN | <?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="icon" href="<?= url('assets/img/dryer.png') ?>" type="image" />
</head>

<body>
    <center>
        <br>
        <br>
        <h2>DATA LAPORAN TRANSAKSI LAUNDRY</h2>
        <?php if($level != 'admin') {
            foreach($ol as $o) :
            echo '<h4>' . $o['outlet_nama'] . '</h4>';
            endforeach;
        } ?>
        
        <?php
        if($mulai != null && $akhir != null) {
            $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai BETWEEN '$mulai' AND '$akhir'");
            echo "<h5>Tanggal : " . date("d".' '."F".' '."Y", strtotime($mulai)) . " - " . date("d".' '."F".' '."Y", strtotime($akhir)) . "</h5>";
        }elseif($mulai != null) {
            $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai >= '$mulai'");
            echo "<h5>Dari Tanggal : " . date("d".' '."F".' '."Y", strtotime($mulai)) . "</h5>";
        }elseif($akhir != null) {
            $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id WHERE o.order_tglmulai <= '$akhir'");
            echo "<h5>Sampai Tanggal : " . date("d".' '."F".' '."Y", strtotime($akhir)) . "</h5>";
        }elseif($mulai == null && $akhir == null) {
            $data = mysqli_query($koneksi,"SELECT * FROM transaksi AS t JOIN orders AS o ON t.transaksi_order = o.order_id JOIN pelanggan AS p ON o.order_pelanggan = p.pelanggan_id JOIN outlet AS ol ON p.pelanggan_outlet = ol.outlet_id");
            echo "<br>";            
        }
        ?>
        <!-- <h5>Tanggal : <?= date("d".' '."F".' '."Y", strtotime($mulai)) ?> - <?= date("d".' '."F".' '."Y", strtotime($akhir)) ?></h5> -->
        <h6><?= strftime('%A, %d %B %Y') ?></h6>
        <h6 class="mr-auto">Oleh : <?= $_SESSION['user']; ?></h6>
        <br>
    </center>
    <div class="px-3 mx-3">
    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 3%">#</th>
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
        <tbody>
            <?php
            $no = 1;
            if (mysqli_num_rows($data) > 0) {
                while ($trans = mysqli_fetch_assoc($data)) {
            ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $trans['order_id']; ?></td>
                        <?php if($level != 'admin') {
                            echo '<td>' . date("d".' '."F".' '."Y", strtotime($trans['order_tglmulai'])) . '</td>';
                        } ?>
                        <td><?= $trans['pelanggan_nama']; ?></td>
                        <td><?= $trans['order_status']; ?></td>
                        <td><?= $trans['transaksi_status']; ?></td>
                        <?php if($level == 'admin') {
                            echo '<td>' . $trans['outlet_nama'] . '</td>';
                        } ?>
                        <td><?= 'Rp' . number_format($trans['transaksi_totalbiaya'],0,'','.'); ?></td>
                    </tr>
            <?php }
            }
            ?>
        </tbody>
    </table>
    </div>
    <script>
        window.print();
    </script>

</body>

</html>