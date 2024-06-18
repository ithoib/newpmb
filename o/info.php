<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/pengumuman';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$pengumuman = $db->query("SELECT * FROM pengumuman ORDER BY tgl DESC");
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	if(isset($_POST['hapus'])){
		$hapus = $_POST['hapus'];
		$kp = $hapus['id_pengumuman'];
		hapus_pengumuman($kp,$s_name);
	}
	include THEME_DIR.'/info.php';
}
?>