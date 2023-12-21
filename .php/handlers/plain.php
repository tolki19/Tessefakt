<?php
namespace tessefakt\handlers;
class plain extends _handler{
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->_oEvironment=new \tessefakt\environment($this->_oTessefakt,['get','post','server','header','session','operations']);
	}
	protected function _handle():void{
// var_dump($this->apps);
$this->apps->tessefakt->lores->plain->controllers->install->create_structure();
var_dump(3);
		$this->reply();
	}
	protected function _reply(int $status):void{
		http_response_code($status);
		header('Content-Type: text/html');
		if(count($this->exception)){
			include($this->_oTessefakt->setup['paths']['tpl'].'/plain/exception.php');
		}else{
			include($this->_oTessefakt->setup['paths']['tpl'].'/plain/index.php');
		}
		die();
	}
}