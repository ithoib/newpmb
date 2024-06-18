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
		'<h2><i class="fas fa-users"></i> Ekspor Data Pendaftar</h2>'.
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
			$all_gel = $db->query("SELECT * FROM gelombang ORDER BY tahun DESC");
		}
		foreach($all_gel as $gel){
			echo '<option value="'.$gel['id_gelombang'].'" '.($fgel==$gel['id_gelombang'] ? 'selected' : '').'>'.$gel['gelombang'].' Tahun '.$gel['tahun'].'</option>';
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
			'<option value="1" '.($fsta==1 ? 'selected' : '').'>Step 1</option>'.
			'<option value="2" '.($fsta==2 ? 'selected' : '').'>Step 2</option>'.
			'<option value="3" '.($fsta==3 ? 'selected' : '').'>Step 3</option>'.
			'<option value="4" '.($fsta==4 ? 'selected' : '').'>Step 4</option>'.
			'<option value="5" '.($fsta==5 ? 'selected' : '').'>Step 5</option>'.
			// '<option value="6" '.(@$_POST['pilih']['status']==6 ? 'selected' : '').'>Diterima</option>'.
		'</select>'.
		'<button type="submit"><i class="fas fa-filter"></i> Filter</button>'.
		// '<a href="'.$au.'/pendaftar/export'.($fgel!='' ? '?gel='.$fgel : '?gel=').($fjal!='' ? '&jal='.$fjal : '&jal=').($fpro!='' ? '&pro='.$fpro : '&pro=').($fsta!='' ? '&sta='.$fsta : '&sta=').'" class="export"><i class="fas fa-file-excel"></i> Export</a>'.
	'</form>';
	if(count($pendaftar)>0){
		echo
		'<table id="mhs" class="display dt-responsive nowrap" width="100%" style="font-size:15px">'.
			'<thead>'.
				'<tr>'.
					'<th data-priority="1">Kode Registrasi</th>'.
					'<th>NISN</th>'.
					'<th>NIK</th>'.
					'<th data-priority="2">Nama</th>'.
					'<th>L/P</th>'.
					'<th>Tempat Lahir</th>'.
					'<th>Tgl Lahir</th>'.
					'<th>Agama</th>'.
					'<th>Email</th>'.
					'<th>No HP</th>'.
					'<th>Prodi</th>'.
					'<th>Jalur</th>'.
					'<th>Gelombang</th>'.
					'<th>Provinsi</th>'.
					'<th>Kabupaten/Kota</th>'.
					'<th>Kecamatan</th>'.
					'<th>Alamat</th>'.
					'<th>Kode Pos</th>'.
					'<th>Asal Sekolah</th>'.
					'<th>Tahun Lulus</th>'.
					'<th>No. KIP</th>'.
					'<th>Kode Akses KIP</th>'.
					'<th>Nama Ayah</th>'.
					'<th>NIK Ayah</th>'.
					'<th>Tgl. Lahir Ayah</th>'.
					'<th>Pendidikan Ayah</th>'.
					'<th>Pekerjaan Ayah</th>'.
					'<th>Penghasilan Ayah</th>'.
					'<th>No. HP Ayah</th>'.
					'<th>Nama Ibu</th>'.
					'<th>NIK Ibu</th>'.
					'<th>Tgl. Lahir Ibu</th>'.
					'<th>Pendidikan Ibu</th>'.
					'<th>Pekerjaan Ibu</th>'.
					'<th>Penghasilan Ibu</th>'.
					'<th>No. HP Ibu</th>'.
					'<th>Nama Wali</th>'.
					'<th>Tgl. Lahir Wali</th>'.
					'<th>Pendidikan Wali</th>'.
					'<th>Pekerjaan Wali</th>'.
					'<th>Penghasilan Wali</th>'.
					'<th>No. HP Wali</th>'.
					'<th>Proyeksi</th>'.
					'<th>Sumber Info</th>'.
					'<th>Tgl. Daftar</th>'.
				'</tr>'.
			'</thead>'.
			'<tbody>';
			$i = 0;
		foreach($pendaftar as $mhs){
			$i++;
			echo '<tr>'.
					'<td>'.$mhs['kode_reg'].'</td>'.
					'<td>'.$mhs['nisn'].'</td>'.
					'<td>'.$mhs['nik'].'</td>'.
					'<td>'.$mhs['nama'].'</td>'.
					'<td>'.$mhs['jenis_kelamin'].'</td>'.
					'<td>'.$mhs['tempat_lahir'].'</td>'.
					'<td>'.$mhs['tgl_lahir'].'</td>'.
					'<td>'.$mhs['agama'].'</td>'.
					'<td>'.$mhs['email'].'</td>'.
					'<td>'.$mhs['wa'].'</td>'.
					'<td>'.$mhs['prodi'].'</td>'.
					'<td>'.$mhs['jalur'].'</td>'.
					'<td>'.str_replace('Gelombang ','',$mhs['gelombang']).'</td>'.
					'<td>'.$mhs['provinsi'].'</td>'.
					'<td>'.$mhs['kabupaten_kota'].'</td>'.
					'<td>'.$mhs['kecamatan'].'</td>'.
					'<td>'.$mhs['alamat'].'</td>'.
					'<td>'.$mhs['kode_pos'].'</td>'.
					'<td>'.$mhs['asal_sekolah'].'</td>'.
					'<td>'.$mhs['thn_lulus'].'</td>'.
					'<td>'.$mhs['no_kip'].'</td>'.
					'<td>'.$mhs['kode_akses_kip'].'</td>'.
					'<td>'.$mhs['nama_ayah'].'</td>'.
					'<td>'.$mhs['nik_ayah'].'</td>'.
					'<td>'.$mhs['tgl_lahir_ayah'].'</td>'.
					'<td>'.$mhs['pendidikan_ayah'].'</td>'.
					'<td>'.$mhs['pekerjaan_ayah'].'</td>'.
					'<td>'.$mhs['penghasilan_ayah'].'</td>'.
					'<td>'.$mhs['no_hp_ayah'].'</td>'.
					'<td>'.$mhs['nama_ibu'].'</td>'.
					'<td>'.$mhs['nik_ibu'].'</td>'.
					'<td>'.$mhs['tgl_lahir_ibu'].'</td>'.
					'<td>'.$mhs['pendidikan_ibu'].'</td>'.
					'<td>'.$mhs['pekerjaan_ibu'].'</td>'.
					'<td>'.$mhs['penghasilan_ibu'].'</td>'.
					'<td>'.$mhs['no_hp_ibu'].'</td>'.
					'<td>'.$mhs['nama_wali'].'</td>'.
					'<td>'.$mhs['tgl_lahir_wali'].'</td>'.
					'<td>'.$mhs['pendidikan_wali'].'</td>'.
					'<td>'.$mhs['pekerjaan_wali'].'</td>'.
					'<td>'.$mhs['penghasilan_wali'].'</td>'.
					'<td>'.$mhs['no_hp_wali'].'</td>'.
					'<td>'.$mhs['proyeksi'].'</td>'.
					'<td>'.$mhs['sumber_info'].'</td>'.
					'<td>'.$mhs['tgl_daftar'].'</td>'.
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
'title: "Data Pendaftar ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'exportOptions: {'.
'columns: [":not(.notexport)"],'.
'}'.
'},'.
'{'.
'extend: "pdf",'.
'text: \'<i class="far fa-file-pdf"></i> PDF\','.
'title: "Data Pendaftar ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bpdf",'.
'exportOptions: {'.
'columns: ":not(.notexport)"'.
'}'.
'},'.
'{'.
'extend: "print",'.
'text: \'<i class="fas fa-print"></i> Print\','.
'title: "Data Pendaftar ITM Per Tanggal '.date('d-m-Y H:i:s').'",'.
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
			'<h2><i class="fas fa-users"></i> Data Calon Mahasiswa Baru</h2>'.
		'</div>'.
		'<div class="cw">Anda tidak berhak mengakses halaman ini! <span class="cl"><i class="fas fa-times"></i></span></div>'.
	'</div>';
}
include 'footer.php';
?>