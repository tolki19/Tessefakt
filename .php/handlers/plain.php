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
				if(!$this->_oResponse) $this->_oResponse=new \tessefakt\response($this->_oTessefakt,['success','exception','recommend','data','tpl','op']);
				return $this->_oResponse;
			case 'env':
				if(!$this->_oEnvironment) $this->_oEnvironment=new \tessefakt\environment($this->_oTessefakt,['get','post','server','header','session']);
				return $this->_oEnvironment;
		}
		return parent::__get($key);
	}
	protected function _handle():void{
		$this->response->op['urls']['folder']=compileurl($this->tessefakt->setup['urls']['folder']);
		$this->response->op['urls']['target']=compileurl($this->tessefakt->setup['urls']['target']);
$this->apps->tessefakt->libraries->install->create_structure();
$this->apps->hebaz->libraries->install->create_structure();
		if(isset($this->env->get['app'])) $sApp=$this->env->get['app'];
		else $sApp=$this->setup['defaults']['app'];
		$sEntrance='plain';
		if(isset($this->env->get['controller'])&&isset($this->env->get['controller'])){
			$sController=$this->env->get['controller'];
			$sMethod=$this->env->get['method'];
		}elseif(isset($this->setup['defaults']['controller'])&&isset($this->setup['defaults']['method'])){
			$sController=$this->setup['defaults']['controller'];
			$sMethod=$this->setup['defaults']['method'];
		}else{
			$sController=$this->setup['apps'][$sApp]['defaults']['entrances'][$sEntrance]['controller'];
			$sMethod=$this->setup['apps'][$sApp]['defaults']['entrances'][$sEntrance]['method'];
		}
		$this->apps->{$sApp}->entrances->{$sEntrance}->controllers->{$sController}->{$sMethod}();
		$this->response->op['address']=[
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
		if(count($this->response->exception)){
			$this->response->op['tpls']['index']=compilepath($this->_oTessefakt->setup['paths']['tpl'].'/plain/exception.php');
		}else{
			$this->response->op['tpls']['index']=compilepath($this->_oTessefakt->setup['paths']['tpl'].'/plain/index.php');
		}
		$this->_include($this->response->op['tpls']['index']);
		die();
	}
	protected function _include(string $path,array $space=[],bool $return=false):string|bool{
		if(!$return) ob_start();
		if($space){
			$aFormer=$this->_compact($space);
			$this->_extract($space);
		}
		$bReturn=include $path;
		if($space) $this->_extract($aFormer);
		if($return) return ob_get_clean();
		return $bReturn;
	}
	protected function _compact(array $space):array{
		$aKeys=array_keys($space);
		$aReturn=[];
		foreach($aKeys as $mKey){
			if(!isset($this->response->op[$mKey])) continue;
			$aReturn[$mKey]=$this->response->op[$mKey];
		}
		return $aReturn;
	}
	protected function _extract(array $space):bool{
		$aReturn=[];
		foreach($space as $mKey=>$mValue) $this->response->op[$mKey]=$mValue;
		return true;
	}
}