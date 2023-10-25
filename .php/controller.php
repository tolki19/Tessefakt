<?php
namespace tessefakt;
class controller{
	protected $_oTessefakt;
	protected $_oApp;
	public function __construct(\tessefakt\tessefakt $tessefakt,\tessefakt\app $app){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'app': return $this->_oApp;
			case 'dbs': return $this->_oApp->dbs;
			case 'hash': return $this->_oApp->hash;
			case 'key': return $this->_oApp->key;
		}
	}
	public function __set(string $key,$value){}
}