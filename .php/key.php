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
	public function create(int $length):string{
		return bin2hex(random_bytes($n));
	}
}