<?php
namespace tessefakt\requests;
class get extends _request{
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->__aValue=$_GET;
	}
}
