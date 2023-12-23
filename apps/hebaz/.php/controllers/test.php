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
				'test'=>$this->connectors->db->crush($aRawdata)
			],
			'collections'=>[
				'test'=>$this->connectors->db->enumerate($aRawdata)
			]
		];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='display';
		$this->tessefakt->response->data=$aData;
	}
	public function moderate(){
		$aRawdata=$this->connectors->db->query('
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
				'test'=>$this->connectors->db->crush($aRawdata)
			],
			'collections'=>[
				'test'=>$this->connectors->db->enumerate($aRawdata)
			]
		];
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='display';
		$this->tessefakt->response->data=$aData;
	}
	public function complex(){
		$sTestSort=$this->connectors->db->sort($this->tessefakt->request->post->{'test-sort'},
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
		$sSearch=$this->connectors->db->searchCombine($this->connectors->db->searchCross($this->tessefakt->request->post->{'test-search'},
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
		$aRawData=$this->connectors->db->query($sQuery);
		$aSequencesData=$this->connectors->db->crush($aRawData);
		$aCollectionsData=$this->connectors->db->enumerate($aRawData);
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
		$sSearch1=$this->connectors->db->searchCombine($this->connectors->db->searchCross($this->tessefakt->request->post->{'test-interim-replacement'},
			[
				['db'=>'`id`','op'=>'=']
			]
		),['and','or']);
		$sSearch2=$this->connectors->db->searchCombine($this->connectors->db->searchCross($this->tessefakt->request->post->{'test-id'},
			[
				['db'=>'`id`','op'=>'!=']
			]
		),['and','or']).' and '.$this->connectors->db->searchCombine($this->connectors->db->searchCross($this->tessefakt->request->post->{'test-search'},
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
			'.(!empty($this->tessefakt->request->post->{'limit'})?'limit '.$this->connectors->db->escape($this->tessefakt->request->post->{'limit'}):'').'
		';
		$aRawData=$this->connectors->db->query($sQuery);
		$aSequencesData=$this->connectors->db->crush($aRawData);
		$aCollectionsData=$this->connectors->db->enumerate($aRawData);
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
		$sSearch=$this->connectors->db->searchCombine($this->connectors->db->searchCross(\implode(' ',$this->tessefakt->request->post->{'test-sequence'}),
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
		$aRawData=$this->connectors->db->query($sQuery);
		$aSequencesData=$this->connectors->db->crush($aRawData);
		$aCollectionsData=$this->connectors->db->enumerate($aRawData);
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
		$this->connectors->db->query('
			insert `test`
			set
				`id`=default,
				`caption`="Test-Insert",
				`example`="Ja"
		');
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='refresh';
		$this->tessefakt->response->recommendation='select';
		$this->tessefakt->response->data=['insert'=>[(string)$this->connectors->db->insert()]];
	}
	public function delete(){
		$sSearch=$this->connectors->db->searchCombine($this->connectors->db->searchCross(\implode(' ',$this->tessefakt->request->post->id),
			[
				['db'=>'`id`','op'=>'in']
			]
		),['or','or']);
		$this->connectors->db->query('
			delete from `test`
			where '.$sSearch.'
		');
		$this->tessefakt->response->success=true;
		$this->tessefakt->response->recommendation='refresh';
		$this->tessefakt->response->recommendation='deselect';
		$this->tessefakt->response->data=['delete'=>[(string)$this->connectors->db->insert()]];
	}
	public function verify(){
		if($this->tessefakt->response->exception) $this->tessefakt->reply();
	}
	public function save(){
		$this->verify();
		$aUpdates=[];
		foreach($this->tessefakt->request->post->test as $mKey=>$aSet){
			$sSearch=$this->connectors->db->searchCombine($this->connectors->db->searchCross($mKey,
				[
					['db'=>'`id`','op'=>'=']
				]
			),['and','or']);
			$sQuery='
				update `test`
				set
					`example`='.$this->connectors->db->assign($aSet['example']).',
					`caption`='.$this->connectors->db->assign($aSet['caption']).',
					`replacement`='.$this->connectors->db->assign(value:$aSet['replacement'],nullable:true).'
				where
					'.$sSearch.'
			';
			$this->connectors->db->query($sQuery);
			$aUpdates[]=(string)$this->connectors->db->insert();
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