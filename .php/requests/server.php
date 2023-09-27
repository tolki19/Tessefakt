<?php
namespace mdf\requests;
class server extends requests{
	public function __construct(\mdf\mdf $mdf){
		parent::__construct($mdf);
		$this->__aValue=$_SERVER;
	}
}
