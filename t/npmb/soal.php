<?php 
$header_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>';
$header_script .= '<link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/datatables.min.css" rel="stylesheet"/>';
$header_script .= '<script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/datatables.min.js"></script>';
$header_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>';
$header_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>';
include 'header.php';
if($s_role==1){
echo
'<div id="c">'.
	'<div class="ct">'.
		'<h2><i class="fas fa-question-circle"></i> Bank Soal</h2>'.
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
	if(count($soal)>0){
		echo 
			'<table id="mhs" class="display dt-responsive nowrap" style="font-size:14px;width:100%;">'.
				'<thead>'.
					'<tr>'.
						'<th style="width:30px">No.</th>'.
						'<th>Nama Soal</th>'.
						'<th>Jumlah Pertanyaan</th>'.
						'<th style="width:80px">Status</th>'.
						'<th class="notexport" style="width:80px">Aksi</th>'.
					'</tr>'.
				'</thead>'.
				'<tbody>';
				$i = 0;
				foreach($soal as $item){
					$i++;
					echo '<tr>'.
							'<td>'.$i.'</td>'.
							'<td>'.$item['nama_soal'].'</td>'.
							'<td>'.$item['jumlah_pertanyaan'].'</td>'.
							'<td>'.($item['status']==1 ? '<span class="cak"><i class="fas fa-check"></i> <em>Aktif</em></span>' : '<span class="ctk"><i class="fas fa-times"></i> <em>Tidak Aktif</em></span>').'</td>'.
							'<td><a href="'.$cn.'/'.$item['id_soal'].'" class="cbb" title="Lihat Pertanyaan"><i class="fas fa-eye"></i></a> <a href="#pertanyaan'.$item['id_soal'].'" class="cbw" rel="modal:open" title="Tambah Pertanyaan"><i class="fas fa-plus"></i></a> <a href="#edit'.$item['id_soal'].'" class="cbe" rel="modal:open"><i class="fas fa-pencil-alt"></i></a> <a href="#hapus'.$item['id_soal'].'" class="cbh" rel="modal:open"><i class="fas fa-trash-alt"></i></a></td>'.
						'</tr>';
					$modal .=
					'<div id="hapus'.$item['id_soal'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Hapus Soal</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<p>Apa Anda yakin akan menghapus?</p>'.
								'<form method="post" action="">'.
									'<input type="hidden" name="hapus[id_soal]" value="'.$item['id_soal'].'">'.
									'<div class="cbu">'.
										'<a href="#" rel="modal:close"><i class="fas fa-undo-alt"></i> Tidak</a>'.
										'<button type="submit" class="ya"><i class="fas fa-trash-alt"></i> Ya</button>'.
									'</div>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
					$modal .= 
					'<div id="edit'.$item['id_soal'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Ubah Soal</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<form method="post" action="">'.
									'<input type="hidden" name="ubah[id_soal]" value="'.$item['id_soal'].'">'.
									'<label>Nama Soal</label>'.
									'<input type="text" name="ubah[nama_soal]" placeholder="Nama Soal" required="" class="modal-text" value="'.$item['nama_soal'].'">'.
									'<label>Status</label>'.
									'<select name="ubah[status]" class="modal-select" required="">'.
										'<option value="0" '.($item['status']==0 ? 'selected' : '').'>Tidak Aktif</option>'.
										'<option value="1" '.($item['status']==1 ? 'selected=' : '').'>Aktif</option>'.
									'</select>'.
									'<button type="submit" class="modal-button"><i class="fas fa-pencil-alt"></i> Ubah</button>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
					$modal .= 
					'<div id="pertanyaan'.$item['id_soal'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Tambah Pertanyaan</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<form method="post" action="">'.
									'<input type="hidden" name="goto[id_soal]" value="'.$item['id_soal'].'">'.
									'<label for="jumlah">Jumlah Pertanyaan</label>'.
									'<input id="jumlah" type="number" name="goto[jumlah]" placeholder="Jumlah" required="" class="modal-text">'.
									'<button type="submit" class="modal-button"><i class="fas fa-plus"></i> Tambah</button>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
				}
		echo '</tbody>'.
			'</table>';
	} else {
		echo '<div class="cw">Belum ada soal. Tambahkan dulu! <span class="cl"><i class="fas fa-times"></i></span></div>';
	}
echo '</div>'.
'<div id="tambah" class="modal">'.
	'<div class="modal-content">'.
		'<div class="modal-header">'.
			'<a href="#" class="close" rel="modal:close">&times;</a>'.
			'<h2>Tambah Soal</h2>'.
		'</div>'.
		'<div class="modal-body">'.
			'<form method="post" action="">'.
				'<label>Nama Soal</label>'.
				'<input type="text" name="tambah[nama_soal]" placeholder="Nama Soal" required="" class="modal-text">'.
				'<label>Status</label>'.
				'<select name="tambah[status]" class="modal-select" required="">'.
					'<option value="0">Tidak Aktif</option>'.
					'<option value="1">Aktif</option>'.
				'</select>'.
				'<button type="submit" class="modal-button">Tambah Soal <i class="fas fa-plus"></i></button>'.
			'</form>'.
		'</div>'.
	'</div>'.
'</div>'.
$modal;
$footer_script .= '<script src="'.THEME_URL.'/a/modal.js"></script>';
$footer_script .= '<script src="'.THEME_URL.'/a/close.js"></script>';
$footer_script .=
'<script>'.
'$(document).ready( function () {'.
'$(\'#mhs\').DataTable({'.
'responsive: true,'.
'columnDefs: ['.
'{ responsivePriority: 1, targets: 0 },'.
'{ responsivePriority: 2, targets: -1 }'.
'],'.
'language: { search: "", searchPlaceholder: "Cari data" },'.
'paging : false,'.
'info : false,'.
'order: [],'.
'dom: "Bfrtip",'.
'buttons: ['.
'{'.
'extend: "excel",'.
'text: \'<i class="far fa-file-excel"></i> Excel\','.
'className: "bexc",'.
'title: "Data Soal PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'exportOptions: {'.
'columns: [":not(.notexport)"],'.
'}'.
'},'.
'{'.
'extend: "pdf",'.
'text: \'<i class="far fa-file-pdf"></i> PDF\','.
'title: "Data Soal PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bpdf",'.
'exportOptions: {'.
'columns: ":not(.notexport)"'.
'}'.
'},'.
'{'.
'extend: "print",'.
'text: \'<i class="fas fa-print"></i> Print\','.
'title: "Data Soal PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bprn",'.
'exportOptions: {'.
'columns: [":not(.notexport)"]'.
'}'.
'},'.
'],'.
'});'.
'} );'.
'</script>';
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