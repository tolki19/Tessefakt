<?php
namespace tessefakt;
class controller{
	private $__oMdf;
	private $__oApp;
	public function __construct(\tessefakt\tessefakt $tessefakt,app $app){
		$this->__oMdf=$tessefakt;
		$this->__oApp=$app;
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->__oMdf;
			case 'app': return $this->__oApp;
			case 'db': return $this->__oApp->db;
		}
	}
	public function __set(string $key,$value){}
}