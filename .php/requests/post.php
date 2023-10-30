<?php
namespace tessefakt\requests;
class post extends _request{
	public function __construct(\tessefakt\tessefakt $tessefakt){
		parent::__construct($tessefakt);
		$this->__aValue=$_POST;
		array_walk_recursive($this->__aValue,function(&$value,$key){
			preg_match('#^\((object|bool|number|bigint|string)\)(.*)$#',$value,$match);
			switch($match[1]){
				case 'object':
					switch($match[2]){
						case 'null': $value=null; break 2;
						default: throw new \Exception('Unrecognized POST data object ('.$match[2].')');
					}
					break;
				case 'bool': $value=(bool)$match[2]; break;
				case 'number':
				case 'bigint':
					if(preg_match('#^-?[\d]+$#',$match[2])) $value=(int)$match[2];
					elseif(preg_match('#^-?[\d]*\.[\d]+$#',$match[2])) $value=(float)$match[2];
					else throw new \Exception('Unrecognized POST data number ('.$match[2].')');
					break;
				case 'string': $value=(string)$match[2]; break;
				default: throw new \Exception('Unrecognized POST data type ('.$value.')');
			}
		});
	}
}
