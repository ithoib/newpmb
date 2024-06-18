<?php 

require 's.php';

require 'Db.class.php';

require 'SimpleXLSX.php';

require 'phpqrcode/qrlib.php';

require_once 't_kecamatan.php';

require_once 't_provinsi.php';

require_once 't_kota.php';


/* getId

** Usage  : Generate random unique ID

** Author : Pak Bambang

*/

function getId() {
    return str_replace('.', '', uniqid(rand(100,999),true));
}



/* getURL

** Usage  : Get URL PATH

*/

function getURL() {
	$fa_url  = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	$no_http = str_replace(array('http:','https:'), '', SITEURL);
	$f_URL   = SITEURL_MODE=='DIR' ? str_replace($no_http, '', $fa_url) : $_SERVER['REQUEST_URI'];
	return $f_URL;
}

function startsWith( $haystack, $needle ) {
     $length = strlen( $needle );
     return substr( $haystack, 0, $length ) === $needle;
}
function waktu_lengkap($ts){ 
  $ts = strtotime($ts);
  $ts = date("j F Y G:i", $ts);   
  $nmeng = array('january', 'february', 'march','april','may','june','july','august','september','october','november','december','sunday','monday','tuesday','wednesday','thursday','friday','saturday');
  $nmtur = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember','Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'); 
  $ts = str_ireplace($nmeng, $nmtur, $ts);
  return $ts;
}

function get_option($option_name){
	$db = new Db();
	$q1 = $db->row("SELECT option_value FROM pengaturan WHERE option_name='$option_name'");
	return $q1['option_value'];
}

function update_option($option_name,$option_value){
	$db = new Db();
	$q1 = $db->query("UPDATE pengaturan SET option_value='$option_value' WHERE option_name='$option_name'");
}
/* login

** Usage  : Log in to dashboard

** $user  : no hp

** $pass  : password

*/

function login($user,$pass){
	$db = new Db();
	$cek =  $db->query("SELECT * FROM user WHERE userpmb='$user' AND passpmb='$pass' AND status=1");
	if(count($cek)!=0){
		$_SESSION["log"] 	= md5($user.$pass);
		$_SESSION["user"] 	= $user;
		writeLog('berhasil login','login','',$user);
		header('Location: '.ADMIN_URL);
	} else {
		writeLog('gagal login','','',$user);
		header('Location: '.SITEURL.'/akun?w=px');
	}
}


/* writeLog

** Usage  : write log history

** $keterangan : keterangan

** $modul : nama modul

** $modul_id : id modul

** $by 	  : user id

*/

function writeLog($keterangan,$modul='',$modul_id='',$by=''){
	$db = new Db();
	$args = array(
		'keterangan' => $keterangan,
		'modul' => $modul,
		'modul_id' => $modul_id,
		'masuk_oleh' => $by,
		'masuk_tanggal' => date('Y-m-d H:i:s'),
	);
	$q1 = $db->insert('log',$args);
}

function reset_password($wa){
	$db 	= new Db();
	$q1 	= $db->row("SELECT kode_reg,nama FROM camaba WHERE wa='$wa'");
	if(empty($q1)){
		header('Location: '.SITEURL.'/lupa?w=lupa&m=ko');
	} else {
		$kode_reg 	= $q1['kode_reg'];
		$nama 			= $q1['nama'];
		$new_pass 	= generate_password(8);
		$md5pass  	= md5($new_pass);
		$q2 				= $db->query("UPDATE user SET passpmb='$md5pass' WHERE userpmb='$kode_reg'");
		kirim_pesan_reset($nama,$wa,$kode_reg,$new_pass);
		header('Location: '.SITEURL.'/akun?w=lupa&m=ok');
	}
}

function kirim_pesan_reset($nama,$wa,$user,$pass){
$wa  = to62($wa);
/*$text = 
"Selamat kak $nama! Akun PMB Anda berhasil dibuat
*USER ID :* $user
*PASSWORD :* $pass
Selanjutnya klik link di bawah ini untuk melanjutkan pendaftaran ke STEP 2:
https://pmb.itmnganjuk.ac.id/akun
Gunakan AKUN di atas untuk log in ke dasbor PMB, dan lengkapi biodata Anda. Simpan akun PMB ini baik-baik di tempat yang aman.";*/
$text = "Selamat kak $nama! Akun PMB Anda berhasil direset.

*USER ID :* $user 
*PASSWORD :* $pass

Simpan akun PMB ini baik-baik di tempat yang aman karena akan digunakan selama proses pendaftaran.";
$postfield = [
	'recipient_type' => 'individual',
	'to' => $wa,
	'type' => 'text',
	'text' => ['body'=>$text]
];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.WAG_IP.'/api/v1/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postfield),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer dk_16ff14ab8b9d435db3928fec1b716a0f',
    'Content-Type: text/plain'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
}

function get_name($user){
	$db = new Db();
	$q1 = $db->row("SELECT * FROM user WHERE userpmb='$user'");
	$role = $q1['role'];
	if($role==1){
		$q2 = "SELECT nama FROM administrator WHERE useradmin='$user'";
	} elseif($role==2){
		$q2 = "SELECT nama FROM camaba WHERE kode_reg='$user'";
	} elseif($role==3){
		$q2 = "SELECT nama FROM affiliator WHERE affuser='$user'";
	}
	$r2  = $db->row($q2);
	return $r2['nama'];
}
function get_user_session($user){
	$db = new Db();
	$q1 = $db->row("SELECT * FROM user WHERE userpmb='$user'");
	$role = $q1['role'];
	if($role==1){
		$q2 = "SELECT nama FROM administrator WHERE useradmin='$user'";
	} elseif($role==2){
		$q2 = "SELECT nama FROM camaba WHERE kode_reg='$user'";
	} elseif($role==3){
		$q2 = "SELECT nama FROM affiliator WHERE affuser='$user'";
	}
	$r2  = $db->row($q2);
	return array('nama'=>$r2['nama'],'role'=>$role);
}

