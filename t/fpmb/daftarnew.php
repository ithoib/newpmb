<?php 
echo
'<!DOCTYPE html>'.
'<html>'.
'<head>'.
'<meta charset="utf-8">'.
'<meta name="viewport" content="width=device-width, initial-scale=1">'.
'<title>Pendaftaran - PMB Institut Teknologi Mojosari Tahun '.$th_aktif.'</title>'.
'<link rel="preconnect" href="https://fonts.googleapis.com">'.
'<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>'.
'<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> '.
'<link rel="stylesheet" type="text/css" href="'.FRONT_THEME_URL.'/c/b.css?t='.time().'">'.
'<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">'.
'</head>'.
'<body>'.
'<div id="m">'.
	'<div class="mw">'.
		'<h1><i class="las la-user-circle"></i> Pendaftaran Akun PMB</h1>'.
		'<p>Untuk mendapatkan akun PMB, silahkan lakukan pembayaran biaya pendaftaran ke rekening di bawah ini:</p>'.
		'<div class="norek">'.
		  '<img src="'.THEME_URL.'/a/bri.png" alt="Nomor Rekening BRI ITM Nganjuk">'.
	      '<table>'.
	        '<tr><th>Nomor Rekening</th><td>:</td><td><strong>'.get_option('norek_itm').'</strong></td></tr>'.
	        '<tr><th>Nama Rekening</th><td>:</td><td>Institut Teknologi Mojosari</td></tr>'.
	        '<tr><th>Bank</th><td>:</td><td>BRI Kantor Cabang Nganjuk</td></tr>'.
	        '<tr><th>Jumlah Transfer</th><td>:</td><td><strong>Rp '.number_format($cg['biaya_daftar'],0,',','.').'</strong></td></tr>'.
	      '</table>'.
	    '</div>'.
		'<h2><i class="las la-check-square"></i> Petunjuk Pembayaran:</h2>'.
		'<ul>'.
			'<li>Pembayaran dapat dilakukan melalui transfer bank dari bank manapun</li>'.
			'<li>Pembayaran dapat dilakukan melalui teller, mobile banking ataupun internet banking</li>'.
			'<li>Lakukan konfirmasi dengan melampirkan bukti pembayaran melalui tombol di bawah ini menggunakan nomor WhatsApp yang aktif</li>'.
			'<li>Satu nomor WA hanya dapat digunakan satu kali konfirmasi pembayaran</li>'.
			'<li>Akun PMB akan dikirimkan ke nomor WA yang digunakan untuk konfirmasi pembayaran</li>'.
			'<li>Lakukan konfirmasi pembayaran pada jam kerja, jika dilakukan di luar jam kerja maka akan diproses keesokan hari pada jam kerja</li>'.
			'<li>Jam kerja kantor Institut Teknologi Mojosari : <strong>Senin s.d. Sabtu</strong> Jam <strong>08.00 s.d. 16.00 WIB</strong></li>'.
			'<li><strong>Jika Anda tidak dapat melakukan pembayaran melalui transfer bank, Anda bisa membayar langsung di Kantor ITM pada jam kerja</strong></li>'.
		'</ul>'.
		'<a class="mk" href="https://api.whatsapp.com/send?phone=6281333210003&text=Assalamu%27alaikum%20kak!%20Saya%20ingin%20konfirmasi%20pembayaran%20PMB%20ITM.%20Berikut%20saya%20lampirkan%20bukti%20transfernya.%20Mohon%20dibantu."><i class="las la-calendar-check"></i> Konfirmasi Pembayaran</a>'.
	'</div>'.
'</div>'.
'</body>'.
'</html>';