<?php
echo
'<div id="g">'.
	'<div class="gw">'.
		'<div class="gi">'.
			'<img src="'.FRONT_THEME_URL.'/c/5124556.png" alt="">'.
		'</div>'.
		'<div class="gs">'.
			'<h3>Ada Masalah Terkait PMB?</h3>'.
			'<p>Hubungi kami melalui WA ke nomor '.get_option('no_wa_support').' atau datang langsung ke kantor Institut Teknologi Mojosari untuk mendapatkan bantuan lebih lanjut.</p>'.
			'<a href="https://wa.me/'.to62(get_option('no_wa_support')).'" class="ea"><i class="lab la-whatsapp"></i> Hubungi Kami</a>'.
		'</div>'.
	'</div>'.
'</div>'.
'<div id="f">'.
	'<div class="fw">'.
		'&copy; Institut Teknologi Mojosari '.date('Y').'. Made with &hearts; by <a href="https://ithoib.blogspot.com">ithoib</a>.'.
	'</div>'.
'</div>'.
'<script>'.
'const am = document.getElementById("am");'.
'const ar = document.getElementById("ar");'.
'am.onclick = function() {'.
'if(ar.className=="visible"){'.
'ar.classList.remove("visible");'.
'ar.style.visibility = "hidden";'.
'} else {'.
'ar.classList.add("visible");'.
'ar.style.visibility = "visible";'.
'}'.
'}'.
'</script>'.
'</body>'.
'</html>';