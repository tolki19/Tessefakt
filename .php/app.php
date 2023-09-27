<?php
namespace mdf;
class app{
	private $__oMdf;
	private $__aDbCredentials;
	private $__oControllers;
	private $__oDb;
	private $__oReflection;
	public function __construct(\mdf\mdf $mdf,$db_credentials){
		$this->__oMdf=$mdf;
		$this->__aDbCredentials=$db_credentials;
		$this->__oControllers=new \mdf\controller_router($this->__oMdf,$this);
		$this->__oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'mdf': return $this->__oMdf;
			case 'controllers': return $this->__oControllers;
			case 'db':
				if(!$this->__oDb) $this->__oDb=new \mdf\dbs\mysqli($this->__oMdf,$this->__aDbCredentials);
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