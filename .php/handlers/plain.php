<?php
namespace tessefakt\handlers;
class plain extends _handler{
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->_oEvironment=new \tessefakt\environment($this->_oTessefakt,['get','post','server','header','session','operations']);
var_dump(1);
	}
	protected function _handle():void{
var_dump(1);
var_dump($this);
var_dump($this->apps);
var_dump($this->apps->tessefakt);
var_dump($this->apps->tessefakt->lores->plain->controllers->install);
$this->apps->tessefakt->lores->plain->controllers->install->create_structure();
var_dump($this);
		$this->reply();
	}
	protected function _reply(int $status):void{
		http_response_code($status);
		header('Content-Type: text/html');
		include($this->_oTessefakt->setup['paths']['tpl'].'/plain.php');
	}
}