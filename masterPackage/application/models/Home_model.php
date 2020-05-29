<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_model {
	public function getall()
	{
		return $this->db->get('address')->result_array();
	}

	public function getrow($id)
	{
		return $this->db->get('address', ["id" => $id])->row_array();
	}

	public function getrowname($address)
	{
		return $this->db->get('address', ["address" => $address])->row_array();
	}

	public function getjson()
	{
		$result = json_decode(shell_exec('cat ./data/asuiSSA33vbii78.json'),True);
		return $result;

	}
}