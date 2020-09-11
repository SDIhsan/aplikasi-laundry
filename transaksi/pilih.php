<?php 
    $page = 'transaksi';
    $title = 'Pilih Pelanggan';
    require_once('../_header.php');
    $outlet = $_SESSION['outlet'];
    if($_SESSION['level'] == 'admin'){
    $dplgv = query("SELECT * FROM pelanggan AS p JOIN outlet AS o ON p.pelanggan_outlet = o.outlet_id");
    }else{
        $dplgv = query("SELECT * FROM pelanggan AS p JOIN outlet AS o ON p.pelanggan_outlet = o.outlet_id WHERE p.pelanggan_outlet = '$outlet'");
    }
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pilih Pelanggan</h1>

    <!-- DataTales Example -->
    <div class="card border-left-info shadow mb-2">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-warning">Data Pelanggan</h6>
            <a href="<?= url('transaksi/transaksi.php') ?>" class="btn btn-danger btn-default"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th>Nomor KTP</th>
                    <th>Nama Pelanggan</th>
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
                    <th style="width: 5%;">No.</th>
                    <th>Nomor KTP</th>
                    <th>Nama Pelanggan</th>
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
                    <td><?= $plg['pelanggan_noktp'] ?></td>
                    <td><?= $plg['pelanggan_nama'] ?></td>
                    <td><?= $plg['pelanggan_notelp'] ?></td>
                    <?php if($_SESSION['level'] == 'admin') :
                    echo "<td>" . $plg['outlet_nama'] . "</td>";
                    endif; ?>
                    <td><?= $plg['pelanggan_alamat'] ?></td>
                    <td style="width: 5%;">
                        <div class="form-button-action">
                            <center>
                                <a type="button" href="<?= url('transaksi/add.php?id=') . $plg['pelanggan_id'] ?>" data-toggle="tooltip" title="Pilih <?= $plg['pelanggan_id'] ?>" class="btn btn-sm btn-info" data-original-title="Pilih <?= $plg['pelanggan_id'] ?>">
                                    <i class="fa fa-edit"></i> Pilih
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
