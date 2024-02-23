<?php

namespace tessefakt;

class hash
{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_aSetup;
	const DEFAULT = 0;
	const UNPEPPERED = 1;
	public function __construct(
		\tessefakt $tessefakt,
		\tessefakt\app $app,
		array $setup,
	) {
		$this->_oTessefakt = $tessefakt;
		$this->_oApp = $app;
		$this->_aSetup = $setup;
	}
	public function create(
		string $string,
		string $algo = 'bcrypt',
		int $flags = 0,
	): string {
		if ($flags & self::UNPEPPERED) $sString = $string;
		else $sString = $this->_pepper($string);
		if ($algo == 'bcrypt') {
			return password_hash($sString, \PASSWORD_DEFAULT);
		}
		return hash($algo, $sString);
	}
	public function verify(
		string $string,
		string $hash,
		string $algo = 'bcrypt',
		int $flags = 0,
	): bool {
		if ($flags & self::UNPEPPERED) $sString = $string;
		else $sString = $this->_pepper($string);
		if ($algo == 'bcrypt') {
			return password_verify($sString, $hash);
		}
		return hash_equals($hash, hash($algo, $sString));
	}
	protected function _pepper(
		string $string,
		string $algo = 'sha256',
	): string {
		return hash_hmac($algo, $string, $this->_aSetup['pepper']);
	}
}
