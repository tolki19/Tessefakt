<?php
namespace tessefakt;
class app{
	private $__oTessefakt;
	private $__aDbs;
	private $__aHash;
	private $__oControllers;
	private $__oDbs;
	private $__oHash;
	private $__oReflection;
	public function __construct(\tessefakt\tessefakt $tessefakt,?array $dbs=null,?array $hash=null){
		$this->__oTessefakt=$tessefakt;
		$this->__aDbs=$dbs;
		$this->__aHash=$hash;
		$this->__oControllers=new \tessefakt\controller_router($this->__oTessefakt,$this);
		$this->__oDbs=new \tessefakt\db_router($this->__oTessefakt,$this,$this->__aDbs);
		$this->__oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->__oTessefakt;
			case 'controllers': return $this->__oControllers;
			case 'dbs': return $this->__oDbs;
			case 'hash':
				if(!$this->__aHashCredentials) return null;
				if(!$this->__oHash) $this->__oHash=new \tessefakt\hash($this->__oTessefakt,$this->__aHashCredentials);
				return $this->__oHash;
			case 'name': return $this->__oReflection->getShortName();
			case 'dir': return \dirname($this->__oReflection->getFileName());
		}
	}
	public function __set(string $key,$value){}
	public function stats(){
		if($this->__oDb) return ['db'=>$this->__oDb->stats()];
		return ['db'=>['queries'=>0,'time'=>.0]];
	}
}