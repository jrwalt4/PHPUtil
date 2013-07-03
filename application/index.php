<?php
<<<<<<< HEAD
include '../public/include_list.php';
//echo "something";
$handle = fopen('script.js','r');

$head = new RW_HTMLHead();
$script = new RW_HTMLScriptFromFile('script.js');
$script->addAttribute('id','me');
$title = new RW_HTMLElement('title');
$title->innerHTML = "OOPHP TEST"; 
$head->addElement($script);
$head->addElement($title);

$body = new RW_HTMLBody();
$div1 = new RW_HTMLElement('div',array('align'=>'center'));

//$link = new RW_MySQLLink('localhost', 'reese', 'reese', 'paris');
$table = new RW_HTMLTable(array('border'=>2),array('text'));
//$result = new RW_MySQLResult($link->query('SELECT*FROM betainspectors'));
//$table->buildFromResult($result);

$div1->addElement($table);
$p = new RW_HTMLElement('p',array('id'=>'para'));
$p->innerHTML = "Something";
$button = new RW_HTMLElement('button',
		array('onclick'=>"respond(document.getElementById(\"para\"))"),
		"Does something");
$table->addRow(array($p,$button));
$body->addElement($div1);

$break = new RW_HTMLSingleTag('input',array('type'=>'number'));
$div1->insertElement($break, 1);

$html = new RW_HTMLPage();
$html->setHead($head);
$html->setBody($body);

$html->display();

fclose($handle);
=======
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
>>>>>>> 2c8a0c80a6b501887d5a4222ae501f425ae2f85b
?>