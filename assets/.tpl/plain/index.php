<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta name="Language" content="DE">
		<meta http-equiv="Content-Language" content="de">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<link rel="apple-touch-icon" sizes="180x180" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/layout/apple-touch-icon.png'); ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/layout/favicon-32x32.png'); ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/layout/favicon-16x16.png'); ?>">
		<link rel="manifest" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/layout/site.webmanifest'); ?>">
		<link rel="mask-icon" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/layout/safari-pinned-tab.svg'); ?>" color="#5bbad5">
		<link rel="shortcut icon" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/layout/favicon.ico'); ?>">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="msapplication-config" content="<?=compileurl($this->env->operations['urls']['current'].'/assets/layout/browserconfig.xml'); ?>">
		<meta name="theme-color" content="#ffffff">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<link rel="stylesheet" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/css/fonts/inter.css'); ?>" type="text/css">
		<link rel="stylesheet" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/css/fonts/jetbrains-mono.css'); ?>" type="text/css">
		<link rel="stylesheet" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/css/fonts/mso.css'); ?>" type="text/css">
		<link rel="stylesheet" href="<?=compileurl($this->env->operations['urls']['current'].'/assets/css/desktop/standard.css'); ?>" type="text/css">
	</head>
	<body>
		<?php if(isset($this->env->operations['tpls']['page'])) include($this->env->operations['tpls']['page']); ?>
	</body>
</html>