<?php
namespace tessefakt\handlers;
class plain extends \tessefakt\handler{
	protected $_oResponse;
	protected $_oEnvironment;
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
	}
	public function __get(string $key):mixed{
		switch($key){
			case 'response':
				if(!$this->_oResponse) $this->_oResponse=new \tessefakt\response($this->_oTessefakt,['success','exception','recommend','data','tpl','operations']);
				return $this->_oResponse;
			case 'env':
				if(!$this->_oEnvironment) $this->_oEnvironment=new \tessefakt\environment($this->_oTessefakt,['get','post','server','header','session']);
				return $this->_oEnvironment;
		}
		return parent::__get($key);
	}
	protected function _handle():void{
		$this->response->operations['urls']['folder']=compileurl($this->tessefakt->setup['urls']['folder']);
		$this->response->operations['urls']['target']=compileurl($this->tessefakt->setup['urls']['target']);
$this->apps->tessefakt->libraries->install->create_structure();
		$sApp=$this->setup['defaults']['app'];
		$sEntrance='plain';
		$sController=$this->setup['apps'][$sApp]['defaults']['entrances'][$sEntrance]['controller'];
		$sMethod=$this->setup['apps'][$sApp]['defaults']['entrances'][$sEntrance]['method'];
		$this->apps->{$sApp}->entrances->{$sEntrance}->controllers->{$sController}->{$sMethod}();
		$this->response->operations['address']=[
			'app'=>$sApp,
			'entrance'=>$sEntrance,
			'controller'=>$sController,
			'method'=>$sMethod
		];
// $this->apps
		$this->reply();
	}
	protected function _reply(int $status):void{
		if(headers_sent()&&$status<500) throw new \Exception('Output from other source');
		if($this->response->success===null||$status<200||$status>=300) $this->response->success=false;
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