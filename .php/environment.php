<?php
namespace tessefakt;
class environment{
	protected $_oTessefakt;
	protected $_aSubjects=[];
	protected $_aAllowed=[];
	public function __construct(\tessefakt $tessefakt,array $allowed){
		$this->_oTessefakt=$tessefakt;
		$this->_aAllowed=$allowed;
	}
	public function &__get(string $key){
		switch($key){
			case 'get':
				if(!array_key_exists($key,$this->_aSubjects)){
					$this->_aSubjects[$key]=$_GET;
				}
				return $this->_aSubjects[$key];
			case 'post':
				if(!array_key_exists($key,$this->_aSubjects)){
					$this->_aSubjects[$key]=$_POST;
				}
				return $this->_aSubjects[$key];
			case 'server':
				if(!array_key_exists($key,$this->_aSubjects)){
					$this->_aSubjects[$key]=$_SERVER;
				}
				return $this->_aSubjects[$key];
			case 'header':
				if(!array_key_exists($key,$this->_aSubjects)){
					$this->_aSubjects[$key]=apache_request_headers();
				}
				return $this->_aSubjects[$key];
			case 'session':
				if(!array_key_exists($key,$this->_aSubjects)){
					session_start();
					$this->_aSubjects[$key]=&$_SESSION;
				}
				return $this->_aSubjects[$key];
			case 'operations':
				if(!array_key_exists($key,$this->_aSubjects)){
					$this->_aSubjects[$key]=[];
				}
				return $this->_aSubjects[$key];
		}
	}
}