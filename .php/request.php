<?php
namespace tessefakt;
class request{
	private $__oMdf;
	private $__oGet;
	private $__oPost;
	private $__oServer;
	private $__oHeader;
	public function __construct(\tessefakt\tessefakt $tessefakt){
		$this->__oMdf=$tessefakt;
		$this->__oGet=new \tessefakt\requests\get($this->__oMdf);
		$this->__oPost=new \tessefakt\requests\post($this->__oMdf);
		$this->__oServer=new \tessefakt\requests\server($this->__oMdf);
		$this->__oHeader=new \tessefakt\requests\header($this->__oMdf);
	}
	public function __get(string $key){
		switch($key){
			case 'get': return $this->__oGet;
			case 'post': return $this->__oPost;
			case 'server': return $this->__oServer;
			case 'header': return $this->__oHeader;
		}
	}
}