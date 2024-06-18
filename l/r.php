<?php 
$f_URL 	= getURL();
$p_URL	= parse_url($f_URL,PHP_URL_PATH);
$t_URL	= array_values(array_filter(explode('/',$p_URL)));
$c_URL	= count($t_URL);
$header_script = '';
$footer_script = '';
$db 		= new Db();
$th_ak 		= $db->row("SELECT * FROM tahun WHERE status=1");
$th_aktif 	= $th_ak['tahun_akademik'];
$th_pmb 	= $th_ak['tahun'];

# homepage 
if(empty($t_URL)){
	$p = 'home';
}

# panduan
elseif($c_URL==1 && $t_URL[0]=='panduan'){
	$p = 'panduan';
}

# ajax
elseif($c_URL==1 && $t_URL[0]=='ajax'){
	$p = 'ajax';
}

# pengumuman
elseif($c_URL==1 && $t_URL[0]=='pengumuman'){
	$p = 'pengumuman';
}

# daftar
elseif($c_URL==1 && $t_URL[0]=='daftar'){
	$p = 'daftar';
}

# akun
elseif($c_URL==1 && $t_URL[0]=='akun'){
	$p = 'akun';
}

# kipk
elseif($c_URL==1 && $t_URL[0]=='kipk'){
	$p = 'kipk';
}

# lupa
elseif($c_URL==1 && $t_URL[0]=='lupa'){
	$p = 'lupa';
}

# ti
elseif($c_URL==1 && $t_URL[0]=='ti'){
	$p = 'ti';
}

# si
elseif($c_URL==1 && $t_URL[0]=='si'){
	$p = 'si';
}

# pti
elseif($c_URL==1 && $t_URL[0]=='pti'){
	$p = 'pti';
}

# logout
elseif($c_URL==2 && $t_URL[0]=='akun' && $t_URL[1]=='logout'){
	$p = 'logout';
}

# dasbor
elseif($c_URL==2 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor'){
	$p = 'dasbor';
}

# ujian
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='ujian'){
	$p = 'ujian';
}

# ujian pagination
elseif($c_URL==4 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='ujian' && @is_numeric($t_URL[3]) && @!startsWith($t_URL[3],'0')){
	$p = 'ujian';
}

# jalur
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='jalur'){
	$p = 'jalur';
}

# biodata
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='biodata'){
	$p = 'biodata';
}

# cetak
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='cetak'){
	$p = 'cetak';
}

# tahun
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='tahun'){
	$p = 'tahun';
}

# hasil ujian
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='record'){
	$p = 'record';
}

# detil ujian
elseif($c_URL==4 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='record' && $t_URL[3]!=''){
	$p = 'detil_ujian';
}

# soal
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='soal'){
	$p = 'soal';
}

# detil soal
elseif($c_URL==4 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='soal' && $t_URL[3]!=''){
	$p = 'detil_soal';
}

# tambah soal
elseif($c_URL==5 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='soal' && $t_URL[3]!='' && $t_URL[4]=='tambah'){
	$p = 'tambah_soal';
}

# edit pertanyaan
elseif($c_URL==6 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='soal' && $t_URL[3]!='' && $t_URL[4]=='pertanyaan' && $t_URL[5]!=''){
	$p = 'edit_pertanyaan';
}

# gelombang
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='gelombang'){
	$p = 'gelombang';
}

# prodi
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='prodi'){
	$p = 'prodi';
}

# pending
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='pending'){
	$p = 'pending';
}

# pendaftar
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='pendaftar'){
	$p = 'pendaftar';
}

# export pendaftar
elseif($c_URL==4 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='pendaftar' && $t_URL[3]=='export'){
	$p = 'export_pendaftar';
}

# profil pendaftar
elseif($c_URL==5 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='pendaftar' && $t_URL[3]=='profil' && $t_URL[4]!=''){
	$p = 'profil_pendaftar';
}

# administrator
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='administrator'){
	$p = 'administrator';
}

# affiliator
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='affiliator'){
	$p = 'affiliator';
}

# affiliator detil
elseif($c_URL==4 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='affiliator' && $t_URL[3]!=''){
	$p = 'affiliator_detil';
}

# pengaturan
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='pengaturan'){
	$p = 'pengaturan';
}

# moodle
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='moodle'){
	$p = 'moodle';
}

# ekspor
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='ekspor'){
	$p = 'ekspor';
}


# export moodle
elseif($c_URL==4 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='moodle' && $t_URL[3]=='export'){
	$p = 'export';
}

# broadcast
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='broadcast'){
	$p = 'broadcast';
}

# info
elseif($c_URL==3 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='pengumuman'){
	$p = 'info';
}

# tambah info
elseif($c_URL==4 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='pengumuman' && $t_URL[3]=='tambah'){
	$p = 'tambah_info';
}

# edit info
elseif($c_URL==5 && $t_URL[0]=='akun' && $t_URL[1]=='dasbor' && $t_URL[2]=='pengumuman' && $t_URL[3]=='edit' && $t_URL[4]!=''){
	$p = 'edit_info';
}

# 404
else {
	http_response_code(404);
	$p = '404';
}


?>