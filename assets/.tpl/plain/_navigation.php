<?php switch($this->response->op['navigation']['type']){ 
	case 'group': ?> 
		<li>
			<input type="checkbox" id="chk-<?=$this->response->op['iterator']; ?>">
			<label for="chk-<?=$this->response->op['iterator']; ?>">
				<?php $this->_include(compilepath($this->tessefakt->setup['paths']['tpl'].'/plain/_navigation-link.php')); ?>
			</label>
			<nav>
				<?php foreach($this->response->op['navigation']['navigation'] as $iNav=>$aNav){ ?>
					<?php $this->_include(compilepath($this->tessefakt->setup['paths']['tpl'].'/plain/_navigation.php'),['navigation'=>$aNav,'iterator'=>$this->response->op['iterator'].'-'.$iNav]); ?>
				<?php } ?>
			</nav>
		</li>
		<?php break; ?> 
	<?php case 'link': ?> 
	<?php case 'action': ?> 
		<li>
			<?php $this->_include(compilepath($this->tessefakt->setup['paths']['tpl'].'/plain/_navigation-link.php')); ?>
		</li>
		<?php break; ?> 
	<?php case 'sep': ?> 
		<li>
			<hr>
		</li>
		<?php break; ?> 
	<?php default: ?> 
<?php var_dump($this->response->op['navigation']); ?> 
		<?php break; ?> 
<?php } ?> 
