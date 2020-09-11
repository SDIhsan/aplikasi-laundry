<?php 
	require_once('../_header.php');
	$id = $_GET['id'];
?>

<?php if (del_user($id) > 0) : 
    //  Statement 1 
    $_SESSION['psn'] = 'Data User Berhasil Dihapus!!!';    
else : 
    //  Statement 2 
    $_SESSION['psnd'] = 'Data User Gagal Dihapus!!!';
endif;

echo "<script>location.href='user.php';</script>"; ?>