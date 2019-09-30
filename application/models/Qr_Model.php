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

    public function select_events_for_site($event_site){
	    $this->default->select('event_id,event_title');
	    $this->default->from('events');
	    $this->default->where('event_branch_id',$event_site);
	    // $this->default->where('DATE(event_created_on)=CURDATE()');
	    $query = $this->default->get();
	    return $query->result();
    }

    public function qr_add($data,$decoded_qr,$event_id)
    {
	 $this->default->select('*');
	 $this->default->from('employees');
	 $this->default->where('employee_no',$decoded_qr);
	 $query_get_employee_users_id = $this->default->get();
		if($query_get_employee_users_id->num_rows() > 0){
			$id = $query_get_employee_users_id->row();
			$this->default->select('first_name,last_name');
			$this->default->from('users');
			$this->default->where('id',$id->employee_users_id);
			$query_employee_details = $this->default->get();
			$employee_details = $query_employee_details->row();
			$data['first_name'] = $employee_details->first_name;
			$data['last_name'] = $employee_details->last_name;
			//Check is he/she is rsvp
			$this->default->select('rsvp.event_attendance_status');
			$this->default->from('event_attendance AS rsvp');
			$this->default->join('employees AS emp','rsvp.event_attendance_employee_id = emp.employee_id');
			$this->default->where('rsvp.event_attendance_event_id',$event_id);
			$this->default->where('emp.employee_id',$id->employee_id);
			$query_check_if_rsvp = $this->default->get();
			if($query_check_if_rsvp->num_rows() > 0){
				$is_rsvp_status = $query_check_if_rsvp->row();
				$data['event_rsvp'] = $is_rsvp_status->event_attendance_status;
				$data['event_attendance'] = "yes";
			}else{
				$data['event_rsvp'] = "No RSVP";
				$data['event_attendance'] = "yes";
			}
			//End
			$this->db->insert($this->table, $data);
			$this->db->insert_id();
			return $query_employee_details->result();
		}else  {
		    return false;
		}
    }
}
