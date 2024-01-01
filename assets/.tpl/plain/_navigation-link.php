<?php if(isset($this->response->op['navigation']['address'])){ ?> 
	<a href="<?php
		$aAddress=[];
		if(isset($this->response->op['navigation']['address']['app'])){
			$aAddress[]='app='.$this->response->op['navigation']['address']['app'];
			if(isset($this->response->op['navigation']['address']['controller'])){
				$aAddress[]='controller='.$this->response->op['navigation']['address']['controller'];
				if(isset($this->response->op['navigation']['address']['method'])){
					$aAddress[]='controller='.$this->response->op['navigation']['address']['method'];
				}
			}
		}
		echo compileurl($this->response->op['urls']['target'].(count($aAddress)?'?'.implode('&',$aAddress):''));
	?>">
		<span><?=htmlentities($this->response->op['navigation']['caption'],\ENT_QUOTES); ?></span>
	</a>
<?php }else{ ?> 
	<span><?=htmlentities($this->response->op['navigation']['caption'],\ENT_QUOTES); ?></span>
<?php } ?> 