<?php
namespace tessefakt;
class lore_router{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_aLores=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\app $app){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aLores)){
			$this->_aLores[$key]=new ($this->_oApp->name.'\\lores\\'.$key)($this->_oTessefakt,$this->_oApp);
		}
		return $this->_aLores[$key];
	}
	public function __set(string $key,$value){}
}