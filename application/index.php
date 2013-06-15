<?php
include '../public/include_list.php';

$handle = fopen('script.js','r');

$head = new RW_HTMLHead();
$script = new RW_HTMLScriptFromFile('script.js');
$script->addAttribute('id','me');
$title = new RW_HTMLElement('title');
$title->innerHTML = "OOPHP TEST"; 
$head->addElement($script);
$head->addElement($title);

$body = new RW_HTMLBody();
$div1 = new RW_HTMLDiv(array('align'=>'center'));

$link = new RW_MySQLLink('localhost', 'reese', 'reese', 'paris');
$table = new RW_HTMLTableMySQL(array('border'=>2));
$result = new RW_MySQLResult($link->query('SELECT*FROM betainspectors'));
$table->buildFromResult($result);

$div1->addElement($table);
$p = new RW_HTMLElement('p',array('id'=>'para'));
$p->innerHTML = "Something";
$button = new RW_HTMLElement('button',
		array('onclick'=>"respond(document.getElementById(\"para\"))"),
		"Does smting");
$table->addRow(array($p,$button));
$body->addElement($div1);

$break = new RW_HTMLSingleTag('input',array('type'=>'text'));
$div1->insertElement($break, 0);

$html = new RW_HTMLPage();
$html->setHead($head);
$html->setBody($body);

$html->display();

fclose($handle);
?>