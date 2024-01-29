<?php
namespace tessefakt\apps\hebaz\libraries\install\build;
class data extends \tessefakt\library{
	public function prime():array{
		return $this->_prime();
	}
	protected function _prime():array{
		$aReturn=[];
		return $aReturn;
	}
	public function migrate():array{
		return $this->_migrate();
	}
	protected function _migrate():array{
		$aReturn=[];
var_dump($this->connectors->migrate->query('select * from users'));
// var_dump($this->connectors->migrate->query('select * from languages'));
// var_dump($this->connectors->migrate->query('select * from regions'));
// var_dump($this->connectors->migrate->query('select * from services'));
// var_dump($this->connectors->migrate->query('select * from practices'));
// var_dump($this->connectors->migrate->query('select * from midwives'));
// var_dump($this->connectors->migrate->query('select * from midwife_holidays'));
// var_dump($this->connectors->migrate->query('select * from midwife_languages'));
// var_dump($this->connectors->migrate->query('select * from midwife_regions'));
// var_dump($this->connectors->migrate->query('select * from midwife_services'));
// var_dump($this->connectors->migrate->query('select * from midwife_vacancies'));
// var_dump($this->connectors->migrate->query('select * from events'));
// var_dump($this->connectors->migrate->query('select * from pages'));
// var_dump($this->connectors->migrate->query('select * from navigations'));
// var_dump($this->connectors->migrate->query('select * from navigation_pages'));
		return $aReturn;
	}
}
