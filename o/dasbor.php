<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt = 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn = ADMIN_URL;
	$us = get_user_session($_SESSION['user']);
	$s_name = $us['nama'];
	$s_role = $us['role'];
	$today 	= date('Y-m-d'); 
	if($s_role==1){
		// Group by prodi
		$q1 	= $db->query("SELECT p.kode_prodi, COUNT(c.kode_reg) AS jumlah FROM prodi p LEFT JOIN camaba c ON p.kode_prodi = c.prodi LEFT JOIN gelombang g ON c.gelombang = g.id_gelombang WHERE g.tahun=$th_pmb AND c.status=1 GROUP BY c.prodi");
		$s1 	= array_combine(array_column($q1, 'kode_prodi'), array_column($q1, 'jumlah'));
		$tSI 	= isset($s1['SI']) ? $s1['SI'] : 0;
		$tPTI 	= isset($s1['PTI']) ? $s1['PTI'] : 0;
		$tTI 	= isset($s1['TI']) ? $s1['TI'] : 0;

		// Group by gelombang
		$q2 	= $db->query("SELECT g.gelombang, COUNT(c.kode_reg) AS jumlah FROM gelombang g LEFT JOIN camaba c ON g.id_gelombang = c.gelombang WHERE g.tahun=$th_pmb AND c.status=1 GROUP BY g.gelombang");
		$s2 	= array_combine(array_column($q2, 'gelombang'), array_column($q2, 'jumlah'));
		$tg1 	= isset($s2['Gelombang I']) ? $s2['Gelombang I'] : 0;
		$tg2 	= isset($s2['Gelombang II']) ? $s2['Gelombang II'] : 0;
		$tg3 	= isset($s2['Gelombang III']) ? $s2['Gelombang III'] : 0;

		// Group by jalur
		$q3 	= $db->query("SELECT c.jalur, COUNT(c.kode_reg) AS jumlah FROM camaba c LEFT JOIN gelombang g ON c.gelombang = g.id_gelombang WHERE g.tahun=$th_pmb AND c.status=1 GROUP BY c.jalur");
		$s3 	= array_combine(array_column($q3, 'jalur'), array_column($q3, 'jumlah'));
		$tkip 	= isset($s3['KIP']) ? $s3['KIP'] : 0;
		$treg 	= isset($s3['REG']) ? $s3['REG'] : 0;
		$teks 	= isset($s3['EKS']) ? $s3['EKS'] : 0;

		// Asal sekolah
		$q4 	= $db->query("SELECT c.asal_sekolah, count(c.kode_reg) as jumlah FROM camaba c LEFT JOIN gelombang g ON c.gelombang = g.id_gelombang WHERE c.asal_sekolah!=''  AND g.tahun=$th_pmb AND c.status=1 GROUP BY c.asal_sekolah ORDER BY jumlah DESC, c.asal_sekolah ASC");

		$total 	= $tg1+$tg2+$tg3;
		include THEME_DIR.'/dadmin.php';
	} elseif($s_role==2){
		$kode_reg = $_SESSION['user'];
		$progress = $db->row("SELECT * FROM progress WHERE kode_reg='$kode_reg'");
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
		include THEME_DIR.'/dmhs.php';
	} elseif($s_role==3){
		$w 		= isset($_GET['w']) ? $_GET['w'] : '';
		$m 		= isset($_GET['m']) ? $_GET['m'] : '';
		$com  	= 0.5;
		$aff 	= $_SESSION['user'];
		$laff 	= $db->query("SELECT c.tgl_daftar,c.kode_reg,c.nama,c.asal_sekolah, c.wa, g.gelombang, g.tahun, g.biaya_daftar, 0.5*g.biaya_daftar AS komisi FROM camaba c LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang WHERE c.reff='$aff' AND g.tahun=$th_pmb");
		$tkom 	= array_sum(array_column((array)$laff, 'komisi'));
		$taff 	= count(array_column((array)$laff, 'nama'));
		$gel_ak = $db->row("SELECT * FROM gelombang WHERE status=1");
		if(isset($_POST['tambah'])){
			$tambah 				= $_POST['tambah'];
			$tambah['gelombang'] 	= $gel_ak['id_gelombang'];
			$tambah['reff']			= $aff;

			$image_file 			= $_FILES["bukti"];
			$image_name 			= time().'.jpg';
			$bukti 					= 'f/'.$image_name;
			move_uploaded_file($image_file["tmp_name"], $bukti);

			$tambah['bukti']		= $bukti;

			$last_id 				= $db->single("SELECT counter FROM counter WHERE type='ITM'");
			$next_id 				= $last_id+1;
			$reg_num 				= sprintf("%05d", $next_id);
			$kode_reg 				= 'ITM'.$th_pmb.$gel_ak['id_gelombang'].$reg_num;

			$tambah['kode_reg']		= $kode_reg;
			$tambah['status']		= 0;

			tambah_pending($tambah,$next_id,$aff);
		}
		include THEME_DIR.'/daff.php';
	}
}
?>