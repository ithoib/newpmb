<?php 
include 'header.php';
if($s_role==1){
echo
'<div id="c">'.
	'<div class="ct">'.
		'<h2><i class="fas fa-cogs"></i> Pengaturan</h2>'.
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
	if(!empty($pengaturan)){
		echo '<form method="post" action="" class="fpk">';
		foreach($pengaturan as $item){
			echo
			'<div class="form-group">'.
				'<label for="'.$item['option_name'].'">'.$item['option_nicename'].'</label>'.
				'<input id="'.$item['option_name'].'" type="text" name="ubah['.$item['option_name'].']" value="'.$item['option_value'].'" class="option-text">'.
			'</div>';
		}
		echo '<button type="submit" class="option-button">Simpan Perubahan</button>'.
		'</form>';
}
echo '</div>';
$footer_script .= '<script src="'.THEME_URL.'/a/close.js"></script>';
} else {
	echo
	'<div id="c">'.
		'<div class="ct">'.
			'<h2><i class="fas fa-cogs"></i> Pengaturan</h2>'.
		'</div>'.
		'<div class="cw">Anda tidak berhak mengakses halaman ini! <span class="cl"><i class="fas fa-times"></i></span></div>'.
	'</div>';
}
include 'footer.php';
?>