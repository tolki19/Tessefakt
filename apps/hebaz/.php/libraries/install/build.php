<?php
namespace tessefakt\apps\hebaz\libraries\install;
class build extends \tessefakt\library{
	public function new():void{
		$this->subs->structure->create();
		$this->subs->data->prime();
	}
	public function migrate():void{
		$this->subs->structure->create();
		$this->subs->data->migrate();
	}
}
