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

	// Codeigniter Upload Multiple File
	public function multifile($filedata){ // $_FILES['files'];
		if(count($filedata) == 0) return;

		$files = array();
		$all_files = $filedata['name'];
		$i = 0;

		foreach ($all_files as $filename) {
			$files[++$i]['name'] = $filename;
			$files[$i]['type'] = current($filedata['type']);
			next($filedata['type']);
			$files[$i]['tmp_name'] = current($filedata['tmp_name']);
			next($filedata['tmp_name']);
			$files[$i]['error'] = current($filedata['error']);
			next($filedata['error']);
			$files[$i]['size'] = current($filedata['size']);
			next($filedata['size']);
		}

		return $files;
	}

	public function upload()
	{
		$upload_rand = rand(1111, 9999);
		$upload_date= date("Ymd");

		$upload_path = 'uploads/';

		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0777, TRUE);
		}

		$upload_path = $upload_path.$upload_date."/";
		
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0777, TRUE);
		}

		$upload_path = $upload_path.$upload_rand."/";

		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0777, TRUE);
		}

		$config['upload_path'] = $upload_path;
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
			$image_url = 'ci-editor/'.$upload_path.$data_upload['file_name'];

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