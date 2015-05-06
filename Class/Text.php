<?php
class Text{
	public $code;
	public $text;
	function __construct($data){
		$data = str_split($data, 31);
		foreach ($data as $k => $v)
			$data[$k] = trim($v);
		$code = "";
		$text = "";
		foreach ($data as $k => $v){
			$code .= "Text ".($k+1).",1,".trim($v)."\n";
			$text .= trim($v)."<br />";
		}
		$this->code = $code;
		$this->text = $text;
	}
}
?>