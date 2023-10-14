<?php
namespace tessefakt\apps\hwdb\controllers;
class test extends \tessefakt\controller{
	public function simple(){
		$aRawdata=[
			[
				'id'=>'1',
				'caption'=>'Eins',
				'example'=>'Ein Beispiel'
			],
			[
				'id'=>'2',
				'caption'=>'Zwei',
				'example'=>'2.'
			],
			[
				'id'=>'3',
				'caption'=>'Drei',
				'example'=>'Drittens'
			]
		];
		$aData=[
			'sequences'=>[
				'test'=>$this->dbs->current->crush($aRawdata)
			],
			'collections'=>[
				'test'=>$this->dbs->current->enumerate($aRawdata)
			]
		];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='display';
		$this->tessefakt->response->data=$aData;
	}
	public function moderate(){
		$aRawdata=$this->dbs->current->query('
			select
				1 `id`,
				"Eins" `caption`,
				"Ein Beispiel" `example`
			union select
				2,
				"Zwei",
				"2."
			union select
				3,
				"Drei",
				"Drittens"
			union select
				4,
				"Vier",
				"Fantastisch"
		');
		$aData=[
			'sequences'=>[
				'test'=>$this->dbs->current->crush($aRawdata)
			],
			'collections'=>[
				'test'=>$this->dbs->current->enumerate($aRawdata)
			]
		];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='display';
		$this->tessefakt->response->data=$aData;
	}
	public function complex(){
		$sTestSort=$this->dbs->current->sort($this->tessefakt->request->post->{'test-sort'},
			[
				'id asc'=>'t1.`id` asc',
				'id desc'=>'t1.`id` desc',
				'caption asc'=>'t1.`caption` asc',
				'caption desc'=>'t1.`caption` desc',
				'example asc'=>'t1.`example` asc',
				'example desc'=>'t1.`example` desc',
				'replacement asc'=>'t2.`caption` asc',
				'replacement desc'=>'t2.`caption` desc'
			]
		);
		$sSearch=$this->dbs->current->searchCombine($this->dbs->current->searchCross($this->tessefakt->request->post->{'test-search'},
			[
				['db'=>'t1.`caption`','caption'=>'caption','op'=>'like'],
				['db'=>'t1.`example`','caption'=>'example','op'=>'like'],
				['db'=>'t1.`replacement`','caption'=>'replacement','op'=>'like']
			]
		),['and','or']);
		$sQuery='
			select
				t1.`id`,
				t1.`caption`,
				t1.`example`,
				t2.`caption` `replacement`
			from `test` t1
			left join `test` t2 on
				t2.`id`=t1.`replacement`
			where '.$sSearch.'
			order by '.$sTestSort.'
		';
		$aRawData=$this->dbs->current->query($sQuery);
		$aSequencesData=$this->dbs->current->crush($aRawData);
		$aCollectionsData=$this->dbs->current->enumerate($aRawData);
		$aData=[
			'sequences'=>[
				'test'=>$aSequencesData
			],
			'collections'=>[
				'test'=>$aCollectionsData
			]
		];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='display';
		$this->tessefakt->response->data=$aData;
	}
	public function list(){
		$sSearch1=$this->dbs->current->searchCombine($this->dbs->current->searchCross($this->tessefakt->request->post->{'test-interim-replacement'},
			[
				['db'=>'`id`','op'=>'=']
			]
		),['and','or']);
		$sSearch2=$this->dbs->current->searchCombine($this->dbs->current->searchCross($this->tessefakt->request->post->{'test-id'},
			[
				['db'=>'`id`','op'=>'!=']
			]
		),['and','or']).' and '.$this->dbs->current->searchCombine($this->dbs->current->searchCross($this->tessefakt->request->post->{'test-search'},
			[
				['db'=>'`caption`','caption'=>'caption','op'=>'like'],
				['db'=>'`example`','caption'=>'example','op'=>'like'],
				['db'=>'`replacement`','caption'=>'replacement','op'=>'like']
			]
		),['and','or']);
		$sQuery='
			select
				`id`,
				`caption`,
				`example`
			from `test`
			where '.$sSearch1.'
			union
			select
				null `id`,
				null `caption`,
				null `example`
			union
			select
				`id`,
				`caption`,
				`example`
			from `test`
			where '.$sSearch2.'
			order by `caption` asc,`id` asc
			'.(!empty($this->tessefakt->request->post->{'limit'})?'limit '.$this->dbs->current->escape($this->tessefakt->request->post->{'limit'}):'').'
		';
		$aRawData=$this->dbs->current->query($sQuery);
		$aSequencesData=$this->dbs->current->crush($aRawData);
		$aCollectionsData=$this->dbs->current->enumerate($aRawData);
		$aData=[
			'sequences'=>[
				'test'=>$aSequencesData
			],
			'collections'=>[
				'test'=>$aCollectionsData
			]
		];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='display';
		$this->tessefakt->response->data=$aData;
	}
	public function details(){
// var_dump($this->app->rights);
		$sSearch=$this->dbs->current->searchCombine($this->dbs->current->searchCross(\implode(' ',$this->tessefakt->request->post->{'test-sequence'}),
			[
				['db'=>'t1.`id`','op'=>'in']
			]
		),['and','or']);
		$sQuery='
			select
				t1.`id`,
				t1.`caption`,
				t1.`example`,
				t1.`replacement`
			from `test` t1
			where '.$sSearch.'
			order by `id`
		';
		$aRawData=$this->dbs->current->query($sQuery);
		$aSequencesData=$this->dbs->current->crush($aRawData);
		$aCollectionsData=$this->dbs->current->enumerate($aRawData);
		$aData=[
			'sequences'=>[
				'test'=>$aSequencesData
			],
			'collections'=>[
				'test'=>$aCollectionsData
			]
		];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='display';
		$this->tessefakt->response->data=$aData;
	}
	public function create(){
		$this->dbs->current->query('
			insert `test`
			set
				`id`=default,
				`caption`="Test-Insert",
				`example`="Ja"
		');
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='refresh';
		$this->tessefakt->response->recommendation='select';
		$this->tessefakt->response->data=['insert'=>[(string)$this->dbs->current->insert()]];
	}
	public function delete(){
		$sSearch=$this->dbs->current->searchCombine($this->dbs->current->searchCross(\implode(' ',$this->tessefakt->request->post->id),
			[
				['db'=>'`id`','op'=>'in']
			]
		),['or','or']);
		$this->dbs->current->query('
			delete from `test`
			where '.$sSearch.'
		');
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='refresh';
		$this->tessefakt->response->recommendation='deselect';
		$this->tessefakt->response->data=['delete'=>[(string)$this->dbs->current->insert()]];
	}
	public function verify(){
		if($this->tessefakt->response->exception) $this->tessefakt->reply();
	}
	public function save(){
		$this->verify();
		$aUpdates=[];
		foreach($this->tessefakt->request->post->test as $mKey=>$aSet){
			$sSearch=$this->dbs->current->searchCombine($this->dbs->current->searchCross($mKey,
				[
					['db'=>'`id`','op'=>'=']
				]
			),['and','or']);
			$sQuery='
				update `test`
				set
					`example`='.$this->dbs->current->assign($aSet['example']).',
					`caption`='.$this->dbs->current->assign($aSet['caption']).',
					`replacement`='.$this->dbs->current->assign(value:$aSet['replacement'],nullable:true).'
				where
					'.$sSearch.'
			';
			$this->dbs->current->query($sQuery);
			$aUpdates[]=(string)$this->dbs->current->insert();
		}
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='return';
		$this->tessefakt->response->recommendation='refresh';
		$this->tessefakt->response->data=['update'=>$aUpdates];
	}
	public function cancel(){
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='return';
		$this->tessefakt->response->recommendation='refresh';
	}
}