<?php
namespace tessefakt\apps\tessefakt\libraries\install\test;
class mysqli extends \tessefakt\library{
	public function test():bool{
		$bReturn=true;
		$bReturn&=$this->subs->users->subs->emails->test();
		return $bReturn;
	}
}
