<?php
namespace tessefakt\apps\tessefakt\libraries;
class install extends \tessefakt\library{
	public function test():void{
		$this->subs->mysqli->subs->test->execute();
	}
}
