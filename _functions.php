<?php 

session_start();


// Koneksi Ke database
$host	= 'localhost';
$user = 'root';
$pass	= '';
$db	= 'aplaun';

// Koneksi ke Database
$koneksi = mysqli_connect($host,$user,$pass,$db);

// Fungsi untuk menampilkan semua query dari database
function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

// Fungsi Absolute URL
// Absolute url merupakan Serangkaian alamat yang menunjukkan suatu dokumen atau direktori, dengan menyertakan alamat domain atau host
function url($url = null){
	$url_utama = "http://localhost/aplikasi-laundry";
	// $url_utama = "http://localhost/aplaun";
	// $url_utama = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if ($url != null) {
		return $url_utama . '/' . $url;
	}else{
		return $url_utama;
	}
}
//paket
//add paket
function add_paket($data_pkt){
	global $koneksi;
	$paket 	= htmlspecialchars($data_pkt['paket']);
	$outlet 	= htmlspecialchars($data_pkt['outlet']);
	$jenis	= htmlspecialchars($data_pkt['jenis']);
	$tarif	= htmlspecialchars($data_pkt['tarif']);
	$ket	= htmlspecialchars($data_pkt['ket']);

	$query = "INSERT INTO paket(paket_nama,paket_outlet,paket_jenis,paket_tarif,paket_ket) VALUES(
		'$paket','$outlet','$jenis','$tarif','$ket'
	)";
	mysqli_query($koneksi,$query);
	return mysqli_affected_rows($koneksi);
}

//update paket
function update_paket($edit_pkt){
    global $koneksi;
    $id = $edit_pkt['id'];
	$paket 	= htmlspecialchars($edit_pkt['paket']);
	$outlet 	= htmlspecialchars($edit_pkt['outlet']);
	$jenis	= htmlspecialchars($edit_pkt['jenis']);
	$tarif	= htmlspecialchars($edit_pkt['tarif']);
	$ket	= htmlspecialchars($edit_pkt['ket']);

	$query = "UPDATE paket SET
        paket_nama = '$paket',
        paket_outlet = '$outlet',
        paket_jenis = '$jenis',
        paket_tarif = '$tarif',
        paket_ket = '$ket'
		WHERE paket_id = '$id'
	";
	mysqli_query($koneksi,$query);
	return mysqli_affected_rows($koneksi);
}

//delete paket
function del_paket($del_pkt){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM paket WHERE paket_id = '$del_pkt'");
	return mysqli_affected_rows($koneksi);
}

//pelanggan
//add pelanggan
function add_pelanggan($data_plg){
	global $koneksi;

	$nama 	= htmlspecialchars($data_plg['nama']);
	$email 	= htmlspecialchars($data_plg['email']);
	$noktp 	= htmlspecialchars($data_plg['noktp']);
	$notelp	= htmlspecialchars($data_plg['notelp']);
	$jk 	= htmlspecialchars($data_plg['jk']);
	$outlet = htmlspecialchars($data_plg['outlet']);
	$alamat	= htmlspecialchars($data_plg['alamat']);
	$created = date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s');

	$query = "INSERT INTO pelanggan(pelanggan_noktp,pelanggan_nama,pelanggan_email,pelanggan_notelp,pelanggan_jk,pelanggan_outlet,pelanggan_alamat,pelanggan_created) VALUES (
		'$noktp','$nama','$email','$notelp','$jk','$outlet','$alamat','$created'
	)";
	mysqli_query($koneksi,$query);
	return mysqli_affected_rows($koneksi);
}

//update pelanggan
function update_pelanggan($edit_plg){
	global $koneksi;	
    $id = $edit_plg['id'];
	$nama 	= htmlspecialchars($edit_plg['nama']);
	$email 	= htmlspecialchars($edit_plg['email']);
	$noktp 	= htmlspecialchars($edit_plg['noktp']);
	$notelp	= htmlspecialchars($edit_plg['notelp']);
	$jk	= htmlspecialchars($edit_plg['jk']);
	$outlet = htmlspecialchars($edit_plg['outlet']);
	$alamat	= htmlspecialchars($edit_plg['alamat']);

	$query = "UPDATE pelanggan SET
    pelanggan_nama = '$nama',
    pelanggan_email = '$email',
	pelanggan_noktp = '$noktp',
    pelanggan_notelp = '$notelp',
	pelanggan_jk = '$jk',
	pelanggan_outlet = '$outlet',
    pelanggan_alamat = '$alamat'
    WHERE pelanggan_id = '$id'
    ";
	mysqli_query($koneksi,$query);
	return mysqli_affected_rows($koneksi);
}

