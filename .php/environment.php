<?php
namespace tessefakt;
class environment{
	private $__oTessefakt;
	private $__oGet;
	private $__oPost;
	private $__oServer;
	private $__oHeader;
	public function __construct(\tessefakt $tessefakt){
		$this->__oTessefakt=$tessefakt;
	}
	public function __get(string $key){
		switch($key){
			case 'get':
				if(!this->__oGet) $this->__oGet=new \tessefakt\requests\get($this->__oTessefakt);
				return $this->__oGet;
			case 'post':
				if(!this->__oPost) $this->__oPost=new \tessefakt\requests\post($this->__oTessefakt);
				return $this->__oPost;
			case 'server':
				if(!this->__oServer) $this->__oServer=new \tessefakt\requests\server($this->__oTessefakt);
				return $this->__oServer;
			case 'header':
				if(!this->__oHeader) $this->__oHeader=new \tessefakt\requests\header($this->__oTessefakt);
				return $this->__oHeader;
			case 'session':
				if(!this->__oSession) $this->__oSession=new \tessefakt\requests\session($this->__oTessefakt);
				return $this->__oSession;
		}
	}
}