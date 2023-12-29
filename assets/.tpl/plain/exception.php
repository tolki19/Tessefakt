<?php foreach($this->response->exception as $aException){ ?> 
	<p>
		<b><?=htmlentities($aException['title'].': ',\ENT_QUOTES); ?> </b>
		<?=htmlentities($aException['message'].': ',\ENT_QUOTES); ?> 
	</p>
	<?php $aArrays=[]; ?> 
	<ol>
		<?php foreach($aException['trace'] as $aTrace){ ?> 
			<li>
				<i><?=htmlentities($aTrace['file'],\ENT_QUOTES); ?>:<?=htmlentities($aTrace['line'],\ENT_QUOTES); ?></i>
				<sub>
					<?=htmlentities($aTrace['class'],\ENT_QUOTES); ?>=&gt;<?=htmlentities($aTrace['function'],\ENT_QUOTES); ?>
					(<?=htmlentities(implode(',',
						array_map(
							function($value)use(&$aArrays){ 
								if(is_object($value)) return '(object) ['.(new ReflectionClass($value))->getName().']'; 
								elseif(is_array($value)){ 
									$aArrays[]=$value;
									return '(array) [#'.count($aArrays).']';
								}elseif(is_string($value)) return'(string) ["'.$value.'"]';
								return '('.gettype($value).') ['.$value.']';
							},
							$aTrace['args']
						)
					),\ENT_QUOTES);	?>)
				</sub>
			</li>
		<?php } ?> 
	</ol>
	<?php if(count($aArrays)){ ?>
		<ol>
			<?php foreach($aArrays as $aArray){ ?>
				<li>
					<?=var_export($aArray); ?>
				</li>
			<?php } ?>
		</ol>
	<?php } ?>
<?php } ?>