<?php 
echo
'<!DOCTYPE html>'.
'<html>'.
'<head>'.
	'<meta charset="utf-8">'.
	'<meta name="viewport" content="width=device-width, initial-scale=1">'.
	'<title>'.$mt.'</title>'.
	'<meta name="robots" content="noindex"/>'.
	'<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>'.
	'<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">'.
	$header_script.
	'<link rel="stylesheet" type="text/css" href="'.THEME_URL.'/a/c.css?v=2.1">'.
'</head>'.
'<body>'.
'<div id="a">'.
	'<div id="l">'.
		'<div class="lo">'.
			'<a href="'.ADMIN_URL.'">'.
				'<img src="'.THEME_URL.'/a/logo-itm.png">'.
				'<strong>PMB</strong>'.
				'<span>'.$th_aktif.'</span>'.
			'</a>'.
		'</div>'.
		'<div class="lm">'.
			'<ul>';
			$menus = $s_role==1 ? $admin_menu : ( $s_role==2 ? $camaba_menu : $aff_menu) ;
			foreach($menus as $menu){
				echo '<li '.($menu['url']==$cn ? 'class="lk"' : '').'><a href="'.$menu['url'].'" title="'.$menu['menu'].'">'.$menu['icon'].' <em>'.$menu['menu'].'</em></a></li>';
			}
			echo
				'<li><a id="lh"><i class="fas fa-chevron-circle-left"></i> <em id="tgl">Sembunyikan</em></a></li>'.
			'</ul>'.
		'</div>'.
	'</div>'.
	'<div id="r">'.
		'<div id="m">'.
			'<h1><i class="fas fa-graduation-cap"></i> P<span>enerimaan </span>M<span>ahasiswa </span>B<span>aru</span> '.$th_aktif.'</h1>'.
			'<div class="rm">'.
				'<a href="#" class="sm">'.$s_name.'</a>'.
				'<button id="am">☰</button>'.
			'</div>'.
		'</div>';