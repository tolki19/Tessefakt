<?php
namespace tessefakt;
class controller{
	private $__oTessefakt;
	private $__oApp;
	public function __construct(\tessefakt\tessefakt $tessefakt,app $app){
		$this->__oTessefakt=$tessefakt;
		$this->__oApp=$app;
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->__oTessefakt;
			case 'app': return $this->__oApp;
			case 'db': return $this->__oApp->db;
			case 'hash': return $this->__oApp->hash;
		}
	}
	public function __set(string $key,$value){}
}