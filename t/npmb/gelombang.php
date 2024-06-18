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
		'<h2><i class="fas fa-water"></i> Gelombang Pendaftaran</h2>'.
		'<a href="#tambahgel" class="cj" rel="modal:open"><span>Tambah</span> <i class="fas fa-plus"></i></a>'.
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
	if(count($gelombang)>0){
		echo 
			'<table id="mhs" class="display dt-responsive nowrap" style="font-size:14px;width:100%;">'.
				'<thead>'.
					'<tr>'.
						'<th style="width:30px">No.</th>'.
						'<th>Gelombang</th>'.
						'<th style="width:50px">Tahun</th>'.
						'<th>Tgl Buka</th>'.
						'<th>Tgl Tutup</th>'.
						'<th class="hom">Biaya</th>'.
						'<th>Jalur</th>'.
						'<th style="width:80px">Status</th>'.
						'<th class="notexport" style="width:80px">Aksi</th>'.
					'</tr>'.
				'</thead>'.
				'<tbody>';
				$i = 0;
				foreach($gelombang as $item){
					$i++;
					$jg = $db->query("SELECT b.kode_jalur,b.nama_jalur,b.urutan FROM jalur_gelombang a,jalur b WHERE a.kode_jalur=b.kode_jalur AND a.id_gelombang={$item['id_gelombang']} ORDER BY b.urutan ASC");
					echo '<tr>'.
							'<td>'.$i.'</td>'.
							'<td>'.$item['gelombang'].'</td>'.
							'<td>'.$item['tahun'].'</td>'.
							'<td class="hom">'.indotime(date('Y-m-d',strtotime($item['tgl_buka']))).'</td>'.
							'<td>'.indotime(date('Y-m-d',strtotime($item['tgl_tutup']))).'</td>'.
							'<td class="hom">Rp '.number_format($item['biaya_daftar'],0,",",".").'</td>'.
							'<td>';
							$koja = array();
							$x = 0;
							foreach($jg as $ji){
								$x++;
								if($x==count($jg)){
									echo $ji['kode_jalur'];
								} elseif ($x==count($jg)-1){
									echo $ji['kode_jalur'].' & ';
								} else {
									echo $ji['kode_jalur'].', ';
								}
								$koja[] = $ji['kode_jalur'];
							}
							echo
							'</td>'.
							'<td>'.($item['status']==1 ? '<span class="cak"><i class="fas fa-check"></i> <em>Aktif</em></span>' : '<span class="ctk"><i class="fas fa-times"></i> <em>Tidak Aktif</em></span>').'</td>'.
							'<td><a href="#edit'.$item['id_gelombang'].'" class="cbe" rel="modal:open"><i class="fas fa-pencil-alt"></i></a> <a href="#hapus'.$item['id_gelombang'].'" class="cbh" rel="modal:open"><i class="fas fa-trash-alt"></i></a></td>'.
						'</tr>';
					$modal .=
					'<div id="hapus'.$item['id_gelombang'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Hapus Gelombang Pendaftaran</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<p>Apa Anda yakin akan menghapus '.$item['gelombang'].'?</p>'.
								'<form method="post" action="">'.
									'<input type="hidden" name="hapus[id_gelombang]" value="'.$item['id_gelombang'].'">'.
									'<div class="cbu">'.
										'<a href="#" rel="modal:close"><i class="fas fa-undo-alt"></i> Tidak</a>'.
										'<button type="submit" class="ya"><i class="fas fa-trash-alt"></i> Ya</button>'.
									'</div>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
					$modal .= 
					'<div id="edit'.$item['id_gelombang'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Ubah Gelombang Pendaftaran</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<form method="post" action="">'.
									'<input type="hidden" name="ubah[id_gelombang]" value="'.$item['id_gelombang'].'">'.
									'<label>Nama Gelombang</label>'.
									'<input type="text" name="ubah[gelombang]" placeholder="Nama Gelombang" required="" class="modal-text" value="'.$item['gelombang'].'">'.
									'<label>Tahun Akademik</label>'.
									'<select name="ubah[tahun]" class="modal-select" required="">';
									foreach($ta as $tg){
										$modal .= '<option value="'.$tg['tahun'].'" '.($tg['tahun']==$item['tahun'] ? 'selected' : '').'>'.$tg['tahun_akademik'].'</option>';
									}
									$modal .=
									'</select>'.
									'<label>Jalur yang Dibuka</label>'.
									'<div class="jlg">';
									foreach($jalur as $ji){
										$modal .= '<span><input type="checkbox" aria-label="'.$ji['kode_jalur'].'" name="ubah[kode_jalur][]" value="'.$ji['kode_jalur'].'" '.(in_array($ji['kode_jalur'], $koja) ? 'checked' : '').'> '.$ji['nama_jalur'].'</span>';
									}
									$modal .=
									'</div>'.
									'<label>Tanggal Buka</label>'.
									'<input type="date" name="ubah[tgl_buka]" placeholder="Tanggal Buka" required="" class="modal-text" value="'.$item['tgl_buka'].'">'.
									'<label>Tanggal Tutup</label>'.
									'<input type="date" name="ubah[tgl_tutup]" placeholder="Tanggal Tutup" required="" class="modal-text" value="'.$item['tgl_tutup'].'">'.
									'<label>Tanggal Ujian</label>'.
									'<input type="date" name="ubah[tgl_ujian]" placeholder="Tanggal Ujian" class="modal-text" value="'.$item['tgl_ujian'].'">'.
									'<label>Tanggal Pengumuman</label>'.
									'<input type="date" name="ubah[tgl_pengumuman]" placeholder="Tanggal Pengumuman" class="modal-text" value="'.$item['tgl_pengumuman'].'">'.
									'<label>Biaya Pendaftaran</label>'.
									'<input type="text" name="ubah[biaya_daftar]" placeholder="Biaya Pendaftaran" class="modal-text" value="'.$item['biaya_daftar'].'">'.
									'<label>Status</label>'.
									'<select name="ubah[status]" class="modal-select" required="">'.
										'<option value="0" '.($item['status']==0 ? 'selected' : '').'>Tidak Aktif</option>'.
										'<option value="1" '.($item['status']==1 ? 'selected=' : '').'>Aktif</option>'.
									'</select>'.
									'<button type="submit" class="modal-button"><i class="fas fa-pencil-alt"></i> Ubah Gelombang</button>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
				}
		echo '</tbody>'.
			'</table>';
	} else {
		echo '<div class="cw">Gelombang pendaftaran masih kosong. Tambahkan dulu! <span class="cl"><i class="fas fa-times"></i></span></div>';
	}
echo '</div>'.
'<div id="tambahgel" class="modal">'.
	'<div class="modal-content">'.
		'<div class="modal-header">'.
			'<a href="#" class="close" rel="modal:close">&times;</a>'.
			'<h2>Tambah Gelombang Pendaftaran</h2>'.
		'</div>'.
		'<div class="modal-body">';
		if(count($jalur)!=0){
			echo
			'<form method="post" action="">'.
				'<input type="hidden" name="tambah[id_gelombang]" value="'.$next_id.'">'.
				'<label>Nama Gelombang</label>'.
				'<input type="text" name="tambah[gelombang]" placeholder="Nama Gelombang" required="" class="modal-text">'.
				'<label>Tahun Akademik</label>'.
				'<select name="tambah[tahun]" class="modal-select" required="">';
				foreach($ta as $tg){
					echo '<option value="'.$tg['tahun'].'" '.($tg['tahun']==$th_pmb ? 'selected' : '').'>'.$tg['tahun_akademik'].'</option>';
				}
				echo
				'</select>'.
				'<label>Jalur yang Dibuka</label>'.
				'<div class="jlg">';
				foreach($jalur as $item){
					echo '<span><input type="checkbox" aria-label="'.$item['kode_jalur'].'" name="tambah[kode_jalur][]" value="'.$item['kode_jalur'].'"> '.$item['nama_jalur'].'</span>';
				}
				echo 
				'</div>'.
				'<label>Tanggal Buka</label>'.
				'<input type="date" name="tambah[tgl_buka]" placeholder="Tanggal Buka" required="" class="modal-text">'.
				'<label>Tanggal Tutup</label>'.
				'<input type="date" name="tambah[tgl_tutup]" placeholder="Tanggal Tutup" required="" class="modal-text">'.
				'<label>Tanggal Ujian</label>'.
				'<input type="date" name="tambah[tgl_ujian]" placeholder="Tanggal Ujian"  class="modal-text">'.
				'<label>Tanggal Pengumuman</label>'.
				'<input type="date" name="tambah[tgl_pengumuman]" placeholder="Tanggal Pengumuman" class="modal-text">'.
				'<label>Biaya Pendaftaran</label>'.
				'<input type="text" name="tambah[biaya_daftar]" placeholder="Biaya Pendaftaran" class="modal-text">'.
				'<label>Status</label>'.
				'<select name="tambah[status]" class="modal-select" required="">'.
					'<option value="0">Tidak Aktif</option>'.
					'<option value="1">Aktif</option>'.
				'</select>'.
				'<button type="submit" class="modal-button">Tambah Gelombang <i class="fas fa-plus"></i></button>'.
			'</form>';
		} else {
			echo '<p>Tidak ada jalur pendaftaran yang aktif. Aktifkan dulu! <span class="cl"><i class="fas fa-times"></i></span></p>';
		}	
		echo
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
'title: "Data Gelombang PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'exportOptions: {'.
'columns: [":not(.notexport)"],'.
'}'.
'},'.
'{'.
'extend: "pdf",'.
'text: \'<i class="far fa-file-pdf"></i> PDF\','.
'title: "Data Gelombang PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bpdf",'.
'exportOptions: {'.
'columns: ":not(.notexport)"'.
'}'.
'},'.
'{'.
'extend: "print",'.
'text: \'<i class="fas fa-print"></i> Print\','.
'title: "Data Gelombang PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
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
			'<h2><i class="fas fa-water"></i> Gelombang Pendaftaran</h2>'.
		'</div>'.
		'<div class="cw">Anda tidak berhak mengakses halaman ini! <span class="cl"><i class="fas fa-times"></i></span></div>'.
	'</div>';	
}
include 'footer.php';
?>