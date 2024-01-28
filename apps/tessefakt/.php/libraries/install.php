<?php
namespace tessefakt\apps\tessefakt\libraries;
class install extends \tessefakt\library{
	public function test():void{
		$this->subs->test->test();
	}
	public function prime():void{
		$this->subs->build->build();
	}
}