function tambah_jalur($args,$s_name){
	$db 	= new Db();
	$cek 	= $db->row("SELECT * FROM jalur WHERE kode_jalur='{$args['kode_jalur']}'");
	if($cek==0){
		$q1 = $db->insert('jalur',$args);
		writeLog('Jalur '.$args['kode_jalur'].' berhasil ditambahkan','jalur',$args['kode_jalur'],$s_name);
		header('Location: '.ADMIN_URL.'/jalur?w=tambah&m=ok');
	} else {
		header('Location: '.ADMIN_URL.'/jalur?w=tambah&m=ada');
	}
	
}

function ubah_jalur($args,$s_name){
	$db 	= new Db();
	$q1 = $db->update('jalur',$args,"WHERE kode_jalur='{$args['kode_jalur']}'");
	if($q1>0){
		writeLog('Jalur '.$args['kode_jalur'].' berhasil diubah','jalur',$args['kode_jalur'],$s_name);
		header('Location: '.ADMIN_URL.'/jalur?w=ubah&m=ok');
	}	
}

function hapus_jalur($kode,$s_name){
	$db 	= new Db();
	$q1 	= $db->query("DELETE FROM jalur WHERE kode_jalur='$kode'");
	$q3 	= $db->query("DELETE FROM jalur_gelombang WHERE id_gelombang IN (SELECT id_gelombang FROM jalur_gelombang WHERE kode_jalur='$kode')");
	writeLog('Jalur '.$kode.' berhasil dihapus','jalur',$kode,$s_name);
	header('Location: '.ADMIN_URL.'/jalur?w=hapus&m=ok');
}
function tambah_soal($args,$s_name){
	$db 	= new Db();
	$cek 	= $db->row("SELECT * FROM soal WHERE nama_soal='{$args['nama_soal']}'");
	if($cek==0){
		if($args['status']==1){
			$q2 = $db->query("UPDATE soal SET status=0");
		}
		$q1 = $db->insert('soal',$args);
		writeLog('Soal berhasil ditambahkan','soal',$args['nama_soal'],$s_name);
		header('Location: '.ADMIN_URL.'/soal?w=tambah&m=ok');
	} else {
		header('Location: '.ADMIN_URL.'/soal?w=tambah&m=ada');
	}
	
}
function ubah_soal($args,$s_name){
	$db 	= new Db();
	if($args['status']==1){
		$q2 = $db->query("UPDATE soal SET status=0");
	}
	$q1 = $db->update('soal',$args,"WHERE id_soal='{$args['id_soal']}'");
	writeLog('Soal berhasil diubah','soal',$args['id_soal'],$s_name);
	header('Location: '.ADMIN_URL.'/soal?w=ubah&m=ok');
}
function hapus_soal($id_soal,$s_name){
	$db 	= new Db();
	$q1 	= $db->query("DELETE FROM soal WHERE id_soal=$id_soal");
	writeLog('Soal berhasil dihapus','soal',$id_soal,$s_name);
	header('Location: '.ADMIN_URL.'/soal?w=hapus&m=ok');
}

function hapus_pertanyaan($id_pertanyaan,$id_soal,$s_name){
	$db 	= new Db();
	$q1 	= $db->query("DELETE FROM pertanyaan WHERE id_pertanyaan=$id_pertanyaan");
	writeLog('Pertanyaan berhasil dihapus','soal',$id_pertanyaan,$s_name);
	header('Location: '.ADMIN_URL.'/soal/'.$id_soal.'?w=hapus&m=ok');
}
function tambah_pertanyaan($id_soal,$soal,$s_name){
	$pdo    = new PDO(dsn, DB_USER, DB_PASSWORD);
	foreach($soal as $so){
		$p1 = $so['pertanyaan'];
		$q1 = "INSERT INTO pertanyaan(id_soal,pertanyaan) VALUES(?,?)";
		$s1 = $pdo->prepare($q1);
		$s1->execute([$id_soal,$p1]);
		$pd = $pdo->lastInsertId();
		$j1 = $so['jawaban'];
		foreach($so['pilihan'] as $k => $v){
			$st = $k==$j1 ? 1 : 0;
			$q2 = "INSERT INTO pilihan(id_pertanyaan,pilihan,status) VALUES(?,?,?)";
			$s2 = $pdo->prepare($q2);
			$s2->execute([$pd,$v,$st]);
		}
	}
	writeLog('Pertanyaan berhasil ditambahkan','soal',$id_soal,$s_name);
	header('Location: '.ADMIN_URL.'/soal?w=tambah&m=ok');
}
function ubah_pertanyaan($id_soal,$id_pertanyaan,$pertanyaan,$s_name){
	$db 	= new Db();
	$p1 	= $pertanyaan['pertanyaan'];
	$q1 	= $db->query("UPDATE pertanyaan SET pertanyaan='$p1' WHERE id_pertanyaan='$id_pertanyaan'");
	$j1 	= $pertanyaan['jawaban'];
	foreach($pertanyaan['pilihan'] as $k => $v){
		$st = $k==$j1 ? 1 : 0;
		$q2 = $db->query("UPDATE pilihan SET pilihan='$v', status=$st WHERE id_pilihan=$k");
	}
	writeLog('Pertanyaan berhasil diubah','soal',$id_pertanyaan,$s_name);
	header('Location: '.ADMIN_URL.'/soal/'.$id_soal.'/pertanyaan/'.$id_pertanyaan.'?w=ubah&m=ok');
}
function tambah_tahun($args,$s_name){
	$db 	= new Db();
	$cek 	= $db->row("SELECT * FROM tahun WHERE tahun='{$args['tahun']}'");
	if($cek==0){
		if($args['status']==1){
			$q2 = $db->query("UPDATE tahun SET status=0");
		}
		$q1 = $db->insert('tahun',$args);
		writeLog('Tahun akademik '.$args['tahun_akademik'].' berhasil ditambahkan','tahun',$args['tahun'],$s_name);
		header('Location: '.ADMIN_URL.'/tahun?w=tambah&m=ok');
	} else {
		header('Location: '.ADMIN_URL.'/tahun?w=tambah&m=ada');
	}
	
}

