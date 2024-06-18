<?php 
$pt = 'Daftar PMB Tahun Akademik '.$th_aktif;
$mt = $pt;
$md = 'Daftar akun PMB Institut Teknologi Mojosari Nganjuk Tahun Akademik '.$th_aktif;
$cn = SITEURL.'/'.$t_URL[0];
$in = 1;
$cg = $db->row("SELECT * FROM gelombang WHERE status=1");
if(!empty($cg)) {
	include FRONT_THEME_DIR.'/daftarnew.php';
} else {
	include FRONT_THEME_DIR.'/daftar.php';
}
?>