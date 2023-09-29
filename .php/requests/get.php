<?php
namespace tessefakt\requests;
class get extends requests{
	public function __construct(\tessefakt\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->__aValue=$_GET;
	}
}
