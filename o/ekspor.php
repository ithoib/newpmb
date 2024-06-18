<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/ekspor';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$all_jalur 	= $db->query("SELECT * FROM jalur ORDER BY urutan ASC");
	$all_prod 	= $db->query("SELECT * FROM prodi ORDER BY urutan ASC");
	$all_th 	= $db->query("SELECT * FROM tahun");
	if(isset($_POST['pilih'])){
		$pilih 	= $_POST['pilih'];
		$fth  	= $pilih['tahun'];
		$fgel 	= $pilih['gelombang'];
		$fjal 	= $pilih['jalur'];
		$fpro 	= $pilih['prodi'];
		$fsta 	= $pilih['status'];
		$pendaftar = eksporcamaba($fth,$fgel,$fjal,$fpro,$fsta);
	} else {
		$fth 	= $th_pmb;
		$fgel 	= '';
		$fjal 	= '';
		$fpro 	= '';
		$fsta 	= '';
		$pendaftar = eksporcamaba($fth,$fgel,$fjal,$fpro,$fsta);
	}
	include THEME_DIR.'/ekspor.php';
}
?>