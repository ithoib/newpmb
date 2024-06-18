<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/affiliator';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$com  		= 0.5;
	$aff  		= $t_URL[3];
	$laff 		= $db->query("SELECT c.tgl_daftar,c.kode_reg,c.nama,c.asal_sekolah, c.wa, g.gelombang, g.tahun, g.biaya_daftar, 0.5*g.biaya_daftar AS komisi FROM camaba c LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang WHERE c.reff='$aff' AND g.tahun='$th_pmb'");
	$tkom 		= array_sum(array_column((array)$laff, 'komisi'));
	$taff 		= count(array_column((array)$laff, 'nama'));
	include THEME_DIR.'/affiliator_detil.php';
}
?>