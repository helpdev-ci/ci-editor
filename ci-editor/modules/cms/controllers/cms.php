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
		$upload_rand = rand(1111, 9999);
		$upload_date= date("YmdHi");

		$create_ref = $upload_date."/".$upload_rand;

		$data['editor'] = array(
			'create_ref' => $create_ref,
			'content' => ''
			);
		$this->load->view('header', $data);
		$this->load->view('editor', $data);
		$this->load->view('footer', $data);
	}

	private function rand_string($length, $chars) {
		return substr(str_shuffle($chars), 0, $length);
	}

	public function upload()
	{
		$upload_rand = $this->rand_string(2, '123456789').$this->rand_string(2, 'ABCDEFGHIJKLMNOP').$this->rand_string(5, '123456789');
		$upload_date= date("YmdH");

		/*$create_ref = $this->input->post('create_ref');

		if (!$create_ref || empty($create_ref)) {

			$data_return['error'] = 1;
			$data_return['msg'] = 'Missing reference';
			echo json_encode($data_return);
			return false;
		}

		$explode_path = explode("/", $create_ref);*/

		$upload_path = 'uploads/';


		if (!is_dir($upload_path)) {
			if (!mkdir(FCPATH.$upload_path, 0777, TRUE)) {
				$data_return['error'] = 1;
				$data_return['msg'] = "Create '".$upload_path ."' is failed.";
				echo json_encode($data_return);
				return false;
			}
		}

		$upload_path = $upload_path.$upload_date."/";
		
		if (!is_dir($upload_path)) {
			if (!mkdir(FCPATH.$upload_path, 0777, TRUE)) {
				$data_return['error'] = 1;
				$data_return['msg'] = "Create '".$upload_path ."' is failed.";
				echo json_encode($data_return);
				return false;				
			}
		}

		/*$upload_path = $upload_path.$explode_path[1]."/";

		if (!is_dir($upload_path)) {
			if (!mkdir(FCPATH.$upload_path, 0777, TRUE)) {
				$data_return['error'] = 1;
				$data_return['msg'] = "Create '".$upload_path ."' is failed.";
				echo json_encode($data_return);
				return false;				
			}
		}*/

		$config['upload_path'] = FCPATH.$upload_path;
		$config['allowed_types'] = 'gif|jpg|png';
		/*$config['max_size']    = '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';*/		

		$config['file_name']  = $upload_rand;

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

	public function json_upload($config, $path = 'uploads/', $file) 
	{
		### Disable
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */