<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/tahun';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$tahun 		= $db->query("SELECT * FROM tahun");
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	if(isset($_POST['tambah'])){
		$tambah = $_POST['tambah'];
		tambah_tahun($tambah,$s_name);
	}
	if(isset($_POST['ubah'])){
		$ubah 	= $_POST['ubah'];
		ubah_tahun($ubah,$s_name);
	}
	if(isset($_POST['hapus'])){
		$hapus = $_POST['hapus'];
		$th = $hapus['tahun'];
		hapus_tahun($th,$s_name);
	}
	include THEME_DIR.'/tahun.php';
}
?>