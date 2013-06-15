<?php

class RW_HTMLTableMySQL extends RW_HTMLTable {
	protected $result;
	
	function buildFromQuery($link,$query) {
		
	}
	
	function buildFromResult($rw_result) {
		$row = $rw_result->fetchAssoc();
		$this->fields = array_keys($row);
		while ($row) {
			$this->addRow($row);
			$row = $rw_result->fetchAssoc();
		}
	}
}
?>