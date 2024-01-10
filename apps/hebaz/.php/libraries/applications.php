<?php
namespace tessefakt\apps\hebaz\libraries;
class applications extends \tessefakt\library{
	public function create(array $data):int{
		return $this->_create(
			$data['first_name'],
			$data['last_name'],
			$data['birthdate'],
			$data['deliverydate']??null,
			$data['remark']??null,
			$data['agreement-gtoc'],
			$data['agreement-gdpr'],
			$data['agreement-email']??null,
			$data['withdrawal-gtoc']??null,
			$data['withdrawal-gdpr']??null,
			$data['withdrawal-email']??null,
			$data['public-remark']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(string $first_name,string $last_name,int|string $birthdate,int|string|null $deliverydate,string|null $remark,int|string $agreement_gtoc,int|string $agreement_gdpr,int|string|null $agreement_email,int|string|null $withdrawal_gtoc,int|string|null $withdrawal_gdpr,int|string|null $withdrawal_email,string|null $public_remark,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `applications`
			set
				`first_name`="'.$this->connectors->db->escape($first_name).'",
				`last_name`="'.$this->connectors->db->escape($last_name).'",
				`birthdate`='.(is_int($deliverydate)?'"'.date('Y-m-d H:i:s',$deliverydate).'"':'"'.$this->connectors->db->escape($deliverydate).'"').',
				`deliverydate`='.(is_null($deliverydate)?'null':(is_int($deliverydate)?'"'.date('Y-m-d H:i:s',$deliverydate).'"':'"'.$this->connectors->db->escape($deliverydate).'"')).',
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').',
				`agreement-gtoc`='.(is_int($agreement_gtoc)?'"'.date('Y-m-d H:i:s',$agreement_gtoc).'"':'"'.$this->connectors->db->escape($agreement_gtoc).'"').',
				`agreement-gdpr`='.(is_int($agreement_gdpr)?'"'.date('Y-m-d H:i:s',$agreement_gdpr).'"':'"'.$this->connectors->db->escape($agreement_gdpr).'"').',
				`agreement-email`='.(is_null($agreement_email)?'null':(is_int($agreement_email)?'"'.date('Y-m-d H:i:s',$agreement_email).'"':'"'.$this->connectors->db->escape($agreement_email).'"')).',
				`withdawal-gtoc`='.(is_null($withdawal_gtoc)?'null':(is_int($withdawal_gtoc)?'"'.date('Y-m-d H:i:s',$withdawal_gtoc).'"':'"'.$this->connectors->db->escape($withdawal_gtoc).'"')).',
				`withdawal-gdpr`='.(is_null($withdawal_gdpr)?'null':(is_int($withdawal_gdpr)?'"'.date('Y-m-d H:i:s',$withdawal_gdpr).'"':'"'.$this->connectors->db->escape($withdawal_gdpr).'"')).',
				`withdawal-email`='.(is_null($withdawal_email)?'null':(is_int($withdawal_email)?'"'.date('Y-m-d H:i:s',$withdawal_email).'"':'"'.$this->connectors->db->escape($withdawal_email).'"')).',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}