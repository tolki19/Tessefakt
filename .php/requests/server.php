<?php
namespace tessefakt\requests;
class server extends requests{
	public function __construct(\tessefakt\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->__aValue=$_SERVER;
	}
}
