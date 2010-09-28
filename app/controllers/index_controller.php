<?php
class IndexController extends AppController {
	
	var $name = 'Index';
	
	var $uses = array();
	
	function beforeFilter() {
		parent::beforeFilter();
	}
	function display() {
		$this->set('title_for_layout', 'Restocom');
	}
	function menu()	{
	}
	
}


?>