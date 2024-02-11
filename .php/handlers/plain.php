<?php

namespace tessefakt\handlers;

class plain extends \tessefakt\handler
{
	protected $_oResponse;
	protected $_oEnvironment;
	public function __construct(\tessefakt $tessefakt)
	{
		parent::__construct($tessefakt);
	}
	public function __get(string $key): mixed
	{
		switch ($key) {
			case 'response':
				if (!$this->_oResponse) $this->_oResponse = new \tessefakt\response($this->_oTessefakt, ['success', 'exception', 'recommend', 'data', 'tpl', 'op']);
				return $this->_oResponse;
			case 'env':
				if (!$this->_oEnvironment) $this->_oEnvironment = new \tessefakt\environment($this->_oTessefakt, ['get', 'post', 'server', 'header', 'session']);
				return $this->_oEnvironment;
		}
		return parent::__get($key);
	}
	protected function _handle(): void
	{
		$this->response->op['urls']['folder'] = compileurl($this->tessefakt->setup['urls']['folder']);
		$this->response->op['urls']['target'] = compileurl($this->tessefakt->setup['urls']['target']);
		// $this->apps->tessefakt->libraries->install->test();
		$this->apps->tessefakt->libraries->install->prime();
		$this->apps->hebaz->libraries->install->migrate();
		if (
			isset($this->env->get['app']) &&
			isset($this->env->get['controller']) &&
			isset($this->env->get['method'])
		) {
			if (
				!(
					$this->env->get['app'] == 'tessefakt' &&
					$this->env->get['controller'] == 'system'
				) &&
				!$this->apps->tessefakt->libraries->system->auth()
			) {
				$this->response->data = ['location' => compileurl($this->tessefakt->setup['urls']['target'] . '?app=tessefakt&controller=system&method=login')];
				$this->reply(302);
			}
			$this->apps->{$this->env->get['app']}->entrances->plain->controllers->{$this->env->get['controller']}->{$this->env->get['method']}();
			$this->reply();
		}
		if (isset($this->env->get['app'])) {
			$sApp = $this->env->get['app'];
		} else {
			$sApp = $this->setup['defaults']['app'];
		}
		if (
			isset($this->setup['defaults']['controller']) &&
			isset($this->setup['defaults']['method'])
		) {
			$sController = $this->setup['defaults']['controller'];
			$sMethod = $this->setup['defaults']['method'];
		} else {
			$sController = $this->setup['apps'][$sApp]['defaults']['entrances']['plain']['controller'];
			$sMethod = $this->setup['apps'][$sApp]['defaults']['entrances']['plain']['method'];
		}
		$this->response->data = ['location' => compileurl($this->tessefakt->setup['urls']['target'] . '?app=' . $sApp . '&controller=' . $sController . '&method=' . $sMethod)];
		$this->reply(303);
	}
	protected function _reply(int $status): void
	{
		switch (floor($status / 100) * 100) {
			case 200:
				if (headers_sent()) throw new \Exception('Output from other source');
				http_response_code($status);
				header('Content-Type: text/html');
				$this->_include(compilepath($this->_oTessefakt->setup['paths']['tpl'] . '/plain/index.php'));
				die();
			case 300:
				http_response_code($status);
				header('Location: ' . $this->response->data['location']);
				die();
			default:
				if (headers_sent()) throw new \Exception('Output from other source');
				if (is_null($this->response->success)) $this->response->success = false;
				http_response_code($status);
				header('Content-Type: text/html');
				$this->_include(compilepath($this->_oTessefakt->setup['paths']['tpl'] . '/plain/exception.php'));
				die();
		}
	}
	protected function _include(string $path, array $space = [], bool $return = false): string|bool
	{
		if (!$return) ob_start();
		if ($space) {
			$aFormer = $this->_compact($space);
			$this->_extract($space);
		}
		$bReturn = include $path;
		if ($space) $this->_extract($aFormer);
		if ($return) return ob_get_clean();
		return $bReturn;
	}
	protected function _compact(array $space): array
	{
		$aKeys = array_keys($space);
		$aReturn = [];
		foreach ($aKeys as $mKey) {
			if (!isset($this->response->op[$mKey])) continue;
			$aReturn[$mKey] = $this->response->op[$mKey];
		}
		return $aReturn;
	}
	protected function _extract(array $space): bool
	{
		$aReturn = [];
		foreach ($space as $mKey => $mValue) $this->response->op[$mKey] = $mValue;
		return true;
	}
}
