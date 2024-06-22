<?php 
$q = isset($_POST['q']) ? $_POST['q'] : '';
$a = isset($_POST['a']) ? $_POST['a'] : '';
$b = isset($_POST['b']) ? $_POST['b'] : '';
if($q!=''){
	$q1 = $db->query("SELECT * FROM sma WHERE MATCH(sekolah) AGAINST ('$q') LIMIT 20");
	if(!empty($q1)){
		$data = array();
		foreach($q1 as $item){
			$data[] = array("id"=>strtoupper(strtolower($item['sekolah'])), "text"=>strtoupper(strtolower($item['sekolah'])));
		}
		echo json_encode($data);
	}
}

if($a!='' && $b!=''){
	$aa 		= explode('.', $a);
	$kode_reg 	= $b;
	$args = array(
		'kode_reg' 		=> $b,
		'id_soal'		=> $aa[0],
		'id_pertanyaan'	=> $aa[1],
		'jawaban'		=> $aa[2],
		'skor' 			=> $aa[3],
		'id_ujian' 		=> $aa[4]
	);
	jawab_soal($args);
}
?>