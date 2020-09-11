<?php 
	require_once('../_header.php');
	$id = $_GET['id'];
?>

<?php if (del_pelanggan($id) > 0) : 
    //  Statement 1 
    $_SESSION['psn'] = 'Data Pelanggan Berhasil Dihapus!!!';    
else : 
    //  Statement 2 
    $_SESSION['psnd'] = 'Data Pelanggan Gagal Dihapus!!!';
endif;

echo "<script>location.href='pelanggan.php';</script>"; ?>