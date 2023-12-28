<?php
namespace tessefakt\handlers;
class html extends \tessefakt\handler{
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->_oEvironment=new \tessefakt\environment($this->_oTessefakt,['get','post','server','header','session','operations']);
	}
	public function _reply(?int $status=200):void{
		parent::reply($status);
		http_response_code($status);
		header('Content-Type: text/html');
	}
}