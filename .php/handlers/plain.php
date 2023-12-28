<?php
namespace tessefakt\handlers;
class plain extends _handler{
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->_oEnvironment=new \tessefakt\environment($this->_oTessefakt,['get','post','server','header','session','operations']);
	}
	protected function _handle():void{
$this->apps->tessefakt->entrances->internal->controllers->install->create_structure();
		$this->reply();
	}
	protected function _reply(int $status):void{
		http_response_code($status);
		header('Content-Type: text/html');
		if(count($this->exception)){
			$this->env->operations['tpls']['index']=compilepath($this->_oTessefakt->setup['paths']['tpl'].'/plain/exception.php');
		}else{
			$this->env->operations['tpls']['index']=compilepath($this->_oTessefakt->setup['paths']['tpl'].'/plain/index.php');
		}
		include($this->env->operations['tpls']['index']);
		die();
	}
}