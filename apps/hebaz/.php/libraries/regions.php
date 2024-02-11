<?php

namespace tessefakt\apps\hebaz\libraries;

class regions extends \tessefakt\library
{
	public function create(
		int $sort,
		string $name,
		int|null $region = null,
		string|null $keywords = null,
		string|null $public_caption = null,
		string|null $public_remark = null,
		string|null $internal_caption = null,
		string|null $internal_remark = null
	): int {
		return $this->_create(
			region: $region,
			sort: $sort,
			name: $name,
			keywords: $keywords,
			public_caption: $public_caption,
			public_remark: $public_remark,
			internal_caption: $internal_caption,
			internal_remark: $internal_remark,
		);
	}
	protected function _create(
		int $sort,
		string $name,
		int|null $region,
		string|null $keywords,
		string|null $public_caption,
		string|null $public_remark,
		string|null $internal_caption,
		string|null $internal_remark
	): int {
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=least(greatest(' . $sort . ',0),ifnull(count(*),0))
			from `regions`
		');
		$this->connectors->db->query('
			insert into `regions`
			set
				`region`=' . ($region ?? 'null') . ',
				`sort`=@sort,
				`name`="' . $this->connectors->db->escape($name) . '",
				`keywords`=' . (is_null($keywords) ? 'null' : '"' . $this->connectors->db->escape($keywords) . '"') . ',
				`public-caption`=' . (is_null($public_caption) ? 'null' : '"' . $this->connectors->db->escape($public_caption) . '"') . ',
				`public-remark`=' . (is_null($public_remark) ? 'null' : '"' . $this->connectors->db->escape($public_remark) . '"') . ',
				`internal-caption`=' . (is_null($internal_caption) ? 'null' : '"' . $this->connectors->db->escape($internal_caption) . '"') . ',
				`internal-remark`=' . (is_null($internal_remark) ? 'null' : '"' . $this->connectors->db->escape($internal_remark) . '"') . '
		');
		$iId = $this->connectors->db->insert();
		$this->connectors->db->query('
			update `regions`
			set `sort`=`sort`+1
			where `sort`>=@sort and `id`!=' . $iId . '
		');
		$this->connectors->db->commit();
		return $iId;
	}
	public function read(
		array|null $columns = null,
		array|null $where = null,
		array|null $order = null,
		array|null $limit = null,
	): array {
		return $this->_read(
			columns: $columns,
			where: $where,
			order: $order,
			limit: $limit,
		);
	}
	protected function _read(
		array|null $columns,
		array|null $where,
		array|null $order,
		array|null $limit,
	): array {
		return $this->connectors->db->query('
			select ' . (is_null($columns) || !count($columns) ? '*' : '`' . implode('`,`', $columns) . '`') . '
			from `regions`
			where ' . (is_null($where) || !count($where) ? '1' : implode(' and ', array_recombine($where, function ($key, $value) {
			return '`' . $key . '`=' . (is_null($value) ? 'null' : '"' . $this->connectors->db->escape($value) . '"');
		}))) . '
			' . (is_null($order) || !count($order) ? '' : 'order by ' . implode(',', $order)) . '
			' . (is_null($limit) || !count($limit) ? '' : implode(' ', array_filter([(isset($limit['offset']) ? 'offset ' . $limit['offset'] : ''), (isset($limit['fetch']) ? ' fetch ' . $limit['fetch'] : '')], 'strlen'))) . '
		');
	}
	public function update(
		int $id,
		int $sort,
		string $name,
		int|null $region = null,
		string|null $keywords = null,
		string|null $public_caption = null,
		string|null $public_remark = null,
		string|null $internal_caption = null,
		string|null $internal_remark = null
	): int {
		return $this->_update(
			id: $id,
			region: $region,
			sort: $sort,
			name: $name,
			keywords: $keywords,
			public_caption: $public_caption,
			public_remark: $public_remark,
			internal_caption: $internal_caption,
			internal_remark: $internal_remark,
		);
	}
	protected function _update(
		int $id,
		int $sort,
		string $name,
		int|null $region,
		string|null $keywords,
		string|null $public_caption,
		string|null $public_remark,
		string|null $internal_caption,
		string|null $internal_remark
	): int {
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=`sort`
			from `regions`
			where `id`=' . $id . '
		');
		$this->connectors->db->query('
			update `regions`
			set `sort`=`sort`-1
			where `sort`>@sort
		');
		$this->connectors->db->query('
			select @sort:=least(greatest(' . $sort . ',0),ifnull(count(*),0))
			from `regions`
			where `id`!=' . $id . '
		');
		$this->connectors->db->query('
			update `regions`
			set
				`region`=' . ($region ?? 'null') . ',
				`sort`=@sort,
				`name`="' . $this->connectors->db->escape($name) . '",
				`keywords`=' . (is_null($keywords) ? 'null' : '"' . $this->connectors->db->escape($keywords) . '"') . ',
				`public-caption`=' . (is_null($public_caption) ? 'null' : '"' . $this->connectors->db->escape($public_caption) . '"') . ',
				`public-remark`=' . (is_null($public_remark) ? 'null' : '"' . $this->connectors->db->escape($public_remark) . '"') . ',
				`internal-caption`=' . (is_null($internal_caption) ? 'null' : '"' . $this->connectors->db->escape($internal_caption) . '"') . ',
				`internal-remark`=' . (is_null($internal_remark) ? 'null' : '"' . $this->connectors->db->escape($internal_remark) . '"') . '
			where `id`=' . $id . '
		');
		$this->connectors->db->query('
			update `regions`
			set `sort`=`sort`+1
			where `sort`>=@sort and `id`!=' . $id . '
		');
		$this->connectors->db->commit();
		return $id;
	}
	public function delete(
		int $id,
	): int {
		return $this->_delete(
			id: $id,
		);
	}
	protected function _delete(
		int $id,
	): int {
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=`sort`
			from `regions`
			where `id`=' . $id . '
		');
		$this->connectors->db->query('
			update `regions`
			set `sort`=`sort`-1
			where `sort`>@sort
		');
		$this->connectors->db->query('
			delete from `regions`
			where `id`=' . $id . '
		');
		$this->connectors->db->commit();
		return $id;
	}
}
