<?php 
if(isset($_SESSION['log'])){
	header('Location: '.ADMIN_URL);
} else {
	$pt = 'Akun PMB '.$th_aktif;
	$mt = $pt;
	$md = '';
	$cn = SITEURL.'/akun';
	$in = 0;
	if(isset($_POST['login'])){
		$login = $_POST['login'];
		$us = $login['userpmb'];
		$pa = md5($login['passwordpmb']);
		login($us,$pa);
	}
	$w = isset($_GET['w']) ? $_GET['w'] : '';
	$m = isset($_GET['m']) ? $_GET['m'] : '';
	include FRONT_THEME_DIR.'/akun.php';
}
?>