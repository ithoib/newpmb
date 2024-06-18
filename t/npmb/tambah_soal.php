<?php 
$header_script .= '<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>';
include 'header.php'; 
echo
'<div id="c">'.
	'<div class="ct">'.
		'<h2><i class="fas fa-question-circle"></i> Buat Pertanyaan</h2>'.
	'</div>
	<form method="post" action="">';
	for($i=1;$i<=$num;$i++){
		echo 
		'<div class="nq">'.
			'<h3>Pertanyaan Nomor '.$i.'</h3>'.
			'<div class="np">'.
				'<textarea class="editor" name="soal['.$i.'][pertanyaan]"></textarea>'.
			'</div>'.
			'<div class="no">'.
				'<label><strong>Pilihan Ganda :</strong></label>';
				for($j=1;$j<=5;$j++){
					echo
					'<div class="ni">'.
						'<input type="radio" value="'.$j.'" class="or" name="soal['.$i.'][jawaban]">'.
						'<input type="text" placeholder="Isi pilihan ke '.$j.' di sini" class="ox" name="soal['.$i.'][pilihan]['.$j.']">'.
					'</div>';
				}
			echo
			'</div>'.
		'</div>';
	}
echo 
	'<button class="cj" type="submit" name="submit"><i class="fas fa-save"></i> Simpan Pertanyaan</button>'.
'</form></div>'.
'<script>'.
'var allEditors = document.querySelectorAll(\'.editor\');'.
'for (var i = 0; i < allEditors.length; ++i) {'.
  'CKEDITOR.replace(allEditors[i]);'.
'}'.
'</script>';
include 'footer.php'; ?>