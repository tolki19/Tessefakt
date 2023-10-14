<?php
namespace tessefakt\requests;
class server extends \tessefakt\requests\_request{
	public function __construct(\tessefakt\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->__aValue=$_SERVER;
	}
}
