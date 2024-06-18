<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/pengumuman';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$view 		= $db->row("SELECT * FROM pengumuman WHERE id_pengumuman={$t_URL[4]}");
	if(isset($_POST['ubah'])){
		$ubah = $_POST['ubah'];
		ubah_pengumuman($ubah,$s_name);
	}
	include THEME_DIR.'/edit_info.php';
}
?>