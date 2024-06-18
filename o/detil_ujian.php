<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/record';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$iu 		= $t_URL[3];
	$record 	= $db->query("SELECT j.id_pertanyaan, j.jawaban, g.gelombang,j.skor, c.nama,c.asal_sekolah,c.prodi, c.jalur,u.waktu_ujian, u.waktu_submit FROM jawaban j LEFT JOIN camaba c ON j.kode_reg=c.kode_reg LEFT JOIN ujian u ON j.id_ujian=u.id LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang WHERE j.id_ujian=$iu");
	$terjawab	= count($record);
	if($terjawab==0){
		$record = $db->query("SELECT c.nama, c.asal_sekolah,c.prodi, c.jalur,g.gelombang,u.waktu_ujian, u.waktu_submit FROM camaba c LEFT JOIN ujian u ON c.kode_reg=u.kode_reg LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang WHERE u.id=$iu");
		$benar 		= 0;
		$salah 		= 0;
		$skor 		= 0;
	} else {
		$benar 		= array_sum(array_column($record,'skor'));
		$salah 		= $terjawab-$benar;
		$skor 		= $benar*2;
	}
	include THEME_DIR.'/detil_ujian.php';
}
?>