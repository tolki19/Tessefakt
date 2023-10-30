<?php
namespace tessefakt\requests;
class session extends _request{
	public function __construct(\tessefakt\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		switch(session_status()){
			case \PHP_SESSION_DISABLED: throw new \Exception('Session requested but disabled');
			case \PHP_SESSION_NONE: session_start();
		}
		$this->__aValue=&$_SESSION;
	}
	public function destroy(){
		if(ini_get('session.use_cookies')){
			$aParams=session_get_cookie_params();
			setcookie(session_name(),'',time()-42000,$aParams["path"],$aParams["domain"],$aParams["secure"],$aParams["httponly"]);
		}
		session_destroy();
	}
	public function abort(){
		session_abort();
	}
	public function commit(){
		session_write_close();
	}
}