function ubah_tahun($args,$s_name){
	$db 	= new Db();
	if($args['status']==1){
		$q2 = $db->query("UPDATE tahun SET status=0");
	}
	$q1 = $db->update('tahun',$args,"WHERE tahun='{$args['tahun']}'");
	writeLog('Tahun akademik '.$args['tahun_akademik'].' berhasil diubah','tahun',$args['tahun'],$s_name);
	header('Location: '.ADMIN_URL.'/tahun?w=ubah&m=ok');
}

function hapus_tahun($tahun,$s_name){
	$db 	= new Db();
	$q1 	= $db->query("DELETE FROM tahun WHERE tahun='$tahun'");
	writeLog('Tahun '.$tahun.' berhasil dihapus','tahun',$tahun,$s_name);
	header('Location: '.ADMIN_URL.'/tahun?w=hapus&m=ok');
}

function tambah_pengumuman($args,$s_name){
	$db 	= new Db();
	$q1 = $db->insert('pengumuman',$args);
	if($q1>0){
		writeLog('Pengumuman berhasil ditambahkan','pengumuman',$args['judul'],$s_name);
		header('Location: '.ADMIN_URL.'/pengumuman?w=tambah&m=ok');
	}
}
function ubah_pengumuman($args,$s_name){
	$db 	= new Db();
	$q1 = $db->update('pengumuman',$args,"WHERE id_pengumuman='{$args['id_pengumuman']}'");
	writeLog('Pengumuman berhasil diubah','pengumuman',$args['id_pengumuman'],$s_name);
	header('Location: '.ADMIN_URL.'/pengumuman?w=ubah&m=ok');
}
function hapus_pengumuman($id_pengumuman,$s_name){
	$db 	= new Db();
	$q1 	= $db->query("DELETE FROM pengumuman WHERE id_pengumuman='$id_pengumuman'");
	writeLog('Pengumuman berhasil dihapus','pengumuman',$id_pengumuman,$s_name);
	header('Location: '.ADMIN_URL.'/pengumuman?w=hapus&m=ok');
}
function tambah_gelombang($args,$tjalur,$s_name){
	$db 	= new Db();
	$cek 	= $db->row("SELECT * FROM gelombang WHERE gelombang='{$args['gelombang']}'");
	if($cek==0){
		if($args['status']==1){
			$q2 = $db->query("UPDATE gelombang SET status=0");
		}
		$q1 	= $db->insert('gelombang',$args);
		foreach($tjalur as $jl){
			$q3 = $db->insert('jalur_gelombang',array('id_gelombang'=>$args['id_gelombang'],'kode_jalur'=>$jl));
		}
		writeLog($args['gelombang'].' berhasil ditambahkan','gelombang',$args['id_gelombang'],$s_name);
		header('Location: '.ADMIN_URL.'/gelombang?w=tambah&m=ok');
	} else {
		header('Location: '.ADMIN_URL.'/gelombang?w=tambah&m=ada');
	}
}

function ubah_gelombang($args,$tjalur,$s_name){
	$db 	= new Db();
	if($args['status']==1){
		$q4 = $db->query("UPDATE gelombang SET status=0");
	}
	$q1 	= $db->update('gelombang',$args,"WHERE id_gelombang='{$args['id_gelombang']}'");
	$q2 	= $db->query("DELETE FROM jalur_gelombang WHERE id_gelombang='{$args['id_gelombang']}'");
	foreach($tjalur as $jl){
		$q3 = $db->insert('jalur_gelombang',array('id_gelombang'=>$args['id_gelombang'],'kode_jalur'=>$jl));
	}
	writeLog($args['gelombang'].' berhasil diubah','gelombang',$args['id_gelombang'],$s_name);
	header('Location: '.ADMIN_URL.'/gelombang?w=ubah&m=ok');
}

function hapus_gelombang($gel,$s_name){
	$db 	= new Db();
	$q1 	= $db->query("DELETE FROM gelombang WHERE id_gelombang='$gel'");
	$q2 	= $db->query("DELETE FROM jalur_gelombang WHERE id_gelombang='$gel'");
	writeLog('Gelombang berhasil dihapus','gelombang',$gel,$s_name);
	header('Location: '.ADMIN_URL.'/gelombang?w=hapus&m=ok');
}
function slug($str, $replace=array(), $delimiter='-') {
  if( !empty($replace) ) {
    $str = str_replace((array)$replace, ' ', $str);
  }
  $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
  $clean = strtolower(trim($clean, '-'));
  $clean = trim($clean);
  $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
  return trim($clean);
}

function tambah_prodi($args,$s_name){
	$db 	= new Db();
	$cek 	= $db->row("SELECT * FROM prodi WHERE kode_prodi='{$args['kode_prodi']}'");
	if($cek==0){
		$q1 = $db->insert('prodi',$args);
		writeLog('Prodi '.$args['kode_prodi'].' berhasil ditambahkan','prodi',$args['kode_prodi'],$s_name);
		header('Location: '.ADMIN_URL.'/prodi?w=tambah&m=ok');
	} else {
		header('Location: '.ADMIN_URL.'/prodi?w=tambah&m=ada');
	}
	
}

function ubah_prodi($args,$prodi_lama,$s_name){
	$db 	= new Db();
	$q1 = $db->update('prodi',$args,"WHERE kode_prodi='$prodi_lama'");
	writeLog('Prodi '.$prodi_lama.' berhasil diubah','prodi',$args['kode_prodi'],$s_name);
	header('Location: '.ADMIN_URL.'/prodi?w=ubah&m=ok');
}

function hapus_prodi($kode,$s_name){
	$db 	= new Db();
	$q1 	= $db->query("DELETE FROM prodi WHERE kode_prodi='$kode'");
	writeLog('Prodi '.$kode.' berhasil dihapus','prodi',$kode,$s_name);
	header('Location: '.ADMIN_URL.'/prodi?w=hapus&m=ok');
}


