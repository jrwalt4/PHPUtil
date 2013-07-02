<?php  
class RW_HTMLElement {
	protected $tagName;
	protected $attributes;
	private $selfClosing;
	protected $elements;
	protected $parentElement;
	
	function __construct($tagName,$attributes=array(),$self_closing=false) {
		$this->tagName = $tagName;
		$this->attributes = $attributes;
		$this->selfClosing = $self_closing;
		$this->elements = array();	
	}
	
	function __destruct() {
		unset($this->attributes);
		unset($this->elements);
	}
	
	protected function setElementAtIndex($el,$ind) {
		$this->elements[$ind] = $el;
		if ($el instanceof RW_HTMLElement) {
			$el->setParent($this);
		}
	}
	
	function addElement($el) {
		array_push($this->elements,$el);
		if ($el instanceof RW_HTMLElement) {
			$el->setParent($this);
		}
	}
	
	function insertElement($el,$pos) {
		$cnt = $this->elementCount();
		if ($pos <= $cnt) {
			if ($pos == $cnt) {
				array_push($this->elements, $el);
			} else {
				$elAry = $this->elements;
				array_push($elAry, null);
				$cnt++;
				for ($i = $cnt-1; $i > $pos ; $i--) {
					$elAry[$i] = $this->elements[$i-1];
				}
				$this->elements = $elAry;
				unset($elAry);
				$this->setElementAtIndex($el, $pos);
			}
		}
	}
	
	function removeElementAtIndex($index) {
		$cnt = $this->elementCount();
		if (!($index >= $cnt)) {
			$this->elements[$index]->removeParent();
			if ($index == $cnt-1) {
				array_pop($this->elements);
			}
			else {
				for ($i = $index ; $i < $cnt - 1 ; $i++) {
					$this->elements[$i] = $this->elements[$i+1];
				}
				array_pop($this->elements);
			}
		}
	}
	
	function removeElement($el) {
		$cnt = count($this->elements);
		$index = -1;
		for ($i = 0 ; $i < $cnt ; $i++) {
			if($el == $this->elements[$i]) {
				$index = $i;
				break;
			}
		}
		if($index == -1) {
			return false;
		}
		$this->removeElementAtIndex($index);
		return true;
	}
	
	function elementCount() {
		return count($this->elements);
	}
	
	function getTag() {
		return $this->tagName;
	}
	
	function isSelfClosing($sc) {
		if (is_bool($sc)) {
			switch ($this->tagName) {
				case "input":
				case "button":
				case "br":
					$this->selfClosing = $sc;
					break;
				default:
					$this->selfClosing = false;
			}
		}
	}

	function setAttribute($key,$val) {
		$this->attributes[$key] = $val;
	}
	
	function getAttributes() {
		return $this->attributes;
	}
	
	function setParent($par) {
		$this->parentElement = $par;
	}
	
	function getParent() {
		return $this->parent;
	}
	
	function removeParent() {
		$this->parentElement = null;
	}
	
	function __toString() {
		$string = EOL."<$this->tagName";
		foreach ($this->attributes as $attName=>$att) {
			//$att = escapeshellarg($att);
			$string.= " $attName='$att'";
		}
		if ($this->selfClosing) {
			$string.= " />";
		}
		else {
			$string.= ">";
			foreach($this->elements as $element) {
				$string.= $element;
			}
			$string.= "</$this->tagName>".EOL;
		}
		return $string;
	}
}