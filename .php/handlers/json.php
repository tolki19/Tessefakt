<?php
namespace tessefakt\handlers;
class json extends _handler{
	public function handle():void{}
	public function reply(?int $status=200){
		parent::self($status);
		$iFlags=\JSON_THROW_ON_ERROR;
		if($this->tessefakt->config['settings']['dev']['state']) $iFlags|=\JSON_PRETTY_PRINT;
		$aMetrics=$this->_oTessefakt->stats();
		$aMetrics=[
			'db-queries'=>$aMetrics['db']['queries'],
			'db-time'=>$aMetrics['db']['time'],
			'php-time'=>microtime(true)-$this->_fStart
		];
		http_response_code($status);
		header('Content-Type: application/json');
		echo json_encode([
				'success'=>!!$this->_bSuccess,
				'exception'=>$this->_aException,
				'recommendation'=>$this->_aRecommendation,
				'data'=>$this->_aData,
				'metrics'=>$aMetrics
			],$iFlags);
		exit();
	}
}