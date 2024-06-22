<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/ujian';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$today 		= date('Y-m-d'); 
	$kode_reg 	= $_SESSION['user']; 
	$progress 	= $db->row("SELECT * FROM progress WHERE kode_reg='$kode_reg'");
	if($progress['diterima']==1){
		header('Location: '.ADMIN_URL);
	} else {
		include THEME_DIR.'/ujian.php';
	}
}
?>