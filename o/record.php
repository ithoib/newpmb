<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/record';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$all_jalur 	= $db->query("SELECT * FROM jalur ORDER BY urutan ASC");
	$all_prod 	= $db->query("SELECT * FROM prodi ORDER BY urutan ASC");
	$all_th 	= $db->query("SELECT * FROM tahun");
	$gel_ak 	= $db->row("SELECT * FROM gelombang WHERE status=1");
	if(isset($_POST['pilih'])){
		$pilih = $_POST['pilih'];
		$fth  = $pilih['tahun'];
		$fgel = $pilih['gelombang'];
		$fjal = $pilih['jalur'];
		$fpro = $pilih['prodi'];
		$fsta = $pilih['status'];
		$record = record_ujian($fth,$fgel,$fjal,$fpro,$fsta);
	} else {
		$fth = $th_pmb;
		$fgel = '';
		$fjal = '';
		$fpro = '';
		$fsta = '';
		$record = record_ujian($fth,$fgel,$fjal,$fpro,$fsta);
	}
	// $record 	= $db->query("SELECT u.id, u.kode_reg,u.waktu_ujian,u.batas_waktu,u.waktu_submit,u.soal,u.status,c.nama,c.asal_sekolah,c.jalur,g.tahun,c.prodi,c.gelombang,SUM(j.skor) as benar,COUNT(j.kode_reg) as terjawab,u.lulus FROM ujian u LEFT JOIN camaba c ON u.kode_reg=c.kode_reg LEFT JOIN jawaban j ON u.id=j.id_ujian LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang WHERE g.tahun=$th_pmb GROUP BY u.id");
	include THEME_DIR.'/record.php';
}
?>