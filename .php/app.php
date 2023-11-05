<?php
namespace tessefakt;
class app{
	protected $_oTessefakt;
	private $__aSetup;
	protected $_oControllers;
	protected $_oDbs;
	protected $_oHash;
	protected $_oKey;
	protected $_oReflection;
	public function __construct(\tessefakt\tessefakt $tessefakt,array $setup){
		$this->_oTessefakt=$tessefakt;
		$this->__aSetup=$setup;
		$this->_oControllers=new \tessefakt\controller_router($this->_oTessefakt,$this);
		$this->_oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'db':
				if(!$this->__aSetup['db']) return null;
				if(!$this->_oDbs) $this->_oDbs=new \tessefakt\db_router($this->_oTessefakt,$this,$this->__aSetup['db']);
				return $this->_oDbs;
			case 'hash':
				if(!$this->__aSetup['hash']) return null;
				if(!$this->_oHash) $this->_oHash=new \tessefakt\hash($this->_oTessefakt,$this,$this->__aSetup['hash']);
				return $this->_oHash;
			case 'key':
				if(!$this->_oKey) $this->_oKey=new \tessefakt\key($this->_oTessefakt,$this,[]);
				return $this->_oKey;
			case 'name': return $this->_oReflection->getShortName();
			case 'dir': return dirname($this->_oReflection->getFileName());
			case 'setup': return $this->__aSetup;
			case 'controllers': return $this->_oControllers->$key;
			default: return $this->_oControllers->$key;
		}
	}
	public function __set(string $key,$value){}
	public function stats(){
		if($this->_oDbs) return ['db'=>$this->_oDbs->stats()];
		return ['db'=>['queries'=>0,'time'=>.0]];
	}
}