//delete pelanggan
function del_pelanggan($del_plg){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM pelanggan WHERE pelanggan_id = '$del_plg'");
	return mysqli_affected_rows($koneksi);
}

//outlet
//add outlet
function add_outlet($data_outl){
	global $koneksi;
    $outlet = htmlspecialchars($data_outl['outlet']);
	$email 	= htmlspecialchars($data_outl['email']);
	$notelp	= htmlspecialchars($data_outl['notelp']);
	$alamat	= htmlspecialchars($data_outl['alamat']);

	$query = "INSERT INTO outlet(outlet_nama,outlet_email,outlet_notelp,outlet_alamat) VALUES (
		'$outlet','$email','$notelp','$alamat'
	)";
	mysqli_query($koneksi,$query);
	return mysqli_affected_rows($koneksi);
}

//update outlet
function update_outlet($edit_outl){
    global $koneksi;
    $id         = $edit_outl['id'];
    $outlet     = htmlspecialchars($edit_outl['outlet']);
	$email 	    = htmlspecialchars($edit_outl['email']);
	$notelp	    = htmlspecialchars($edit_outl['notelp']);
	$alamat	    = htmlspecialchars($edit_outl['alamat']);

	$query = "UPDATE outlet SET
    outlet_nama = '$outlet',
    outlet_email = '$email',
    outlet_notelp = '$notelp',
    outlet_alamat = '$alamat'
    WHERE outlet_id = '$id'
    ";
	mysqli_query($koneksi,$query);
	return mysqli_affected_rows($koneksi);
}

//delete outlet
function del_outlet($del_outl){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM outlet WHERE outlet_id = '$del_outl'");
	return mysqli_affected_rows($koneksi);
}

//user
//add user
function add_user($data_user){
	global $koneksi;
    $nama	= htmlspecialchars($data_user['nama']);
    $uname 	= htmlspecialchars($data_user['uname']);
    $pass 	= htmlspecialchars($data_user['pass']);
    $repass = htmlspecialchars($data_user['repass']);
    $notelp	= htmlspecialchars($data_user['notelp']);
	$email	= htmlspecialchars($data_user['email']);
    $outlet	= htmlspecialchars($data_user['outlet']);
	$level	= htmlspecialchars($data_user['level']);
	$created = date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s');

    if($pass == $repass){
		if($level != 'admin'){
			$rpass = password_hash($repass,PASSWORD_DEFAULT);
			$query = "INSERT INTO user (user_nama, user_uname, user_pass, user_notelp, user_email, user_outlet, user_level, user_created) VALUES (
				'$nama', '$uname', '$rpass', '$notelp', '$email', '$outlet', '$level', '$created'
			)";
			mysqli_query($koneksi,$query);
			
		}elseif($level == 'admin'){
			if($outlet != null){
				$rpass = password_hash($repass,PASSWORD_DEFAULT);
				$query = "INSERT INTO user (user_nama, user_uname, user_pass, user_notelp, user_email, user_outlet, user_level, user_created) VALUES (
					'$nama', '$uname', '$rpass', '$notelp', '$email', '$outlet', '$level', '$created'
				)";
			}else{
				$rpass = password_hash($repass,PASSWORD_DEFAULT);
				$query = "INSERT INTO user (user_nama,user_uname,user_pass,user_notelp,user_email,user_level, user_created) VALUES (
					'$nama','$uname','$rpass','$notelp','$email','$level', '$created'
			)";
			}
        mysqli_query($koneksi,$query);
		}
// 		die('Query Error : '.mysqli_errno($koneksi). 
//    ' - '.mysqli_error($koneksi));
    }
	return mysqli_affected_rows($koneksi);
}

