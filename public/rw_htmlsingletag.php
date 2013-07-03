<?php

class RW_HTMLSingleTag implements RW_HTMLDisplay {
	private $tagName;
	private $attributes;
	private $parent;
	
	function __construct($name,$attributes = array()) {
		$this->tagName = $name;
		$this->attributes = $attributes;
	}
	
	function display() {
		echo "<$this->tagName";
		foreach ($this->attributes as $key=>$val) {
			echo " $key='$val'";
		}
		echo "/>";
	}
	
	function setParent($par) {
		$this->parent = $par;
	}
}