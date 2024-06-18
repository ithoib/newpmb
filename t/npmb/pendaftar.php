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
		'<h2><i class="fas fa-users"></i> Data Calon Mahasiswa Baru</h2>'.
		'<a href="#tambah" class="cj" rel="modal:open"><span>Tambah</span> <i class="fas fa-plus"></i></a>'.
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
			'<option value="1" '.($fsta==1 ? 'selected' : '').'>Step 1</option>'.
			'<option value="2" '.($fsta==2 ? 'selected' : '').'>Step 2</option>'.
			'<option value="3" '.($fsta==3 ? 'selected' : '').'>Step 3</option>'.
			'<option value="4" '.($fsta==4 ? 'selected' : '').'>Step 4</option>'.
			'<option value="5" '.($fsta==5 ? 'selected' : '').'>Step 5</option>'.
		'</select>'.
		'<button type="submit"><i class="fas fa-filter"></i> Filter</button>'.
	'</form>';

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
	if(count($pendaftar)>0){
		echo
		'<table id="mhs" class="display dt-responsive nowrap" style="font-size:14px;width:100%;">'.
			'<thead>'.
				'<tr>'.
					'<th>No.</th>'.
					'<th>Tgl Daftar</th>'.
					'<th>Nama</th>'.
					'<th>L/P</th>'.
					'<th style="width:170px">Asal Sekolah</th>'.
					'<th>Prodi</th>'.
					'<th>Jalur</th>'.
					'<th>Gel</th>'.
					'<th style="width:180px" class="notexport">Aksi</th>'.
				'</tr>'.
			'</thead>'.
			'<tbody>';
			$i = 0;
		foreach($pendaftar as $mhs){
			$i++;
			if($mhs['akun']==1 && $mhs['biodata']==0 && $mhs['transfer']==0 && $mhs['berkas']==0 && $mhs['ujian']==0 && $mhs['diterima']==0){
				$pesan = 'Halo kak '.$mhs['nama'].', Saat ini kamu sudah menyelesaikan step 1 dari 6 proses PMB ITM '.date('Y').'. Yuk segera lengkapi biodata kamu agar bisa lanjut ke proses selanjutnya. Jika ada kesulitan, bisa tanya di nomor ini ya.';

			} elseif($mhs['akun']==1 && $mhs['biodata']==1 && $mhs['transfer']==0 && $mhs['berkas']==0 && $mhs['ujian']==0 && $mhs['diterima']==0){
				$pesan = 'Halo kak '.$mhs['nama'].', Saat ini kamu sudah menyelesaikan step 2 dari 6 proses PMB ITM '.date('Y').'. Yuk segera lakukan pembayaran biaya pendaftaran agar bisa melanjutkan ke proses selanjutnya. Jika ada kesulitan, bisa tanya di nomor ini ya.';

			} elseif($mhs['akun']==1 && $mhs['biodata']==1 && $mhs['transfer']==1 && $mhs['berkas']==0 && $mhs['ujian']==0 && $mhs['diterima']==0){
				$pesan = 'Halo kak '.$mhs['nama'].', Saat ini kamu sudah menyelesaikan step 3 dari 6 proses PMB ITM '.date('Y').'. Yuk segera lengkapi dan kirimkan berkas pendaftaran ke kantor ITM agar bisa lanjut ke proses selanjutnya. Jika ada kesulitan, bisa tanya di nomor ini ya.';

			} elseif($mhs['akun']==1 && $mhs['biodata']==1 && $mhs['transfer']==1 && $mhs['berkas']==1 && $mhs['ujian']==0 && $mhs['diterima']==0){
				$pesan = 'Halo kak '.$mhs['nama'].', Saat ini kamu sudah menyelesaikan step 4 dari 6 proses PMB ITM '.date('Y').'. Yuk segera cetak kartu ujian agar bisa mengikuti ujian seleksi masuk ITM tahun '.date('Y').'. Jika ada kesulitan, bisa tanya di nomor ini ya.';

			} elseif($mhs['akun']==1 && $mhs['biodata']==1 && $mhs['transfer']==1 && $mhs['berkas']==1 && $mhs['ujian']==1 && $mhs['diterima']==0){
				$pesan = 'Halo kak '.$mhs['nama'].', kamu telah mengikuti ujian seleksi masuk ITM Tahun '.date('Y').'. Selamat menunggu pengumuman kelulusan!';

			} elseif($mhs['akun']==1 && $mhs['biodata']==1 && $mhs['transfer']==1 && $mhs['berkas']==1 && $mhs['ujian']==1 && $mhs['diterima']==1){
				$pesan = 'Halo kak '.$mhs['nama'].', Selamat! Anda telah diterima di ITM Nganjuk. Segera lakukan daftar ulang ya!';
			} else {
				$pesan = '';
			}

			echo '<tr>'.
					'<td><a href="'.$cn.'/profil/'.$mhs['kode_reg'].'">'.$mhs['kode_reg'].'</a></td>'.
					'<td>'.$mhs['tgl_daftar'].'</td>'.
					'<td>'.$mhs['nama'].'</td>'.
					'<td>'.$mhs['jenis_kelamin'].'</td>'.
					'<td>'.$mhs['asal_sekolah'].'</td>'.
					'<td>'.$mhs['prodi'].'</td>'.
					'<td>'.$mhs['jalur'].'</td>'.
					'<td>'.str_replace('Gelombang ','',$mhs['gelombang']).'</td>'.
					'<td style="font-size:14px;"><a href="#progress'.$mhs['kode_reg'].'" class="cbe" rel="modal:open"><i class="fas fa-pencil-alt"></i></a> <a href="#hapus'.$mhs['kode_reg'].'" class="cbh" rel="modal:open"><i class="fas fa-trash-alt"></i></a> <a href="#gelombang'.$mhs['kode_reg'].'" class="cbe" rel="modal:open" title="Pindah Gelombang"><i class="fas fa-exchange-alt"></i></a> <a href="#bukti'.$mhs['kode_reg'].'" class="cbb" rel="modal:open"><i class="fas fa-eye"></i></a> <a href="https://api.whatsapp.com/send?phone='.to62($mhs['wa']).'&text='.urlencode($pesan).'" class="cbw" title="Follow Up" target="_blank"><i class="fab fa-whatsapp"></i></a></td>'.
				'</tr>';
					$modal .=
					'<div id="hapus'.$mhs['kode_reg'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Hapus Pendaftar</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<p>Apa Anda yakin akan menghapus pendaftar bernama '.$mhs['nama'].'?</p>'.
								'<form method="post" action="">'.
									'<input type="hidden" name="hapus[kode_reg]" value="'.$mhs['kode_reg'].'">'.
									'<div class="cbu">'.
										'<a href="#" rel="modal:close"><i class="fas fa-undo-alt"></i> Tidak</a>'.
										'<button type="submit" class="ya"><i class="fas fa-trash-alt"></i> Ya</button>'.
									'</div>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
					$modal .=
					'<div id="bukti'.$mhs['kode_reg'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Bukti Pembayaran</h2>'.
							'</div>'.
							'<div class="modal-body">'.($mhs['bukti']!='' ? 
								'<img src="'.SITEURL.'/'.$mhs['bukti'].'" alt="Bukti Pembayaran '.$mhs['kode_reg'].'" style="width:100%" loading="lazy">' : '<p>Belum ada bukti pembayaran!</p>').
							'</div>'.
						'</div>'.
					'</div>';
					$modal .= 
					'<div id="progress'.$mhs['kode_reg'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Progress Pendaftaran Mahasiswa</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<form method="post" action="">'.
									'<div class="jlp">';
									$progress = $db->row("SELECT * FROM progress WHERE kode_reg='{$mhs['kode_reg']}'");
									$modal .= '<span><input type="checkbox" aria-label="'.$progress['akun'].'" name="ubah[akun]" value="1" '.($progress['akun']==1 ? 'checked' : '').'> Pembuatan Akun</span>';
									$modal .= '<span><input type="checkbox" aria-label="'.$progress['biodata'].'" name="ubah[biodata]" value="1" '.($progress['biodata']==1 ? 'checked' : '').'> Pengisian Biodata</span>';
									$modal .= '<span><input type="checkbox" aria-label="'.$progress['transfer'].'" name="ubah[transfer]" value="1" '.($progress['transfer']==1 ? 'checked' : '').'> Biaya Pendaftaran</span>';
									$modal .= '<span><input type="checkbox" aria-label="'.$progress['berkas'].'" name="ubah[berkas]" value="1" '.($progress['berkas']==1 ? 'checked' : '').'> Berkas Pendaftaran</span>';
									$modal .= '<span><input type="checkbox" aria-label="'.$progress['ujian'].'" name="ubah[ujian]" value="1" '.($progress['ujian']==1 ? 'checked' : '').'> Ujian Seleksi Masuk</span>';
									$modal .= '<span><input type="checkbox" aria-label="'.$progress['diterima'].'" name="ubah[diterima]" value="1" '.($progress['diterima']==1 ? 'checked' : '').'> Diterima di ITM</span></div>';
									$modal .=
									'<input type="hidden" name="ubah[kode_reg]" value="'.$mhs['kode_reg'].'">'.
									'<button type="submit" class="modal-button"><i class="fas fa-pencil-alt"></i> Simpan Progress</button>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
					$modal .= 
					'<div id="gelombang'.$mhs['kode_reg'].'" class="modal">'.
						'<div class="modal-content">'.
							'<div class="modal-header">'.
								'<a href="#" class="close" rel="modal:close">&times;</a>'.
								'<h2>Pindah Gelombang</h2>'.
							'</div>'.
							'<div class="modal-body">'.
								'<form method="post" action="">';
									$all_gel = $db->query("SELECT * FROM gelombang WHERE tahun=$th_pmb");
									$modal .= '<select name="ubah_gel[gelombang]" aria-label="ubah gelombang" required="" class="ubg">';
									foreach($all_gel as $gel){
										$modal .= '<option value="'.$gel['id_gelombang'].'" '.($mhs['id_gelombang']==$gel['id_gelombang'] ? 'selected' : '').'>'.$gel['gelombang'].' Tahun '.$gel['tahun'].'</option>';
									}
									$modal .= '</select>';
									$modal .=
									'<input type="hidden" name="ubah_gel[kode_reg]" value="'.$mhs['kode_reg'].'">'.
									'<button type="submit" class="modal-button"><i class="fas fa-pencil-alt"></i> Pindah Gelombang</button>'.
								'</form>'.
							'</div>'.
						'</div>'.
					'</div>';
		}
		echo '</tbody>'.
			'</table>';
	} else {
		echo '<div class="cw">Tidak ada data <span class="cl"><i class="fas fa-times"></i></span></div>';
	}
echo '</div>'.
$modal.
'<div id="tambah" class="modal">'.
	'<div class="modal-content">'.
		'<div class="modal-header">'.
			'<a href="#" class="close" rel="modal:close">&times;</a>'.
			'<h2>Tambah Akun</h2>'.
		'</div>'.
		'<div class="modal-body">'.
			'<form method="post" action="" enctype="multipart/form-data">'.
				'<label for="wa">Nomor WA</label>'.
				'<input id="wa" type="number" name="tambah[wa]" placeholder="Nomor Whatsapp" required="" class="modal-text">'.
				'<label for="bukti">Bukti Transfer</label>'.
				'<input id="bukti" type="file" name="bukti" accept="image/png, image/jpeg" class="customFile" required="">'.
				'<button type="submit" class="modal-button"><i class="fas fa-plus"></i> Tambah</button>'.
			'</form>'.
		'</div>'.
	'</div>'.
'</div>';
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