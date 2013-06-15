<?php
class RW_MySQLLink {
	protected $link;
	protected $mysqli;
	
	function __construct($dbhost,$dbuser,$dbpass,$dbname) {
		if(function_exists('connect_mysqli')) {
			$this->link=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
			$this->mysqli = true;
		} else {
			$this->link=mysql_connect($dbhost,$dbuser,$dbpass,$dbname);
			$this->mysqli = false;
		}
	}
	
	function __destruct() {
		if($this->mysqli) {
			mysqli_close($this->link);
		} else {
			mysql_close($this->link);
		}
	}
	
	private function executeQuery($query) {
		if ($this->mysqli) {
			return mysqli_query($this->link,$query);
		} else {
			return mysql_query($query,$this->link);
		}
	}
	
	function query($query) {
		return $this->executeQuery($query);
	}
	
	function getLink() {
		return $this->link;
	}
}
?>