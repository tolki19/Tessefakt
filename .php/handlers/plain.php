<?php
namespace tessefakt\handlers;
class plain extends \tessefakt\handler{
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
	}
	protected function _handle():void{
$this->apps->tessefakt->libraries->install->create_structure();
	$sApp=$this->setup['defaults']['app'];
	$sEntrance='plain';
	$sController=$this->setup['apps'][$sApp]['defaults']['entrances'][$sEntrance]['controller'];
	$sMethod=$this->setup['apps'][$sApp]['defaults']['entrances'][$sEntrance]['method'];
	$this->apps->{$sApp}->entrances->{$sEntrance}->controllers->{$sController}->{$sMethod}();
	$this->env->operations['address']=[
		'app'=>$sApp,
		'entrance'=>$sEntrance,
		'controller'=>$sController,
		'method'=>$sMethod
	];
// $this->apps
		$this->reply();
	}
	protected function _reply(int $status):void{
		http_response_code($status);
		header('Content-Type: text/html');
		if(count($this->exception)){
			$this->env->operations['tpls']['index']=compilepath($this->_oTessefakt->setup['paths']['tpl'].'/plain/exception.php');
		}else{
			$this->env->operations['tpls']['index']=compilepath($this->_oTessefakt->setup['paths']['tpl'].'/plain/index.php');
		}
		include($this->env->operations['tpls']['index']);
		die();
	}
}