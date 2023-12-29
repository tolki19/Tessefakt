<?php
namespace tessefakt;
class environment{
	protected $_oTessefakt;
	protected $_aGet;
	protected $_aPost;
	protected $_aServer;
	protected $_aHeader;
	protected $_aSession;
	protected $_aAllowed=[];
	public function __construct(\tessefakt $tessefakt,array $allowed){
		$this->_oTessefakt=$tessefakt;
		$this->_aAllowed=$allowed;
	}
	public function &__get(string $key){
		if(array_search($key,$this->_aAllowed)===false) throw new \Exception('Disallowed key');
		switch($key){
			case 'get':
				if(!$this->_aGet) $this->_aGet=$_GET;
				return $this->_aGet;
			case 'post':
				if(!$this->_aPost) $this->_aPost=$_POST;
				return $this->_aPost;
			case 'server':
				if(!$this->_aServer) $this->_aServer=$_SERVER;
				return $this->_aServer;
			case 'header':
				if(!$this->_aHeader) $this->_aHeader=apache_request_headers();
				return $this->_aHeader;
			case 'session':
				if(!$this->_aSession){
					session_start();
					$this->_aSession=&$_SESSION;
				}
				return $this->_aSession;
		}
	}
}