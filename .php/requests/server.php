<?php
namespace tessefakt\requests;
class server extends _request{
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->__aValue=$_SERVER;
	}
}
