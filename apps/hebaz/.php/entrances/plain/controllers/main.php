<?php
namespace tessefakt\apps\hebaz\entrances\plain\controllers;
class main extends \tessefakt\controller{
	public function index(){
		$this->response->op['tpls']['page']=compilepath($this->app->setup['paths']['tpl'].'/overview.php');
	}
}