function tambah_admin($args,$s_name){
	$db 	= new Db();
	$cek 	= $db->row("SELECT * FROM administrator WHERE useradmin='{$args['useradmin']}' OR email='{$args['email']}'");
	if($cek==0){
		$passpmb = md5($args['passpmb']);
		unset($args['passpmb']);
		$q1 = $db->insert('administrator',$args);

		$args2 = array(
			'userpmb' => $args['useradmin'],
			'passpmb'	=> $passpmb,
			'role'		=> 1,
			'status' 	=> 1
		);
		$q2 = $db->insert('user',$args2);

		writeLog($args['nama'].' berhasil ditambahkan sebagai administrator','administrator',$args['useradmin'],$s_name);
		header('Location: '.ADMIN_URL.'/administrator?w=tambah&m=ok');

	} else {
		header('Location: '.ADMIN_URL.'/administrator?w=tambah&m=ada');
	}
	
}

function ubah_admin($args,$s_name){
	$db 			= new Db();
	$passpmb 	= $args['passpmb'];
	$status  	= $args['status'];
	unset($args['passpmb']);
	unset($args['status']);
	$q1 = $db->update('administrator',$args,"WHERE useradmin='{$args['useradmin']}'");
	if($passpmb!=''){
		$md = md5($passpmb);
		$q2 = $db->query("UPDATE user SET passpmb='$md', status=$status WHERE userpmb='{$args['useradmin']}'");
	} else {
		$q2 = $db->query("UPDATE user SET status=$status WHERE userpmb='{$args['useradmin']}'");
	}

	writeLog('Administrator berhasil diubah','administrator',$args['useradmin'],$s_name);
	header('Location: '.ADMIN_URL.'/administrator?w=ubah&m=ok');
}

function hapus_admin($useradmin,$s_name){
	$db 	= new Db();
	$q1 	= $db->query("DELETE FROM administrator WHERE useradmin='$useradmin'");
	$q2 	= $db->query("DELETE FROM user WHERE userpmb='$useradmin'");
	writeLog('Administrator berhasil dihapus','administrator',$useradmin,$s_name);
	header('Location: '.ADMIN_URL.'/administrator?w=hapus&m=ok');
}

function tambah_aff($args,$s_name){
	$db 	= new Db();
	$cek 	= $db->row("SELECT * FROM affiliator WHERE affuser='{$args['affuser']}' OR email='{$args['email']}' OR no_hp='{$args['no_hp']}'");
	if($cek==0){
		$passpmb = md5($args['passpmb']);
		unset($args['passpmb']);
		$q1 = $db->insert('affiliator',$args);

		$args2 = array(
			'userpmb' => $args['affuser'],
			'passpmb'	=> $passpmb,
			'role'		=> 3,
			'status' 	=> 1
		);
		$q2 = $db->insert('user',$args2);

		kirim_aff($args['no_hp'],$args['affuser'],$passpmb);
		writeLog($args['nama'].' berhasil ditambahkan sebagai affiliator','affiliator',$args['affuser'],$s_name);
		header('Location: '.ADMIN_URL.'/affiliator?w=tambah&m=ok');

	} else {
		header('Location: '.ADMIN_URL.'/affiliator?w=tambah&m=ada');
	}
}

function ubah_aff($args,$s_name){
	$db 			= new Db();
	$passpmb 	= $args['passpmb'];
	$status  	= $args['status'];
	unset($args['passpmb']);
	unset($args['status']);
	$q1 = $db->update('affiliator',$args,"WHERE affuser='{$args['affuser']}'");
	if($passpmb!=''){
		$md = md5($passpmb);
		$q2 = $db->query("UPDATE user SET passpmb='$md', status=$status WHERE userpmb='{$args['affuser']}'");
	} else {
		$q2 = $db->query("UPDATE user SET status=$status WHERE userpmb='{$args['affuser']}'");
	}

	writeLog('Affiliator berhasil diubah','affiliator',$args['affuser'],$s_name);
	header('Location: '.ADMIN_URL.'/affiliator?w=ubah&m=ok');
}

function hapus_aff($affuser,$s_name){
	$db 	= new Db();
	$q1 	= $db->query("DELETE FROM affiliator WHERE affuser='$affuser'");
	$q2 	= $db->query("DELETE FROM user WHERE userpmb='$affuser'");
	writeLog('Affiliator berhasil dihapus','affiliator',$affuser,$s_name);
	header('Location: '.ADMIN_URL.'/affiliator?w=hapus&m=ok');
}

function camaba_jg($kode_reg){
	$db 	= new Db();
	$q1 	= $db->row("SELECT c.kode_reg, c.nama, c.wa, c.prodi, c.tgl_daftar, c.jalur, j.berkas, g.tgl_berkas, g.tgl_ujian, g.tgl_pengumuman, g.biaya_daftar FROM camaba c, jalur j, gelombang g WHERE c.jalur=j.kode_jalur AND c.gelombang = g.id_gelombang AND c.kode_reg='$kode_reg'");
	return $q1;

}

function kirim_step1($wa,$user,$pass){
$wa  = to62($wa);
/*$text = 
"Selamat kak $nama! Akun PMB Anda berhasil dibuat
*USER ID :* $user
*PASSWORD :* $pass
Selanjutnya klik link di bawah ini untuk melanjutkan pendaftaran ke STEP 2:
https://pmb.itmnganjuk.ac.id/akun
Gunakan AKUN di atas untuk log in ke dasbor PMB, dan lengkapi biodata Anda. Simpan akun PMB ini baik-baik di tempat yang aman.";*/
$text = "Selamat! Pembayaran biaya pendaftaran Anda telah terkonfirmasi. Berikut detil Akun PMB Anda:

*USER ID :* $user 
*PASSWORD :* $pass

Selanjutnya klik link di bawah ini untuk melanjutkan pendaftaran:

https://pmb.itmnganjuk.ac.id/akun?w=lanjut

Gunakan AKUN di atas untuk log in ke dasbor PMB, dan lengkapi biodata Anda. Simpan akun PMB ini baik-baik di tempat yang aman.";
$postfield = [
	'recipient_type' => 'individual',
	'to' => $wa,
	'type' => 'text',
	'text' => ['body'=>$text]
];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.WAG_IP.'/api/v1/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postfield),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer dk_16ff14ab8b9d435db3928fec1b716a0f',
    'Content-Type: text/plain'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
}

