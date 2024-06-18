<?php 
include 'header.php'; 
if($s_role==1){
echo
'<div id="c">'.
	'<div class="ct">'.
		'<h2><i class="fas fa-question-circle"></i> Daftar Pertanyaan</h2>'.
		'<a href="#tambah" class="cj" rel="modal:open"><span>Tambah</span> <i class="fas fa-plus"></i></a>'.
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
	$modal = '';
	if(@$lq){
		echo 
		'<div class="ctab">'.
			'<table>'.
				'<thead>'.
					'<tr>'.
						'<th>No.</th>'.
						'<th>Pertanyaan</th>'.
						'<th style="width:75px">Aksi</th>'.
					'</tr>'.
				'</thead>'.
				'<tbody>';
				$i = 0;
				foreach($lq as $item){
					$i++;
					echo '<tr>'.
							'<td>'.$i.'</td>'.
							'<td>'.$item['pertanyaan'].'</td>'.
							'<td><a href="'.$cn.'/'.$is.'/pertanyaan/'.$item['id_pertanyaan'].'" class="cbe"><i class="fas fa-pencil-alt"></i></a> <a href="#hapus'.$item['id_pertanyaan'].'" class="cbh" rel="modal:open"><i class="fas fa-trash-alt"></i></a></td>'.
						'</tr>';
					$modal .=
					'<div id="hapus'.$item['id_pertanyaan'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Hapus Pertanyaan</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<p>Apa Anda yakin akan menghapus?</p>'.
								'<form method="post" action="">'.
									'<input type="hidden" name="hapus[id_pertanyaan]" value="'.$item['id_pertanyaan'].'">'.
									'<div class="cbu">'.
										'<a href="#" rel="modal:close"><i class="fas fa-undo-alt"></i> Tidak</a>'.
										'<button type="submit" class="ya"><i class="fas fa-trash-alt"></i> Ya</button>'.
									'</div>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
				}
		echo '</tbody>'.
			'</table>'.
		'</div>';
	} else {
		echo '<div class="cw">Belum ada pertanyaan. Tambahkan dulu! <span class="cl"><i class="fas fa-times"></i></span></div>';
	}
echo '</div>'.
'<div id="tambah" class="modal">'.
	'<div class="modal-content">'.
		'<div class="modal-header">'.
			'<a href="#" class="close" rel="modal:close">&times;</a>'.
			'<h2>Tambah Pertanyaan</h2>'.
		'</div>'.
		'<div class="modal-body">'.
			'<form method="post" action="">'.
				'<input type="hidden" name="goto[id_soal]" value="'.$is.'">'.
				'<label for="jumlah">Jumlah Pertanyaan</label>'.
				'<input id="jumlah" type="number" name="goto[jumlah]" placeholder="Jumlah" required="" class="modal-text">'.
				'<button type="submit" class="modal-button"><i class="fas fa-plus"></i> Tambah</button>'.
			'</form>'.
		'</div>'.
	'</div>'.
'</div>'.
$modal;
$footer_script .= '<script src="'.THEME_URL.'/a/modal.js"></script>';
$footer_script .= '<script src="'.THEME_URL.'/a/close.js"></script>';
} else {
	echo
	'<div id="c">'.
		'<div class="ct">'.
			'<h2><i class="fas fa-question-circle"></i> Bank Soal</h2>'.
		'</div>'.
		'<div class="cw">Anda tidak berhak mengakses halaman ini! <span class="cl"><i class="fas fa-times"></i></span></div>'.
	'</div>';	
}
include 'footer.php'; 


?>