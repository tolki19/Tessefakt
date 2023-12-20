<?php
namespace tessefakt;
class lore{
	protected $_oTessefakt;
	protected $_oLores;
	protected $_oApp;
	protected $_oControllers;
	protected $_oReflection;
	public function __construct(\tessefakt $tessefakt,\tessefakt\app $app,\tessefakt\lore_router $lores){
		$this->_oTessefakt=$tessefakt;
		$this->_oLores=$lores;
		$this->_oApp=$app;
		$this->_oControllers=new \tessefakt\controller_router($this->_oTessefakt,$this);
		$this->_oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'apps': return $this->_oApp->apps;
			case 'app': return $this->_oApp;
			case 'lores': return $this->_oLores;
			case 'name': return $this->_oReflection->getName();
			case 'dir': return dirname($this->_oReflection->getFileName());
			case 'controllers': return $this->_oControllers;
		}
		throw new \Exception('Unknown key');
	}
	public function __set(string $key,$value){}
}