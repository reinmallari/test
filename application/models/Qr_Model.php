<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
defined('BASEPATH') OR exit('No direct script access allowed');
class Qr_Model extends CI_Model {
    var $table = 'qr_info';

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
	 $this->default = $this->load->database('db2',TRUE);
    }

    public function qr_add($data,$decoded_qr)
    {
	 $this->default->select('*');
	 $this->default->from('employees');
	 $this->default->where('employee_no',$decoded_qr);
	 $query = $this->default->get();
		if($query->num_rows() > 0){
			$this->db->insert($this->table, $data);
			$this->db->insert_id();
			return true;
		}else  {
		    return false;
		}
    }
}
