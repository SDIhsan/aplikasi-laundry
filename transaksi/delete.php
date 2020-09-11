<?php 
	require_once('../_header.php');
	$id = $_GET['id'];
?>

<?php if (del_transaksi($id) > 0) : 
    //  Statement 1 
    $_SESSION['psn'] = 'Data Order Berhasil Dihapus!!!';    
else : 
    //  Statement 2 
    $_SESSION['psnd'] = 'Data Order Gagal Dihapus!!!';
endif;

echo "<script>location.href='transaksi.php';</script>"; ?>