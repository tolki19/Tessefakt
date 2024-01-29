<?php
namespace tessefakt\apps\hebaz\libraries;
class install extends \tessefakt\library{
	public function test():void{
		$this->subs->test->test();
	}
	public function prime():void{
		$this->subs->build->new();
	}
	public function migrate():void{
		$this->subs->build->migrate();
	}
}
