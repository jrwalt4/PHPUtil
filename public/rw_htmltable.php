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
	
	protected static function buildRow($entry,$header = false) {
		$row = new RW_HTMLElement('tr');
		if (is_array($entry)) {
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