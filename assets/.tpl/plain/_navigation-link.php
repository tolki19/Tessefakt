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
		<?php if(isset($this->response->op['navigation']['icon'])){ ?> 
			<?php switch($this->response->op['navigation']['icon']['type']){
				case 'mso': ?> 
					<i class="mso"><?=$this->response->op['navigation']['icon']['caption']; ?></i>
					<?php break; ?>
				<?php default: ?>
					<?php break; ?>
			<?php } ?>
		<?php } ?> 
		<span><?=htmlentities($this->response->op['navigation']['caption'],\ENT_QUOTES); ?></span>
	</a>
<?php }else{ ?> 
	<span>
		<?php if(isset($this->response->op['navigation']['icon'])){ ?> 
			<?php switch($this->response->op['navigation']['icon']['type']){
				case 'mso': ?> 
					<i class="mso"><?=$this->response->op['navigation']['icon']['caption']; ?></i>
					<?php break; ?>
				<?php default: ?>
					<?php break; ?>
			<?php } ?>
		<?php } ?> 
		<span><?=htmlentities($this->response->op['navigation']['caption'],\ENT_QUOTES); ?></span>
	</span>
<?php } ?> 