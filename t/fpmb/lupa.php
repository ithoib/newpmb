<?php 
include 'header.php';
echo
'<div id="j">'.
	'<div class="jw">	'.
		'<div class="jk">'.
			'<h1><i class="las la-sign-in-alt"></i> Reset Akun PMB</h1>';
			if($w=='px'){
				echo '<div class="lp">USER ID dan PASSWORD salah. Cek lagi dengan teliti!</div>';
			} elseif($w=='logout'){
				echo '<div class="lp">Anda telah keluar dari dasbor!</div>';
			} elseif($w=='tambah' && $m=='ada'){
				echo '<div class="lp">Anda sudah terdaftar. Silahkan masuk!</div>';
			} elseif($w=='lupa' && $m=='ko'){
				echo '<div class="lp">Nomor WA Anda tidak terdaftar. Periksa lagi baik-baik!</div>';
			} else {
				echo '<div class="lp">Silahkan masukkan nomor WA yang Anda gunakan saat pendaftaran. USER ID & PASSWORD akan dikirim ke nomor WA Anda.</div>';
			}
			echo
			'<form method="post" action="">'.
				'<label for="wa">NO WHATSAPP TERDAFTAR</label>'.
				'<input type="text" name="reset[wa]" class="jt" placeholder="No. Whatsapp" required="" id="wa" oninvalid="this.setCustomValidity(\'Masukkan No. WA Aktif Anda!\')" oninput="setCustomValidity(\'\')">'.
				'<button type="sumbit" class="jb">RESET PASSWORD <i class="las la-sign-in-alt"></i></button>'.
			'</form>'.
		'</div>'.
	'</div>'.
'</div>';
include 'footer.php';