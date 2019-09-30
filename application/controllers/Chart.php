<?php
class Chart extends CI_Controller{
    function __construct(){
      parent::__construct();
      //load chart_model from model
      $this->load->model('chart_model');
    }

    function index(){
      $this->load->model('Chart_model');
      $this->load->view('chart_view');
    }

    public function get_all_data(){
		$data = $this->chart_model->get_data();
		echo json_encode($data);
    }
}
