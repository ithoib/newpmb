<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/soal';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$num 		= isset($_GET['num']) ? $_GET['num'] : 1;
	if(isset($_POST['submit'])){
		$soal = $_POST['soal'];
		tambah_pertanyaan($t_URL[3],$soal,$s_name);
	}
	include THEME_DIR.'/tambah_soal.php';
}
?>