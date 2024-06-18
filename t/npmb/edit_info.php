<?php 
if($view){
	$header_script .= '<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>';
	include 'header.php';
	echo
	'<div id="c">'.
		'<div class="ct">'.
			'<h2><i class="fas fa-bullhorn"></i> Edit Pengumuman</h2>'.
		'</div>'.
		'<div class="cti">'.
			'<form method="post" action="">'.
				'<label for="judul">Judul Pengumuman</label>'.
				'<input id="judul" type="text" name="ubah[judul]" placeholder="Judul Pengumuman" required="" class="modal-text" value="'.$view['judul'].'">'.
				'<input aria-label="id_pengumuman" type="hidden" name="ubah[id_pengumuman]" class="modal-text" value="'.$view['id_pengumuman'].'">'.
				'<label for="isi">Isi Pengumuman</label>'.
				'<textarea name="ubah[isi]">'.$view['isi'].'</textarea>'.
				'<label for="unduhan">Unduhan</label>'.
				'<input id="unduhan" type="text" name="ubah[unduhan]" placeholder="Link Unduhan" required="" class="modal-text" value="'.$view['unduhan'].'">'.
				'<button type="submit" class="modal-button">Ubah Pengumuman <i class="fas fa-plus"></i></button>'.
			'</form>'.
		'</div>'.
	'</div>'.
	'<script>'.
	'CKEDITOR.replace( \'ubah[isi]\' );'.
	'</script>';
	include 'footer.php';
} else {
	header('Location: '.ADMIN_URL.'/pengumuman');
}
?>