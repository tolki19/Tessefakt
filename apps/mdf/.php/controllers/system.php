<?php
namespace mdf\apps\mdf\controllers;

class system extends \mdf\controller{
	private function __decodeJson(string $path){
		try{
			$aJson=\json_decode(\file_get_contents($path),true,512,\JSON_THROW_ON_ERROR);
		}catch(\JsonException $oException){
			throw new \Exception('Bad JSON code in "'.$path.'"',\E_USER_ERROR,$oException);
		}
		return $aJson;
	}
	public function setup(){
		$aJsonSetup=$this->__decodeJson(\dirname(\dirname(\dirname(\dirname(__DIR__)))).'/.php/setup.json');
		$aJsonConfig=$this->__decodeJson(\dirname(\dirname(\dirname(\dirname(__DIR__)))).'/.config.json');
		$aConfig=\array_merge_deep($aJsonSetup,$aJsonConfig);
		foreach($aConfig['settings']['apps'] as $sApp=>$aSetting){
			$aJson=$this->__decodeJson(\dirname(\dirname(\dirname(\dirname(__DIR__)))).'/'.$aSetting['config']);
			$aConfig=\array_merge_deep(['apps'=>[$sApp=>$aJson]],$aConfig);
		}
		foreach($aConfig['settings']['apps'] as $sApp=>$aSetting){
			$aConfig['apps'][$sApp]['db']=$aSetting['db'];
		}
		return $aConfig;
	}
	public function bootstrap(){
		$aConfig=$this->mdf->config;
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
		if($aConfig['settings']['dev']['state']){
			$aTransmit['apps']['mdf']['navigation']['navigation'][]=[
				'type'=>'sep'
			];
			$aTransmit['apps']['mdf']['navigation']['navigation'][]=[
				'type'=>'group',
				'caption'=>'Dev',
				'icon'=>'apps/mdf/assets/icons/dev.svg',
				'navigation'=>[
					[
						'type'=>'dialog',
						'caption'=>'Fataler Fehler',
						'key'=>['app'=>'mdf','index'=>'fatal']
					]
				]
			];
			$aTransmit['settings']['dev']=$aConfig['settings']['dev'];
			if(isset($aConfig['settings']['credentials'])) $aTransmit['settings']['credentials']=$aConfig['settings']['credentials'];
		}
		$this->mdf->response->data=['config'=>$aTransmit];
		$this->mdf->response->success=true;
		$this->mdf->response->recommendation='login';
	}
	public function auth(){
		if(!$this->mdf->request->header->Authorization) return false;
		\preg_match('#^(basic):(\S+)#is',$this->mdf->request->header->Authorization,$matches);
		switch(\strtolower($matches[1])){
			case 'basic':
				$a=\explode(':',\base64_decode($matches[2]));
				$credentials=['login'=>$a[0],'password'=>$a[1]];
				break;
		}
		include $this->mdf->request->server->DOCUMENT_ROOT.'shared/ldap_wrapper.php';
		$ldap=new \ldap\wrapper();
		$this->mdf->operations->uid=$credentials['login'];
		$this->mdf->operations->dn=$ldap->auth($credentials['login'],$credentials['password']);
		return !!$this->mdf->operations->dn;
	}
	public function login(){
		$this->mdf->response->data=['dn'=>$this->mdf->operations->dn];
		$this->mdf->response->success=true;
		$this->mdf->response->recommendation='config';
	}
	public function logout(){
		$this->mdf->response->success=true;
		$this->mdf->response->recommendation='bootstrap';
	}
}