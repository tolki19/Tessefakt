<?php
namespace tessefakt\handlers;
class plain extends _handler{
	public function handle():void{
		parent::handle();
$this->apps->tessefakt->lores->plain->controllers->install->create_structure();
$this->reply();
	}
	protected function _reply(int $status):void{
		http_response_code($status);
		header('Content-Type: text/html');
?>ok,plain<?php
	}
}