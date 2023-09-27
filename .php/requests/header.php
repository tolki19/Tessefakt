<?php
namespace mdf\requests;
class header extends requests{
	public function __construct(\mdf\mdf $mdf){
		parent::__construct($mdf);
		$this->__aValue=\apache_request_headers();
	}
}

