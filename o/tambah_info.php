<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/pengumuman';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	if(isset($_POST['tambah'])){
		$tambah = $_POST['tambah'];
		tambah_pengumuman($tambah,$s_name);
	}
	include THEME_DIR.'/tambah_info.php';
}
?>