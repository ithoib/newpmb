<?php 
$header_script .= '<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>';
include 'header.php'; 
if($s_role==1){
echo
'<div id="c">'.
	'<div class="ct">'.
		'<h2><i class="fas fa-question-circle"></i> Edit Pertanyaan</h2>'.
	'</div>';
	if($w=='tambah'){
		if($m=='ada'){
			echo '<div class="cw">Data sudah ada. Jangan menambahkan lebih dari 1 kali! <span class="cl"><i class="fas fa-times"></i></span></div>';
		} elseif($m=='ok'){
			echo '<div class="co">Data berhasil ditambahkan! <span class="cl"><i class="fas fa-times"></i></span></div>';
		}
	} elseif($w=='ubah'){
		if($m=='ok'){
			echo '<div class="co">Data berhasil diubah! <span class="cl"><i class="fas fa-times"></i></span></div>';
		}
	} elseif($w=='hapus'){
		if($m=='ok'){
			echo '<div class="co">Data berhasil dihapus! <span class="cl"><i class="fas fa-times"></i></span></div>';
		}
	}
	echo
	'<form method="post" action="">'.
		'<div class="nq">'.
			'<div class="np">'.
				'<textarea class="editor" name="ubah[pertanyaan]">'.$dp['pertanyaan'].'</textarea>'.
			'</div>';
			if(!empty($pp)){
				echo '<div class="no">'.
						'<label><strong>Pilihan Ganda :</strong></label>';
				foreach($pp as $pi){
					echo
					'<div class="ni">'.
						'<input type="radio" value="'.$pi['id_pilihan'].'" class="or" '.($pi['status']==1 ? 'checked' : '').' name="ubah[jawaban]">'.
						'<input type="text" placeholder="Isi pilihan ke di sini" class="ox" name="ubah[pilihan]['.$pi['id_pilihan'].']" value="'.$pi['pilihan'].'">'.
					'</div>';
				}
				echo '</div>';
			}
		echo
		'</div>'.
	'<button class="cj" type="submit" name="submit"><i class="fas fa-save"></i> Edit Pertanyaan</button>'.
'</form></div>';
} else {
	echo
	'<div id="c">'.
		'<div class="ct">'.
			'<h2><i class="fas fa-question-circle"></i> Bank Soal</h2>'.
		'</div>'.
		'<div class="cw">Anda tidak berhak mengakses halaman ini! <span class="cl"><i class="fas fa-times"></i></span></div>'.
	'</div>';	
}
$footer_script .= '<script src="'.THEME_URL.'/a/close.js"></script>';
echo 
'<script>'.
'var allEditors = document.querySelectorAll(\'.editor\');'.
'for (var i = 0; i < allEditors.length; ++i) {'.
  'CKEDITOR.replace(allEditors[i]);'.
'}'.
'</script>';
include 'footer.php'; 
?>