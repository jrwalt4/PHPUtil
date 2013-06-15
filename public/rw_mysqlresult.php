<?php

class RW_MySQLResult {
	protected $result;
	protected $mysqli;
	
	function __construct($result,$mysqli=true) {
		$this->result = $result;
		$this->mysqli = $mysqli;
	}
	
	function fetchAssoc() {
		return mysqli_fetch_assoc($this->result);
	}
}