//update user
function update_user($edit_user){
    global $koneksi;
    $id = $edit_user['id'];
    $nama	= htmlspecialchars($edit_user['nama']);
    $uname 	= htmlspecialchars($edit_user['uname']);
    $pass 	= htmlspecialchars($edit_user['pass']);
    $repass = htmlspecialchars($edit_user['repass']);
    $notelp	= htmlspecialchars($edit_user['notelp']);
	$email	= htmlspecialchars($edit_user['email']);
    $outlet	= htmlspecialchars($edit_user['outlet']);
    $level	= htmlspecialchars($edit_user['level']);

    if($repass != null && $pass == $repass){
        $rpass = password_hash($repass,PASSWORD_DEFAULT);
        $query = "UPDATE user SET
        user_nama = '$nama',
        user_uname = '$uname',
        user_pass = '$rpass',
        user_notelp = '$notelp',
        user_email = '$email',
        user_outlet = '$outlet',
        user_level = '$level'
        WHERE user_id = '$id'
        ";
        mysqli_query($koneksi,$query);
	}elseif($pass == null || $repass == null || $pass == null && $repass == null){
		if($outlet != null){
		$query = "UPDATE user SET
        user_nama = '$nama',
        user_uname = '$uname',
        user_notelp = '$notelp',
        user_email = '$email',
		user_outlet = '$outlet',
        user_level = '$level'
        WHERE user_id = '$id'
        ";
		mysqli_query($koneksi,$query);

		}else{
			
		$query = "UPDATE user SET
        user_nama = '$nama',
        user_uname = '$uname',
        user_notelp = '$notelp',
        user_email = '$email',
        user_level = '$level'
        WHERE user_id = '$id'
        ";
		mysqli_query($koneksi,$query);

		};
	};

	return mysqli_affected_rows($koneksi);
}

//delete user
function del_user($del_user){
	global $koneksi;
	mysqli_query($koneksi,"DELETE FROM user WHERE user_id = '$del_user'");
	return mysqli_affected_rows($koneksi);
}

//transaksi
//add transaksi
function add_trans($data_trans){
	global $koneksi;
    $order	= htmlspecialchars($data_trans['kode']);
    $paket 	= htmlspecialchars($data_trans['paket']);
    $qty 	= htmlspecialchars($data_trans['qty']);
	$ket	 = htmlspecialchars($data_trans['ket']);
    $user	= htmlspecialchars($data_trans['user']);
	$plg	= htmlspecialchars($data_trans['plg']);
	$diskon	= htmlspecialchars($data_trans['diskon']);
    $tglmulai	= htmlspecialchars($data_trans['tglmulai']);
    $tglselesai	= htmlspecialchars($data_trans['tglselesai']);
    $biayatambahan	= htmlspecialchars($data_trans['biayatambahan']);
	
	$query = "SELECT * FROM paket WHERE paket_id = '$paket'";
	$pkt = mysqli_query($koneksi, $query);
	$p = mysqli_fetch_assoc($pkt);

	$tp = $p['paket_tarif'];
	$totalbiaya = ($qty * $tp + $biayatambahan) - (($qty * $tp + $biayatambahan) * $diskon / 100);
	
    $queryorder = "INSERT INTO orders (order_id,order_user,order_paket,order_pelanggan,order_tglmulai,order_tglselesai,order_biayatambahan,order_diskon,order_status) VALUES (
        '$order','$user','$paket','$plg','$tglmulai','$tglselesai','$biayatambahan','$diskon','Baru'
	)";
	mysqli_query($koneksi,$queryorder);

	$querytrans = "INSERT INTO transaksi (transaksi_order,transaksi_paket,transaksi_qty,transaksi_totalbiaya,transaksi_totalbayar,transaksi_ket) VALUES (
        '$order','$paket','$qty','$totalbiaya','0','$ket'
	)";		
	mysqli_query($koneksi,$querytrans);
    
	return mysqli_affected_rows($koneksi);
}

//konfirmasi transaksi pembayaran
function konfirm_trans($konf_trans){
	global $koneksi;
	$id	= htmlspecialchars($konf_trans['kode']);
	$tglbayar	= htmlspecialchars($konf_trans['tglbayar']);
	$totalbayar	= htmlspecialchars($konf_trans['jumlah']);
	

    $querykt = "UPDATE transaksi SET 
	transaksi_tglbayar = '$tglbayar',
	transaksi_totalbayar = '$totalbayar',
	transaksi_status = 'Terbayar'
	WHERE transaksi_order = '$id'";

	mysqli_query($koneksi,$querykt);
    
	return mysqli_affected_rows($koneksi);
}

//detail order
function det_order($d_order){
	global $koneksi;
	$id	= htmlspecialchars($d_order['kode']);
	$tglselesai	= htmlspecialchars($d_order['tglselesai']);
	$statusorder	= htmlspecialchars($d_order['status']);
	

    $query = "UPDATE orders SET 
	order_tglselesai = '$tglselesai',
	order_status = '$statusorder'
	WHERE order_id = '$id'";

	mysqli_query($koneksi,$query);
    
	return mysqli_affected_rows($koneksi);
}

//delete transaksi
function del_transaksi($del_trans){
	global $koneksi;
	// $id = $del_trans['id'];
	mysqli_query($koneksi,"DELETE FROM orders WHERE order_id = '$del_trans'");
	return mysqli_affected_rows($koneksi);
}


