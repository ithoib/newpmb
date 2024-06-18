<?php 
$header_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>';
$header_script .= '<link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/datatables.min.css" rel="stylesheet"/>';
$header_script .= '<script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/datatables.min.js"></script>';
$header_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>';
$header_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>';
include 'header.php';
echo 
'<div id="ad">'.
	'<div id="ado">'.
		'<div class="afk">'.
			'<span>Total Pendaftar</span>'.
			'<strong>'.$taff.'</strong>'.
		'</div>'.
		'<div class="afk">'.
			'<span>Total Komisi</span>'.
			'<strong>Rp '.rupiah($tkom).'</strong>'.
		'</div>'.
	'</div>'.
	'<div id="adr">'.
		'<div class="aft">'.
			'<h2><i class="fas fa-users"></i> Laporan Afiliasi '.get_name($aff).'</h2>'.
		'</div>';
		if(count($laff)!=0){
			if($taff!=0){
				echo
				'<table id="mhs" class="display dt-responsive nowrap" style="font-size:14px;width:100%;">'.
					'<thead>'.
						'<tr>'.
							'<th>No.</th>'.
							'<th>Tgl Daftar</th>'.
							'<th>Nama</th>'.
							'<th>No. WA</th>'.
							'<th>Asal Sekolah</th>'.
							'<th>Gel</th>'.
							'<th>Komisi</th>'.
						'</tr>'.
					'</thead>'.
					'<tbody>';
				foreach($laff as $mhs){
					echo '<tr>'.
						'<td>'.$mhs['kode_reg'].'</td>'.
						'<td>'.date('d-m-Y',strtotime($mhs['tgl_daftar'])).'</td>'.
						'<td>'.$mhs['nama'].'</td>'.
						'<td>'.$mhs['wa'].'</td>'.
						'<td>'.$mhs['asal_sekolah'].'</td>'.
						'<td>'.str_replace('Gelombang ','',$mhs['gelombang']).'</td>'.
						'<td>Rp '.rupiah($mhs['komisi']).'</td>'.
					'</tr>';
				}
				echo '</tbody>'.
			'</table>';
			} else {
				echo '<div class="cw">Tidak ada data <span class="cl"><i class="fas fa-times"></i></span></div>';
			}
		} else {
			echo '<div class="cw">Tidak ada data <span class="cl"><i class="fas fa-times"></i></span></div>';
		}

	echo
	'</div>'.
'</div>';
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
'title: "Laporan Afiliasi PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'exportOptions: {'.
'columns: [":not(.notexport)"],'.
'}'.
'},'.
'{'.
'extend: "pdf",'.
'text: \'<i class="far fa-file-pdf"></i> PDF\','.
'title: "Laporan Afiliasi PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bpdf",'.
'exportOptions: {'.
'columns: ":not(.notexport)"'.
'}'.
'},'.
'{'.
'extend: "print",'.
'text: \'<i class="fas fa-print"></i> Print\','.
'title: "Laporan Afiliasi PMB ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bprn",'.
'exportOptions: {'.
'columns: [":not(.notexport)"]'.
'}'.
'},'.
'],'.
'});'.
'} );'.
'</script>';
include 'footer.php';
?>