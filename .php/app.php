<?php
namespace tessefakt;
class app{
	private $__oTessefakt;
	private $__aDbCredentials;
	private $__oControllers;
	private $__oDb;
	private $__oReflection;
	public function __construct(\tessefakt\tessefakt $tessefakt,$db_credentials){
		$this->__oTessefakt=$tessefakt;
		$this->__aDbCredentials=$db_credentials;
		$this->__oControllers=new \tessefakt\controller_router($this->__oTessefakt,$this);
		$this->__oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->__oTessefakt;
			case 'controllers': return $this->__oControllers;
			case 'db':
				if(!$this->__oDb) $this->__oDb=new \tessefakt\dbs\mysqli($this->__oTessefakt,$this->__aDbCredentials);
				return $this->__oDb;
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