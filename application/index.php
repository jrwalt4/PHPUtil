<?php
require '../public/rw_html.inc';
$html = new RW_HTMLElement('html');

$head = new RW_HTMLElement('head');
$html->addElement($head);
$script = new RW_HTMLElement('script');
$head->addElement($script);
$paraID = 'itali';
$code = <<<END
function init(phrase) {
	para = document.getElementById('$paraID');
	para.innerHTML = phrase;
}

function change() {
	var input = document.getElementsByTagName('input')[0];
	para.innerHTML = input.value;
}	
END;
$script->addElement($code);

$scriptName = 'init("game")';
$body = new RW_HTMLElement('body',array('onload'=>'init("game")'));
$html->addElement($body);
$div = new RW_HTMLElement('div');
$body->addElement($div);

$table = new RW_HTMLTable(array('Task','Action'),array('border'=>1));
$p=new RW_HTMLElement('p');
$p->addElement('This is a paragraph');
$i = new RW_HTMLElement('i',array('id'=>$paraID));
$i->addElement('This is italicized');
$table->addRow(array($p,$i));
$div->addElement($table);
$input = new RW_HTMLElement('input');
$input->isSelfClosing(true);
$table->addElementAsRow($input);
$button = new RW_HTMLElement('button',array('onclick'=>'change()'));
$button->addElement('Click Me');
$table->addElementAsRow($button);

echo $html;
?>