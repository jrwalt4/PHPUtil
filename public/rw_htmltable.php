<?php

class RW_HTMLTable extends RW_HTMLSection {
	protected $rowCount;
	protected $fields;
	
	function __construct($attributes=array(),$fields=array()) {
		parent::__construct('table',$attributes);
		if (!is_null($fields)) {
			$this->setHeader($fields);
			$this->fields = $fields;
		}
		$this->rowCount = 0;
	}
	
	function setHeader($header) {
		if (count($this->elements)==0) {
			if (is_array($header)) {
				$headerRow = new RW_HTMLElement('tr');
				foreach ($header as $field) {
					$th = new RW_HTMLSection('th');
					$th->innerHTML = $field;
					$headerRow->addElement($th);
				}
				$this->insertElement($headerRow,0);
			} else {
				$this->insertElement($header, 0);
			}
		} else {
			if ($this->elements[0]->tagName == 'th') {
				$this->removeElement($this->elements[0]);
			}
			if (is_array($header)) {
				$headerRow = new RW_HTMLElement('tr');
				foreach ($header as $field) {
					$th = new RW_HTMLSection('th');
					$th->innerHTML = $field;
					$headerRow->addElement($th);
				}
				$this->insertElement($headerRow,0);
			} else {
				$this->insertElement($header, 0);
			}
		}
	}
	
	function addRow($entry,$format = 'td') {
		$newRow = new RW_HTMLSection('tr');
		//if(count($entry) == count($this->fields)) 
		{
			foreach ($entry as $value) {
				$td = new RW_HTMLElement('td');
				if (is_a($value, 'RW_HTMLElement')) {
					$td->addElement($value);
				} else $td->innerHTML = $value;
				$newRow->addElement($td);
			}
		}
		$this->addElement($newRow);
		$this->rowCount++;
	}
	
	function removeRow($index) {
		if($index < count($this->elements)) {
			$this->removeElementAtIndex($index+1);
		}
		$this->rowCount--;
	}
	
	function getFields() {
		return $this->fields;
	}
}
?>