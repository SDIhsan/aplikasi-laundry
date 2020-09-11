
<?php 
	require_once('../_header.php');
	$id = $_GET['id'];
?>

<?php if (del_paket($id) > 0) : 
    //  Statement 1 
    $_SESSION['psn'] = 'Data Paket Berhasil Dihapus!!!';    
else : 
    //  Statement 2 
    $_SESSION['psnd'] = 'Data Paket Gagal Dihapus!!!';
endif;

echo "<script>location.href='paket.php';</script>"; ?>