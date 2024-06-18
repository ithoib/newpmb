<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/gelombang';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$gelombang 	= $db->query("SELECT * FROM gelombang WHERE tahun=$th_pmb ORDER BY id_gelombang ASC");
	$ta 		= $db->query("SELECT * FROM tahun ORDER BY tahun DESC");
	$jalur 		= $db->query("SELECT * FROM jalur WHERE status=1 ORDER BY urutan ASC");
	$last_id 	= $db->single("SELECT max(id_gelombang) FROM gelombang");
	$next_id 	= $last_id+1;
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	if(isset($_POST['tambah'])){
		$tambah = $_POST['tambah'];
		$tjalur = $tambah['kode_jalur'];
		unset($tambah['kode_jalur']);
		tambah_gelombang($tambah,$tjalur,$s_name);
	}
	if(isset($_POST['ubah'])){
		$ubah 	= $_POST['ubah'];
		$tjalur = $ubah['kode_jalur'];
		unset($ubah['kode_jalur']);
		ubah_gelombang($ubah,$tjalur,$s_name);
	}
	if(isset($_POST['hapus'])){
		$hapus 	= $_POST['hapus'];
		$idg 	= $hapus['id_gelombang'];
		hapus_gelombang($idg,$s_name);
	}
	include THEME_DIR.'/gelombang.php';
}
?>