<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/soal';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$is 		= $t_URL[3];
	$lq 		= $db->query("SELECT * FROM pertanyaan WHERE id_soal=$is");
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	if(isset($_POST['hapus'])){
		$hapus = $_POST['hapus'];
		$id_pertanyaan = $hapus['id_pertanyaan'];
		hapus_pertanyaan($id_pertanyaan,$is,$s_name);
	}
	if(isset($_POST['goto'])){
		$goto = $_POST['goto'];
		$id_soal = $goto['id_soal'];
		$jumlah = $goto['jumlah'];
		header('Location: '.ADMIN_URL.'/soal/'.$id_soal.'/tambah?num='.$jumlah);	
	}
	include THEME_DIR.'/detil_soal.php';
}
?>