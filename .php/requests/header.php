<?php
namespace tessefakt\requests;
class header extends _request{
	public function __construct(\tessefakt\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->__aValue=apache_request_headers();
	}
}