function kirim_step2($kode_reg){
$cbjg = camaba_jg($kode_reg);
$nama = $cbjg['nama'];
$wa 	= $cbjg['wa'];
$brks = preg_split('/\r\n|\r|\n/',$cbjg['berkas']);
$wa  	= to62($wa);
if($cbjg['prodi']=='SI'){
  $map = get_option('map_si');
} elseif($cbjg['prodi']=='TI'){
  $map = get_option('map_ti');
} else {
  $map = get_option('map_pti');
}
$berkas = '- '.implode(PHP_EOL.'- ', $brks);
/*$text = 
"Selamat kak $nama! Akun PMB Anda berhasil dibuat
*USER ID :* $user
*PASSWORD :* $pass
Selanjutnya klik link di bawah ini untuk melanjutkan pendaftaran ke STEP 2:
https://pmb.itmnganjuk.ac.id/akun
Gunakan AKUN di atas untuk log in ke dasbor PMB, dan lengkapi biodata Anda. Simpan akun PMB ini baik-baik di tempat yang aman.";*/
$text = "Selamat! Kak $nama sudah melengkapi biodata pada akun PMB ITM Nganjuk. Langkah selanjutnya adalah mengikuti Seleksi Ujian Masuk ITM secara online. Materi yang diujikan terkait dengan Literasi & Numerasi. Silahkan login ke akun PMB kamu untuk mengerjakan.";
$postfield = [
	'recipient_type' => 'individual',
	'to' => $wa,
	'type' => 'text',
	'text' => ['body'=>$text]
];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.WAG_IP.'/api/v1/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postfield),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer dk_16ff14ab8b9d435db3928fec1b716a0f',
    'Content-Type: text/plain'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
}

function kirim_lulus($kode_reg){
$db 			= new Db();
$cbjg 		= camaba_jg($kode_reg);
$th_ak 		= $db->row("SELECT * FROM tahun WHERE status=1");
$th_aktif = $th_ak['tahun_akademik'];
$brks 		= preg_split('/\r\n|\r|\n/',$cbjg['berkas']);
$tglu 		= $db->row("SELECT * FROM ujian WHERE kode_reg='$kode_reg'");
$tgluj 		= $tglu['waktu_ujian'];
$wa  			= to62($cbjg['wa']);
if($cbjg['prodi']=='SI'){
  $map = get_option('map_si');
} elseif($cbjg['prodi']=='TI'){
  $map = get_option('map_ti');
} else {
  $map = get_option('map_pti');
}
$berkas = '- '.implode(PHP_EOL.'- ', $brks);
$text = "Selamat! Anda dinyatakan *LULUS* Ujian Masuk ITM Nganjuk Tahun Akademik ".$th_aktif.". Langkah selanjutnya adalah pemberkasan, silahkan kirim berkas pendaftaran di bawah ini ke kantor ITM Nganjuk pada jam kerja:

$berkas

Masukkan berkas di atas ke dalam map kertas berwarna *".$map."*. Kirimkan paling lambat pada tanggal *".indotime(date('Y-m-d', strtotime($tgluj." + 2 weeks")))."*.";
$postfield = [
	'recipient_type' => 'individual',
	'to' => $wa,
	'type' => 'text',
	'text' => ['body'=>$text]
];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.WAG_IP.'/api/v1/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postfield),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer dk_16ff14ab8b9d435db3928fec1b716a0f',
    'Content-Type: text/plain'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
}
function kirim_tidak_lulus($kode_reg){
$db 			= new Db();
$cbjg 		= camaba_jg($kode_reg);
$th_ak 		= $db->row("SELECT * FROM tahun WHERE status=1");
$th_aktif = $th_ak['tahun_akademik'];
$brks 		= preg_split('/\r\n|\r|\n/',$cbjg['berkas']);
$tglu 		= $db->row("SELECT * FROM ujian WHERE kode_reg='$kode_reg'");
$tgluj 		= $tglu['waktu_ujian'];
$wa  			= to62($cbjg['wa']);
if($cbjg['prodi']=='SI'){
  $map = get_option('map_si');
} elseif($cbjg['prodi']=='TI'){
  $map = get_option('map_ti');
} else {
  $map = get_option('map_pti');
}
$berkas = '- '.implode(PHP_EOL.'- ', $brks);
$text = "Mohon maaf! Kamu dinyatakan TIDAK LULUS Ujian Masuk ITM Tahun $th_aktif. Kamu bisa mencoba lagi pada tanggal ".indotime(date('Y-m-d', strtotime($tgluj." + 1 day")))."*.";
$postfield = [
	'recipient_type' => 'individual',
	'to' => $wa,
	'type' => 'text',
	'text' => ['body'=>$text]
];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.WAG_IP.'/api/v1/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postfield),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer dk_16ff14ab8b9d435db3928fec1b716a0f',
    'Content-Type: text/plain'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
}

function aktifkan($kode_reg,$wa){
	$db 		= new Db();

	# create password
	$upass 	= generate_password(8);

	# create user
	$q1 		= $db->insert('user',array('userpmb'=>$kode_reg,'passpmb'=>md5($upass),'role'=>2,'status'=>1));

	# update progress
	$q2 	= $db->query("UPDATE progress SET transfer=1 WHERE kode_reg='$kode_reg'");
	
	# update camaba
	$q3 	= $db->query("UPDATE camaba SET status=1 WHERE kode_reg='$kode_reg'");
	
	kirim_step1($wa,$kode_reg,$upass);
	header('Location: '.ADMIN_URL.'/pending?w=tambah&m=ok');
}

function kirim_aff($wa,$user,$pass){
$wa  = to62($wa);
/*$text = 
"Selamat kak $nama! Akun PMB Anda berhasil dibuat
*USER ID :* $user
*PASSWORD :* $pass
Selanjutnya klik link di bawah ini untuk melanjutkan pendaftaran ke STEP 2:
https://pmb.itmnganjuk.ac.id/akun
Gunakan AKUN di atas untuk log in ke dasbor PMB, dan lengkapi biodata Anda. Simpan akun PMB ini baik-baik di tempat yang aman.";*/
$text = "Selamat! Akun afiliasi PMB Anda telah aktif. Berikut detil akun Anda:

*USER ID :* $user 
*PASSWORD :* $pass

Selanjutnya klik link di bawah ini untuk masuk ke halaman affiliator:

https://pmb.itmnganjuk.ac.id/akun

Simpan akun ini baik-baik di tempat yang aman.";
$postfield = [
	'recipient_type' => 'individual',
	'to' => $wa,
	'type' => 'text',
	'text' => ['body'=>$text]
];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.WAG_IP.'/api/v1/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postfield),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer dk_16ff14ab8b9d435db3928fec1b716a0f',
    'Content-Type: text/plain'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
}

