<?php 
$header_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>';
$header_script .= '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>';
$header_script .= '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />';
include 'header.php';
echo
'<div id="c">';
	if($s_role==1){
		echo
		'<div class="ct">'.
			'<h2><i class="fas fa-user"></i> Biodata '.$cama['nama'].'</h2>'.
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
		echo
		'<form method="post" action="">'.
			'<div class="ch">'.
				'<h3>1. Data Pendaftar</h3>'.
				'<table>'.
					'<tr>'.
						'<th>Nomor Pendaftaran</th>'.
						'<td>:</td>'.
						'<td><input type="text" name="kr" class="cht" value="'.$cama['kode_reg'].'" disabled aria-label="kr"><input type="hidden" name="ubah[kode_reg]" value="'.$cama['kode_reg'].'" aria-label="kode_reg"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Nama Lengkap</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[nama]" type="text" class="cht" value="'.$cama['nama'].'" aria-label="nama" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>NIK</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[nik]" type="text" class="cht" value="'.$cama['nik'].'" aria-label="nik" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>NISN</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[nisn]" type="text" class="cht" value="'.$cama['nisn'].'" aria-label="nisn" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Program Studi</th>'.
						'<td>:</td>'.
						'<td>'.
							'<select name="ubah[prodi]" aria-label="prodi" required="" class="cht">'.
								'<option value="">Pilih Program Studi</option>';
								foreach($all_prodi as $prod){
									echo '<option value="'.$prod['kode_prodi'].'" '.($cama['prodi']==$prod['kode_prodi'] ? 'selected' : '').'>'.$prod['nama_prodi'].'</option>';
								}
						echo '</select>'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Jalur Pendaftaran</th>'.
						'<td>:</td>'.
						'<td>'.
							'<select name="ubah[jalur]" aria-label="jalur" required="" id="jalur" class="cht">'.
								'<option value="">Pilih Jalur Pendaftaran</option>';
							foreach($all_jalur as $jal){
								echo '<option value="'.$jal['kode_jalur'].'" '.($cama['jalur']==$jal['kode_jalur'] ? 'selected' : '').'>'.$jal['nama_jalur'].'</option>';
							}
						echo '</select>'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Gelombang Pendaftaran</th>'.
						'<td>:</td>'.
						'<td>'.
							'<select name="ubah[gelombang]" aria-label="jalur" required="" class="cht">'.
								'<option value="">Pilih Gelombang Pendaftaran</option>';
								foreach($all_gel as $gel){
									echo '<option value="'.$gel['id_gelombang'].'" '.($cama['gelombang']==$gel['id_gelombang'] ? 'selected' : '').'>'.$gel['gelombang'].' Tahun '.$gel['tahun'].'</option>';
								}
							echo	
							'</select>'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Jenis Kelamin</th>'.
						'<td>:</td>'.
						'<td>'.
							'<div class="jkl">'.
								'<input type="radio" name="ubah[jenis_kelamin]" value="L" aria-label="laki"'.($cama['jenis_kelamin']=='L' ? ' checked=""' : '').' required="">'.
								'<span class="f4">Laki-laki</span>'.
								'<input type="radio" name="ubah[jenis_kelamin]" value="P" aria-label="wanita"'.($cama['jenis_kelamin']=='P' ? ' checked=""' : '').' required="">'.
								'<span class="f4">Perempuan</span>'.
							'</div>'.
							'<input type="text" class="jkp" value="'.($cama['jenis_kelamin']=='L' ? 'Laki-laki' : 'Perempuan').'">'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Agama</th>'.
						'<td>:</td>'.
						'<td>'.
							'<select name="ubah[agama]" aria-label="agama" required="" class="chs">'.
								'<option value="">Pilih Agama</option>'.
								'<option value="Islam"'.($cama['agama']=='Islam' ? ' selected=""' : '').'>Islam</option>'.
								'<option value="Kristen"'.($cama['agama']=='Kristen' ? ' selected=""' : '').'>Kristen</option>'.
								'<option value="Katolik"'.($cama['agama']=='Katolik' ? ' selected=""' : '').'>Katolik</option>'.
								'<option value="Hindu"'.($cama['agama']=='Hindu' ? ' selected=""' : '').'>Hindu</option>'.
								'<option value="Budha"'.($cama['agama']=='Budha' ? ' selected=""' : '').'>Budha</option>'.
								'<option value="Konghucu"'.($cama['agama']=='Konghucu' ? ' selected=""' : '').'>Konghucu</option>'.
							'</select>'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Tempat Lahir</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[tempat_lahir]" type="text" class="cht" value="'.$cama['tempat_lahir'].'" aria-label="tempat_lahir" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Tanggal Lahir</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[tgl_lahir]" type="date" class="cht" value="'.$cama['tgl_lahir'].'" aria-label="tgl_lahir" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>No. WA Aktif</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[wa]" type="text" class="cht" value="'.$cama['wa'].'" aria-label="wa" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Email</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[email]" type="email" class="cht" value="'.$cama['email'].'" aria-label="email" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Asal Sekolah</th>'.
						'<td>:</td>'.
						// '<td><input name="ubah[asal_sekolah]" type="text" class="cht" value="'.$cama['asal_sekolah'].'" aria-label="asal_sekolah" required=""></td>'.
						'<td>'.
							'<div class="cal">'.
								'<select name="ubah[asal_sekolah]" aria-label="asal_sekolah" required=""  id="asal" class="ask">'.
									($cama['asal_sekolah']!='' ? '<option value="'.$cama['asal_sekolah'].'">'.$cama['asal_sekolah'].'</option>' : '<option value=""> - Pilih Asal Sekolah - </option>').
								'</select>'.
							'</div>'.
							'<input type="text" class="jkp" value="'.$cama['asal_sekolah'].'">'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Tahun Lulus</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[thn_lulus]" type="text" class="chs" value="'.$cama['thn_lulus'].'" aria-label="thn_lulus" required=""></td>'.
					'</tr>'.
				'</table>'.
			'</div>'.
			'<div class="ch">'.
				'<h3>2. Alamat Pendaftar</h3>'.
				'<table>'.
					'<tr>'.
						'<th>Provinsi</th>'.
						'<td>:</td>'.
						'<td>'.
							'<div class="cal">'.
								'<select name="ubah[provinsi]" aria-label="provinsi" required="" class="select2-data-array browser-default" id="select2-provinsi">'.
									(!empty($cama['provinsi']) ? '<option value="'.$cama['provinsi'].'" selected="selected">'.$tprov[$cama['provinsi']].'</option>' : '').
								'</select>'.
							'</div>'.
							'<input type="text" class="jkp" value="'.$tprov[$cama['provinsi']].'">'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Kabupaten/Kota</th>'.
						'<td>:</td>'.
						'<td>'.
							'<div class="cal">'.
								'<select name="ubah[kabupaten_kota]" aria-label="kabupaten_kota" required="" class="select2-data-array browser-default" id="select2-kabupaten">'.
								(!empty($cama['kabupaten_kota']) ? '<option value="'.$cama['kabupaten_kota'].'" selected="selected">'.$tkota[$cama['kabupaten_kota']].'</option>' : '').
								'</select>'.
							'</div>'.
							'<input type="text" class="jkp" value="'.$tkota[$cama['kabupaten_kota']].'">'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Kecamatan</th>'.
						'<td>:</td>'.
						'<td>'.
							'<div class="cal">'.
								'<select name="ubah[kecamatan]" aria-label="kecamatan" required="" class="select2-data-array browser-default" id="select2-kecamatan">'.
								(!empty($cama['kecamatan']) ? '<option value="'.$cama['kecamatan'].'" selected="selected">'.$tkec[$cama['kecamatan']].'</option>' : '').
								'</select>'.
							'</div>'.
							'<input type="text" class="jkp" value="'.$tkec[$cama['kecamatan']].'">'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Kode Pos</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[kode_pos]" type="text" class="chs" value="'.$cama['kode_pos'].'" aria-label="kode_pos"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Alamat</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[alamat]" type="text" class="cht" value="'.$cama['alamat'].'" aria-label="alamat"></td>'.
					'</tr>'.
				'</table>'.
			'</div>'.
			'<div class="ch">'.
				'<h3>3. Data Orang Tua/Wali</h3>'.
				'<div id="ortu">'.
				'<div class="ayah">'.
				'<h4>Data Ayah</h4>'.
				'<table>'.
					'<tr>'.
						'<th>Nama Ayah</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[nama_ayah]" type="text" class="cht" value="'.$cama['nama_ayah'].'" aria-label="nama_ayah" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>NIK Ayah</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[nik_ayah]" type="text" class="cht" value="'.$cama['nik_ayah'].'" aria-label="nik_ayah" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Tanggal Lahir Ayah</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[tgl_lahir_ayah]" type="date" class="cht" value="'.$cama['tgl_lahir_ayah'].'" aria-label="tgl_lahir_ayah" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Pendidikan Ayah</th>'.
						'<td>:</td>'.
						'<td>'.
							'<select name="ubah[pendidikan_ayah]" aria-label="pendidikan_ayah" class="chs">'.
								'<option value=""></option>'.
								'<option value="-"'.($cama['pendidikan_ayah']=='-' ? ' selected=""' : '').'>Tidak Sekolah</option>'.
								'<option value="SD"'.($cama['pendidikan_ayah']=='SD' ? ' selected=""' : '').'>SD/Sederajat</option>'.
								'<option value="SMP"'.($cama['pendidikan_ayah']=='SMP' ? ' selected=""' : '').'>SMP/Sederajat</option>'.
								'<option value="SMA"'.($cama['pendidikan_ayah']=='SMA' ? ' selected=""' : '').'>SMA/Sederajat</option>'.
								'<option value="S1"'.($cama['pendidikan_ayah']=='S1' ? ' selected=""' : '').'>Sarjana S1</option>'.
								'<option value="S2"'.($cama['pendidikan_ayah']=='S2' ? ' selected=""' : '').'>Sarjana S2</option>'.
								'<option value="S3"'.($cama['pendidikan_ayah']=='S3' ? ' selected=""' : '').'>Sarjana S3</option>'.
							'</select>'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Pekerjaan Ayah</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[pekerjaan_ayah]" type="text" class="cht" value="'.$cama['pekerjaan_ayah'].'" aria-label="pekerjaan_ayah"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Penghasilan Ayah</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[penghasilan_ayah]" type="number" class="cht" value="'.$cama['penghasilan_ayah'].'" aria-label="penghasilan_ayah"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>No. HP Ayah</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[no_hp_ayah]" type="text" class="cht" value="'.$cama['no_hp_ayah'].'" aria-label="no_hp_ayah"></td>'.
					'</tr>'.
				'</table>'.
				'</div>'.
				'<div class="ibu">'.
				'<h4>Data Ibu</h4>'.
				'<table>'.
					'<tr>'.
						'<th>Nama Ibu</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[nama_ibu]" type="text" class="cht" value="'.$cama['nama_ibu'].'" aria-label="nama_ibu" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>NIK Ibu</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[nik_ibu]" type="text" class="cht" value="'.$cama['nik_ibu'].'" aria-label="nik_ibu" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Tanggal Lahir Ibu</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[tgl_lahir_ibu]" type="date" class="cht" value="'.$cama['tgl_lahir_ibu'].'" aria-label="tgl_lahir_ibu" required=""></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Pendidikan Ibu</th>'.
						'<td>:</td>'.
						'<td>'.
							'<select name="ubah[pendidikan_ibu]" aria-label="pendidikan_ibu" class="chs">'.
								'<option value=""></option>'.
								'<option value="-"'.($cama['pendidikan_ibu']=='-' ? ' selected=""' : '').'>Tidak Sekolah</option>'.
								'<option value="SD"'.($cama['pendidikan_ibu']=='SD' ? ' selected=""' : '').'>SD/Sederajat</option>'.
								'<option value="SMP"'.($cama['pendidikan_ibu']=='SMP' ? ' selected=""' : '').'>SMP/Sederajat</option>'.
								'<option value="SMA"'.($cama['pendidikan_ibu']=='SMA' ? ' selected=""' : '').'>SMA/Sederajat</option>'.
								'<option value="S1"'.($cama['pendidikan_ibu']=='S1' ? ' selected=""' : '').'>Sarjana S1</option>'.
								'<option value="S2"'.($cama['pendidikan_ibu']=='S2' ? ' selected=""' : '').'>Sarjana S2</option>'.
								'<option value="S3"'.($cama['pendidikan_ibu']=='S3' ? ' selected=""' : '').'>Sarjana S3</option>'.
							'</select>'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Pekerjaan Ibu</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[pekerjaan_ibu]" type="text" class="cht" value="'.$cama['pekerjaan_ibu'].'" aria-label="pekerjaan_ibu"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Penghasilan Ibu</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[penghasilan_ibu]" type="number" class="cht" value="'.$cama['penghasilan_ibu'].'" aria-label="penghasilan_ibu"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>No. HP Ibu</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[no_hp_ibu]" type="text" class="cht" value="'.$cama['no_hp_ibu'].'" aria-label="no_hp_ibu"></td>'.
					'</tr>'.
				'</table>'.
				'</div>'.
				'</div>'.
				'<h4>Data Wali (Jika Ada)</h4>'.
				'<table>'.
					'<tr>'.
						'<th>Nama Wali</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[nama_wali]" type="text" class="cht" value="'.$cama['nama_wali'].'" aria-label="nama_wali"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Tanggal Lahir Wali</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[tgl_lahir_wali]" type="date" class="cht" value="'.$cama['tgl_lahir_wali'].'" aria-label="tgl_lahir_wali"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Pendidikan Wali</th>'.
						'<td>:</td>'.
						'<td>'.
							'<select name="ubah[pendidikan_wali]" aria-label="pendidikan_wali" class="chs">'.
								'<option value=""></option>'.
								'<option value="-"'.($cama['pendidikan_wali']=='-' ? ' selected=""' : '').'>Tidak Sekolah</option>'.
								'<option value="SD"'.($cama['pendidikan_wali']=='SD' ? ' selected=""' : '').'>SD/Sederajat</option>'.
								'<option value="SMP"'.($cama['pendidikan_wali']=='SMP' ? ' selected=""' : '').'>SMP/Sederajat</option>'.
								'<option value="SMA"'.($cama['pendidikan_wali']=='SMA' ? ' selected=""' : '').'>SMA/Sederajat</option>'.
								'<option value="S1"'.($cama['pendidikan_wali']=='S1' ? ' selected=""' : '').'>Sarjana S1</option>'.
								'<option value="S2"'.($cama['pendidikan_wali']=='S2' ? ' selected=""' : '').'>Sarjana S2</option>'.
								'<option value="S3"'.($cama['pendidikan_wali']=='S3' ? ' selected=""' : '').'>Sarjana S3</option>'.
							'</select>'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Pekerjaan Wali</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[pekerjaan_wali]" type="text" class="cht" value="'.$cama['pekerjaan_wali'].'" aria-label="pekerjaan_wali"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>Penghasilan Wali</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[penghasilan_wali]" type="number" class="cht" value="'.$cama['penghasilan_wali'].'" aria-label="penghasilan_wali"></td>'.
					'</tr>'.
					'<tr>'.
						'<th>No. HP Wali</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[no_hp_wali]" type="text" class="cht" value="'.$cama['no_hp_wali'].'" aria-label="no_hp_wali"></td>'.
					'</tr>'.
				'</table>'.
			'</div>'.
			'<div class="ch">'.
				'<h3>4. Lain-lain</h3>'.
				'<table>'.
					'<tr>'.
						'<th>Proyeksi ke depan</th>'.
						'<td>:</td>'.
						'<td>'.
							'<select name="ubah[proyeksi]" aria-label="proyeksi" class="chs">'.
								'<option value=""></option>'.
								'<option value="Karir Profesional"'.($cama['proyeksi']=='Karir Profesional' ? ' selected=""' : '').'>Karir Profesional</option>'.
								'<option value="Wirausaha"'.($cama['proyeksi']=='Wirausaha' ? ' selected=""' : '').'>Wirausaha</option>'.
								'<option value="Lanjut Jenjang"'.($cama['proyeksi']=='Lanjut Jenjang' ? ' selected=""' : '').'>Lanjut Jenjang</option>'.
							'</select>'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Sumber Informasi</th>'.
						'<td>:</td>'.
						'<td>'.
							'<select name="ubah[sumber_info]" aria-label="sumber_info" class="chs">'.
								'<option value=""></option>'.
								'<option value="Brosur"'.($cama['sumber_info']=='Brosur' ? ' selected=""' : '').'>Brosur</option>'.
								'<option value="Poster"'.($cama['sumber_info']=='Poster' ? ' selected=""' : '').'>Poster</option>'.
								'<option value="Website"'.($cama['sumber_info']=='Website' ? ' selected=""' : '').'>Website</option>'.
								'<option value="Media Sosial"'.($cama['sumber_info']=='Media Sosial' ? ' selected=""' : '').'>Media Sosial</option>'.
								'<option value="Alumni YPNU"'.($cama['sumber_info']=='Alumni YPNU' ? ' selected=""' : '').'>Alumni YPNU</option>'.
								'<option value="Teman"'.($cama['sumber_info']=='Teman' ? ' selected=""' : '').'>Teman</option>'.
							'</select>'.
						'</td>'.
					'</tr>'.
				'</table>'.
			'</div>';
			$kipk = $cama['no_kip']!='' ? explode('.', $cama['no_kip']) : array();
			$tkip = count($kipk);
				// print_r($kipk);
			echo
			'<div class="ch" id="kip" '.($cama['jalur']=='KIP' ? '' : 'style="display:none"').'>'.
				'<h3>5. Khusus Jalur KIP</h3>'.
				'<p>Isi form di bawah ini jika Anda mengambil jalur KIP dan sudah memiliki akun KIP</p>'.
				'<table>'.
					'<tr>'.
						'<th>Nomor Pendaftaran KIP</th>'.
						'<td>:</td>'.
						'<td>'.
							'<input type="text" name="ubah[no_kip][]" maxlength="4" class="kip kip4" value="'.($tkip>1 ? $kipk[0] : '').'">'.
							'<span class="pbs">&#8226;</span>'.
							'<input type="text" name="ubah[no_kip][]" maxlength="3" class="kip kip3"  value="'.($tkip>1 ? $kipk[1] : '').'">'.
							'<span class="pbs">&#8226;</span>'.
							'<input type="text" name="ubah[no_kip][]" maxlength="5" class="kip kip5"  value="'.($tkip>1 ? $kipk[2] : '').'">'.
							'<span class="pbs">&#8226;</span>'.
							'<input type="text" name="ubah[no_kip][]" maxlength="4" class="kip kip4"  value="'.($tkip>1 ? $kipk[3] : '').'">'.
							'<span class="pbs">&#8226;</span>'.
							'<input type="text" name="ubah[no_kip][]" maxlength="3" class="kip kip3"  value="'.($tkip>1 ? $kipk[4] : '').'">'.
							'<input type="text" value="'.$cama['no_kip'].'" class="fkip">'.
						'</td>'.
					'</tr>'.
					'<tr>'.
						'<th>Kode Akses Akun KIP</th>'.
						'<td>:</td>'.
						'<td><input name="ubah[kode_akses_kip]" type="text" class="chs" value="'.$cama['kode_akses_kip'].'" aria-label="kode_akses_kip"></td>'.
					'</tr>'.
				'</table>'.
			'</div>'.
			'<button type="submit" class="cj"><i class="fas fa-save"></i> Simpan Biodata</button>'.
			'<a class="cpr" onclick="window.print()"><i class="fas fa-print"></i> Cetak Formulir</a>'.
		'</form>';
$footer_script .= '<script src="'.THEME_URL.'/a/close.js"></script>';
$footer_script .= 
'<script>'.
'const el=document.getElementById("jalur"),box=document.getElementById("kip");el.addEventListener("change",function e(t){"KIP"===t.target.value?box.style.display="block":box.style.display="none"}),$(document).ready(function(){$("#asal").select2({width:"100%",ajax:{url:"'.SITEURL.'/ajax",type:"post",dataType:"json",delay:250,data:function(e){return{q:e.term}},processResults:function(e){return{results:e}},cache:!0}})});var urlProvinsi="https://ibnux.github.io/data-indonesia/provinsi.json",urlKabupaten="https://ibnux.github.io/data-indonesia/kabupaten/",urlKecamatan="https://ibnux.github.io/data-indonesia/kecamatan/",urlKelurahan="https://ibnux.github.io/data-indonesia/kelurahan/";function clearOptions(e){console.log("on clearOptions :"+e),$("#"+e).empty().trigger("change")}console.log("Load Provinsi..."),$.getJSON(urlProvinsi,function(e){data=[{id:"",nama:"- Pilih Provinsi -",text:"- Pilih Provinsi -"}].concat(e=$.map(e,function(e){return e.text=e.nama,e})),$("#select2-provinsi").select2({dropdownAutoWidth:!0,width:"100%",data:data})});var selectProv=$("#select2-provinsi");$(selectProv).change(function(){var e=$(selectProv).val();if(clearOptions("select2-kabupaten"),e){console.log("on change selectProv");var t=$("#select2-provinsi :selected").text();console.log("value = "+e+" / text = "+t),console.log("Load Kabupaten di "+t+"..."),$.getJSON(urlKabupaten+e+".json",function(e){data=[{id:"",nama:"- Pilih Kabupaten -",text:"- Pilih Kabupaten -"}].concat(e=$.map(e,function(e){return e.text=e.nama,e})),$("#select2-kabupaten").select2({dropdownAutoWidth:!0,width:"100%",data:data})})}});var selectKab=$("#select2-kabupaten");$(selectKab).change(function(){var e=$(selectKab).val();if(clearOptions("select2-kecamatan"),e){console.log("on change selectKab");var t=$("#select2-kabupaten :selected").text();console.log("value = "+e+" / text = "+t),console.log("Load Kecamatan di "+t+"..."),$.getJSON(urlKecamatan+e+".json",function(e){data=[{id:"",nama:"- Pilih Kecamatan -",text:"- Pilih Kecamatan -"}].concat(e=$.map(e,function(e){return e.text=e.nama,e})),$("#select2-kecamatan").select2({dropdownAutoWidth:!0,width:"100%",data:data})})}});var selectKec=$("#select2-kecamatan");$(selectKec).change(function(){var e=$(selectKec).val();if(clearOptions("select2-kelurahan"),e){console.log("on change selectKec");var t=$("#select2-kecamatan :selected").text();console.log("value = "+e+" / text = "+t),console.log("Load Kelurahan di "+t+"..."),$.getJSON(urlKelurahan+e+".json",function(e){data=[{id:"",nama:"- Pilih Kelurahan -",text:"- Pilih Kelurahan -"}].concat(e=$.map(e,function(e){return e.text=e.nama,e})),$("#select2-kelurahan").select2({dropdownAutoWidth:!0,width:"100%",data:data})})}});var selectKel=$("#select2-kelurahan");$(selectKel).change(function(){var e=$(selectKel).val();if(e){console.log("on change selectKel");var t=$("#select2-kelurahan :selected").text();console.log("value = "+e+" / text = "+t)}});'.
'</script>';
} else {
		echo '<div class="cw">Anda tidak berhak mengakses halaman ini! <span class="cl"><i class="fas fa-times"></i></span></div>';
	}
echo '</div>';
include 'footer.php';
?>