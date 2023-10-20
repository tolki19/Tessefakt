<?php
namespace tessefakt\handlers;
class html extends _handler{
	public function handle():void{}
	public function reply(?int $status=200){
		parent::self($status);
	}
}