<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta name="Language" content="DE">
		<meta http-equiv="Content-Language" content="de">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<link rel="apple-touch-icon" sizes="180x180" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/layout/apple-touch-icon.png'); ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/layout/favicon-32x32.png'); ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/layout/favicon-16x16.png'); ?>">
		<link rel="manifest" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/layout/site.webmanifest'); ?>">
		<link rel="mask-icon" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/layout/safari-pinned-tab.svg'); ?>" color="#5bbad5">
		<link rel="shortcut icon" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/layout/favicon.ico'); ?>">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="msapplication-config" content="<?=compileurl($this->env->operations['urls']['folder'].'/assets/layout/browserconfig.xml'); ?>">
		<meta name="theme-color" content="#ffffff">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<link rel="stylesheet" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/css/fonts/inter.css'); ?>" type="text/css">
		<link rel="stylesheet" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/css/fonts/jetbrains-mono.css'); ?>" type="text/css">
		<link rel="stylesheet" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/css/fonts/mso.css'); ?>" type="text/css">
		<link rel="stylesheet" href="<?=compileurl($this->env->operations['urls']['folder'].'/assets/css/desktop/standard.css'); ?>" type="text/css">
	</head>
	<body>
		<header>
			<menu data-tessefakt-role="apps-menu">
				<nav>
					<?php foreach($this->tessefakt->setup['apps'] as $sApp=>$aApp){ ?>
						<li>
							<a href="<?=compileurl($this->env->operations['urls']['target'].'?app='.$sApp); ?>">
								<span><?=htmlentities($aApp['app']['name'],\ENT_QUOTES); ?></span>
							</a>
						</li>
					<?php } ?>
				</nav>
			</menu>
		</header>
		<main>
			<?php if(isset($this->env->operations['tpls']['dialog'])){ ?>
				<?php include($this->env->operations['tpls']['dialog']); ?>
			<?php }elseif(isset($this->env->operations['tpls']['page'])){ ?>
				<?php include($this->env->operations['tpls']['page']); ?>
			<?php } ?>
		</main>
	</body>
</html>