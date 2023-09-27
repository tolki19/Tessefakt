<?php
namespace mdf;
class request{
	private $__oMdf;
	private $__oGet;
	private $__oPost;
	private $__oServer;
	private $__oHeader;
	public function __construct(\mdf\mdf $mdf){
		$this->__oMdf=$mdf;
		$this->__oGet=new \mdf\requests\get($this->__oMdf);
		$this->__oPost=new \mdf\requests\post($this->__oMdf);
		$this->__oServer=new \mdf\requests\server($this->__oMdf);
		$this->__oHeader=new \mdf\requests\header($this->__oMdf);
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