<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/administrator';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$admin 		= $db->query("SELECT a.useradmin, a.nama, a.email, u.passpmb, u.status FROM administrator a, user u WHERE a.useradmin=u.userpmb");
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	if(isset($_POST['tambah'])){
		$tambah 	= $_POST['tambah'];
		tambah_admin($tambah,$s_name);
	}
	if(isset($_POST['ubah'])){
		$ubah 		= $_POST['ubah'];
		ubah_admin($ubah,$s_name);
	}
	if(isset($_POST['hapus'])){
		$hapus 		= $_POST['hapus'];
		$useradmin 	= $hapus['useradmin'];
		hapus_admin($useradmin,$s_name);
	}
	include THEME_DIR.'/administrator.php';
}
?>