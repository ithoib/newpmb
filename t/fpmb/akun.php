<?php 
include 'header.php';
echo
'<div id="j">'.
	'<div class="jw">	'.
		'<div class="jk">'.
			'<h1><i class="las la-sign-in-alt"></i> Akun PMB '.$th_aktif.'</h1>';
			if($w=='px'){
				echo '<div class="lp">USER ID dan PASSWORD salah. Cek lagi dengan teliti!</div>';
			} elseif($w=='logout'){
				echo '<div class="lp">Anda telah keluar dari dasbor!</div>';
			} elseif($w=='tambah' && $m=='ada'){
				echo '<div class="lp">Anda sudah terdaftar. Silahkan masuk!</div>';
			} elseif($w=='lupa' && $m=='ok'){
				echo '<div class="lp">Akun Anda berhasil direset. Silahkan masuk menggunakan USER ID dan PASSWORD yang kami kirim ke nomor WA Anda.</div>';
			} else {
				echo '<div class="lp">Silahkan masuk menggunakan USER ID dan PASSWORD yang diberikan setelah proses pendaftaran.</div>';
			}
			echo
			'<form method="post" action="">'.
				'<label for="user">USER ID</label>'.
				'<input type="text" name="login[userpmb]" class="jt" placeholder="User ID" required="" id="user" oninvalid="this.setCustomValidity(\'Masukkan USER ID Anda!\')" oninput="setCustomValidity(\'\')">'.
				'<label for="password">PASSWORD</label>'.
				'<input type="password" name="login[passwordpmb]" class="jt" placeholder="Password" required="" id="password" oninvalid="this.setCustomValidity(\'Masukkan Password Anda!\')" oninput="setCustomValidity(\'\')">'.
				'<button type="sumbit" class="jb">Masuk <i class="las la-sign-in-alt"></i></button>'.
			'</form>'.
			'<div class="forget">Lupa Password? <a href="'.SITEURL.'/lupa">Klik di sini!</a></div>'.
		'</div>'.
	'</div>'.
'</div>';
include 'footer.php';