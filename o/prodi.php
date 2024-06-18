<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/prodi';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$prodi 		= $db->query("SELECT * FROM prodi ORDER BY urutan ASC");
	$last_id 	= $db->single("SELECT max(urutan) FROM prodi");
	$next_id 	= $last_id+1;
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	if(isset($_POST['tambah'])){
		$tambah = $_POST['tambah'];
		tambah_prodi($tambah,$s_name);
	}
	if(isset($_POST['ubah'])){
		$ubah 		= $_POST['ubah'];
		$prodi_lama = $ubah['kode_prodi_lama'];
		unset($ubah['kode_prodi_lama']);
		ubah_prodi($ubah,$prodi_lama,$s_name);
	}
	if(isset($_POST['hapus'])){
		$hapus = $_POST['hapus'];
		$kp = $hapus['kode_prodi'];
		hapus_prodi($kp,$s_name);
	}
	include THEME_DIR.'/prodi.php';
}
?>