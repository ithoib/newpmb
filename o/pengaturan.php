<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/pengaturan';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	$pengaturan = $db->query("SELECT * FROM pengaturan");
	if(isset($_POST['ubah'])){
		$ubah = $_POST['ubah'];
		foreach($ubah as $k=>$v){
			ubah_pengaturan($k,$v);
		}
	}
	include THEME_DIR.'/pengaturan.php';
}
?>