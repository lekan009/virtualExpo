<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_controller
{
	function __construct()
	{
		parent::__construct();
	}

	// Load dashboard
	public function index()
	{
		// Load view
		$data['page_title'] = 'Virtual Exposition - Home';
		$this->load->view('frontend/home', $data);
	}
}