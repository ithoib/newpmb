<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/soal';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$is 		= $t_URL[3];
	$ip 		= $t_URL[5];
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	$dp 		= $db->row("SELECT * FROM pertanyaan WHERE id_pertanyaan=$ip");
	$pp 		= $db->query("SELECT * FROM pilihan WHERE id_pertanyaan=$ip");
	if(isset($_POST['ubah'])){
		$ubah = $_POST['ubah'];
		ubah_pertanyaan($is,$ip,$ubah,$s_name);
	}
	include THEME_DIR.'/edit_pertanyaan.php';
}
?>