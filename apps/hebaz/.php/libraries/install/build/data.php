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
		$aCds = [
			[
				'keystring' => 'www',
				'name' => 'Internet',
			],
			[
				'keystring' => 'email',
				'name' => 'E-Mail',
			],
			[
				'keystring' => 'mobile',
				'name' => 'Mobil',
			],
			[
				'keystring' => 'phone',
				'name' => 'Festnetz',
			],
			[
				'keystring' => 'town',
				'name' => 'Ort',
			],
			[
				'keystring' => 'postcode',
				'name' => 'PLZ',
			],
			[
				'keystring' => 'road',
				'name' => 'Straße',
			],
		];
		foreach ($aCds as $aCd) {
			$aReturn['cds']['keystring'][$aCd['keystring']] = $this->apps->hebaz->libraries->cds->create(
				sort: 0,
				name: $aCd['name'],
				keystring: $aCd['keystring'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aRoles = $this->connectors->migrate->query('select * from roles');
		foreach ($aRoles as $aRole) {
			$aReturn['groups']['keystring'][$aRole['keystring']] = $this->apps->tessefakt->libraries->groups->create(
				name: $aRole['name'],
				keystring: $aRole['keystring'],
			);
		}
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
				email: $aUser['email'],
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
		}
		$aServices = $this->connectors->migrate->query('select * from services');
		foreach ($aServices as $aService) {
			$aReturn['services']['id'][$aService['id']] = $this->apps->hebaz->libraries->services->create(
				sort: 0,
				name: $aService['name'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aRegions = $this->connectors->migrate->query('select * from regions');
		foreach ($aRegions as $aRegion) {
			$aReturn['regions']['id'][$aRegion['id']] = $this->apps->hebaz->libraries->regions->create(
				sort: 0,
				name: $aRegion['name'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aLanguages = $this->connectors->migrate->query('select * from languages');
		foreach ($aLanguages as $aLanguage) {
			$aReturn['languages']['id'][$aLanguage['id']] = $this->apps->hebaz->libraries->languages->create(
				sort: 0,
				name: $aLanguage['name'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aPages = $this->connectors->migrate->query('select * from pages');
		foreach ($aPages as $aPage) {
			$aReturn['pages']['id'][$aPage['id']] = $this->apps->hebaz->libraries->pages->create(
				title: $aPage['name'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			$this->apps->hebaz->libraries->pages->subs->contents->create(
				page: $aReturn['pages']['id'][$aPage['id']],
				sort: 0,
				content: $aPage['content'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aNavigations = $this->connectors->migrate->query('select * from navigations');
		foreach ($aNavigations as $aNavigation) {
			$aReturn['navigations']['id'][$aNavigation['id']] = $this->apps->hebaz->libraries->navigations->create(
				keystring: $aNavigation['keystring'],
				internal_caption: $aNavigation['name'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aNavigationsPages = $this->connectors->migrate->query('select * from navigation_page');
		foreach ($aNavigationsPages as $aNavigationsPage) {
			$aReturn['navigation_page']['id'][$aNavigationsPage['id']] = $this->apps->hebaz->libraries->navigations->subs->pages->create(
				navigation: $aReturn['navigations']['id'][$aNavigationsPage['navigation']],
				sort: $aNavigationsPage['sort'],
				type: $aNavigationsPage['type'],
				page: $aReturn['pages']['id'][$aNavigationsPage['page']],
				auto_speaking_url: $aNavigationsPage['auto_speaking_url'],
				speaking_url: $aNavigationsPage['speaking_url'],
				auto_home: $aNavigationsPage['auto_home'],
				public_caption: $aNavigationsPage['caption'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aMidwives = $this->connectors->migrate->query('select * from midwives');
		foreach ($aMidwives as $aMidwife) {
			$aNames = explode(' ', $aMidwife['name']);
			$aReturn['midwives']['id'][$aMidwife['id']] = $this->apps->hebaz->libraries->midwives->create(
				first_name: count($aNames) > 1 ? $aNames[0] : '',
				last_name: implode(' ', count($aNames) > 1 ? array_slice($aNames, 1) : $aNames),
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			if ($aMidwife['www']) {
				$aReturn['midwives_cds']['id']['www'] = $this->apps->hebaz->libraries->midwives->subs->cds->create(
					midwife: $aReturn['midwives']['id'][$aMidwife['id']],
					cd: $aReturn['cds']['keystring']['www'],
					sort: 0,
					date: $aMidwife['www'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->midwives->subs->cds->subs->states->create(
					midwife_cd: $aReturn['midwives_cds']['id']['www'],
					state: $aMidwife['www_public'] ? 'public' : 'secret',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aMidwife['email']) {
				$aReturn['midwives_cds']['id']['email'] = $this->apps->hebaz->libraries->midwives->subs->cds->create(
					midwife: $aReturn['midwives']['id'][$aMidwife['id']],
					cd: $aReturn['cds']['keystring']['email'],
					sort: 0,
					date: $aMidwife['email'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->midwives->subs->cds->subs->states->create(
					midwife_cd: $aReturn['midwives_cds']['id']['email'],
					state: $aMidwife['email_public'] ? 'public' : 'secret',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aMidwife['mobile']) {
				$aReturn['midwives_cds']['id']['mobile'] = $this->apps->hebaz->libraries->midwives->subs->cds->create(
					midwife: $aReturn['midwives']['id'][$aMidwife['id']],
					cd: $aReturn['cds']['keystring']['mobile'],
					sort: 0,
					date: $aMidwife['mobile'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->midwives->subs->cds->subs->states->create(
					midwife_cd: $aReturn['midwives_cds']['id']['mobile'],
					state: $aMidwife['mobile_public'] ? 'public' : 'secret',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aMidwife['phone']) {
				$aReturn['midwives_cds']['id']['phone'] = $this->apps->hebaz->libraries->midwives->subs->cds->create(
					midwife: $aReturn['midwives']['id'][$aMidwife['id']],
					cd: $aReturn['cds']['keystring']['phone'],
					sort: 0,
					date: $aMidwife['phone'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->midwives->subs->cds->subs->states->create(
					midwife_cd: $aReturn['midwives_cds']['id']['phone'],
					state: $aMidwife['phone_public'] ? 'public' : 'secret',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aMidwife['ziparea']) {
				$aReturn['midwives_cds']['id']['town'] = $this->apps->hebaz->libraries->midwives->subs->cds->create(
					midwife: $aReturn['midwives']['id'][$aMidwife['id']],
					cd: $aReturn['cds']['keystring']['town'],
					sort: 0,
					date: $aMidwife['ziparea'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->midwives->subs->cds->subs->states->create(
					midwife_cd: $aReturn['midwives_cds']['id']['town'],
					state: $aMidwife['address_public'] ? 'public' : 'secret',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aMidwife['zipcode']) {
				$aReturn['midwives_cds']['id']['postcode'] = $this->apps->hebaz->libraries->midwives->subs->cds->create(
					midwife: $aReturn['midwives']['id'][$aMidwife['id']],
					cd: $aReturn['cds']['keystring']['postcode'],
					sort: 0,
					date: $aMidwife['zipcode'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->midwives->subs->cds->subs->states->create(
					midwife_cd: $aReturn['midwives_cds']['id']['postcode'],
					state: $aMidwife['address_public'] ? 'public' : 'secret',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aMidwife['street']) {
				$aReturn['midwives_cds']['id']['street'] = $this->apps->hebaz->libraries->midwives->subs->cds->create(
					midwife: $aReturn['midwives']['id'][$aMidwife['id']],
					cd: $aReturn['cds']['keystring']['road'],
					sort: 0,
					date: $aMidwife['street'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->midwives->subs->cds->subs->states->create(
					midwife_cd: $aReturn['midwives_cds']['id']['street'],
					state: $aMidwife['address_public'] ? 'public' : 'secret',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if (
				!is_null($aMidwife['access_email']) &&
				!is_null($aMidwife['access_password'])
			) {
				$aReturn['midwifeusers']['id'][$aMidwife['id']] = $this->apps->tessefakt->libraries->users->create();
				$this->apps->tessefakt->libraries->users->subs->uids->create(
					user: $aReturn['midwifeusers']['id'][$aMidwife['id']],
					uid: $aMidwife['name'],
					state: 'ok',
					state_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->tessefakt->libraries->users->subs->emails->create(
					user: $aReturn['midwifeusers']['id'][$aMidwife['id']],
					email: $aMidwife['access_email'],
					sort: 0,
					state: 'ok',
					state_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->tessefakt->libraries->users->subs->hashes->create(
					user: $aReturn['midwifeusers']['id'][$aMidwife['id']],
					hash: $aMidwife['access_password'],
					type: 'sha128',
					state: 'ok',
					state_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->tessefakt->libraries->users->subs->groups->create(
					user: $aReturn['midwifeusers']['id'][$aMidwife['id']],
					group: $aReturn['groups']['keystring']['midwife'],
				);
			}
			$this->apps->hebaz->libraries->midwives->subs->states->create(
				midwife: $aReturn['midwives']['id'][$aMidwife['id']],
				state: 'public',
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			$this->apps->hebaz->libraries->midwives->subs->rights->create(
				midwife: $aReturn['midwives']['id'][$aMidwife['id']],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				right_create: 0,
				right_read: 0,
				right_update: 0,
				right_delete: 0,
			);
			$this->apps->hebaz->libraries->midwives->subs->rights->create(
				midwife: $aReturn['midwives']['id'][$aMidwife['id']],
				group: $aReturn['groups']['keystring']['admin'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				right_create: 1,
				right_read: 1,
				right_update: 1,
				right_delete: 1,
			);
			$this->apps->hebaz->libraries->midwives->subs->rights->create(
				midwife: $aReturn['midwives']['id'][$aMidwife['id']],
				group: $aReturn['groups']['keystring']['midwife'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				right_read: 1,
			);
			if ($aReturn['midwifeusers']['id'][$aMidwife['id']] ?? false) {
				$this->apps->hebaz->libraries->midwives->subs->rights->create(
					midwife: $aReturn['midwives']['id'][$aMidwife['id']],
					user: $aReturn['midwifeusers']['id'][$aMidwife['id']],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
					right_create: 1,
					right_read: 1,
					right_update: 1,
					right_delete: 1,
				);
			}
		}
		$aHolidays = $this->connectors->migrate->query('select * from midwife_holidays');
		foreach ($aHolidays as $aHoliday) {
			if (!array_key_exists($aHoliday['midwife'], $aReturn['midwives']['id'])) continue;
			$aReturn['midwive_occupancy']['id'][$aHoliday['id']] = $this->apps->hebaz->libraries->midwives->subs->occupancies->create(
				midwife: $aReturn['midwives']['id'][$aHoliday['midwife']],
				from: $aHoliday['from'],
				till: $aHoliday['till'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			if (!is_null($aHoliday['replacement_midwife'])) {
				$this->apps->hebaz->libraries->midwives->subs->occupancies->subs->midwives->create(
					midwife_occupancy: $aReturn['midwive_occupancy']['id'][$aHoliday['id']],
					midwife: $aHoliday['replacement_midwife'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
		}
		$aLanguages = $this->connectors->migrate->query('select * from midwife_languages');
		foreach ($aLanguages as $aLanguage) {
			if (!array_key_exists($aLanguage['midwife'], $aReturn['midwives']['id'])) continue;
			$this->apps->hebaz->libraries->midwives->subs->languages->create(
				midwife: $aReturn['midwives']['id'][$aLanguage['midwife']],
				language: $aReturn['languages']['id'][$aLanguage['language']],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aRegions = $this->connectors->migrate->query('select * from midwife_regions');
		foreach ($aRegions as $aRegion) {
			if (!array_key_exists($aRegion['midwife'], $aReturn['midwives']['id'])) continue;
			$this->apps->hebaz->libraries->midwives->subs->regions->create(
				midwife: $aReturn['midwives']['id'][$aRegion['midwife']],
				region: $aReturn['regions']['id'][$aRegion['region']],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aServices = $this->connectors->migrate->query('select * from midwife_services');
		foreach ($aServices as $aService) {
			if (!array_key_exists($aService['midwife'], $aReturn['midwives']['id'])) continue;
			$this->apps->hebaz->libraries->midwives->subs->services->create(
				midwife: $aReturn['midwives']['id'][$aService['midwife']],
				service: $aReturn['services']['id'][$aService['service']],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
		}
		$aVacancies = $this->connectors->migrate->query('select distinct `midwife`,`from`,`till` from midwife_vacancies');
		foreach ($aVacancies as $aVacancy) {
			if (!array_key_exists($aVacancy['midwife'], $aReturn['midwives']['id'])) continue;
			$aReturn['midwife_occupancies']['def'][$aVacancy['midwife'] . ',' . $aVacancy['from'] . ',' . $aVacancy['till']] = $this->apps->hebaz->libraries->midwives->subs->vacancies->create(
				midwife: $aReturn['midwives']['id'][$aVacancy['midwife']],
				from: $aVacancy['from'],
				till: $aVacancy['till'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			$aServices = $this->connectors->migrate->query('select distinct service from midwife_vacancies where `midwife`=' . $aVacancy['midwife'] . ' and `from`="' . $aVacancy['from'] . '" and `till`=' . (is_null($aVacancy['till']) ? 'null' : '"' . $aVacancy['till'] . '"') . ' and `service` is not null');
			foreach ($aServices as $aService) {
				$this->apps->hebaz->libraries->midwives->subs->vacancies->subs->services->create(
					midwife_vacancy: $aReturn['midwife_occupancies']['def'][$aVacancy['midwife'] . ',' . $aVacancy['from'] . ',' . $aVacancy['till']],
					service: $aReturn['services']['id'][$aService['service']],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
		}
		$aPractices = $this->connectors->migrate->query('select * from practices');
		foreach ($aPractices as $aPractice) {
			$aReturn['practices']['id'][$aPractice['id']] = $this->apps->hebaz->libraries->practices->create(
				name: $aPractice['name'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			if ($aPractice['www']) {
				$aReturn['practice_cds']['id']['www'] = $this->apps->hebaz->libraries->practices->subs->cds->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					cd: $aReturn['cds']['keystring']['www'],
					sort: 0,
					date: $aPractice['www'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->practices->subs->cds->subs->states->create(
					practice_cd: $aReturn['practice_cds']['id']['www'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aPractice['email']) {
				$aReturn['practices_cds']['id']['email'] = $this->apps->hebaz->libraries->practices->subs->cds->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					cd: $aReturn['cds']['keystring']['email'],
					sort: 0,
					date: $aPractice['email'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->practices->subs->cds->subs->states->create(
					practice_cd: $aReturn['practices_cds']['id']['email'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aPractice['mobile']) {
				$aReturn['practices_cds']['id']['mobile'] = $this->apps->hebaz->libraries->practices->subs->cds->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					cd: $aReturn['cds']['keystring']['mobile'],
					sort: 0,
					date: $aPractice['mobile'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->practices->subs->cds->subs->states->create(
					practice_cd: $aReturn['practices_cds']['id']['mobile'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aPractice['phone']) {
				$aReturn['practices_cds']['id']['phone'] = $this->apps->hebaz->libraries->practices->subs->cds->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					cd: $aReturn['cds']['keystring']['phone'],
					sort: 0,
					date: $aPractice['phone'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->practices->subs->cds->subs->states->create(
					practice_cd: $aReturn['practices_cds']['id']['phone'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aPractice['ziparea']) {
				$aReturn['practices_cds']['id']['town'] = $this->apps->hebaz->libraries->practices->subs->cds->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					cd: $aReturn['cds']['keystring']['town'],
					sort: 0,
					date: $aPractice['ziparea'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->practices->subs->cds->subs->states->create(
					practice_cd: $aReturn['practices_cds']['id']['town'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aPractice['zipcode']) {
				$aReturn['practices_cds']['id']['postcode'] = $this->apps->hebaz->libraries->practices->subs->cds->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					cd: $aReturn['cds']['keystring']['postcode'],
					sort: 0,
					date: $aPractice['zipcode'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->practices->subs->cds->subs->states->create(
					practice_cd: $aReturn['practices_cds']['id']['postcode'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aPractice['street']) {
				$aReturn['practices_cds']['id']['street'] = $this->apps->hebaz->libraries->practices->subs->cds->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					cd: $aReturn['cds']['keystring']['road'],
					sort: 0,
					date: $aPractice['street'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->practices->subs->cds->subs->states->create(
					practice_cd: $aReturn['practices_cds']['id']['street'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			$this->apps->hebaz->libraries->practices->subs->states->create(
				practice: $aReturn['practices']['id'][$aPractice['id']],
				state: 'public',
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			$aMidwives = $this->connectors->migrate->query('select id from midwives where practice=' . $aPractice['id']);
			foreach ($aMidwives as $aMidwife) {
				$this->apps->hebaz->libraries->practices->subs->midwives->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					midwife: $aReturn['midwives']['id'][$aMidwife['id']],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->practices->subs->rights->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
					right_create: 0,
					right_read: 0,
					right_update: 0,
					right_delete: 0,
				);
				$this->apps->hebaz->libraries->practices->subs->rights->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					group: $aReturn['groups']['keystring']['admin'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
					right_create: 1,
					right_read: 1,
					right_update: 1,
					right_delete: 1,
				);
				$this->apps->hebaz->libraries->practices->subs->rights->create(
					practice: $aReturn['practices']['id'][$aPractice['id']],
					group: $aReturn['groups']['keystring']['midwife'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
					right_read: 1,
				);
				if (array_key_exists($aMidwife['id'], $aReturn['midwifeusers']['id'])) {
					$this->apps->hebaz->libraries->practices->subs->rights->create(
						practice: $aReturn['practices']['id'][$aPractice['id']],
						user: $aReturn['midwifeusers']['id'][$aMidwife['id']],
						internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
						right_create: 1,
						right_read: 1,
						right_update: 1,
						right_delete: 1,
					);
				}
			}
		}
		$aEvents = $this->connectors->migrate->query('select * from events');
		foreach ($aEvents as $aEvent) {
			$aReturn['events']['id'][$aEvent['id']] = $this->apps->hebaz->libraries->events->create(
				name: $aEvent['name'],
				from: $aEvent['from'],
				till: $aEvent['till'],
				free_place: $aEvent['free_place'],
				public_caption: $aEvent['name'],
				public_remark: $aEvent['description'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			if ($aEvent['ziparea']) {
				$aReturn['events_cds']['id']['town'] = $this->apps->hebaz->libraries->events->subs->cds->create(
					event: $aReturn['events']['id'][$aEvent['id']],
					cd: $aReturn['cds']['keystring']['town'],
					sort: 0,
					date: $aEvent['ziparea'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->events->subs->cds->subs->states->create(
					event_cd: $aReturn['events_cds']['id']['town'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aEvent['zipcode']) {
				$aReturn['events_cds']['id']['postcode'] = $this->apps->hebaz->libraries->events->subs->cds->create(
					event: $aReturn['events']['id'][$aEvent['id']],
					cd: $aReturn['cds']['keystring']['postcode'],
					sort: 0,
					date: $aEvent['zipcode'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->events->subs->cds->subs->states->create(
					event_cd: $aReturn['events_cds']['id']['postcode'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aEvent['street']) {
				$aReturn['events_cds']['id']['street'] = $this->apps->hebaz->libraries->events->subs->cds->create(
					event: $aReturn['events']['id'][$aEvent['id']],
					cd: $aReturn['cds']['keystring']['road'],
					sort: 0,
					date: $aEvent['street'],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
				$this->apps->hebaz->libraries->events->subs->cds->subs->states->create(
					event_cd: $aReturn['events_cds']['id']['street'],
					state: 'public',
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			$this->apps->hebaz->libraries->events->subs->states->create(
				event: $aReturn['events']['id'][$aEvent['id']],
				state: 'public',
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
			);
			if ($aEvent['service']) {
				$this->apps->hebaz->libraries->events->subs->services->create(
					event: $aReturn['events']['id'][$aEvent['id']],
					service: $aReturn['services']['id'][$aEvent['service']],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			if ($aEvent['midwife']) {
				$this->apps->hebaz->libraries->events->subs->midwives->create(
					event: $aReturn['events']['id'][$aEvent['id']],
					midwife: $aReturn['midwives']['id'][$aEvent['midwife']],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				);
			}
			$this->apps->hebaz->libraries->events->subs->rights->create(
				event: $aReturn['events']['id'][$aEvent['id']],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				right_create: 0,
				right_read: 0,
				right_update: 0,
				right_delete: 0,
			);
			$this->apps->hebaz->libraries->events->subs->rights->create(
				event: $aReturn['events']['id'][$aEvent['id']],
				group: $aReturn['groups']['keystring']['admin'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				right_create: 1,
				right_read: 1,
				right_update: 1,
				right_delete: 1,
			);
			$this->apps->hebaz->libraries->events->subs->rights->create(
				event: $aReturn['events']['id'][$aEvent['id']],
				group: $aReturn['groups']['keystring']['midwife'],
				internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
				right_read: 1,
			);
			if (
				$aEvent['midwife'] &&
				array_key_exists($aEvent['midwife'], $aReturn['midwifeusers']['id'])
			) {
				$this->apps->hebaz->libraries->events->subs->rights->create(
					event: $aReturn['events']['id'][$aEvent['id']],
					user: $aReturn['midwifeusers']['id'][$aEvent['midwife']],
					internal_remark: 'Automatischer Import (' . date('d.m.Y H:i:s') . ')',
					right_create: 1,
					right_read: 1,
					right_update: 1,
					right_delete: 1,
				);
			}
		}
		return $aReturn;
	}
}
