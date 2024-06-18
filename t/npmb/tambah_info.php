<?php 
$header_script .= '<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>';
include 'header.php';
echo
'<div id="c">'.
	'<div class="ct">'.
		'<h2><i class="fas fa-bullhorn"></i> Tambah Pengumuman</h2>'.
	'</div>'.
	'<div class="cti">'.
		'<form method="post" action="">'.
			'<label>Judul Pengumuman</label>'.
			'<input type="text" name="tambah[judul]" placeholder="Judul Pengumuman" required="" class="modal-text">'.
			'<label>Isi Pengumuman</label>'.
			'<textarea name="tambah[isi]"></textarea>'.
			'<label>Unduhan</label>'.
			'<input type="text" name="tambah[unduhan]" placeholder="Link Unduhan"  class="modal-text">'.
			'<button type="submit" class="modal-button">Tambah Pengumuman <i class="fas fa-plus"></i></button>'.
		'</form>'.
	'</div>'.
'</div>'.
'<script>'.
'CKEDITOR.replace( \'tambah[isi]\' );'.
'</script>';
include 'footer.php';
?>