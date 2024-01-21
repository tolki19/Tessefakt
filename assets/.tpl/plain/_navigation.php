<?php switch($this->response->op['navigation']['type']){ 
	case 'group': ?> 
		<li>
			<input type="checkbox" id="menu-<?=$this->response->op['iterator']; ?>" <?php if(true){ ?>checked<?php } ?>>
			<label for="menu-<?=$this->response->op['iterator']; ?>">
				<?php $this->_include(compilepath($this->tessefakt->setup['paths']['tpl'].'/plain/_navigations-link.php')); ?>
			</label>
			<nav>
				<menu>
					<?php foreach($this->response->op['navigation']['navigation'] as $iNav=>$aNav){ ?>
						<?php $this->_include(compilepath($this->tessefakt->setup['paths']['tpl'].'/plain/_navigation.php'),['navigation'=>$aNav,'iterator'=>$this->response->op['iterator'].'-'.$iNav]); ?>
					<?php } ?>
				</menu>
			</nav>
		</li>
		<?php break; ?> 
	<?php case 'link': ?> 
	<?php case 'action': ?> 
		<li>
			<div>
				<?php $this->_include(compilepath($this->tessefakt->setup['paths']['tpl'].'/plain/_navigations-link.php')); ?>
			</div>
		</li>
		<?php break; ?> 
	<?php case 'sep': ?> 
		<li>
			<hr>
		</li>
		<?php break; ?> 
	<?php default: var_dump($this->response->op['navigation']); break; ?> 
<?php } ?> 
