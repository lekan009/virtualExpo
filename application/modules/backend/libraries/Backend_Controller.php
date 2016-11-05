<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Backend_controller extends MX_Controller {


	protected $data = array();

	protected $page_title   = false;    // page title
    protected $page_name 	= false;    // page name
    protected $nav_selected = false;    // navigation menu selected
    protected $breadcrumbs  = false;    // page breadcrumbs

	public function __construct()
	{
		parent::__construct();

		$this->page_title   = '';
		$this->page_name    = '';
        $this->nav_selected = '';
        $this->breadcrumbs  = '';

        $this->load->module('backend/login');

        if (!$this->login->is_logged_in()) {
            $data['login'] = $this->login->is_logged_in();
            redirect('backoffice/login');
        }
	}
}