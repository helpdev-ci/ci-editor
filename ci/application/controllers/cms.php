<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url', 'file');
	}

	public function index()
	{
		$this->editor_form();
	}

	public function editor_form()
	{
		
		$data['editor'] = array(
			'content' => ''
			);
		$this->load->view('header', $data);
		$this->load->view('editor', $data);
		$this->load->view('footer', $data);
	}

	public function upload()
	{
		$upload_rand = rand(1111, 9999);
		$upload_date= date("Ymd");

		$upload_path = 'uploads/';


		if (!is_dir($upload_path)) {
			mkdir(FCPATH.$upload_path, 0777, TRUE);
		}

		$upload_path = $upload_path.$upload_date."/";
		
		if (!is_dir($upload_path)) {
			mkdir(FCPATH.$upload_path, 0777, TRUE);
		}

		$upload_path = $upload_path.$upload_rand."/";

		if (!is_dir($upload_path)) {
			mkdir(FCPATH.$upload_path, 0777, TRUE);
		}

		$config['upload_path'] = FCPATH.$upload_path;
		$config['allowed_types'] = 'gif|jpg|png';
		/*$config['max_size']    = '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';*/		

		//$config['file_name']  = $_FILES['attach']['name'];

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('attach')){
			$data_return['error'] = 1;
			$data_return['msg'] = $this->upload->display_errors();
		}else{
			$data_upload= $this->upload->data();

			$caption = strtolower(str_replace($data_upload['file_ext'], "", $data_upload['client_name']));
			$image_url = $upload_path.$data_upload['file_name'];

			$data_return['error'] = 0;
			$data_return['msg'] = '!['.$caption.']('. base_url($image_url).')';
			$data_return['img_name'] = $caption;
			$data_return['img_url'] = base_url($image_url);
			
		}

		echo json_encode($data_return);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */