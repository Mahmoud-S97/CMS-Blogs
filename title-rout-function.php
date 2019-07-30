







<?php

function change_title($title){

	$output = ob_get_contents();
	if(ob_get_length() > 0){
		ob_end_clean();
	}
	$patt = array("/<title>(.*?)<\/title>/");
	$rep = array("<title>" . $title . "</title>");
	$output = preg_replace($patt,$rep,$output);
	echo $output;
}