<?php
function array_merge_deep(array ...$as):array{
	$r=[];
	$f=function($a,&$r)use(&$f){
		foreach($a as $k=>$v){
			if(is_int($k)) $r[]=$v;
			elseif(isset($r[$k])&&is_array($v)) $f($v,$r[$k]);
			else $r[$k]=$v;
		}
	};
	foreach($as as $v) $f($v,$r);
	return $r;
}
function compilepath(string $path):string{
	$aParts=array_filter(preg_split('#(?:/|\\\\)#',$path),'strlen');
	$aReturn=[];
	foreach($aParts as $sPart){
		if($sPart=='.') continue;
		elseif($sPart=='..') array_pop($aReturn);
		else $aReturn[]=$sPart;
	}
	return implode(DIRECTORY_SEPARATOR,$aReturn);
}