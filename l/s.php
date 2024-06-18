<?php
# SYSTEM VARIABLE
# ========================================================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('date.timezone', 'Asia/Jakarta');
date_default_timezone_set("Asia/Jakarta");
setlocale(LC_TIME, 'id_ID');

# GLOBAL VARIABLE
# ========================================================
define("SITENAME", 'PMB ITM');
define("SITEURL", 'http://pmbitm.devs');
define("ADMIN_PATH", 'akun/dasbor');
define("ADMIN_URL", SITEURL.'/'.ADMIN_PATH);
define("SITEURL_MODE", "DOMAIN"); // DIR or DOMAIN
define("THEME_NAME", 'npmb');
define("THEME_DIR", 't/' . THEME_NAME);
define("THEME_URL", SITEURL . '/' . THEME_DIR);
define("FRONT_THEME_NAME", 'fpmb');
define("FRONT_THEME_DIR", 't/' . FRONT_THEME_NAME);
define("FRONT_THEME_URL", SITEURL . '/' . FRONT_THEME_DIR);
define("WAG_IP", '38.242.145.136:3001');

# DATABASE CONFIGURATION
# ========================================================
define("DB_HOST", 'localhost');
define("DB_NAME", 'pmb');
define("DB_USER", 'root');
define("DB_PASSWORD", '');

# for pdo (will be deprecated soon)
define("dsn","mysql:host=localhost;dbname=".DB_NAME);

# PREDEFINED VARIABLE
# ========================================================

$admin_menu = array(
	array('menu'=>'Beranda','url'=>ADMIN_URL,'icon'=>'<i class="fas fa-home"></i>'),
	array('menu'=>'Jalur Pendaftaran','url'=>ADMIN_URL.'/jalur','icon'=>'<i class="fas fa-route"></i>'),
	array('menu'=>'Tahun Akademik','url'=>ADMIN_URL.'/tahun','icon'=>'<i class="fas fa-layer-group"></i>'),
	array('menu'=>'Gelombang','url'=>ADMIN_URL.'/gelombang','icon'=>'<i class="fas fa-water"></i>'),
	array('menu'=>'Program Studi','url'=>ADMIN_URL.'/prodi','icon'=>'<i class="fas fa-warehouse"></i>'),
	array('menu'=>'Afiliasi','url'=>ADMIN_URL.'/pending','icon'=>'<i class="fas fa-user-alt-slash"></i>'),
	array('menu'=>'Pendaftar','url'=>ADMIN_URL.'/pendaftar','icon'=>'<i class="fas fa-users"></i>'),
	array('menu'=>'Pengumuman','url'=>ADMIN_URL.'/pengumuman','icon'=>'<i class="fas fa-bullhorn"></i>'),
	array('menu'=>'Broadcast','url'=>ADMIN_URL.'/broadcast','icon'=>'<i class="fas fa-envelope-open-text"></i>'),
	array('menu'=>'Ekspor Data','url'=>ADMIN_URL.'/ekspor','icon'=>'<i class="far fa-file-excel"></i>'),
	array('menu'=>'Bank Soal','url'=>ADMIN_URL.'/soal','icon'=>'<i class="fas fa-question-circle"></i>'),
	array('menu'=>'Hasil Ujian','url'=>ADMIN_URL.'/record','icon'=>'<i class="fas fa-poll"></i>'),
	array('menu'=>'Administrator','url'=>ADMIN_URL.'/administrator','icon'=>'<i class="fas fa-user-cog"></i>'),
	array('menu'=>'Affiliator','url'=>ADMIN_URL.'/affiliator','icon'=>'<i class="fas fa-retweet"></i>'),
	array('menu'=>'Pengaturan','url'=>ADMIN_URL.'/pengaturan','icon'=>'<i class="fas fa-cogs"></i>'),
	array('menu'=>'Keluar','url'=>SITEURL.'/akun/logout','icon'=>'<i class="fas fa-sign-out-alt"></i>')
);

$camaba_menu = array(
	array('menu'=>'Beranda','url'=>ADMIN_URL,'icon'=>'<i class="fas fa-home"></i>'),
	array('menu'=>'Biodata','url'=>ADMIN_URL.'/biodata','icon'=>'<i class="fas fa-user"></i>'),
	array('menu'=>'Grup WA PMB','url'=>'https://chat.whatsapp.com/HN8J4BfanlDBTRJ4IWgFnk','icon'=>'<i class="fab fa-whatsapp"></i>'),
	array('menu'=>'Keluar','url'=>SITEURL.'/akun/logout','icon'=>'<i class="fas fa-sign-out-alt"></i>')
);

$aff_menu = array(
	array('menu'=>'Beranda','url'=>ADMIN_URL,'icon'=>'<i class="fas fa-home"></i>'),
	array('menu'=>'Keluar','url'=>SITEURL.'/akun/logout','icon'=>'<i class="fas fa-sign-out-alt"></i>')
);
session_start();