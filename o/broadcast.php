<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/broadcast';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$all_gel 	= $db->query("SELECT * FROM gelombang");
	if(isset($_POST['kirim'])){
		$kr = $_POST['kirim'];
		header('Location: '.$cn.'?g='.$kr['penerima'].'&p='.base64_encode($kr['pesan']));
	}
	include THEME_DIR.'/broadcast.php';
}
?>