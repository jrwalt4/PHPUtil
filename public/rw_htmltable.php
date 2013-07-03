<?php

class RW_HTMLTable extends RW_HTMLElement {
	protected $rowCount;
	protected $fields;
	
	function __construct($fields,$attributes=array()) {
		parent::__construct('table',$attributes);
		if (!is_null($fields)) {
			$this->addRow($fields,true);
			$this->fields = $fields;
		}
		$this->rowCount = 0;
	}
	
<<<<<<< HEAD
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
=======
	protected static function buildRow($entry,$header = false) {
		$row = new RW_HTMLElement('tr');
		if (is_array($entry)) {
>>>>>>> 2c8a0c80a6b501887d5a4222ae501f425ae2f85b
			foreach ($entry as $value) {
				$cell = $header? new RW_HTMLElement('th') : new RW_HTMLElement('td');
				$cell->addElement($value);
				$row->addElement($cell);
			}
		}
		return $row;
	} 
	
	function addRow($entry,$header = false) {
		$newRow = RW_HTMLTable::buildRow($entry,$header);
		$this->addElement($newRow);
		$this->rowCount++;
	}
	
	function setRow($entry,$index,$header=false) {
		if($index < $this->elementCount()) {
			$row = RW_HTMLTable::buildRow($entry,$header);
			$this->setElementAtIndex($row, $index);
			$this->rowCount++;
		}
	}
	
	function removeRow($index) {
		if($index < $this->elementCount()) {
			$this->removeElementAtIndex($index);
		}
		$this->rowCount--;
	}
	
	function addElementAsRow($element) {
		$tr = new RW_HTMLElement('tr');
		$td = new RW_HTMLElement('td',array('colspan'=>count($this->fields)));
		$td->addElement($element);
		$tr->addElement($td);
		$this->addElement($tr); 
	}
}
?>