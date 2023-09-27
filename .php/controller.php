<?php
namespace mdf;
class controller{
	private $__oMdf;
	private $__oApp;
	public function __construct(\mdf\mdf $mdf,app $app){
		$this->__oMdf=$mdf;
		$this->__oApp=$app;
	}
	public function __get(string $key){
		switch($key){
			case 'mdf': return $this->__oMdf;
			case 'app': return $this->__oApp;
			case 'db': return $this->__oApp->db;
		}
	}
	public function __set(string $key,$value){}
}