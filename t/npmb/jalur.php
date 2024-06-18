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
		'<h2><i class="fas fa-route"></i> Jalur Pendaftaran</h2>'.
		'<a href="#tambahjalur" class="cj" rel="modal:open"><span>Tambah</span> <i class="fas fa-plus"></i></a>'.
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
	if(count($jalur)>0){
		echo 
			'<table id="mhs" class="display dt-responsive nowrap" style="font-size:14px;width:100%;">'.
				'<thead>'.
					'<tr>'.
						'<th style="width:50px">No.</th>'.
						'<th style="width:80px">Kode Jalur</th>'.
						'<th class="hom">Nama Jalur</th>'.
						// '<th>Berkas Persyaratan</th>'.
						'<th style="width:80px">Status</th>'.
						'<th class="notexport" style="width:80px">Aksi</th>'.
					'</tr>'.
				'</thead>'.
				'<tbody>';
				$i = 0;
				foreach($jalur as $item){
					$i++;
					$brks = preg_split('/\r\n|\r|\n/',$item['berkas']);
					$brks = '<ul><li>'.implode('</li><li>', $brks).'</li></ul>';
					echo '<tr>'.
							'<td>'.$i.'</td>'.
							'<td>'.$item['kode_jalur'].'</td>'.
							'<td class="hom">'.$item['nama_jalur'].'</td>'.
							// '<td>'.$brks.'</td>'.
							'<td>'.($item['status']==1 ? '<span class="cak"><i class="fas fa-check"></i> <em>Aktif</em></span>' : '<span class="ctk"><i class="fas fa-times"></i> <em>Tidak Aktif</em></span>').'</td>'.
							'<td><a href="#edit'.$item['kode_jalur'].'" class="cbe" rel="modal:open"><i class="fas fa-pencil-alt"></i></a> <a href="#hapus'.$item['kode_jalur'].'" class="cbh" rel="modal:open"><i class="fas fa-trash-alt"></i></a></td>'.
						'</tr>';
					$modal .=
					'<div id="hapus'.$item['kode_jalur'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Hapus Jalur Pendaftaran</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<p>Apa Anda yakin akan menghapus jalur pendaftaran '.$item['nama_jalur'].'?</p>'.
								'<form method="post" action="">'.
									'<input type="hidden" name="hapus[kode_jalur]" value="'.$item['kode_jalur'].'">'.
									'<div class="cbu">'.
										'<a href="#" rel="modal:close"><i class="fas fa-undo-alt"></i> Tidak</a>'.
										'<button type="submit" class="ya"><i class="fas fa-trash-alt"></i> Ya</button>'.
									'</div>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
					$modal .= 
					'<div id="edit'.$item['kode_jalur'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Ubah Jalur Pendaftaran</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<form method="post" action="">'.
									'<label>Kode Jalur</label>'.
									'<input type="text" name="kode_jalur" placeholder="Kode Jalur" required="" class="modal-text" disabled="" value="'.$item['kode_jalur'].'">'.
									'<input type="hidden" name="ubah[kode_jalur]" value="'.$item['kode_jalur'].'">'.
									'<label>Nama Jalur</label>'.
									'<input type="text" name="ubah[nama_jalur]" placeholder="Nama Jalur" required="" class="modal-text" value="'.$item['nama_jalur'].'">'.
									'<label>Berkas Persyaratan</label>'.
									'<textarea name="ubah[berkas]" placeholder="Masukkan berkas persyaratan, pisahkan dengan ganti baris jika lebih dari satu." required="" class="modal-textarea">'.$item['berkas'].'</textarea>'.
									'<label>Urutan</label>'.
									'<input type="number" name="ubah[urutan]" placeholder="Urutan" required="" class="modal-text" value="'.$item['urutan'].'">'.
									'<label>Status</label>'.
									'<select name="ubah[status]" class="modal-select" required="">'.
										'<option value="0" '.($item['status']==0 ? 'selected' : '').'>Tidak Aktif</option>'.
										'<option value="1" '.($item['status']==1 ? 'selected=' : '').'>Aktif</option>'.
									'</select>'.
									'<button type="submit" class="modal-button"><i class="fas fa-pencil-alt"></i> Ubah Jalur</button>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
				}
		echo '</tbody>'.
			'</table>';
	} else {
		echo '<div class="cw">Jalur pendaftaran masih kosong. Tambahkan dulu! <span class="cl"><i class="fas fa-times"></i></span></div>';
	}
echo '</div>'.
'<div id="tambahjalur" class="modal">'.
	'<div class="modal-content">'.
		'<div class="modal-header">'.
			'<a href="#" class="close" rel="modal:close">&times;</a>'.
			'<h2>Tambah Jalur Pendaftaran</h2>'.
		'</div>'.
		'<div class="modal-body">'.
			'<form method="post" action="">'.
				'<label>Kode Jalur</label>'.
				'<input type="text" name="tambah[kode_jalur]" placeholder="Kode Jalur" required="" class="modal-text">'.
				'<label>Nama Jalur</label>'.
				'<input type="text" name="tambah[nama_jalur]" placeholder="Nama Jalur" required="" class="modal-text">'.
				'<label>Berkas Persyaratan</label>'.
				'<textarea name="tambah[berkas]" placeholder="Masukkan berkas persyaratan, pisahkan dengan ganti baris jika lebih dari satu." required="" class="modal-textarea"></textarea>'.
				'<label>Urutan</label>'.
				'<input type="number" name="tambah[urutan]" placeholder="Urutan" required="" class="modal-text" value="'.$next_id.'">'.
				'<label>Status</label>'.
				'<select name="tambah[status]" class="modal-select" required="">'.
					'<option value="0">Tidak Aktif</option>'.
					'<option value="1">Aktif</option>'.
				'</select>'.
				'<button type="submit" class="modal-button">Tambah Jalur <i class="fas fa-plus"></i></button>'.
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
'{responsivePriority: 1, targets: 0},'.
'{responsivePriority: 2, targets: -1}'.
'],'.
'language: {search: "", searchPlaceholder: "Cari data"},'.
'paging : false,'.
'info : false,'.
'order: [],'.
'dom: "Bfrtip",'.
'buttons: ['.
'{'.
'extend: "excel",'.
'text: \'<i class="far fa-file-excel"></i> Excel\','.
'className: "bexc",'.
'title: "Data Jalur PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'exportOptions: {'.
'columns: [":not(.notexport)"],'.
'}'.
'},'.
'{'.
'extend: "pdf",'.
'text: \'<i class="far fa-file-pdf"></i> PDF\','.
'title: "Data Jalur PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bpdf",'.
'exportOptions: {'.
'columns: ":not(.notexport)"'.
'}'.
'},'.
'{'.
'extend: "print",'.
'text: \'<i class="fas fa-print"></i> Print\','.
'title: "Data Jalur PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
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
			'<h2><i class="fas fa-route"></i> Jalur Pendaftaran</h2>'.
		'</div>'.
		'<div class="cw">Anda tidak berhak mengakses halaman ini! <span class="cl"><i class="fas fa-times"></i></span></div>'.
	'</div>';
}
include 'footer.php';
?>