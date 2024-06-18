<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/pending';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	$gel_ak 	= $db->query("SELECT * FROM gelombang WHERE status=1");
	$pending 	= $db->query("SELECT c.wa,c.kode_reg,c.nama,c.tgl_daftar,c.asal_sekolah,a.nama AS refferer,c.status,c.bukti FROM camaba c LEFT JOIN affiliator a ON c.reff=a.affuser WHERE c.reff!='' ORDER BY c.status ASC");
	if(isset($_POST['aktif'])){
		$aktif = $_POST['aktif'];
		$kode_reg = $aktif['kode_reg'];
		$wa = $aktif['wa'];
		aktifkan($kode_reg,$wa);
	}
	include THEME_DIR.'/pending.php';
}
?>