<?php 
	require_once('../_header.php');
	$id = $_GET['id'];
?>

<?php if (del_outlet($id) > 0) : 
    //  Statement 1 
    $_SESSION['psn'] = 'Data Outlet Berhasil Dihapus!!!';    
else : 
    //  Statement 2 
    $_SESSION['psnd'] = 'Data Outlet Gagal Dihapus!!!';
endif;

echo "<script>location.href='outlet.php';</script>"; ?>

