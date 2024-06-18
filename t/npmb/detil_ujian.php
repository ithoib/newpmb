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
		'<h2><i class="fas fa-poll"></i> Detil Hasil Ujian</h2>'.
	'</div>'.
	'<div class="hu">'.
		'<table class="ud">'.
			'<tr><th>Nama</th><td>:</td><td>'.$record[0]['nama'].'</td></tr>'.
			'<tr><th>Asal Sekolah</th><td>:</td><td>'.$record[0]['asal_sekolah'].'</td></tr>'.
			'<tr><th>Program Studi</th><td>:</td><td>'.$record[0]['prodi'].'</td></tr>'.
			'<tr><th>Gelombang</th><td>:</td><td>'.str_replace('Gelombang ','',$record[0]['gelombang']).'</td></tr>'.
			'<tr><th>Jalur</th><td>:</td><td>'.$record[0]['jalur'].'</td></tr>'.
			'<tr><th>Waktu Ujian</th><td>:</td><td>'.indotime_lengkap($record[0]['waktu_ujian']).' WIB</td></tr>'.
			'<tr><th>Waktu Submit</th><td>:</td><td>'.indotime_lengkap($record[0]['waktu_submit']).' WIB</td></tr>'.
			'<tr><th>Terjawab</th><td>:</td><td>'.$terjawab.' Soal</td></tr>'.
			'<tr><th>Benar</th><td>:</td><td>'.$benar.' Soal</td></tr>'.
			'<tr><th>Salah</th><td>:</td><td>'.$salah.' Soal</td></tr>'.
			'<tr><th>Skor</th><td>:</td><td>'.$skor.'</td></tr>'.
		'</table>'.
	'</div>';
	'</div>';
	'</div>';
	if($terjawab!=0){
		echo
		'<table id="mhs" class="display dt-responsive nowrap" style="font-size:14px;width:100%;">'.
			'<thead>'.
				'<tr>'.
					'<th>No. Soal</th>'.
					'<th>Jawaban</th>'.
				'</tr>'.
			'</thead>'.
			'<tbody>';
			$i = 0;
			foreach($record as $mhs){
				$i++;
				echo '<tr>'.
					'<td>'.$i.'</a></td>'.
					'<td>'.($mhs['skor']==1 ? 'BENAR' : 'SALAH').'</td>'.
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
'paging : false,'.
'info : false,'.
'language: { search: "", searchPlaceholder: "Cari data" },'.
'order: [],'.
'dom: "Bfrtip",'.
'buttons: ['.
'{'.
'extend: "excel",'.
'text: \'<i class="far fa-file-excel"></i> Excel\','.
'className: "bexc",'.
'title: "Hasil Ujian '.$iu.' Per Tanggal '.date('d-m-Y H:i:s').'",'.
'exportOptions: {'.
'columns: [":not(.notexport)"],'.
'}'.
'},'.
'{'.
'extend: "pdf",'.
'text: \'<i class="far fa-file-pdf"></i> PDF\','.
'title: "Hasil Ujian '.$iu.' Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bpdf",'.
'exportOptions: {'.
'columns: ":not(.notexport)"'.
'}'.
'},'.
'{'.
'extend: "print",'.
'text: \'<i class="fas fa-print"></i> Print\','.
'title: "Hasil Ujian '.$iu.' Per Tanggal '.date('d-m-Y H:i:s').'",'.
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