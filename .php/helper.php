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
function scandir_r(string $path):array|false{
	if(!($aFiles=scandir($path))) return false;
	$aReturn=[];
	foreach($aFiles as $sFile){
		if($sFile=='.'||$sFile=='..') continue;
		$sPath=$path.'/'.$sFile;
		if(is_file($sPath)) $aReturn[]=$sPath;
		else $aReturn=array_merge($aReturn,call_user_func(__FUNCTION__,$sPath));
	}
	return $aReturn;
}
function compilepath(string $path):string{
	$aParts=array_filter(preg_split('#(?:/|\\\\)#',$path),'strlen');
	$aReturn=[];
	foreach($aParts as $sPart){
		if($sPart=='.') continue;
		elseif($sPart=='..'&&count($aReturn)) array_pop($aReturn);
		else $aReturn[]=$sPart;
	}
	return implode(DIRECTORY_SEPARATOR,$aReturn);
}
function compileurl(string $url):string{
// var_dump($url);
	preg_match(preg_replace('#(?:\t|\r\n|\r|\n)#','',file_get_contents(compilepath(__DIR__.'/compileurl.regex'))),$url,$aParts);
// var_dump(array_filter($aParts,'is_string',ARRAY_FILTER_USE_KEY));
	$sReturn='';
	if(array_key_exists('scheme',$aParts)&&$aParts['scheme']) $sReturn.=$aParts['scheme'].':';
	$sReturn.=$aParts['separator'];
	if(array_key_exists('authority',$aParts)){
		if(array_key_exists('userinfo',$aParts)&&$aParts['userinfo']){
			if(array_key_exists('password',$aParts)&&$aParts['password']) $sReturn.=$aParts['username'].':'.$aParts['password'].'@';
			else $sReturn.=$aParts['username'].'@';
		}
		if(array_key_exists('domain',$aParts)&&$aParts['domain']) $sReturn.=$aParts['domain'].'.';
		if(array_key_exists('sld',$aParts)&&$aParts['sld']) $sReturn.=$aParts['sld'].'.';
		$sReturn.=$aParts['tld'];
		if(array_key_exists('port',$aParts)&&$aParts['port']) $sReturn.=':'.$aParts['port'];
	}
	if(array_key_exists('path',$aParts)&&$aParts['path']){
		$aDiscoveries=array_filter(preg_split('#(?:/|\\\\)#',$aParts['path']),'strlen');
		$aPaths=[];
		foreach($aDiscoveries as $sDiscovery){
			if($sDiscovery=='.') continue;
			elseif($sDiscovery=='..'&&count($aPaths)) array_pop($aPaths);
			else $aPaths[]=$sDiscovery;
		}
		$sReturn.='/'.implode('/',$aPaths);
	}
	if(array_key_exists('query',$aParts)&&$aParts['query']){
		$aParams=[];
		$aDiscoveries=preg_split('#&#',$aParts['query']);
		foreach($aDiscoveries as $sDiscovery){
			$aTuple=preg_split('#=#',$sDiscovery);
			unset($aParams[$aTuple[0]]);
			$aParams[$aTuple[0]]=$aTuple[1]??null;
		}
		$sReturn.='?'.implode('&',array_map(function($key,$value){ return $key.'='.$value; },array_keys($aParams),$aParams));
	}
	if(array_key_exists('fragment',$aParts)&&$aParts['fragment']) $sReturn.='#'.$aParts['fragment'];
	return $sReturn;
}
function array_recombine(array $array,callable $callable):array{
	$aReturn=[];
	foreach($array as $mKey=>$mValue) $aReturn[]=$callable($mKey,$mValue);
	return $aReturn;
}