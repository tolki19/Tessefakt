<?php
namespace tessefakt\handlers;
class json extends \tessefakt\_handler{
	public function __construct(\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->_oEvironment=new \tessefakt\environment($this->_oTessefakt,['get','post','server','header','operations']);
	}
	protected function _handle():void{
		if(isset($_GET['action'])&&$_GET['action']==='bootstrap'){
			$this->apps->tessefakt->controllers->system->bootstrap();
			$this->reply();
		}elseif(!$this->apps->tessefakt->controllers->system->auth()){
			$this->reply(401);
		}elseif(isset($_GET['action'])&&$_GET['action']==='login'){
			$this->apps->tessefakt->controllers->system->login();
			$this->reply();
		}elseif(isset($_GET['action'])&&$_GET['action']==='logout'){
			$this->apps->tessefakt->controllers->system->logout();
			$this->reply();
		}elseif(isset($_GET['app'])&&isset($_GET['controller'])&&isset($_GET['method'])){
			$this->apps->{$_GET['app']}->controllers->{$_GET['controller']}->{$_GET['method']}();
			$this->reply();
		}
		throw new \Exception('No query received');
	}
	public function _reply(?int $status=200):void{
		$iFlags=\JSON_THROW_ON_ERROR;
		if($this->tessefakt->config['dev']['state']) $iFlags|=\JSON_PRETTY_PRINT;
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