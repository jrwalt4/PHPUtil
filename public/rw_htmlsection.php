<?php

class RW_HTMLSection extends RW_HTMLElement {
	function display() {
		echo EOL.$this->startTag;
		echo $this->innerHTML;
		foreach($this->elements as $element) {
			$element->display();
		}
		echo EOL.$this->endTag;
	}
}