<?php  
class RW_HTMLElement implements RW_HTMLDisplay {
	protected $tagName;
	protected $attributes;
	protected $startTag;
	protected $elements;
	protected $endTag;
	public $innerHTML;
	protected $parentElement;
	
	function __construct($tagName,$attributes=array(),$innerHTML="") {
		$this->tagName = $tagName;
		$this->attributes = $attributes;
		$this->elements = array();
		$this->setAttributes($attributes);	
		$this->endTag = "</$this->tagName>";
		$this->innerHTML = $innerHTML;
	}
	
	function __destruct() {
		unset($this->elements);
	}
	
	function addAttribute($key,$val) {
		$this->attributes[$key] = $val;
		$this->setAttributes($this->attributes);
	}
	
	function addElement($el) {
		if ($el instanceof RW_HTMLDisplay) {
			array_push($this->elements,$el);
		}
		if ($el instanceof RW_HTMLElement) {
			$el->setParent($this);
		}
	}
	
	function insertElement($el,$pos) {
		$cnt = count($this->elements);
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
				$elAry[$pos] = $el;
				$this->elements = $elAry;
			}
			$el->setParent($this);
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
	
	function lnBreak() {
		echo " <br> ";
	}
	
	function display() {
		echo $this->startTag;
		echo $this->innerHTML;
		foreach($this->elements as $element) {
			$element->display();
		}
		echo $this->endTag;
	}
	
	function elementCount() {
		return count($this->elements);
	}
	
	function getTag() {
		return $this->tagName;
	}
	
	function setStartTag($tag) {
		$this->startTag = $tag;
	}
	
	function setEndTag($tag) {
		$this->endTag = $tag;
	}
	
	function setAttributes($att) {
		$this->attributes = $att;
		$tag = "<$this->tagName";
		foreach ($this->attributes as $key=>$val) {
			$tag.=" $key='$val'";
		}
		$tag .= ">";//($endTag == "")? "/>" : ">";
		$this->startTag = $tag;
	}
	
	function getAttributes() {
		return $this->attributes;
	}
	
	function setParent($par) {
		$this->parentElement = $par;
	}
	
	function removeParent() {
		$this->parentElement = null;
	}
}