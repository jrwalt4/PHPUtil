<?php

abstract class RW_HTMLScript extends RW_HTMLSection {
	
	function __construct($attributes=array()) {
		parent::__construct('script',$attributes);
	}
	
	function display() {
		echo "<script>\n";
		$this->printScriptCode();
		echo "</script>\n";
	}
	
	abstract function printScriptCode();
}