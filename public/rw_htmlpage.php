<?php
class RW_HTMLPage extends RW_HTMLSection {
	protected $pageDef;
	
	function __construct($pageDef=null,$head=null,$body=null) {
		parent::__construct('html');
		if (is_null($pageDef)) {
			$this->pageDef = "<!DOCTYPE html>";
		} else $this->head = $head; 
		if (is_null($head)) {
			$this->head = new RW_HTMLHead();
		} else $this->head = $head; 
		if (is_null($body)) {
			$this->body = new RW_HTMLBody();
		} else $this->body = $body;
	}
	
	function setPageDef($def) {
		$this->pageDef = $def;
	}
	
	function setHead($head) {
		if(is_subclass_of($head, 'RW_HTMLHead')) $this->elements[0] = $head;
		else $this->insertElement($head, 0);
	}
	
	function setBody($body) {
		if(is_subclass_of($body, 'RW_HTMLBody')) $this->elements[1] = $body;
		else $this->insertElement($body, 1);
	}
	
	function display() {
		echo $this->pageDef."\n";
		parent::display();
	}
}