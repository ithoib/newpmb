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
		'<h2><i class="fas fa-poll"></i> Hasil Ujian Seleksi Masuk ITM</h2>'.
	'</div>'.
	'<form method="post" action="" class="cfilter">'.
		'<select name="pilih[tahun]" aria-label="pilih tahun">'.
			'<option value="">Tahun Akademik</option>';
		foreach($all_th as $th){
			echo '<option value="'.$th['tahun'].'" '.($fth==$th['tahun'] ? 'selected' : '').'>'.$th['tahun_akademik'].'</option>';
		}
		echo
		'</select>'.
		'<select name="pilih[gelombang]" aria-label="pilih gelombang">'.
			'<option value="">Semua Gelombang</option>';
		if($fth!=''){
			$all_gel = $db->query("SELECT * FROM gelombang WHERE tahun=$fth");
		} else {
			$all_gel = $db->query("SELECT * FROM gelombang");
		}
		foreach($all_gel as $gel){
			echo '<option value="'.$gel['id_gelombang'].'" '.($fgel==$gel['id_gelombang'] ? 'selected' : '').'>'.$gel['gelombang'].'</option>';
		}
		echo
		'</select>'.
		'<select name="pilih[jalur]" aria-label="pilih jalur">'.
			'<option value="">Semua Jalur</option>';
		foreach($all_jalur as $jal){
			echo '<option value="'.$jal['kode_jalur'].'" '.($fjal==$jal['kode_jalur'] ? 'selected' : '').'>'.$jal['nama_jalur'].'</option>';
		}
		echo
		'</select>'.
		'<select name="pilih[prodi]" aria-label="pilih prodi">'.
			'<option value="">Semua Prodi</option>';
		foreach($all_prod as $prod){
			echo '<option value="'.$prod['kode_prodi'].'" '.($fpro==$prod['kode_prodi'] ? 'selected' : '').'>'.$prod['nama_prodi'].'</option>';
		}
		echo
		'</select>'.
		'<select name="pilih[status]" aria-label="pilih prodi">'.
			'<option value="">Semua Status</option>'.
			'<option value="1" '.($fsta==1 ? 'selected' : '').'>Lulus</option>'.
			'<option value="0" '.($fsta==0 ? 'selected' : '').'>Tidak Lulus</option>'.
		'</select>'.
		'<button type="submit"><i class="fas fa-filter"></i> Filter</button>'.
	'</form>';
	if(!empty($record)){
		echo
		'<table id="mhs" class="display dt-responsive nowrap" style="font-size:14px;width:100%;">'.
			'<thead>'.
				'<tr>'.
					'<th>ID</th>'.
					'<th>Kode Reg</th>'.
					'<th>Nama</th>'.
					'<th>Asal Sekolah</th>'.
					'<th>Prodi</th>'.
					'<th>Skor</th>'.
					// '<th>Terjawab</th>'.
					// '<th>Benar</th>'.
					// '<th>Salah</th>'.
					'<th>Waktu Ujian</th>'.
					'<th>Status</th>'.
				'</tr>'.
			'</thead>'.
			'<tbody>';
			$i = 0;
			foreach($record as $mhs){
				$i++;
				$t_soal = count(explode(',', $mhs['soal']));
				echo '<tr>'.
					'<td>'.$mhs['id'].'</td>'.
					'<td><a href="'.$cn.'/'.$mhs['id'].'">'.$mhs['kode_reg'].'</a></td>'.
					'<td>'.$mhs['nama'].'</td>'.
					'<td>'.$mhs['asal_sekolah'].'</td>'.
					'<td>'.$mhs['prodi'].'</td>'.
					'<td>'.round($mhs['benar']/$t_soal*100).'</td>'.
					// '<td>'.$mhs['terjawab'].'</td>'.
					// '<td>'.$mhs['benar'].'</td>'.
					// '<td>'.($t_soal-$mhs['benar']).'</td>'.
					'<td>'.$mhs['waktu_ujian'].'</td>'.
					// '<td>'.($mhs['lulus']==1 ? '<span class="cak">LULUS</span>' : '<span class="ctk">GAGAL</span>').'</td>'.
					'<td>'.($mhs['lulus']==1 ? '<span class="cak"><i class="fas fa-check"></i> <em>LULUS</em></span>' : '<span class="ctk"><i class="fas fa-times"></i> <em>GAGAL</em></span>').'</td>'.
				'</tr>';
			}
			echo '</tbody>'.
			'</table>';
	} else {
		echo '<div class="cw">Tidak ada data <span class="cl"><i class="fas fa-times"></i></span></div>';
	}
echo '</div>';
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
'pageLength : 50,'.
'order: [],'.
'dom: "Bfrtip",'.
'buttons: ['.
'{'.
'extend: "excel",'.
'text: \'<i class="far fa-file-excel"></i> Excel\','.
'className: "bexc",'.
'title: "Hasil Ujian Masuk ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'exportOptions: {'.
'columns: [":not(.notexport)"],'.
'}'.
'},'.
'{'.
'extend: "pdf",'.
'text: \'<i class="far fa-file-pdf"></i> PDF\','.
'title: "Hasil Ujian Masuk ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bpdf",'.
'exportOptions: {'.
'columns: ":not(.notexport)"'.
'}'.
'},'.
'{'.
'extend: "print",'.
'text: \'<i class="fas fa-print"></i> Print\','.
'title: "Hasil Ujian Masuk ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
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
			'<h2><i class="fas fa-poll"></i> Hasil Ujian Seleksi Masuk ITM</h2>'.
		'</div>'.
		'<div class="cw">Anda tidak berhak mengakses halaman ini! <span class="cl"><i class="fas fa-times"></i></span></div>'.
	'</div>';	
}
include 'footer.php'; 


?>