<?php
namespace tessefakt\apps\tessefakt\controllers;
class system extends \tessefakt\controller{
	public function bootstrap(){
		$aConfig=$this->tessefakt->config;
		$aApps=[];
		foreach($aConfig['apps'] as $key=>$value){
			$aApps[$key]=[
				'version'=>$value['version']??[],
				'navigation'=>$value['navigation']??[],
				'entities'=>$value['entities']??[]
			];
		}
		$aTransmit=[
			'construct'=>$aConfig['construct'],
			'settings'=>[
				'defaults'=>$aConfig['settings']['defaults']
			],
			'apps'=>$aApps
		];
		if(array_search('frontend',$aConfig['settings']['dev']['level']??[])!==false){
			$aTransmit['apps']['tessefakt']['navigation']['navigation'][]=[
				'type'=>'sep'
			];
			$aTransmit['apps']['tessefakt']['navigation']['navigation'][]=[
				'type'=>'group',
				'caption'=>'Dev',
				'icon'=>[
					'type'=>'mso',
					'caption'=>'assistant_direction'
				],
				'navigation'=>[
					[
						'type'=>'dialog',
						'caption'=>'Fataler Fehler (Client)',
						'key'=>['app'=>'tessefakt','index'=>'fatal']
					]
				]
			];
			$aTransmit['settings']['dev']=$aConfig['settings']['dev'];
			if(isset($aConfig['settings']['credentials'])) $aTransmit['settings']['credentials']=$aConfig['settings']['credentials'];
		}
		$this->tessefakt->response->data=['config'=>$aTransmit];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='login';
	}
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
	public function login(){
		// $this->tessefakt->response->data=['dn'=>$this->tessefakt->operations->dn];
		$this->tessefakt->response->data=['id'=>1];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='config';
	}
	public function logout(){
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='bootstrap';
	}
}