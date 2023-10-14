<?php
namespace tessefakt\dbs;
class mysqli extends \tessefakt\dbs\_db{
	protected $_oTessefakt;
	private $__oConnection;
	private $__bAutocommit;
	private $__bFormerAutocommit;
	private $__aCredentials;
	protected $_iQueries=0;
	protected $_fTime=.0;
	public function __construct(\tessefakt\tessefakt $tessefakt,array $credentials){
		$this->_oTessefakt=$tessefakt;
		$this->__bFormerAutocommit=&$this->__bAutocommit;
		$this->__aCredentials=$credentials;
	}
	public function __get(string $key){
		switch($key){
		}
	}
	protected function __connection(){
		if(!$this->__oConnection){
			\mysqli_report(\MYSQLI_REPORT_ERROR|\MYSQLI_REPORT_STRICT);
			$this->__oConnection=new \mysqli($this->__aCredentials['host'],$this->__aCredentials['username'],$this->__aCredentials['password'],$this->__aCredentials['dbname']);
			$this->__oConnection->set_charset('utf8mb4');
		};
		return $this->__oConnection;
	}
	public function query(string $query){
		try{
			$fStart=\microtime(true);
			$oResult=$this->__connection()->query($query);
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
			return $this->__connection()->insert_id;
		}catch(\mysqli_sql_exception $ex){
			throw $ex;
		}finally{
			++$this->_iQueries;
			$this->_fTime+=\microtime(true)-$fStart;
		}
	}
	public function escape(string $string){
		return $this->__connection()->real_escape_string($string);
	}
	public function autocommit(bool $state=true){
		try{
			$fStart=\microtime(true);
			$this->__connection()->autocommit($state);
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
			$bReturn=$this->__connection()->begin_transaction(0,$name);
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
			$bReturn=$this->__connection()->savepoint($name);
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
			$bReturn=$this->__connection()->commit(0,$name);
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
			$bReturn=$this->__connection()->rollback(0,$name);
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
	public function searchCross($value,array $fields){
		if(!$value) return '1';
		$values=\explode(' ',(string)$value);
		$aReturn=[];
		foreach($fields as $field){
			$oSet=$this->searchAggr($values,$field);
			if($oSet) $aReturn[]=$oSet;
		}
		foreach($values as $value){
			$aSet=[];
			foreach($fields as $field){
				$oSet=$this->searchScalar($value,$field);
				if($oSet) $aSet[]=$oSet;
			}
			if(count($aSet)) $aReturn[]=$aSet;
		}
		return $aReturn;
	}
	public function searchAggr(array $values,array $field){
		\array_walk($values,function(&$value,$key){$value='"'.$this->escape($value).'"';});
		switch($field['op']){
			case 'in':
			case 'not in':
				return $field['db'].' '.$field['op'].' ('.\implode(',',$values).')';
		}
		return false;
	}
	public function searchScalar(string $value,array $field){
		switch($field['op']){
			case '<':
			case '<=':
			case '=':
			case '>=':
			case '>':
			case '!=':
			case '<>':
				return $field['db'].$field['op'].'"'.$this->escape($value).'"';
			case 'like':
			case 'not like':
				return $field['db'].' '.$field['op'].' "%'.$this->escape($value).'%"';
			case 'rlike':
			case 'not rlike':
			case 'regexp':
			case 'not regexp':
				return $field['db'].' '.$field['op'].' "'.$this->escape($value).'"';
			case 'null':
			case 'not null':
				return $field['db'].' is '.$field['op'];
		}
		return false;
	}
	public function searchCombine($sets,array $ops){
		if(!is_array($sets)) return $sets;
		$aSets=[];
		foreach($sets as $set){
			if(is_array($set)) $aSets[]=$this->searchCombine($set,array_slice($ops,1));
			else $aSets[]=$set;
		}
		return '('.implode(' '.$ops[0].' ',$aSets).')';
	}
	public function sort(string $value,array $fields=null,string $alt='1'):string{
		if(isset($fields[$value])) $sReturn=$fields[$value];
		else $sReturn=$alt;
		return $sReturn;
	}
	public function assign($value,$field=null,bool $defaultable=true,bool $nullable=false):string{
		$sReturn='';
		if(\is_array($field)){
			$aDimensions=[];
			\array_walk($field,function($aValue,$iKey)use(&$aDimensions){$aDimensions[]='`'.$aValue.'`';});
			$sReturn.=\implode('.',$aDimensions).'=';
		}elseif(isset($field)) $sReturn.='`'.$field.'`=';
		if($value) $sReturn.='"'.$this->escape((string)$value).'"';
		elseif($value==null&&$nullable) $sReturn.='null';
		elseif($defaultable) $sReturn.='default';
		return $sReturn;
	}
}
