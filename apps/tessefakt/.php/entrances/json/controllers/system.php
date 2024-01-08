<?php
namespace tessefakt\apps\tessefakt\entrances\json\controllers;
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
				'defaults'=>$aConfig['defaults']
			],
			'apps'=>$aApps
		];
		if(array_search('frontend',$aConfig['dev']['level']??[])!==false){
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
			$aTransmit['dev']=$aConfig['dev'];
			if(isset($aConfig['credentials'])) $aTransmit['credentials']=$aConfig['credentials'];
		}
		$this->tessefakt->response->data=['config'=>$aTransmit];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='login';
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