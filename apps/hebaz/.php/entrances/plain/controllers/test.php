<?php
namespace tessefakt\apps\hebaz\entrances\plain\controllers;
class test extends \tessefakt\controller{
	public function test(){
		$this->response->op['tpls']['page']=compilepath($this->app->setup['paths']['tpl'].'/test.php');
	}
}