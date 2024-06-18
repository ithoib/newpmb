<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= $_SESSION['user'];
	$cn 		= ADMIN_URL.'/biodata';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	$kode_reg 	= $_SESSION['user'];
	$id_gel 	= $db->single("SELECT id_gelombang FROM gelombang WHERE status=1");
	$cama 		= $db->row("SELECT * FROM camaba WHERE kode_reg='$kode_reg'");
	$all_jalur 	= $db->query("SELECT * FROM jalur WHERE kode_jalur IN (SELECT kode_jalur FROM jalur_gelombang WHERE id_gelombang=$id_gel) ORDER BY urutan ASC");
	$all_prodi 	= $db->query("SELECT * FROM prodi WHERE status=1 ORDER BY urutan ASC");
	$tprov 		= array_combine(array_column($t_provinsi, 'id'), array_column($t_provinsi, 'nama'));
	$tkota 		= array_combine(array_column($t_kota, 'id'), array_column($t_kota, 'nama'));
	$tkec 		= array_combine(array_column($t_kecamatan, 'id'), array_column($t_kecamatan, 'nama'));
	$progress = $db->row("SELECT * FROM progress WHERE kode_reg='{$_SESSION['user']}'");
	if($progress['akun']==1 && $progress['biodata']==0 && $progress['transfer']==1 && $progress['berkas']==0 && $progress['ujian']==0 && $progress['diterima']==0){
			$step = 2;
	} elseif($progress['akun']==1 && $progress['biodata']==1 && $progress['transfer']==1 && $progress['berkas']==0 && $progress['ujian']==0 && $progress['diterima']==0){
		$step = 3;
	} elseif($progress['akun']==1 && $progress['biodata']==1 && $progress['transfer']==1 && $progress['berkas']==0 && $progress['ujian']==1 && $progress['diterima']==0){
		$step = 4;
	} elseif($progress['akun']==1 && $progress['biodata']==1 && $progress['transfer']==1 && $progress['berkas']==1 && $progress['ujian']==1 && $progress['diterima']==0){
		$step = 4;
	} elseif($progress['akun']==1 && $progress['biodata']==1 && $progress['transfer']==1 && $progress['berkas']==1 && $progress['ujian']==0 && $progress['diterima']==0){
		$step = 3;
	} elseif($progress['akun']==1 && $progress['biodata']==1 && $progress['transfer']==1 && $progress['berkas']==0 && $progress['ujian']==1 && $progress['diterima']==1){
		$step = 5;
	} elseif($progress['akun']==1 && $progress['biodata']==1 && $progress['transfer']==1 && $progress['berkas']==1 && $progress['ujian']==1 && $progress['diterima']==1){
		$step = 6;
	}
	if(isset($_POST['ubah'])){
		$ubah 	= $_POST['ubah'];
		$kipk 	= $ubah['no_kip'];
		unset($ubah['no_kip']);
		$kipk 	= array_filter($kipk);
		$ubah['no_kip'] = implode('.',$kipk);
		// echo '<pre>'.print_r($ubah,true).'</pre>';
		if($step==2){
			step2($ubah,1);
		} else {
			step2($ubah,0);
		}
		
	}
	include THEME_DIR.'/biodata.php';
}
?>