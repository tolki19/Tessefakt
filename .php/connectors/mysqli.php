<?php
namespace tessefakt\connectors;
class mysqli extends _connector{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_aSetup;
	private $__oConnection;
	private $__bAutocommit;
	private $__bFormerAutocommit;
	protected $_iQueries=0;
	protected $_fTime=.0;
	public function __construct(\tessefakt $tessefakt,\tessefakt\app $app,array $setup){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
		$this->_aSetup=$setup;
		$this->__bFormerAutocommit=&$this->__bAutocommit;
	}
	public function __get(string $key){
		switch($key){
			case 'connection':
				if(!$this->__oConnection){
					\mysqli_report(\MYSQLI_REPORT_ERROR|\MYSQLI_REPORT_STRICT);
					$this->__oConnection=new \mysqli($this->_aSetup['host'],$this->_aSetup['username'],$this->_aSetup['password'],$this->_aSetup['dbname']);
					$this->__oConnection->set_charset('utf8mb4');
				};
				return $this->__oConnection;
		}
	}
	public function multi(string $query){
		try{
			$fStart=\microtime(true);
			$this->connection->multi_query($query);
			if($oResult===true) return $oResult;
			$aReturn=[];
			while($this->connection->more_results()){
				$oResult=$this->connection->store_result();
				$aRows=[];
				while($aRow=$oResult->fetch_assoc()) $aRows[]=$aRow;
				$oResult->free();
				$aReturn[]=$aRows;
			}
			return $aReturn;
		}catch(\mysqli_sql_exception $ex){
			throw $ex;
		}finally{
			++$this->_iQueries;
			$this->_fTime+=\microtime(true)-$fStart;
		}
	}
	public function query(string $query){
		try{
			$fStart=\microtime(true);
			$oResult=$this->connection->query($query);
			if($oResult===true) return $oResult;
			$aReturn=[];
			while($aRow=$oResult->fetch_assoc()) $aReturn[]=$aRow;
			$oResult->free();
			return $aReturn;
		}catch(\mysqli_sql_exception $ex){
			throw $ex;
		}finally{
			++$this->_iQueries;
			$this->_fTime+=\microtime(true)-$fStart;
		}
	}
	public function insert(){
		try{
			$fStart=\microtime(true);
			return $this->connection->insert_id;
		}catch(\mysqli_sql_exception $ex){
			throw $ex;
		}finally{
			++$this->_iQueries;
			$this->_fTime+=\microtime(true)-$fStart;
		}
	}
	public function escape(string $string){
		return $this->connection->real_escape_string($string);
	}
	public function autocommit(bool $state=true){
		try{
			$fStart=\microtime(true);
			$this->connection->autocommit($state);
			$this->__bAutocommit=$state;
			$bReturn=$this->__bAutocommit;
			return $bReturn;
		}catch(\mysqli_sql_exception $ex){
			throw $ex;
		}finally{
			++$this->_iQueries;
			$this->_fTime+=\microtime(true)-$fStart;
		}
	}
	public function transaction(?string $name=null){
		try{
			$fStart=\microtime(true);
			$bReturn=$this->connection->begin_transaction(0,$name);
			$this->__bFormerAutocommit=$this->__bAutocommit;
			$this->__bAutocommit=false;
			return $bReturn;
		}catch(\mysqli_sql_exception $ex){
			throw $ex;
		}finally{
			++$this->_iQueries;
			$this->_fTime+=\microtime(true)-$fStart;
		}
	}
	public function savepoint(string $name){
		try{
			$fStart=\microtime(true);
			$bReturn=$this->connection->savepoint($name);
			return $bReturn;
		}catch(\mysqli_sql_exception $ex){
			throw $ex;
		}finally{
			++$this->_iQueries;
			$this->_fTime+=\microtime(true)-$fStart;
		}
	}
	public function commit(?string $name=null){
		try{
			$fStart=\microtime(true);
			$bReturn=$this->connection->commit(0,$name);
			return $bReturn;
		}catch(\mysqli_sql_exception $ex){
			throw $ex;
		}finally{
			$this->__bAutocommit=$this->__bFormerAutocommit;
			$this->__bFormerAutocommit=&$this->__bAutocommit;
			++$this->_iQueries;
			$this->_fTime+=\microtime(true)-$fStart;
		}
	}
	public function rollback(?string $name=null){
		try{
			$fStart=\microtime(true);
			$bReturn=$this->connection->rollback(0,$name);
			return $bReturn;
		}catch(\mysqli_sql_exception $ex){
			throw $ex;
		}finally{
			++$this->_iQueries;
			$this->_fTime+=\microtime(true)-$fStart;
		}
	}
	public function stats(){
		return [
			'queries'=>$this->_iQueries,
			'time'=>$this->_fTime
		];
	}
	public function crush(array $array,string $index='id'):array{
		$aReturn=[];
		$sIndex=$index;
		\array_walk($array,function($aValue,$iKey)use(&$aReturn,$sIndex){$aReturn[]=$aValue[$sIndex]===null?'null':(string)$aValue[$sIndex];});
		return $aReturn;
	}
	public function enumerate(array $array,string $index='id'):array{
		$aReturn=[];
		$sIndex=$index;
		\array_walk($array,function($aValue,$iKey)use(&$aReturn,$sIndex){$aReturn[$aValue[$sIndex]===null?'null':(string)$aValue[$sIndex]]=$aValue;});
		return $aReturn;
	}
}
