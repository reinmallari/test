<?php
class Chart_model extends CI_Model{

	public function __construct()
     {
       parent::__construct();
       $this->load->database();
 	 $this->db = $this->load->database('default',TRUE);
     }
  //get data from database
  function get_data(){
      	$this->db->select('AVG(current_usage) AS current_usage,DATE_FORMAT(`date_created`, "%d/%m/%Y") AS date_created,project_id');
		$this->db->from('electricity_usage');
		$this->db->group_by('project_id');
	 	$query = $this->db->get();
	 	return $query->result();
  }

}
