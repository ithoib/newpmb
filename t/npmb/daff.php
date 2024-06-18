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
			'<strong>Rp '.number_format($tkom,0,',','.').'</strong>'.
		'</div>'.
	'</div>'.
	'<div id="adp">'.
		'<div class="aft">'.
			'<h2><i class="fas fa-map-signs"></i> Petunjuk Afiliasi</h2>'.
		'</div>'.
		'<p>Program afiliasi adalah program di mana Anda akan mendapatkan komisi ketika berhasil mengajak seseorang untuk melakukan sesuatu. Pada penerimaan mahasiswa baru, ITM membuka peluang untuk mendapatkan penghasilan tambahan dengan program Afiliasi PMB. Di bawah ini adalah skema komisi afiliasi PMB TA '.$th_ak['tahun_akademik'].'.</p>'.
		'<div class="skm">'.
		'<table>'.
			'<thead>'.
				'<tr>'.
					'<th>Gel<span>ombang</span></th>'.
					'<th>Tanggal</th>'.
					'<th><span>Biaya </span>Pendaftaran</th>'.
					'<th>Komisi</th>'.
				'</tr>'.
			'</thead>'.
			'<tbody>'.
				'<tr>'.
					'<td>Gel<span>ombang</span> I</td>'.
					'<td>18 Des 2023 s.d. 30 April 2024</td>'.
					'<td>Rp 100.000</td>'.
					'<td>Rp 50.000</td>'.
				'</tr>'.
				'<tr>'.
					'<td>Gel<span>ombang</span> II</td>'.
					'<td>1 Mei s.d. 31 Juli 2024</td>'.
					'<td>Rp 150.000</td>'.
					'<td>Rp 75.000</td>'.
				'</tr>'.
				'<tr>'.
					'<td>Gel<span>ombang</span> III</td>'.
					'<td>1 s.d. 31 Agustus 2024</td>'.
					'<td>Rp 200.000</td>'.
					'<td>Rp 100.000</td>'.
				'</tr>'.
			'</tbody>'.
		'</table>'.
		'</div>'.
		'<h3>Cara Kerja</h3>'.
		'<ol>'.
			'<li>Anda akan mendapatkan komisi 50% dari setiap pembayaran biaya pendaftaran calon mahasiswa baru ITM</li>'.
			'<li>Lakukan transfer biaya pendaftaran yang sudah Anda potong sejumlah komisi sesuai gelombang pendaftaran ke rekening <strong>BRI '.get_option('norek_itm').' a.n. Institut Teknologi Mojosari</strong></li>'.
			'<li>Simpan bukti pembayaran biaya pendaftaran</li>'.
			'<li>Tambahkan data calon mahasiswa dengan klik tombol <strong>Tambah</strong> berwarna biru di bagian Laporan Afiliasi</li>'.
			'<li>Masukkan Nama, Asal Sekolah, Nomor WA yang aktif dan bukti pembayaran, kemudian klik tombol <strong>Tambah</strong></li>'.
			'<li>Admin akan melakukan pengecekan, apabila biaya pendaftaran diterima, calon mahasiswa akan mendapatkan pesan yang berisi akun PMB ke nomor WA yang didaftarkan</li>'.
			'<li>Satu nomor WA hanya bisa didaftarkan untuk satu calon mahasiswa saja</li>'.
			'<li>Mahasiswa dapat melanjutkan proses pendaftaran secara mandiri sesuai petunjuk yang dikirimkan melalui WA</li>'.
			'<li>Pendaftaran di luar jam kerja akan direspon keesokan harinya pada jam kerja yaitu pukul <strong>08.00 s.d. 16.00 WIB</strong> pada hari <strong>Senin s.d. Sabtu</strong></li>'.
		'</ol>'.
	'</div>'.
	'<div id="adr">'.
		'<div class="aft">'.
			'<h2><i class="fas fa-users"></i> Laporan Afiliasi</h2>'.
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
		if(@$laff){
			if($taff!=0){
				echo
				'<table id="mhs" class="display dt-responsive nowrap" style="font-size:14px;width:100%;">'.
					'<thead>'.
						'<tr>'.
							'<th style="width:50px;">No.</th>'.
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
						'<td>Rp '.number_format($mhs['komisi'],0,',','.').'</td>'.
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
'</div>'.
'<div id="tambah" class="modal">'.
	'<div class="modal-content">'.
		'<div class="modal-header">'.
			'<a href="#" class="close" rel="modal:close">&times;</a>'.
			'<h2>Tambah Pendaftar</h2>'.
		'</div>'.
		'<div class="modal-body">'.
			'<form method="post" action="" enctype="multipart/form-data">'.
				'<label>Nama</label>'.
				'<input type="text" name="tambah[nama]" placeholder="Nama Lengkap" required="" class="modal-text" oninput="this.value = this.value.toUpperCase()">'.
				'<label>Asal Sekolah</label>'.
				'<input type="text" name="tambah[asal_sekolah]" placeholder="Nama Sekolah" required="" class="modal-text" oninput="this.value = this.value.toUpperCase()">'.
				'<label>Nomor WA</label>'.
				'<input type="number" name="tambah[wa]" placeholder="Nomor Whatsapp" required="" class="modal-text">'.
				'<label>Bukti Transfer</label>'.
				'<input type="file" name="bukti" accept="image/png, image/jpeg" class="customFile" required="">'.
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
'pageLength : 50,'.
'language: { search: "", searchPlaceholder: "Cari data" },'.
'order: [],'.
'dom: "Bfrtip",'.
'buttons: ['.
'{'.
'extend: "excel",'.
'text: \'<i class="far fa-file-excel"></i> Excel\','.
'className: "bexc",'.
'title: "Laporan Afiliasi Per Tanggal '.date('d-m-Y H:i:s').'",'.
'exportOptions: {'.
'columns: [":not(.notexport)"],'.
'}'.
'},'.
'{'.
'extend: "pdf",'.
'text: \'<i class="far fa-file-pdf"></i> PDF\','.
'title: "Laporan Afiliasi Per Tanggal '.date('d-m-Y H:i:s').'",'.
'className: "bpdf",'.
'exportOptions: {'.
'columns: ":not(.notexport)"'.
'}'.
'},'.
'{'.
'extend: "print",'.
'text: \'<i class="fas fa-print"></i> Print\','.
'title: "Laporan Afiliasi Per Tanggal '.date('d-m-Y H:i:s').'",'.
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