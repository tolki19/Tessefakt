<?php
namespace tessefakt\requests;
class get extends \tessefakt\requests\_request{
	public function __construct(\tessefakt\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->__aValue=$_GET;
	}
}