function kirim_ke_cs($wa,$nama,$reff){
$reff = get_name($reff);
$wa  = to62($wa);
/*$text = 
"Selamat kak $nama! Akun PMB Anda berhasil dibuat
*USER ID :* $user
*PASSWORD :* $pass
Selanjutnya klik link di bawah ini untuk melanjutkan pendaftaran ke STEP 2:
https://pmb.itmnganjuk.ac.id/akun
Gunakan AKUN di atas untuk log in ke dasbor PMB, dan lengkapi biodata Anda. Simpan akun PMB ini baik-baik di tempat yang aman.";*/
$text = "Assalamu'alaikum Wr. Wb. 
Ada mahasiswa baru dengan nama $nama yang didaftarkan melalui program afiliasi oleh $reff. Mohon dicek ya!";
$postfield = [
	'recipient_type' => 'individual',
	'to' => $wa,
	'type' => 'text',
	'text' => ['body'=>$text]
];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.WAG_IP.'/api/v1/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postfield),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer dk_16ff14ab8b9d435db3928fec1b716a0f',
    'Content-Type: text/plain'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
}

function kirim_bc($wa,$text){
$wa  = to62($wa);
$postfield = [
	'recipient_type' => 'individual',
	'to' => $wa,
	'type' => 'text',
	'text' => ['body'=>$text]
];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.WAG_IP.'/api/v1/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postfield),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer dk_16ff14ab8b9d435db3928fec1b716a0f',
    'Content-Type: text/plain'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
}
function list_camaba2($tahun='', $gel='',$jal='',$pro='',$status=''){
	$db = new Db();
	$q1 = "SELECT c.kode_reg,c.tgl_daftar,c.asal_sekolah,c.nama,c.jenis_kelamin,c.prodi,c.email,c.wa,c.jalur,j.nama_jalur,g.gelombang,g.id_gelombang,c.status,c.bukti,p.akun,p.biodata,p.transfer,p.berkas,p.ujian,p.diterima FROM camaba c LEFT JOIN progress p ON c.kode_reg=p.kode_reg LEFT JOIN jalur j ON c.jalur=j.kode_jalur LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang WHERE c.status=1";
	if($tahun!=''){
		$q1 .= " AND g.tahun=$tahun";
	}
	if($gel!=''){
		$q1 .= " AND c.gelombang=$gel";
	}
	if($jal!=''){
		$q1 .= " AND c.jalur='$jal'";
	}
	if($pro!=''){
		$q1 .= " AND c.prodi='$pro'";
	}
	if($status==1){
		$q1 .= " AND p.akun=1 AND p.biodata=0 AND p.transfer=1 AND p.berkas=0 AND p.ujian=0 AND p.diterima=0";
	} elseif($status==2){
		$q1 .= " AND p.akun=1 AND p.biodata=1 AND p.transfer=1 AND p.berkas=0 AND p.ujian=0 AND p.diterima=0";
	} elseif($status==3){
		$q1 .= " AND p.akun=1 AND p.biodata=1 AND p.transfer=1 AND p.berkas=0 AND p.ujian=1 AND p.diterima=0";
	} elseif($status==4){
		$q1 .= " AND p.akun=1 AND p.biodata=1 AND p.transfer=1 AND p.berkas=0 AND p.ujian=1 AND p.diterima=1";
	} elseif($status==5){
		$q1 .= " AND p.akun=1 AND p.biodata=1 AND p.transfer=1 AND p.berkas=1 AND p.ujian=1 AND p.diterima=1";
	} else {}
	$q1 .= " ORDER BY c.tgl_daftar DESC";
	$s1 = $db->query($q1);
	if($s1==0){
		return array();
	} else {
		return $s1;
	}
}

function record_ujian($tahun='', $gel='',$jal='',$pro='',$status=''){
	$db = new Db();
	$q1 = "SELECT u.id, u.kode_reg,u.waktu_ujian,u.batas_waktu,u.waktu_submit,u.soal,u.status,c.nama,c.asal_sekolah,c.jalur,g.tahun,c.prodi,c.gelombang,SUM(j.skor) as benar,COUNT(j.kode_reg) as terjawab,u.lulus FROM ujian u LEFT JOIN camaba c ON u.kode_reg=c.kode_reg LEFT JOIN jawaban j ON u.id=j.id_ujian LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang WHERE 1=1";
	if($tahun!=''){
		$q1 .= " AND g.tahun=$tahun";
	}
	if($gel!=''){
		$q1 .= " AND c.gelombang=$gel";
	}
	if($jal!=''){
		$q1 .= " AND c.jalur='$jal'";
	}
	if($pro!=''){
		$q1 .= " AND c.prodi='$pro'";
	}
	if($status==1){
		$q1 .= " AND u.lulus=1";
	} elseif($status==0){
		$q1 .= " AND u.lulus=0";
	} else {}
	$q1 .= " GROUP BY u.id";
	$s1 = $db->query($q1);
	if($s1==0){
		return array();
	} else {
		return $s1;
	}
}

