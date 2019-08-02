<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('form');
	    $this->load->helper('url');
	    $this->load->model('Qr_Model','Qr_Model');
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function qr_add(){
	    $qr = $this->input->post('qr_url');
	    $decoded_qr = base64_decode($qr);
	    $data = array(
	      'qr_url'=>$decoded_qr,
	    );
	  $insert = $this->Qr_Model->qr_add($data,$decoded_qr);
	  echo json_encode(array("status" => TRUE,"qr"=>$qr));
	}
}
