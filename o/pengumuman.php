<?php 
$pt = 'Pengumuman - PMB Institut Teknologi Mojosari Tahun '.$th_aktif;
$mt = $pt;
$md = 'Pengumuman terkait dengan PMB Institut Teknologi Mojosari Tahun '.$th_aktif;
$cn = SITEURL.'/'.$t_URL[0];
$in = 1;
$pengumuman = $db->query("SELECT * FROM pengumuman WHERE YEAR(tgl)='$th_pmb'");
include FRONT_THEME_DIR.'/pengumuman.php';
?>