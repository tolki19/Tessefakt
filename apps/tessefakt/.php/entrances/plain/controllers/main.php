<?php
namespace tessefakt\apps\tessefakt\entrances\plain\controllers;
class main extends \tessefakt\controller{
	public function index(){
		$this->response->op['tpls']['page']=$this->_tpl('index.php');
	}
	public function test(){
		$this->response->op['test']=$this->apps->tessefakt->libraries->install->subs->test->test();
		$this->response->op['tpls']['page']=$this->_tpl('install_test.php');
	}
	public function create(){
		$this->apps->tessefakt->libraries->install->subs->mysqli->subs->structure->create();
	}
}