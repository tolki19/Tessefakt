<?php
namespace tessefakt\apps\hebaz\entrances\plain\controllers;
class test extends \tessefakt\controller{
	public function test(){
		$this->env->operations['tpls']['page']=compilepath($this->app->setup['paths']['tpl'].'/test.php');
	}
}