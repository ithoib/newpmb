<?php 	
include 'header.php';
if($step!=6){
echo '<div class="stepper-wrapper">';
for($i=1;$i<=6;$i++){
	echo 
		'<div class="stepper-item '.($i<=$step ? 'completed' : 'active').'">'.
		'<div class="step-counter"><i class="fas fa-check"></i></div>'.
		'<div class="step-name">Step '.$i.'</div>'.
		'</div>';
}
echo '</div>';
}
if($step==2){
	include 'step2.php';
} elseif($step==3){
	include 'step3.php';
} elseif($step==4){
	include 'step4.php';
} elseif($step==5){
	include 'step5.php';
} elseif($step==6){
	include 'step6.php';
}
include 'footer.php';
?>