<?php 
$page = $c_URL==3 ? 1 : $t_URL[3];
$num = 10;
if($page>$num || @$t_URL[3]==1){
	header('Location: '.ADMIN_URL.'/ujian');	
} else {
	$iu 			= $cek['id'];
	$prtnyn 		= array_chunk(explode(',',$cek['soal']),5);
	$qstn 			= $prtnyn[$page-1];
	shuffle($qstn);
	$modal 			= '';
	$header_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>';
	include 'header.php'; 
	echo
	'<div id="u">';
		if(isset($_POST['kirim'])){
			step4($kode_reg,$iu);
			echo 
			'<div class="loading">'.
				'<img src="'.THEME_URL.'/a/loading.gif">'.
				'<h3>Selamat!</h3>'.
				'<p>Kamu telah menyelesaikan USUK ITM Nganjuk Tahun '.$th_aktif.'</p>'.
				'<p>Tunggu <span id="detik">10</span> detik, kami sedang mengkalkulasi hasil ujian Anda...</p>'.
			'</div>';?>
			<script>
			var seconds = 10;
			var foo;
			function redirect() {
				document.location.href = '<?php echo ADMIN_URL;?>';
			}
			function updateSecs() {
				document.getElementById("detik").innerHTML = seconds;
				seconds--;
				if (seconds == -1) {
					clearInterval(foo);
					redirect();
				}
			}
			function countdownTimer() {
				foo = setInterval(function () {
					updateSecs()
				}, 1000);
			}
			countdownTimer();
			</script>
		<?php	
		} else {
			echo 
			'<div class="ct">'.
				'<h2>USUK ITM Nganjuk Tahun '.$th_aktif.'</h2><div id="sisa"></div>'.
			'</div>'.
			'<div class="soal">
			<form method="post" action="">';
			$i = 0;
			foreach($qstn as $qs){
				$i++;
				$q1 = $db->row("SELECT * FROM pertanyaan WHERE id_pertanyaan=$qs");
				$q2 = (array)$db->query("SELECT * FROM pilihan WHERE id_pertanyaan=$qs");
				$q3 = $db->row("SELECT * FROM jawaban WHERE id_ujian=$iu AND id_pertanyaan=$qs AND kode_reg='$kode_reg'");
				$jb = !empty($q3) ? $q3['jawaban'] : '';
				shuffle($q2);
				echo 
				'<div class="sq">'.
					'<div class="sr">'.
					$q1['pertanyaan'].
						'<div class="opsi">';
						foreach($q2 as $op){
							echo '<div class="ops"><input type="radio" class="ock" name="soal['.$i.'][jawaban]" value="'.$q1['id_soal'].'.'.$qs.'.'.$op['id_pilihan'].'.'.$op['status'].'.'.$iu.'" '.($op['id_pilihan']==$jb ? 'checked' : '').'>'.$op['pilihan'].'</div>';
						}
					echo '</div>'.
					'</div>'.
				'</div>';
			}
			echo 
			'</form>'.
			'</div>'.
			'<div id="pgn">';
			if($page==1){
				echo '<a href="'.$cn.'/'.($page+1).'">Selanjutnya <i class="fas fa-chevron-right" disabled></i></a>';
			} elseif($page==$num){
				echo '<a href="'.$cn.'/'.($page-1).'"><i class="fas fa-chevron-left"></i> Sebelumnya</a>';
				echo '<a href="#kirim" rel="modal:open"><i class="fas fa-upload"></i> Kirim Jawaban</a>';
			} else {
				echo '<a href="'.$cn.(($page-1)==1 ? '' : '/'.($page-1)).'"><i class="fas fa-chevron-left"></i> Sebelumnya</a>';
				echo '<a href="'.$cn.'/'.($page+1).'">Selanjutnya <i class="fas fa-chevron-right"></i></a>';
			}
			echo
			'</div>';
			$modal .= '<div id="kirim" class="modal">'.
				'<div class="modal-content">'.
					'<div class="modal-header">'.
						'<a href="#" class="close" rel="modal:close">&times;</a>'.
						'<h2>Kirim Jawaban</h2>'.
					'</div>'.
					'<div class="modal-body">'.
						'<p>Apa Anda yakin akan mengirim jawaban dan mengakhiri ujian ini?</p>'.
						'<form method="post" action="">'.
							'<div class="cbu">'.
								'<a href="#" rel="modal:close"><i class="fas fa-undo-alt"></i> Tidak</a>'.
								'<button type="submit" class="ya" name="kirim"><i class="fas fa-trash-alt"></i> Ya</button>'.
							'</div>'.
						'</form>'.
					'</div>'.
				'</div>'.
			'</div>'.
			'<script>'.
			'$(document).ready(function(){'.
			'$(\'input[type="radio"]\').click(function(){'.
			'var vk = $(this).val();'.
			'$.ajax({'.
			'url:"'.SITEURL.'/ajax",'.
			'method:"POST",'.
			'data:{a:vk,b:\''.$kode_reg.'\'}'.
			'});'.
			'});'.
			'});'.
			'var countDownDate = new Date("'.$cek['batas_waktu'].'").getTime();'.
			'var x = setInterval(function() {'.
			'var now = new Date().getTime();'.
			'var distance = countDownDate - now;'.
			'var days = Math.floor(distance / (1000 * 60 * 60 * 24));'.
			'var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));'.
			'var minutes = Math.floor(((distance-1) % (1000 * 60 * 60 * 24)) / (1000 * 60));'.
			'var seconds = Math.floor((distance % (1000 * 60)) / 1000);'.
			'document.getElementById("sisa").innerHTML = minutes + ":" + seconds;'.
			'if (distance < 0) {'.
				'clearInterval(x);'.
				'document.getElementById("sisa").innerHTML = "<b>WAKTU HABIS</b>";'.
				'document.getElementById("pgn").style.display = "none";'.
				'var opsi = document.querySelectorAll(".ock");'.
				'var len=opsi.length;'.
			   	'for(var i=0;i<len;i++)'.
			   	'{'.
			       'opsi[i].disabled=true;'.
			   	'}'.
			   	'function redirectWithPost(url, postData) {'.
				'var form = document.createElement(\'form\');'.
				'form.method = \'POST\';'.
				'form.action = url;'.
				'for (var key in postData) {'.
				'if (postData.hasOwnProperty(key)) {'.
				'var input = document.createElement(\'input\');'.
				'input.type = \'hidden\';'.
				'input.name = key;'.
				'input.value = postData[key];'.
				'form.appendChild(input);'.
				'}'.
				'}'.
				'document.body.appendChild(form);'.
				'form.submit();'.
				'}'.
				'var redirectUrl = \''.ADMIN_URL.'/ujian\';'.
				'var postData = { kirim: 1};'.
				'redirectWithPost(redirectUrl, postData);'.
			'}'.
			'}, 1000);'.
			'</script>';

		}
	echo
	'</div>'.
	$modal;
	$footer_script .= '<script src="'.THEME_URL.'/a/modal.js"></script>';
	include 'footer.php'; 
}
?>