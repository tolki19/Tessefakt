<?php
namespace tessefakt\apps\tessefakt\libraries\install;
class test extends \tessefakt\library{
	public function test():bool{
		$bReturn=true;
		$bReturn&=$this->subs->users->subs->emails->test();
		return $bReturn;
	}
	public function validate(
		array|bool $result,
		string $file
	):bool{
		return (preg_replace('#(?:\r\n|\r|\n)#',"\n",json_encode($result,\JSON_THROW_ON_ERROR|\JSON_PRETTY_PRINT))===preg_replace('#(?:\r\n|\r|\n)#',"\n",file_get_contents(compilepath($this->app->setup['paths']['test'].'/'.$file))));

	}
}
