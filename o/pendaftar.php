<?php 
if(!isset($_SESSION['log'])){
	header('Location: '.SITEURL.'/akun');
} else {
	$mt 		= 'Dasbor PMB ITM Tahun '.$th_aktif;
	$cn 		= ADMIN_URL.'/pendaftar';
	$us 		= get_user_session($_SESSION['user']);
	$s_name 	= $us['nama'];
	$s_role 	= $us['role'];
	$w 			= isset($_GET['w']) ? $_GET['w'] : '';
	$m 			= isset($_GET['m']) ? $_GET['m'] : '';
	$all_jalur 	= $db->query("SELECT * FROM jalur ORDER BY urutan ASC");
	$all_prod 	= $db->query("SELECT * FROM prodi ORDER BY urutan ASC");
	$all_th 	= $db->query("SELECT * FROM tahun");
	$gel_ak 	= $db->row("SELECT * FROM gelombang WHERE status=1");
	if(isset($_POST['pilih'])){
		$pilih = $_POST['pilih'];
		$fth  = $pilih['tahun'];
		$fgel = $pilih['gelombang'];
		$fjal = $pilih['jalur'];
		$fpro = $pilih['prodi'];
		$fsta = $pilih['status'];
		$pendaftar = list_camaba2($fth,$fgel,$fjal,$fpro,$fsta);
	} else {
		$fth = $th_pmb;
		$fgel = '';
		$fjal = '';
		$fpro = '';
		$fsta = '';
		$pendaftar = list_camaba2($fth,$fgel,$fjal,$fpro,$fsta);
	}
	if(isset($_POST['hapus'])){
		$hapus = $_POST['hapus'];
		hapus_camaba($hapus['kode_reg'],$s_name);
	}
	if(isset($_POST['ubah'])){
		$ubah 				= $_POST['ubah'];
		$ubah['akun'] 		= isset($ubah['akun']) ? $ubah['akun'] : 0;
		$ubah['biodata'] 	= isset($ubah['biodata']) ? $ubah['biodata'] : 0;
		$ubah['transfer'] 	= isset($ubah['transfer']) ? $ubah['transfer'] : 0;
		$ubah['berkas'] 	= isset($ubah['berkas']) ? $ubah['berkas'] : 0;
		$ubah['ujian'] 		= isset($ubah['ujian']) ? $ubah['ujian'] : 0;
		$ubah['diterima'] 	= isset($ubah['diterima']) ? $ubah['diterima'] : 0;
		ubah_progress($ubah,$s_name);
	}
	if(isset($_POST['ubah_gel'])){
		$ubg = $_POST['ubah_gel'];
		pindah_gelombang($ubg,$s_name);
	}
	if(isset($_POST['tambah'])){
		$tambah 	= $_POST['tambah'];
		$last_id 	= $db->single("SELECT counter FROM counter WHERE type='ITM'");
		$next_id 	= $last_id+1;
		$reg_num 	= sprintf("%05d", $next_id);
		$kode_reg 	= 'ITM'.$th_pmb.$gel_ak['id_gelombang'].$reg_num;
		$image_file = $_FILES["bukti"];
		$image_name = time().'.jpg';
		$bukti 		= 'f/'.$image_name;
		move_uploaded_file($image_file["tmp_name"], $bukti);

		$tambah['gelombang'] 	= $gel_ak['id_gelombang'];
		$tambah['kode_reg']		= $kode_reg;
		$tambah['bukti'] 		= $bukti;
		tambah_camaba($tambah,$next_id,$s_name);
	}
	include THEME_DIR.'/pendaftar.php';
}
?>