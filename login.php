<?php 
	require_once('_functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= url('assets/img/dryer.png') ?>" type="image" />
    <title>APLAUN | Login</title>
    <link rel="stylesheet" href="<?= url('assets/css/login.css') ?>" type="text/css">
    <style>
    .bodys{
        background: #00b09b;
        background: -webkit-linear-gradient(45deg, #8E2DE2, #4A00E0) !important;
        background: linear-gradient(45deg, #8E2DE2, #4A00E0) !important;
    }
    </style>
</head>
<body class="bodys">
    
	<?php 
		if (isset($_POST['login'])) {
			$uname = $_POST['uname'];
			$pass = $_POST['pass'];
            $data = mysqli_query($koneksi,"SELECT * FROM user WHERE user_uname = '$uname' ");
            $u = mysqli_fetch_assoc($data);

			if (mysqli_num_rows($data) > 0) {
                if(password_verify($pass, $u['user_pass'])){
                    $_SESSION['user'] = $uname;
                    $_SESSION['level'] = $u['user_level'];
                    $_SESSION['outlet'] = $u['user_outlet'];
                    $_SESSION['id_user'] = $u['user_id'];
					$_SESSION['login'] = true; ?>
						<script>window.location="index.php";</script>
                <?php
				}else {?>
					<div class="overlay">
						<div class="boxSalah">
							<a href="<?= url('login.php');?>" class="close">&times;</a>
							<p>Password Salah!</p>
						</div>
                    </div>	
				<?php 
				}
			}else{?>
				<div class="overlay">
					<div class="boxSalah">
						<a href="<?= url('login.php');?>" class="close">&times;</a>
						<p>Username & Password Salah!!!</p>
					</div>
				</div>
			<?php 
			}
		}
	?>
    <div class="form-login">
        <div class="contentx">
            <div class="col box__left">
                <div class="mt-2">
                    <h1 style="
                    color: #2B32B2 !important; 
                    animation-name: toRight;
	                animation-duration: 1.2s;
	                animation-timing-function: ease;
                    animation-iteration-count: 1;
                    "><b>APLAUN</b></h1>
                    <h3 style="
                    color: #fc4a1a !important;
                    animation-name: toLeft;
	                animation-duration: 1.2s;
	                animation-timing-function: ease;
                    animation-iteration-count: 1;
                    ">Aplikasi Pengelolaan Laundry</h3>
                </div>
                <div class="left-title">
                    <h4>Login</h4>
                </div>
                <div class="left-form">
                    <form action="" method="POST">
                        <div class="left-form-group">
                            <div class="input-form">
                                <input type="text" name="uname" placeholder="Username" required autocomplete="off">
                            </div>
                        </div>
                        <div class="left-form-group">
                            <div class="input-form">
                                <input type="password" name="pass" placeholder="Password" required autocomplete="off">
                            </div>
                        </div>
                        <div class="left-form-group">
                            <button type="submit" name="login" class="btn-login">Login</button>
                        </div>                        
                    </form>
                    <div class="copyright">
                        <p>Copyright &copy; 2020 | Design by <a href="https://github.com/rizqi07" target="_blank">Rizqi Setiaji</a> & <a href="https://www.instagram.com/azhargunawan00/?hl=id" target="_blank">Azhar Gunawan</a></p>
                    </div>
                </div>
            </div>
            <div class="col box__right">
				<div class="box__right-content">

					<img src=" <?= url('assets/img/orang.png')?>" alt="" class="box-img-orang">
					<img src=" <?= url('assets/img/celana.png')?>" alt="" class="box-img-celana">
					<img src=" <?= url('assets/img/kaos.png')?>" alt="" class="box-img-kaos">
					<img src=" <?= url('assets/img/kemeja.png')?>" alt="" class="box-img-kemeja">

					<!-- Bubble Variasi -->
					<div class="bubble-1"></div>
					<div class="bubble-2"></div>
					<div class="bubble-3"></div>
					<div class="bubble-4"></div>
					<div class="bubble-5"></div>
					<div class="bubble-6"></div>

					<!-- Garis Variasi -->
					<div class="garis garis-sm garis-1"></div>
					<div class="garis garis-md garis-2"></div>
					<div class="garis garis-sm garis-3"></div>
					<div class="garis garis-md garis-4"></div>
					<div class="garis garis-md garis-5"></div>
					<div class="garis garis-lg garis-6"></div>
					<div class="garis garis-lg garis-7"></div>
					<div class="garis garis-xl garis-8"></div>
					<div class="garis garis-sm garis-9"></div>
					<div class="garis garis-md garis-10"></div>
					<div class="garis garis-sm garis-11"></div>
					<div class="garis garis-md garis-12"></div>
				</div>
			</div>
        </div>
    </div>
</body>
</html>