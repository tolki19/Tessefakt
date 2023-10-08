<?php
namespace tessefakt;
class hash{
	protected $_oTessefakt;
	private $__aCredentials;
	public function __construct(\tessefakt\tessefakt $tessefakt,array $credentials){
		$this->_oTessefakt=$tessefakt;
		$this->__aCredentials=$credentials;
	}
	public function create(string $string):string{
		return password_hash($this->__pepper($string),\PASSWORD_DEFAULT);
	}
	public function verify(string $string,string $hash):bool{
		return password_verify($this->__pepper($string),$hash);
	}
	private function __pepper(string $string,string $algo="sha256"):string{
		return hash_hmac($algo,$string,$this->__aCredentials['pepper']);
	}
}