<?php
namespace tessefakt;
class app{
	protected $_oTessefakt;
	private $__aSetup;
	private $__oControllers;
	private $__oDbs;
	private $__oHash;
	private $__oReflection;
	public function __construct(\tessefakt\tessefakt $tessefakt,array $setup){
		$this->_oTessefakt=$tessefakt;
		$this->__aSetup=$setup;
		$this->__oControllers=new \tessefakt\controller_router($this->_oTessefakt,$this);
		$this->__oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'controllers': return $this->__oControllers;
			case 'dbs':
				if(!$this->__aSetup['dbs']) return null;
				if(!$this->__oDbs) $this->__oDbs=new \tessefakt\db_router($this->_oTessefakt,$this,$this->__aSetup['dbs']);
				return $this->__oDbs;
			case 'hash':
				if(!$this->__aSetup['hash']) return null;
				if(!$this->__oHash) $this->__oHash=new \tessefakt\hash($this->_oTessefakt,$this,$this->__aSetup['hash']);
				return $this->__oHash;
			case 'name': return $this->__oReflection->getShortName();
			case 'dir': return \dirname($this->__oReflection->getFileName());
		}
	}
	public function __set(string $key,$value){}
	public function stats(){
		if($this->__oDbs) return ['db'=>$this->__oDbs->stats()];
		return ['db'=>['queries'=>0,'time'=>.0]];
	}
}