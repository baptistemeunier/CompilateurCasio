<?php
	function debug($var){
		
		$debug = debug_backtrace();
		echo'<a href="#"><strong>'.$debug[0]['file'].'</strong></a> l.'.$debug[0]['line'];
		echo'<ol>';
		foreach($debug as $k=>$v){ if($k<0){
			echo'<li><strong>'.$v['file'].'</strong> l.'.$v['line'].'</li>';
		}}
		echo'</ol>';

	
	echo'<pre>';
	print_r($var);//$var
	echo'</pre>';
	}
?>
