<?php 
$result 	= $db->row("SELECT c.kode_reg,c.prodi,c.nama,c.provinsi,c.kabupaten_kota,c.tempat_lahir,c.tgl_lahir,c.asal_sekolah,g.gelombang,g.tahun,t.tahun_akademik,j.berkas,p.nama_prodi,j.nama_jalur FROM camaba c LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang LEFT JOIN prodi p ON c.prodi=p.kode_prodi LEFT JOIN jalur j ON c.jalur=j.kode_jalur LEFT JOIN tahun t ON g.tahun=t.tahun WHERE c.kode_reg='{$_SESSION['user']}'");
$cek 		= $db->row("SELECT * FROM ujian WHERE kode_reg='$kode_reg' ORDER BY id DESC LIMIT 1");
if(isset($_POST['goto'])){
	$prtnyn = $db->query("SELECT id_pertanyaan FROM pertanyaan WHERE id_soal IN (SELECT id_soal FROM soal WHERE status=1)");
	$prtnyn2 = array_column((array)$prtnyn,'id_pertanyaan');
	shuffle($prtnyn2);
	$pqs = implode(',', $prtnyn2);
	$goto = $_POST['goto'];
	$soal = $pqs;
	step3($kode_reg,$soal);
}
echo
'<div id="c">';
if($cek['status']==1){
	$next_try = date('Y-m-d', strtotime($cek['waktu_ujian']." + 1 day"));
	// $next_try = $today;
	echo  
	'<div class="ct">'.
		'<h2>Halo '.$s_name.'!</h2>'.
	'</div>'.
	'<div class="cw">Kamu sudah mengikuti USUK ITM Tahun '.$result['tahun_akademik'].' pada tanggal '.waktu_lengkap($cek['waktu_ujian']).' WIB dan dinyatakan <strong>'.($cek['lulus']==1 ? 'LULUS' : 'TIDAK LULUS').'</strong>.'.($cek['lulus']==0 ? ' Kamu bisa mencoba lagi pada tanggal '.indotime($next_try).'.' : '').'</div>'.
	(($cek['lulus']==0 && $today>=$next_try) ? 
	'<form method="post" action="">'.
		'<input name="goto[kode_reg]" type="hidden" value="1">'.
		'<button type="submit" class="cj">Coba Lagi <i class="fas fa-angle-double-right"></i></button>'.
	'</form>' : '');
}
echo '</div>';
?>