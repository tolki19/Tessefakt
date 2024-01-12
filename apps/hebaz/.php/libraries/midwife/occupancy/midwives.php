<?php
namespace tessefakt\apps\hebaz\libraries\midwife\occupancy;
class midwives extends \tessefakt\library{
	public function create(
		int $midwife_occupancy,
		string|null $public_caption=null,
		string|null $public_remark=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$midwife_occupancy,
			midwife:$midwife,
			public_caption:$public_caption,
			public_remark:$public_remark,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark,
		);
	}
	protected function _create(int $midwife_occupancy,string|null $public_caption,string|null $public_remark,string|null $internal_caption,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `midwife-occupancy-midwives`
			set
				`midwife-occupancy`='.$midwife_occupancy.',
				`public-caption`='.(is_null($public_caption)?'null':'"'.$this->connectors->db->escape($public_caption).'"').',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}