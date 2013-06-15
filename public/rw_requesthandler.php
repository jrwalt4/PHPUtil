<?php
class RW_RequestHandler {
	protected $request;
	protected $post;
	protected $get;
	
	function __construct($request,$post=array(), $get=array()) {
		$this->request	= $request;
		$this->post	= $post;
		$this->get	= $get;
	}
	
	function getValues($array_of_names,$post=true,$get=false) {
		$retArray = array();
		foreach ($this->request as $key=>$value) {
			foreach ($array_of_names as $name) {
				if($name == $key) {
					$retArray[$name]=$value;
					break;
				}
			}
		}
		return $retArray;
	}
}
?>