<?php
namespace tessefakt\apps\tessefakt\entrances\plain\controllers;
class system extends \tessefakt\controller{
	public function login(){
		$this->response->op['tpls']['page']=$this->_tpl('system/login.php');
		$this->response->op['areas']['nav']=false;
	}
}