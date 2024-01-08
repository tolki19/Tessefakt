<?php
namespace tessefakt\apps\tessefakt\entrances\plain\controllers;
class main extends \tessefakt\controller{
	public function index(){
		$this->response->op['tpls']['page']=compilepath($this->app->setup['paths']['tpl'].'/index.php');
	}
}