<?php 
$cek = $db->row("SELECT * FROM ujian WHERE kode_reg='$kode_reg' ORDER BY id DESC LIMIT 1");
if(!empty($cek)){
	$batas = $cek['batas_waktu'];
	$status = $cek['status'];
	$jam_ini = date('Y-m-d H:i:s');
	if($jam_ini<=$batas && $status==0){
		# waktu ujian masih ada dan belum selesai;
		$posisi = 1;
	} elseif($jam_ini<=$batas && $status==1){
		# waktu ujian masih ada dan sudah selesai;
		$posisi = 2;
	} elseif($jam_ini>$batas && $status==0){
		# waktu ujian habis dan belum selesai;
		$posisi = 3;
	} elseif($jam_ini>$batas && $status==1){
		# waktu ujian habis dan sudah selesai;
		$posisi = 4;
	}
} else {
	$posisi = 5;
}
if(isset($_POST['goto'])){
	$prtnyn = $db->query("SELECT id_pertanyaan FROM pertanyaan WHERE id_soal IN (SELECT id_soal FROM soal WHERE status=1)");
	$prtnyn2 = array_column((array)$prtnyn,'id_pertanyaan');
	shuffle($prtnyn2);
	$pqs = implode(',', $prtnyn2);
	$goto = $_POST['goto'];
	$soal = $pqs;
	step3($kode_reg,$soal);
}

if($posisi==1){
	header('Location: '.ADMIN_URL.'/ujian');
} elseif($posisi==2 || $posisi==3 || $posisi==4){
	$db->query("UPDATE progress SET ujian=1 WHERE kode_reg='$kode_reg'");
	echo '<meta http-equiv="refresh" content="0">';
} elseif($posisi==5){

echo
'<div id="c">'.
'<div class="ct">'.
'<h2>Halo '.$s_name.'!</h2>'.
'</div>'.
'<p>Saat ini kamu sudah menyelesaikan step 3 dari 6 step PMB ITM Nganjuk. Langkah selanjutnya adalah mengikuti Ujian Masuk (USUK) ITM secara online. Berikut adalah beberapa hal yang perlu diperhatikan terkait USUK ITM '.$th_aktif.':</p>'.
'<ul class="cuj">'.
	'<li>Materi ujian meliputi Literasi & Numerasi</li>'.
	'<li>Jumlah soal ada 50 buah</li>'.
	'<li>Waktu pengerjaan 60 menit dihitung sejak klik tombol <strong>Ujian Masuk ITM Online</strong></li>'.
	'<li>Kamu dapat mengerjakan di manapun dan kapanpun selama ada koneksi internet</li>'.
	'<li>Pastikan koneksi internet kamu lancar agar tidak terkendala saat ujian</li>'.
	'<li>Jika waktu masih tersisa, kamu bisa merevisi jawabanmu</li>'.
	'<li>Jika sudah selesai pastikan tekan tombol <strong>Kirim Jawaban</strong>, agar jawaban kamu terkirim dan bisa diproses.</li>'.
'</ul>'.
'<p>Jika kamu sudah siap, silahkan klik tombol di bawah ini untuk memulai ujian.</p>'.
'<form method="post" action="">'.
	'<input name="goto[kode_reg]" type="hidden" value="1">'.
	'<button type="submit" class="cj">Ujian Masuk ITM Online <i class="fas fa-angle-double-right"></i></button>'.
'</form>'.
'</div>';
}
?>