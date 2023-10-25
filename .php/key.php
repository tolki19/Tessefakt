<?php
namespace tessefakt;
class key{
	protected $_oTessefakt;
	protected $_oApp;
	private $__aSetup;
	public function __construct(\tessefakt\tessefakt $tessefakt,\tessefakt\app $app,array $setup){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
		$this->__aSetup=$setup;
	}
	public function create(int $length=16):string{
		if($length<8||$length>256) throw new \Exception('Length out of range');
		return bin2hex(random_bytes($length));
	}
}