function eksporcamaba($tahun='',$gel='',$jal='',$pro='',$status=''){
	$db = new Db();
	$q1 = "SELECT c.kode_reg, c.nisn, c.nik, c.nama, c.jenis_kelamin, c.tempat_lahir, c.tgl_lahir, c.agama, c.email, c.wa, c.prodi, c.jalur, g.gelombang, p.nama as provinsi, k.nama as kabupaten_kota, d.nama as kecamatan, c.alamat, c.kode_pos, c.asal_sekolah, c.thn_lulus, c.no_kip, c.kode_akses_kip, c.nama_ayah, c.nik_ayah, c.tgl_lahir_ayah, c.pendidikan_ayah, c.pekerjaan_ayah, c.penghasilan_ayah, c.no_hp_ayah, c.nama_ibu, c.nik_ibu, c.tgl_lahir_ibu, c.pendidikan_ibu, c.pekerjaan_ibu, c.penghasilan_ibu, c.no_hp_ibu, c.nama_wali, c.tgl_lahir_wali, c.pendidikan_wali, c.pekerjaan_wali, c.penghasilan_wali, c.no_hp_wali, c.proyeksi, c.sumber_info, c.tgl_daftar FROM camaba c LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang LEFT JOIN t_provinsi p ON c.provinsi=p.id LEFT JOIN t_kota k ON c.kabupaten_kota=k.id LEFT JOIN t_kecamatan d ON c.kecamatan=d.id LEFT JOIN progress r ON c.kode_reg=r.kode_reg WHERE c.status=1";
	if($tahun!=''){
		$q1 .= " AND g.tahun=$tahun";
	}
	if($gel!=''){
		$q1 .= " AND c.gelombang=$gel";
	}
	if($jal!=''){
		$q1 .= " AND c.jalur='$jal'";
	}
	if($pro!=''){
		$q1 .= " AND c.prodi='$pro'";
	}
	if($status==1){
		$q1 .= " AND p.akun=1 AND p.biodata=0 AND p.transfer=0 AND p.berkas=0 AND p.ujian=0 AND p.diterima=0";
	} elseif($status==2){
		$q1 .= " AND p.akun=1 AND p.biodata=1 AND p.transfer=0 AND p.berkas=0 AND p.ujian=0 AND p.diterima=0";
	} elseif($status==3){
		$q1 .= " AND p.akun=1 AND p.biodata=1 AND p.transfer=1 AND p.berkas=0 AND p.ujian=0 AND p.diterima=0";
	} elseif($status==4){
		$q1 .= " AND p.akun=1 AND p.biodata=1 AND p.transfer=1 AND p.berkas=1 AND p.ujian=0 AND p.diterima=0";
	} elseif($status==5){
		$q1 .= " AND p.akun=1 AND p.biodata=1 AND p.transfer=1 AND p.berkas=1 AND p.ujian=1 AND p.diterima=0";
	} elseif($status==6){
		$q1 .= " AND p.akun=1 AND p.biodata=1 AND p.transfer=1 AND p.berkas=1 AND p.ujian=1 AND p.diterima=1";
	} else {}
	$q1 .= " ORDER BY c.tgl_daftar DESC";
	$s1 = $db->query($q1);
	if($s1==0){
		return array();
	} else {
		return $s1;
	}

}
function tambah_camaba($args,$next_id,$s_name){
	$db 				= new Db();
	$args['wa'] = from62($args['wa']);
	$cek 				= $db->row("SELECT * FROM camaba WHERE gelombang={$args['gelombang']} AND (kode_reg='{$args['kode_reg']}' OR wa='{$args['wa']}')");
	if($cek==0){
		$db->beginTransaction();

		# add new camaba 
		$q1 				= $db->insert('camaba',$args);

		# add new user
		$upass 			= generate_password(8);
		$args2 			= array(
				'userpmb' => $args['kode_reg'],
				'passpmb' => md5($upass),
				'role' 		=> 2,
				'status' 	=> 1
		);
		$q2 				= $db->insert('user',$args2);

		# update counter 
		$q3 				= $db->update('counter',array('counter'=>$next_id),"WHERE type='ITM'");

		# insert progress
		$args3 			= array(
				'kode_reg' => $args['kode_reg'],
				'akun'		 => 1,
				'transfer' => 1
		);
		$q4 				= $db->insert('progress',$args3);

		$db->executeTransaction();
		kirim_step1($args['wa'],$kode_reg,$upass);
		writeLog($args['kode_reg'].' berhasil ditambahkan','pendaftar',$args['kode_reg'],$s_name);
		header('Location: '.ADMIN_URL.'/pendaftar?w=tambah&m=ok');

	} else {
		header('Location: '.ADMIN_URL.'/pendaftar?w=tambah&m=ada');
	}
}

function tambah_pending($args,$next_id,$s_name){
	$db 				= new Db();
	$args['wa'] = from62($args['wa']);
	$cek 				= $db->row("SELECT * FROM camaba WHERE gelombang={$args['gelombang']} AND (kode_reg='{$args['kode_reg']}' OR wa='{$args['wa']}')");
	if($cek==0){
		$db->beginTransaction();

		# add new camaba 
		$q1 				= $db->insert('camaba',$args);

		# update counter 
		$q3 				= $db->update('counter',array('counter'=>$next_id),"WHERE type='ITM'");

		# insert progress
		$args3 			= array(
				'kode_reg' => $args['kode_reg'],
				'akun'		 => 1
		);
		$q4 				= $db->insert('progress',$args3);

		$db->executeTransaction();
		kirim_ke_cs(get_option('wa_jawa'),$args['nama'],$args['reff']);
		writeLog($args['kode_reg'].' berhasil ditambahkan','pendaftar',$args['kode_reg'],$s_name);
		header('Location: '.ADMIN_URL.'?w=tambah&m=ok');

	} else {
		header('Location: '.ADMIN_URL.'?w=tambah&m=ada');
	}
}

function ubah_camaba($args,$s_name){
	$db 	= new Db();
	$q1 	= $db->update('camaba',$args,"WHERE kode_reg='{$args['kode_reg']}'");
	$q2 	= $db->query("UPDATE progress SET biodata=1 WHERE kode_reg='{$args['kode_reg']}'");
	writeLog($args['kode_reg'].' berhasil diubah','pendaftar',$args['kode_reg'],$s_name);
	header('Location: '.ADMIN_URL.'/pendaftar/profil/'.$args['kode_reg'].'?w=ubah&m=ok');
}

