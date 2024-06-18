<?php 
$result 	= $db->row("SELECT c.kode_reg,c.prodi,c.nama,c.provinsi,c.kabupaten_kota,c.tempat_lahir,c.tgl_lahir,c.asal_sekolah,g.gelombang,g.tahun,t.tahun_akademik,j.berkas,p.nama_prodi,j.nama_jalur FROM camaba c LEFT JOIN gelombang g ON c.gelombang=g.id_gelombang LEFT JOIN prodi p ON c.prodi=p.kode_prodi LEFT JOIN jalur j ON c.jalur=j.kode_jalur LEFT JOIN tahun t ON g.tahun=t.tahun WHERE c.kode_reg='{$_SESSION['user']}'");
$kota 		= array_combine(array_column($t_kota, 'id'), array_column($t_kota, 'nama'));
$prov 		= array_combine(array_column($t_provinsi, 'id'), array_column($t_provinsi, 'nama'));
$tglu 		= $db->row("SELECT * FROM ujian WHERE kode_reg='$kode_reg' ORDER BY id DESC LIMIT 1");
$tgluj 		= $tglu['waktu_ujian'];
if($result['prodi']=='SI'){
  $map = get_option('map_si');
} elseif($result['prodi']=='TI'){
  $map = get_option('map_ti');
} else {
  $map = get_option('map_pti');
}
QRcode::png($result['kode_reg'],'q/'.$result['kode_reg'].'.png', QR_ECLEVEL_H, 15, 0); 
// print_r($id_jal);
$brks = isset($result['berkas']) ? explode("\n",$result['berkas']) : array();
echo
  	'<div id="peng">'.
  		'<div class="peng-a">'.
  			'<div class="peng-b">'.
  				'<h1>SELAMAT!</h1>'.
  				'<h2>ANDA DINYATAKAN LULUS SELEKSI MASUK ITM NGANJUK</h2>'.
  				'<h3>'.$result['gelombang'].' TAHUN AKADEMIK '.$result['tahun_akademik'].'</h3>'.
  			'</div>'.
  			'<img src="'.THEME_URL.'/a/logo-itm.png" alr="ITM" loading="lazy">'.
  		'</div>'.
  		'<div class="peng-d">'.
  			'<div class="peng-e">'.
  				'<img src="'.SITEURL.'/q/'.$result['kode_reg'].'.png" alt="'.$result['nama'].'" loading="lazy">'.
  			'</div>'.
  			'<div class="peng-f">'.
  				'<table>'.
  					'<tr>'.
  						'<th>Kode Registrasi</th>'.
  						'<td>:</td>'.
  						'<td>'.$result['kode_reg'].'</td>'.
  					'</tr>'.
  					'<tr>'.
  						'<th>Nama</th>'.
  						'<td>:</td>'.
  						'<td>'.$result['nama'].'</td>'.
  					'</tr>'.
  					'<tr>'.
  						'<th>Tempat/Tgl. Lahir</th>'.
  						'<td>:</td>'.
  						'<td>'.($result['tempat_lahir']!='' ? $result['tempat_lahir'].', '.indotime($result['tgl_lahir']) : '').'</td>'.
  					'</tr>'.
  					'<tr>'.
  						'<th>Asal Sekolah</th>'.
  						'<td>:</td>'.
  						'<td>'.$result['asal_sekolah'].'</td>'.
  					'</tr>'.
  					'<tr>'.
  						'<th>Kabupaten/Kota</th>'.
  						'<td>:</td>'.
  						'<td>'.(isset($result['kabupaten_kota']) ? $kota[$result['kabupaten_kota']] : '').'</td>'.
  					'</tr>'.
  					'<tr>'.
  						'<th>Provinsi</th>'.
  						'<td>:</td>'.
  						'<td>'.(isset($result['provinsi']) ? $prov[$result['provinsi']] : '').'</td>'.
  					'</tr>'.
  					'<tr>'.
  						'<th>Program Studi</th>'.
  						'<td>:</td>'.
  						'<td>'.$result['nama_prodi'].'</td>'.
  					'</tr>'.
  					'<tr>'.
  						'<th>Jalur</th>'.
  						'<td>:</td>'.
  						'<td>'.$result['nama_jalur'].'</td>'.
  					'</tr>'.
  					'<tr>'.
  						'<th>Gelombang</th>'.
  						'<td>:</td>'.
  						'<td>'.$result['gelombang'].'</td>'.
  					'</tr>'.
  				'</table>'.
  			'</div>'.
  		'</div>'.
  		'<div class="peng-g">'.
			'<p>Informasi terkait pembayaran daftar ulang akan diinformasikan menyusul melalui grup WA PMB Tahun '.$th_pmb.'. Pastikan Anda sudah bergabung dengan grup WA di sini: <a href="https://chat.whatsapp.com/HN8J4BfanlDBTRJ4IWgFnk">https://chat.whatsapp.com/HN8J4BfanlDBTRJ4IWgFnk</a>.</p>'.
			
			// '<p><strong>B.</strong> Bagi calon mahasiswa yang lulus ujian seleksi masuk dengan program <strong>KIP-K</strong> diwajibkan untuk daftar ulang dengan segera melengkapi berkas pendaftaran ( NB: bebas biaya pendidikan setelah dinyatakan lolos Beasiswa KIP-K, pengumuman lolos Beasiswa KIP-K menyusul)</p>'.
			// '<p><strong>C.</strong> Bagi calon mahasiswa yang lulus ujian masuk dengan program <strong>REGULER</strong> diwajibkan untuk daftar ulang dengan rincian sbb.</p>'.
			// '<ul>'.
			// 	'<li>Melengkapi Berkas Pendaftaran</li>'.
			// 	'<li>Membayar Heregistrasi & PKKMB sebesar <strong>Rp 400.000</strong></li>'.
			// 	'<li>Jas Almamater & Kaos sebesar <strong>Rp 300.000</strong></li>'.
			// 	'<li>NIM & KTM sebesar <strong>Rp 100.000</strong></li>'.
			// 	'<li>UKT/SPP Semester I sebesar <strong>Rp 1.050.000</strong></li>'.
			// 	'<li>Pembayaran dapat dilakukan melalui transfer ke rekening BRI <strong>'.get_option('norek_itm').'</strong> atas nama ITM Nganjuk atau datang langsung ke kantor ITM Nganjuk</li>'.
			// 	'<li>Pembayaran melalui transfer bank wajib konfirmasi melalui WA <strong>'.get_option('no_wa_support').'</strong> dengan melampirkan bukti pembayaran</li>'.
			// 	'<li>Pembayaran paling lambat tanggal <strong>3 September 2023</strong></li>'.
			// '</ul>'.
		'</div>'.
  	'</div>';