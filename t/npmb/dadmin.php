<?php 
$header_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>';
include 'header.php';
echo 
'<div id="gr">'.
	'<div class="gf">'.
		'<div class="dx df">'.
			'<i class="fas fa-user-friends"></i>'.
			'<span>'.$total.'</span>'.
			'<p>Pendaftar</p>'.
		'</div>'.
		'<div class="dx df">'.
			'<i class="fas fa-chalkboard-teacher"></i>'.
			'<span>'.$tPTI.'</span>'.
			'<p>PTI</p>'.
		'</div>'.
		'<div class="dx df">'.
			'<i class="fas fa-laptop-house"></i>'.
			'<span>'.$tSI.'</span>'.
			'<p>SI</p>'.
		'</div>'.
		'<div class="dx df">'.
			'<i class="fas fa-industry"></i>'.
			'<span>'.$tTI.'</span>'.
			'<p>TI</p>'.
		'</div>'.
	'</div>'.
'</div>'.
'<div id="gs">'.
	'<div class="gt">'.
		'<div class="gj">'.
			'<h2><i class="fas fa-route"></i> Jalur Pendaftaran</h2>'.
		'</div>'.
		'<canvas id="cjalur" style="width:100%"></canvas>'.
	'</div>'.
	'<div class="gt">'.
		'<div class="gj">'.
			'<h2><i class="fas fa-water"></i> Gelombang Pendaftaran</h2>'.
		'</div>'.
		'<canvas id="stepc"></canvas>'.
	'</div>'.
'</div>';
if(!empty($q4)){
echo
'<div id="gu">'.
	'<div class="gj">'.
		'<h2><i class="fas fa-graduation-cap"></i> Sebaran Sekolah Pendaftar</h2>'.
	'</div>';
	
		echo '<table><thead><tr><th>Asal Sekolah</th><th>Jumlah</th></tr></thead><tbody>';
		foreach($q4 as $i12){
			echo '<tr><td>'.$i12['asal_sekolah'].'</td><td>'.$i12['jumlah'].'</td></tr>';
		}
		echo '<tr><td>Total</td><td>'.array_sum(array_column((array)$q4, 'jumlah')).'</td></tr>';
		echo '</tbody></table>'.
'</div>';
}
$footer_script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>';
$footer_script .= 
'<script>'.
'var xValues = ["KIP", "REG", "EKS"];'.
'var yValues = ['.$tkip.','.$treg.','.$teks.'];'.
'var barColors = ['.
  '"#36a2eb",'.
  '"#ff6384",'.
  '"#f66d44"'.
'];'.
'new Chart("cjalur", {'.
  'type: "pie",'.
  'data: {'.
  'labels: xValues,'.
  'datasets: [{'.
    'backgroundColor: barColors,'.
    'data: yValues'.
  '}]'.
'},'.
'options: {'.
  'title: {'.
    'display: false,'.
    'text: "Jalur Pendaftaran"'.
  '},'.
  'layout: {'.
    'padding: {left: 0,right: 0,bottom: 0},'.
    'margin: {left:0,right:0,bottom:0}'.
  '}'.
'}'.
'});'.
'var xValues = ["Gelombang I","Gelombang II","Gelombang III"];'.
'var yValues = ['.$tg1.', '.$tg2.', '.$tg3.'];'.
'var barColors = ["#f66d44", "#feae65","#e6f69d","#aadea7","#64c2a6","#2d87bb"];'.
'new Chart("stepc", {'.
  'type: "bar",'.
  'data: {'.
  'labels: xValues,'.
  'datasets: [{'.
    'backgroundColor: barColors,'.
    'data: yValues'.
  '}]'.
'},'.
'options: {'.
  'legend: {display: false},'.
  'title: {'.
    'display: false,'.
    'text: "Gelombang Pendaftaran"'.
  '}'.
'}'.
'});'.
'</script>';
include 'footer.php';?>