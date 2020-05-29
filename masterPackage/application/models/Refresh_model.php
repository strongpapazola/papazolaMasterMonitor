<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refresh_model extends ci_model {

	public function getall($table)
	{
		return $this->db->get($table)->result_array();
	}

	public function getrow($table, $id)
	{
		return $this->db->get($table, ['id' => $id])->row_array();
	}

	public function addrow($server, $table, $data)
	{
		$this->db->insert($table, $data);
	}

}