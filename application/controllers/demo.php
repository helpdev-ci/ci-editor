<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->config->load('ci_editor');
		$this->load->helper('url', 'file');
	}

	public function index()
	{
		$this->load->view('demo_form');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */