<?php
namespace tessefakt\apps\tessefakt\libraries\install;
class build extends \tessefakt\library{
	public function new():void{
		$this->subs->structure->create();
		$this->subs->data->prime();
	}
}
