<?php 
include 'header.php';
if($s_role==1){
echo
'<div id="c">'.
	'<div class="ct">'.
		'<h2><i class="fas fa-envelope-open-text"></i> Kirim Pesan Masal</h2>'.
	'</div>'.
	'<div class="cti">';
	if(isset($_GET['g'])){
		$g = $_GET['g'];
		$p = isset($_GET['p']) ? base64_decode($_GET['p']) : '';
		if($p==''){
			header('Location: '.$cn);
		} else {
			$mhs 	= $db->query("SELECT * FROM camaba WHERE gelombang=$g");
			$tmhs 	= count($mhs);
			$id 	= isset($_GET['id']) ? $_GET['id'] : 0;
			if($id<$tmhs){
				for($i=0;$i<=$id;$i++){
					echo '<div class="co">Pesan berhasil dikirim ke '.$mhs[$i]['nama'].' (+'.to62($mhs[$i]['wa']).') <span class="cl"><i class="fas fa-times"></i></span></div>';

				}
				$prodi 		= $mhs[$id]['prodi'];
				$jalur 		= $mhs[$id]['jalur'];
				$kode_reg 	= $mhs[$id]['kode_reg'];
				$nama 		= $mhs[$id]['nama'];
				$wa 		= $mhs[$id]['wa'];
				$p 			= str_ireplace(array('[prodi]','[jalur]','[kode_reg]','[nama]','[wa]'), array($prodi,$jalur,$kode_reg,$nama,$wa), $p);
				// echo $p;
				kirim_bc($wa,$p);
				// echo '<pre>'.print_r($mhs[$id],true).'</pre>';
				if($id<($tmhs-1)){
					echo '<meta http-equiv="refresh" content="3; url='.$cn.'?g='.$g.'&id='.($id+1).'&p='.$_GET['p'].'">';
				}
				
			}
			
		}
	} else {
		echo
		'<form method="post" action="">'.
			'<label>Pesan</label>'.
			'<textarea name="kirim[pesan]" placeholder="Masukkan pesan yang akan dikirim" required="" class="modal-textarea"></textarea>'.
			'<label>Penerima</label>'.
			'<select name="kirim[penerima]" class="modal-select" required="">'.
				'<option value="">Pilih Gelombang</option>';
			foreach($all_gel as $gel){
				echo '<option value="'.$gel['id_gelombang'].'">'.$gel['gelombang'].' Tahun '.$gel['tahun'].'</option>';
			}
			echo
			'</select>'.
			'<button type="submit" class="modal-button"><i class="fas fa-envelope-open-text"></i> Kirim Pesan</button>'.
		'</form>';
	}
	echo
	'</div>'.
'</div>';
$footer_script .= '<script src="'.THEME_URL.'/a/close.js"></script>';
} else {
	echo
	'<div id="c">'.
		'<div class="ct">'.
			'<h2><i class="fas fa-envelope-open-text"></i> Kirim Pesan Masal</h2>'.
		'</div>'.
		'<div class="cw">Anda tidak berhak mengakses halaman ini! <span class="cl"><i class="fas fa-times"></i></span></div>'.
	'</div>';
}
include 'footer.php';
?>