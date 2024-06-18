<?php 
$pt = 'Lupa Password - PMB ITM Nganjuk Tahun '.$th_aktif;
$mt = $pt;
$md = '';
$cn = SITEURL.'/'.$t_URL[0];
$in = 0;
$w 	= isset($_GET['w']) ? $_GET['w'] : '';
$m 	= isset($_GET['m']) ? $_GET['m'] : '';
if(isset($_POST['reset'])){
	$reset 	= $_POST['reset'];
	$wa 	= from62($reset['wa']);
	reset_password($wa);
}
include FRONT_THEME_DIR.'/lupa.php';
?>