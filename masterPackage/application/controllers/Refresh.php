<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refresh extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('refresh_model');
	}

	private function curl_data($requests, $server, $endpoint, $secret_key)
	{
		$data = shell_exec('curl '.$requests.'://'.$server.'/'.$endpoint.'/index.php?key='.$secret_key);
		$data = json_decode($data, True);
		return $data;
	}

	public function index()
	{
		$address = $this->home_model->getall();
		$result = [];

		foreach ($address as $addr) {
			$kosong = [];
			$curlres = $this->curl_data($addr['requests'], $addr['address'], $addr['endpoint'], $addr['secret_key']);
			array_push($kosong, $addr['address']);
			array_push($kosong, $curlres);
			array_push($result, $kosong);
		}

		// echo json_encode($result);
		shell_exec("rm -rf ./data/asuiSSA33vbii78.json");
		shell_exec("echo '".json_encode($result, True)."' > ./data/asuiSSA33vbii78.json");
		// echo shell_exec('pwd');
		redirect(base_url('home'));


	}
}
