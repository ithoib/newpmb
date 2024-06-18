<?php 
include 'header.php';
echo
'<div id="l">'.
	'<div class="lw">'.
		'<h1><i class="las la-bullhorn"></i> Pengumuman</h1>'.
		'<p>Arsip pengumuman resmi terkait PMB Institut Teknologi Mojosari Tahun '.$th_aktif.'.</p>';
		if(!empty($pengumuman)){
			echo
			'<div class="lt">'.
				'<table>'.
					'<thead>'.
						'<tr>'.
							'<th>No.</th>'.
							'<th>Tanggal</th>'.
							'<th>Judul</th>'.
							'<th>Unduhan</th>'.
						'</tr>'.
					'</thead>'.
					'<tbody>';
					$i = 0;
					foreach($pengumuman as $item){
						$i++;
						echo
						'<tr>'.
							'<td>'.$i.'</td>'.
							'<td>'.indotime(date('Y-m-d',strtotime($item['tgl']))).'</td>'.
							'<td>'.$item['judul'].'</td>'.
							'<td>'.($item['unduhan']!='' ? '<a href="'.$item['unduhan'].'"><i class="las la-file-download"></i> Unduh</a>' : 'Tidak Tersedia').'</td>'.
						'</tr>';
					}
					echo
					'</tbody>'.
				'</table>'.
			'</div>';
		} else {
			echo '<div class="lp">Belum ada pengumuman. Silahkan menunggu!</div>';
		}
	echo
	'</div>'.
'</div>';
include 'footer.php';