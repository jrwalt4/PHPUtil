<?php

class RW_HTMLScriptFromFile extends RW_HTMLElement {
	
	function __construct($fileName) {
		parent::__construct('script',array('src'=>$fileName));
	}
}