<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index()
	{
		$search = $this->input->post('searchkey',True);
		if ( isset($search) ) {
			redirect('https://www.google.com/search?q='.$search);
		}
		$data['address'] = $this->home_model->getall();
		$data['title'] = 'Admin Dashboard';
		$data['result'] = $this->home_model->getjson();
		$this->load->view('templates/headerhome', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('home/index', $data);
		$this->load->view('templates/footerhome');
	}

	public function tambahserver()
	{
		$this->form_validation->set_rules('address', 'Address Server', 'required');
		$this->form_validation->set_rules('requests', 'HTTP Request', 'required');
		$this->form_validation->set_rules('endpoint', 'Address Endpoint', 'required');
		$this->form_validation->set_rules('secret_key', 'Secret Key', 'required');

		if ( $this->form_validation->run() == False ) {
			echo 'gagal';
		} else {
			$data = [
				'address' => htmlspecialchars($this->input->post('address', True)),
				'requests' => htmlspecialchars($this->input->post('requests', True)),
				'endpoint' => htmlspecialchars($this->input->post('endpoint', True)),
				'secret_key' => htmlspecialchars($this->input->post('secret_key', True))
			];

			$this->db->insert('address', $data);
			redirect(base_url('refresh'));
		}

	}
}
