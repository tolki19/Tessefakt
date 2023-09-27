<?php
namespace mdf\requests;
class get extends requests{
	public function __construct(\mdf\mdf $mdf){
		parent::__construct($mdf);
		$this->__aValue=$_GET;
	}
}
