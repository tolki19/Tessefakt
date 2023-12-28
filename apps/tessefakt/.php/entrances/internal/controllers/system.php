<?php
namespace tessefakt\apps\tessefakt\entrances\internal\controllers;
class system extends \tessefakt\controller{
	public function auth(){
		if(!$this->tessefakt->request->header->Authorization) return false;
		\preg_match('#^(basic):(\S+)#is',$this->tessefakt->request->header->Authorization,$matches);
		switch(\strtolower($matches[1])){
			case 'basic':
				$a=\explode(':',\base64_decode($matches[2]));
				$credentials=['login'=>$a[0],'password'=>$a[1]];
				break;
		}
		// include $this->tessefakt->request->server->DOCUMENT_ROOT.'shared/ldap_wrapper.php';
		// $ldap=new \ldap\wrapper();
		// $this->tessefakt->operations->uid=$credentials['login'];
		// $this->tessefakt->operations->dn=$ldap->auth($credentials['login'],$credentials['password']);
		// return !!$this->tessefakt->operations->dn;
		return true;
	}
}