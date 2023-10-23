<?php
namespace tessefakt\handlers;
class html extends _handler{
	public function handle():void{
		parent::handle();
$this->reply();
	}
	public function reply(?int $status=200):void{
		parent::reply($status);
		http_response_code($status);
		header('Content-Type: text/html');
	}
}