<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/jalur';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$jalur 		= $db->query("SELECT * FROM jalur ORDER BY urutan ASC");
	$last_id 	= $db->single("SELECT max(urutan) FROM jalur");
	$next_id 	= $last_id+1;
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	if(isset($_POST['tambah'])){
		$tambah = $_POST['tambah'];
		tambah_jalur($tambah,$s_name);
	}
	if(isset($_POST['ubah'])){
		$ubah 	= $_POST['ubah'];
		ubah_jalur($ubah,$s_name);
	}
	if(isset($_POST['hapus'])){
		$hapus 	= $_POST['hapus'];
		$kj 	= $hapus['kode_jalur'];
		hapus_jalur($kj,$s_name);
	}
	include THEME_DIR.'/jalur.php';
}
?>