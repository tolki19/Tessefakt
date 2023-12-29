<?php
namespace tessefakt;
class response{
	protected $_oTessefakt;
	protected $_aAllowed;
	protected $_bSuccess=null;
	protected $_aException=[];
	protected $_aRecommendation=[];
	protected $_aData=[];
	protected $_aTemplate;
	protected $_aOperations;
	public function __construct(\tessefakt $tessefakt,array $allowed){
		$this->_oTessefakt=$tessefakt;
		$this->_aAllowed=$allowed;
	}
	public function &__get(string $key):mixed{
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
		}
		if(array_search($key,$this->_aAllowed)===false) throw new \Exception('Disallowed key');
		switch($key){
			case 'success': return $this->_bSuccess;
			case 'exception': return $this->_aException;
			case 'recommendation': return $this->_aRecommendation;
			case 'data': return $this->_aData;
			case 'tpl': return $this->_aTemplate;
			case 'op': return $this->_aOperations;
		}
		throw new \Exception('Unknown key');
	}
	public function __set(string $key,$value):void{
		if(array_search($key,$this->_aAllowed)===false) throw new \Exception('Disallowed key');
		switch($key){
			case 'success': 
				if(!is_bool($value)) throw new \Exception('Boolean needed');
				$this->_bSuccess=$value;
				break;
			case 'exception': 
				if(!is_array($value)) throw new \Exception('Array needed');
				$this->_aException[]=$value;
				break;
			case 'recommendation': 
				if(!is_string($value)) throw new \Exception('String needed');
				$this->_aRecommendation[]=$value;
				break;
			case 'data': 
				if(!is_array($value)) throw new \Exception('Array needed');
				foreach($value as $mKey=>$mValue) $this->_aData[$mKey]=$mValue;
				break;
			case 'tpl':
				if(!is_array($value)) throw new \Exception('Array needed');
				foreach($value as $mKey=>$mValue) $this->_aTemplate[$mKey]=$mValue;
				break;
		}
	}
}