function step2($args,$send=0){
	$db 	= new Db();
	$q1 	= $db->update('camaba',$args,"WHERE kode_reg='{$args['kode_reg']}'");
	$q2 	= $db->query("UPDATE progress SET biodata=1 WHERE kode_reg='{$args['kode_reg']}'");
	writeLog($args['kode_reg'].' berhasil diubah','pendaftar',$args['kode_reg'],$args['kode_reg']);
	if($send==1){
		kirim_step2($args['kode_reg']);
		header('Location: '.ADMIN_URL);
	} else {
		header('Location: '.ADMIN_URL.'/biodata?w=ubah&m=ok');
	}
}

function step3($kode_reg,$soal){
	$db 		= new Db();
	$batas 	= date('Y-m-d H:i:s', strtotime("+60 minutes"));
	$args 	= array(
			'kode_reg' 		=> $kode_reg,
			'soal'		 		=> $soal,
			'waktu_ujian' => date('Y-m-d H:i:s'),
			'batas_waktu' => $batas
	);
	$q1 		= $db->insert('ujian',$args);
	writeLog($kode_reg.' memulai ujian','ujian',$kode_reg,$kode_reg);
	header('Location: '.ADMIN_URL.'/ujian');	
}

function step4($kode_reg,$iu){
	$db 				= new Db();
	$submit 		= date('Y-m-d H:i:s');
	$q1 				= $db->row("SELECT SUM(skor) AS skor,COUNT(skor) AS terjawab FROM jawaban WHERE kode_reg='$kode_reg' AND id_ujian=$iu");
	$skor 			= $q1['skor']==NULL ? 0 : $q1['skor'];
	$diterima 	= $q1['terjawab']>=25 ? 1 : 0;
	$q2 				= $db->query("UPDATE ujian SET waktu_submit='$submit', skor=$skor, status=1, lulus=$diterima WHERE id=$iu");
	$q3 				= $db->query("UPDATE progress SET ujian=1,diterima=$diterima WHERE kode_reg='$kode_reg'");
	if($diterima==1){
		kirim_lulus($kode_reg);
	} else {
		kirim_tidak_lulus($kode_reg);
	}
}
function hapus_camaba($kode_reg,$s_name){
	$db 	= new Db();

	$db->beginTransaction();
	$q1 	= $db->query("DELETE FROM camaba WHERE kode_reg='$kode_reg'");
	$q2 	= $db->query("DELETE FROM progress WHERE kode_reg='$kode_reg'");
	$q3 	= $db->query("DELETE FROM user WHERE userpmb='$kode_reg'");
	$q4 	= $db->query("DELETE FROM kartu WHERE kode_reg='$kode_reg'");
	$q5 	= $db->query("DELETE FROM jawaban WHERE kode_reg='$kode_reg'");
	$q6 	= $db->query("DELETE FROM ujian WHERE kode_reg='$kode_reg'");
	$db->executeTransaction();
	
	writeLog($kode_reg.' berhasil dihapus','pendaftar',$kode_reg,$s_name);
	header('Location: '.ADMIN_URL.'/pendaftar?w=hapus&m=ok');
}

function ubah_progress($args,$s_name){
	$db 	= new Db();
	$q1 = $db->update('progress',$args,"WHERE kode_reg='{$args['kode_reg']}'");
	writeLog('Progress untuk '.$args['kode_reg'].' berhasil diubah','progress',$args['kode_reg'],$s_name);
	header('Location: '.ADMIN_URL.'/pendaftar?w=ubah&m=ok');
}

function pindah_gelombang($args,$s_name){
	$db 	= new Db();
	$q1 = $db->update('camaba',$args,"WHERE kode_reg='{$args['kode_reg']}'");
	if($q1>0){
		writeLog($args['kode_reg'].' berhasil pindah gelombang','pendaftar',$args['kode_reg'],$s_name);
		header('Location: '.ADMIN_URL.'/pendaftar?w=ubah&m=ok');
	}	
}

function ubah_pengaturan($option_name,$option_value){
	$db = new Db();
	$q1 = $db->query("UPDATE pengaturan SET option_value='$option_value' WHERE option_name='$option_name'");
	header('Location: '.ADMIN_URL.'/pengaturan?w=ubah&m=ok');	
}
function generate_password($length = 20){
  $chars =  'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz'.
            '0123456789!@#$%&';

  $str = '';
  $max = strlen($chars) - 1;

  for ($i=0; $i < $length; $i++)
    $str .= $chars[random_int(0, $max)];

  return $str;
}

function jawab_soal($args){
	$db = new Db();
	$q1 = $db->row("SELECT * FROM jawaban WHERE kode_reg='{$args['kode_reg']}' AND id_ujian={$args['id_ujian']} AND id_pertanyaan={$args['id_pertanyaan']}");

	if(empty($q1)){
		$q2 = $db->insert('jawaban',$args);
	} else {
		$q2 = $db->update('jawaban',$args,"WHERE kode_reg='{$args['kode_reg']}'");
	}
}

function indotime($ts){ 
  $ts = strtotime($ts);
  $ts = date("j F Y", $ts);   
  $nmeng = array('january', 'february', 'march','april','may','june','july','august','september','october','november','december','sunday','monday','tuesday','wednesday','thursday','friday','saturday');
  $nmtur = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember','Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'); 
  $ts = str_ireplace($nmeng, $nmtur, $ts);
  return $ts;
}

function indotime_lengkap($ts){ 
  $ts = strtotime($ts);
  $ts = date("j F Y H:i:s", $ts);   
  $nmeng = array('january', 'february', 'march','april','may','june','july','august','september','october','november','december','sunday','monday','tuesday','wednesday','thursday','friday','saturday');
  $nmtur = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember','Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'); 
  $ts = str_ireplace($nmeng, $nmtur, $ts);
  return $ts;
}

function rupiah($angka){
 
 $hasil_rupiah = number_format($angka,0,',','.');
 return $hasil_rupiah;
 
}

function to62($number){
	$to62 = '62'.ltrim($number, '0');
	return $to62;
}
function from62($input){
	$string = preg_replace("/[^0-9]/", "", $input);
	$is62 	= substr($string, 0, 2);
	if($is62=='62'){
		$string = '0'.ltrim($string,'62');
	}
	return $string;
}