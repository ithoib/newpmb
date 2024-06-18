<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/soal';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$soal 		= $db->query("SELECT s.id_soal, s.nama_soal, s.status, count(p.id_pertanyaan) as jumlah_pertanyaan FROM soal s LEFT JOIN pertanyaan p ON s.id_soal=p.id_soal GROUP BY s.id_soal;");
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	if(isset($_POST['tambah'])){
		$tambah = $_POST['tambah'];
		tambah_soal($tambah,$s_name);
	}
	if(isset($_POST['ubah'])){
		$ubah = $_POST['ubah'];
		ubah_soal($ubah,$s_name);
	}
	if(isset($_POST['hapus'])){
		$hapus = $_POST['hapus'];
		$id_soal = $hapus['id_soal'];
		hapus_soal($id_soal,$s_name);
	}
	if(isset($_POST['goto'])){
		$goto = $_POST['goto'];
		$id_soal = $goto['id_soal'];
		$jumlah = $goto['jumlah'];
		header('Location: '.ADMIN_URL.'/soal/'.$id_soal.'/tambah?num='.$jumlah);	
	}

	// $insert = $db->insert('soal',array('nama_soal'=>'soal 3','status'=>0));
	// print_r($insert);
	include THEME_DIR.'/soal.php';
}
?>