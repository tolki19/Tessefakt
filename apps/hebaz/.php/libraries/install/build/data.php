<?php

namespace tessefakt\apps\hebaz\libraries\install\build;

class data extends \tessefakt\library
{
	public function prime(): array
	{
		return $this->_prime();
	}
	protected function _prime(): array
	{
		$aReturn = [];
		return $aReturn;
	}
	public function migrate(): array
	{
		return $this->_migrate();
	}
	protected function _migrate(): array
	{
		$aReturn = [];
		$aRoles = $this->connectors->migrate->query('select * from roles');
		foreach ($aRoles as $aRole) {
			$aReturn['groups']['keystring'][$aRole['keystring']] = $this->apps->tessefakt->libraries->groups->create(
				name: $aRole['name']
			);
		}
		var_dump($aReturn);
		$aUsers = $this->connectors->migrate->query('select * from users');
		foreach ($aUsers as $aUser) {
			$aReturn['users']['id'][$aUser['id']] = $this->apps->tessefakt->libraries->users->create();
			$this->apps->tessefakt->libraries->users->subs->uids->create(
				user: $aReturn['users']['id'][$aUser['id']],
				uid: $aUser['name'],
				state: (!is_null($aUser['email_authentication']) && !is_null($aUser['sent_password'])) ? 'ok' : null,
				state_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			$this->apps->tessefakt->libraries->users->subs->emails->create(
				user: $aReturn['users']['id'][$aUser['id']],
				email: $aUser['name'],
				sort: 0,
				state: (!is_null($aUser['email_authentication']) && !is_null($aUser['sent_password'])) ? 'ok' : null,
				state_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			$this->apps->tessefakt->libraries->users->subs->hashes->create(
				user: $aReturn['users']['id'][$aUser['id']],
				hash: $aUser['password'],
				type: 'sha128',
				state: (!is_null($aUser['email_authentication']) && !is_null($aUser['sent_password'])) ? 'ok' : null,
				state_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			$this->apps->tessefakt->libraries->users->subs->groups->create(
				user: $aReturn['users']['id'][$aUser['id']],
				group: $aReturn['groups']['keystring']['admin'],
			);
			var_dump($aUser);
		}

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
