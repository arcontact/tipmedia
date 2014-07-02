<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public $data;
	public $language;
	public $months = array();
	
	public function __construct() {
		parent::__construct();
		
		$this->language = 1;
		
		/*
		$this->output->set_header('HTTP/1.0 200 OK');
		$this->output->set_header('HTTP/1.1 200 OK');
		$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
		$this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		$this->output->set_header('Pragma: no-cache');
		*/
		
		// kontrast
		if(!$this->session->userdata('kontrast')) {
			$this->session->set_userdata('kontrast', 1);
		}
		if($this->input->get('kontrast') && is_numeric($this->input->get('kontrast')) && $this->input->get('kontrast')>0 && $this->input->get('kontrast')<5) {
			$this->session->set_userdata('kontrast', $this->input->get('kontrast'));
		}
		$this->data['kontrast'] = $this->session->userdata('kontrast');
		
		//czcionka
		if(!$this->session->userdata('czcionka')) {
			$this->session->set_userdata('czcionka', 1);
		}
		if($this->input->get('czcionka') && is_numeric($this->input->get('czcionka')) && $this->input->get('czcionka')>0 && $this->input->get('czcionka')<4) {
			$this->session->set_userdata('czcionka', $this->input->get('czcionka'));
		}
		$this->data['czcionka'] = $this->session->userdata('czcionka');
		
		//strefa
		if(!$this->session->userdata('strefa')) {
			$this->session->set_userdata('strefa', 1);
		}
		$_strefa = new Zone;
		switch($this->uri->segment(1)){
			case "strefa-organizacji":		{ $_strefa->get_by_id(1); break; }
			case "strefa-mieszkanca":		{ $_strefa->get_by_id(2); break; }
			case "strefa-samorzadu":		{ $_strefa->get_by_id(3); break; }
			case "strefa-wolontariatu":		{ $_strefa->get_by_id(4); break; }
			case "strefa-przedsiebiorcy":	{ $_strefa->get_by_id(5); break; }
			default: 						{ $_strefa->get_by_id(1); break; }
		}
		$this->data['strefa'] = $_strefa;
		
		if($this->session->userdata('temporary_password')){
			if($this->router->class != 'account') {
            	redirect('/account/temporary_password/');
			}
		}
		
		$this->data['user_cms_permissions'] = false;
		if($this->logged_in()){
			if($user_id = $this->get_user_id()){
				$user = new User;
				$user->get_by_id($user_id);
				$this->data['logged_user'] = $user;
				if(user_cms_permissions()) {
					$this->data['user_cms_permissions'] = $this->session->userdata('user_cms_permissions');
				}
			}
		}
		
		//$this->init_slider();
		//$this->rotate_banners();
		
		$this->months = array(
			0=>null,
			1=>array("styczeń","stycznia","sty"),
			2=>array("luty","lutego","lut"),
			3=>array("marzec","marca","mar"),
			4=>array("kwiecień","kwietnia","kwi"),
			5=>array("maj","maja","maj"),
			6=>array("czerwiec","czerwca","cze"),
			7=>array("lipiec","lipca","lip"),
			8=>array("sierpień","sierpnia","sie"),
			9=>array("wrzesień","września","wrz"),
			10=>array("październik","października","paź"),
			11=>array("listopad","listopada","lis"),
			12=>array("grudzień","grudnia","gru")
		);
		
		$this->images_sizes = array(
			's1'	=> array('width' => 200, 'height' => 104),
			's2'	=> array('width' => 300, 'height' => 300),
			's3'	=> array('width' => 653, 'height' => 356),
			's4'	=> array('width' => 980)
		);
		
		$this->session->set_flashdata('flash_post', $this->input->post());
	}
	
	/*
	public function init_slider()
	{
		$slider = new Slider();
		$slider->where_related('slider_translation', 'language_id', $this->default_lang->id);
		$slider->get_by_active(1);
		$this->template->set('slider', $slider);
	}
	*/
	
	/*
	public function rotate_banners()
	{
		$banner = new Banner();
		$banner->where('active', 1);
		$banner->limit(1);
		$banner->get();
		$banner_dimensions = @getimagesize(FCPATH.'assets/banners/'.$banner->filename);
		$this->template->set('banner', $banner);
		$this->template->set('banner_dimensions', $banner_dimensions);
	}
	*/
	
	public function make_upload($field, $config, $multi=FALSE)
	{
		$this->load->library('upload');			
		$this->upload->initialize($config);
		
		if($multi) {
			$upload = $this->upload->do_multi_upload($field);
			
			if($upload) {
				return $upload;
			} else {
				return strip_tags($this->upload->display_errors());
			}
		} else {
			$upload = $this->upload->do_upload($field);
			
			if($upload) {
				return $this->upload->data();
			} else {
				return strip_tags($this->upload->display_errors());
			}
		}
	}
	
	public function logged_in()
	{
		return (bool) $this->session->userdata('identity');
	}
	
	public function get_user_id()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id)) {
			return $user_id;
		}
		return null;
	}
	
}