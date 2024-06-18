<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/affiliator';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$affiliator = $db->query("SELECT a.nama, a.affuser,a.email,a.no_hp, a.instansi, u.status, COUNT(c.kode_reg) as jumlah FROM affiliator a LEFT JOIN camaba c ON a.affuser=c.reff LEFT JOIN user u ON a.affuser=u.userpmb GROUP BY a.affuser");
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	if(isset($_POST['tambah'])){
		$tambah 	= $_POST['tambah'];
		tambah_aff($tambah,$s_name);
	}
	if(isset($_POST['ubah'])){
		$ubah 		= $_POST['ubah'];
		ubah_aff($ubah,$s_name);
	}
	if(isset($_POST['hapus'])){
		$hapus 		= $_POST['hapus'];
		$affuser 	= $hapus['affuser'];
		hapus_aff($affuser,$s_name);
	}
	include THEME_DIR.'/affiliator.php';
}
?>