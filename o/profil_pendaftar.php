<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= $t_URL[4];
	$cn 		= ADMIN_URL.'/pendaftar';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	$kode_reg 	= $t_URL[4];
	$cama 		= $db->row("SELECT * FROM camaba WHERE kode_reg='$kode_reg'");
	$all_gel 	= $db->query("SELECT * FROM gelombang WHERE tahun=$th_pmb ORDER BY id_gelombang ASC");
	$all_jalur 	= $db->query("SELECT * FROM jalur WHERE status=1 ORDER BY urutan ASC");
	$all_prodi 	= $db->query("SELECT * FROM prodi WHERE status=1 ORDER BY urutan ASC");
	$tprov 		= array_combine(array_column($t_provinsi, 'id'), array_column($t_provinsi, 'nama'));
	$tkota 		= array_combine(array_column($t_kota, 'id'), array_column($t_kota, 'nama'));
	$tkec 		= array_combine(array_column($t_kecamatan, 'id'), array_column($t_kecamatan, 'nama'));
	if(isset($_POST['ubah'])){
		$ubah = $_POST['ubah'];
		if(isset($ubah['no_kip'])){
			$kipk = $ubah['no_kip'];
			unset($ubah['no_kip']);
			$kipk = array_filter($kipk);
			$ubah['no_kip'] = implode('.',$kipk);
		}
		ubah_camaba($ubah,$s_name);
	}
	include THEME_DIR.'/profil_pendaftar.php';
}
?>