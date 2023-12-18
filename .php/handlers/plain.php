<?php
namespace tessefakt\handlers;
class plain extends _handler{
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->_oEvironment=new \tessefakt\environment($this->_oTessefakt,['get','post','server','header','session','operations']);
	}
	public function _handle():void{
$this->apps->tessefakt->lores->plain->controllers->install->create_structure();
		$this->reply();
	}
	protected function _reply(int $status):void{
		http_response_code($status);
		header('Content-Type: text/html');
		include($this->_oTessefakt->setup['paths']['tpl'].'/plain.php');
	}
}