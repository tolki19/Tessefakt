<?php
namespace tessefakt;
class library{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_oLibraries;
	protected $_oReflection;
	protected $_oSubs;
	public function __construct(\tessefakt $tessefakt,\tessefakt\app $app,\tessefakt\library_router $libraries){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
		$this->_oLibraries=$libraries;
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'apps': return $this->_oApp->apps;
			case 'app': return $this->_oApp;
			case 'libraries': return $this->_oLibraries;
			case 'connectors': return $this->_oApp->connectors;
			case 'hash': return $this->_oApp->hash;
			case 'key': return $this->_oApp->key;
			case 'name':
				if(!$this->_oReflection) $this->_oReflection=new \ReflectionClass($this);
				return $this->_oReflection->getName();
			case 'dir':
				if(!$this->_oReflection) $this->_oReflection=new \ReflectionClass($this);
				return dirname($this->_oReflection->getFileName());
			case 'subs':
				if(!$this->_oSubs) $this->_oSubs=new \tessefakt\library_router(
					tessefakt:$this->_oTessefakt,
					app:$this->_oApp,
					library:$this,
				);
				return $this->_oSubs;
		}
		throw new \Exception('Unknown key');
	}
	public function __set(string $key,$value){}
}