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