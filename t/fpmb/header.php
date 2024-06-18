<?php
echo
'<!DOCTYPE html>'.
'<html>'.
'<head>'.
'<meta charset="utf-8">'.
'<meta name="viewport" content="width=device-width, initial-scale=1">'.
'<title>'.$mt.'</title>'.
($in==1 ? '<meta name="description" content="'.$md.'"/>' : '<meta name="robots" content="noindex"/>').
'<link rel="shortcut icon" type="image/x-icon" href="'.SITEURL.'/favicon.ico">'.
'<link rel="preconnect" href="https://fonts.googleapis.com">'.
'<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>'.
'<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> '.
'<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">'.
'<link rel="stylesheet" type="text/css" href="'.FRONT_THEME_URL.'/c/c.css?t='.time().'">'.
'</head>'.
'<body>'.
'<div id="a">'.
	'<div class="aw">'.
		'<div class="al">'.
			'<a href="'.SITEURL.'">'.
				'<img src="'.FRONT_THEME_URL.'/c/logo-itm.png" alt="">'.
				'<span>PMB</span>'.
				'<span>'.$th_aktif.'</span>'.
			'</a>'.
		'</div>'.
		'<div id="ar">'.
			'<ul>'.
				'<li><a href="'.SITEURL.'/pengumuman"><i class="las la-bullhorn"></i> Pengumuman</a></li>'.
				'<li><a href="'.SITEURL.'/panduan"><i class="las la-book-open"></i> Panduan</a></li>'.
				'<li class="ak"><a href="'.SITEURL.'/akun"><i class="lar la-user"></i> Akun</a></li>'.
				'<li class="ad"><a href="'.SITEURL.'/daftar"><i class="las la-book-reader"></i> Daftar</a></li>'.
			'</ul>'.
		'</div>'.
		'<button id="am">&#9776;</button>'.
	'</div>'.
'</div>';