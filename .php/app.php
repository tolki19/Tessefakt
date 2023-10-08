<?php
namespace tessefakt;
class app{
	private $__oTessefakt;
	private $__aDbCredentials;
	private $__aHashCredentials;
	private $__oControllers;
	private $__oDb;
	private $__oHash;
	private $__oReflection;
	public function __construct(\tessefakt\tessefakt $tessefakt,?array $db_credentials=null,?array $hash_credentials=null){
		$this->__oTessefakt=$tessefakt;
		$this->__aDbCredentials=$db_credentials;
		$this->__aHashCredentials=$hash_credentials;
		$this->__oControllers=new \tessefakt\controller_router($this->__oTessefakt,$this);
		$this->__oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->__oTessefakt;
			case 'controllers': return $this->__oControllers;
			case 'db':
				if(!$this->__aDbCredentials) return null;
				if(!$this->__oDb) $this->__oDb=new \tessefakt\dbs\mysqli($this->__oTessefakt,$this->__aDbCredentials);
				return $this->__oDb;
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