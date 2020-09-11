<?php 
	require_once('_functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?= url('assets/img/dryer.png') ?>" type="image" />
  <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
  <title>APLAUN | <?= $title ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <!-- Custom styles for this template-->
  <link href="<?= url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?= url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
    .gradient-deepblue {
			background: #6a11cb;
			background: -webkit-linear-gradient(45deg, #6a11cb, #2575fc) !important;
			background: linear-gradient(45deg, #6a11cb, #2575fc) !important;
    }
    .text-orange{
      color: #fc4a1a !important;
      font-weight: bold;
    }
    .gradient-orange,
		.edit {
			background: #fc4a1a;
			color: #ffffff;
			background: -webkit-linear-gradient(45deg, #f7b733, #fc4a1a) !important;
			background: linear-gradient(45deg, #f7b733, #fc4a1a) !important;
    }
        
    .text-skyline{
      color: #2B32B2 !important;
      font-weight: bold;
    }

    .gradient-skyline {
			background: #00b09b;
			background: -webkit-linear-gradient(45deg, #1488CC, #2B32B2) !important;
			background: linear-gradient(45deg, #1488CC, #2B32B2) !important;
		}

  </style>
</head>

<body id="page-top">
<?php 
	if($_SESSION['login'] == false){
		header("location:login.php");
  };
  
  setlocale(LC_ALL, 'id_id');
  setlocale(LC_TIME, 'id_ID.utf8');
	?>
  <!-- Page Wrapper -->
  <div id="wrapper">
  <?php 
	require_once('_sidebar.php');
?>
