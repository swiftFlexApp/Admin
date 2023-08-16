<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_Model');
	}
	
	public function login()
	{
		$data = array();
		
		if(empty($_POST['email']) || empty($_POST['password']))
		{
			$data['status'] = 'failed';
		}
		else
		{
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			$response = $this->Api_Model->check_login($email, $password);
			
			
			
			if($response == false)
			{
				$data['status'] = 'failed';
			}
			else
			{
				$data['status'] = 'success';
				$data['data'] = $response;
			}
		}
		
		echo json_encode($data);
		die();
	}
	
	public function add_billing()
	{
		$data = array();
		
		if(empty($_POST))
		{
			$data['message'] = 'failed';
		}
		else
		{
			$data['driver_id']          = $_POST['driver_id'];
			$data['car_id']             = $_POST['car_id'];
			$data['trip_strat_time']    = $_POST['trip_strat_time'];
			$data['trip_start_location']= $_POST['trip_start_location'];
			$data['trip_end_time']      = $_POST['trip_end_time'];
			$data['trip_end_location']  = $_POST['trip_end_location'];
			$data['customer_name']      = $_POST['customer_name'];
			$data['customer_mobile']    = $_POST['customer_mobile'];
			$data['payment_mode']       = $_POST['payment_mode'];
			$data['amount']             = $_POST['amount'];
			$data['hotel_id']           = $_POST['hotel_id'];
			$data['date']          		= $_POST['date'];
			
			
			if($this->db->insert('bill', $data))
			{
				$data['message'] = 'success';
			}
			else
			{
				$data['message'] = 'failed';
			}
		}
		
		echo json_encode($data);
		die();
	}

	
	
	public function get_cars() {
		$query=$this->db->query("SELECT * FROM cars");
		$result = $query->result_array();	
   //add the header here
		header('Content-Type: application/json');
		echo json_encode($result, JSON_PRETTY_PRINT);
    //echo json_encode( $result );
	}
	
	public function get_hotels() {
		$query=$this->db->query("SELECT * FROM hotels");
		$result = $query->result_array();	
   //add the header here
		header('Content-Type: application/json');
		echo json_encode($result, JSON_PRETTY_PRINT);
    //echo json_encode( $result );
	}
	
	public function get_bills() {
		$query=$this->db->query("SELECT * FROM bill");
		$result = $query->result_array();	
   //add the header here
		header('Content-Type: application/json');
		echo json_encode($result, JSON_PRETTY_PRINT);
    //echo json_encode( $result );
	}

	public function get_driver_bills() {
		$driver_id = $_POST['driver_id'];
		$query=$this->db->query("
			SELECT * FROM bill 
			JOIN cars ON bill.car_id=cars.car_id 
			JOIN register ON register.user_id=bill.driver_id 
			LEFT JOIN hotels ON hotels.hotel_id=bill.hotel_id 
			WHERE bill.driver_id = '$driver_id'
			ORDER BY bill.bill_id DESC
			");
		$result = $query->result_array();	
   //add the header here
		header('Content-Type: application/json');
		echo json_encode($result, JSON_PRETTY_PRINT);
    //echo json_encode( $result );
	}

	public function get_exp_head() {
		$query=$this->db->query("SELECT * FROM expense_head");
		$result = $query->result_array();	
   //add the header here
		header('Content-Type: application/json');
		echo json_encode($result, JSON_PRETTY_PRINT);
    //echo json_encode( $result );
	}

	public function add_expense()
	{
		$data = array();
		
		if(empty($_POST))
		{
			$data['message'] = 'Failed';
		}
		else
		{
			$data['exp_head_id']        = $_POST['exp_head_id'];
			$data['driver_id']          = $_POST['driver_id'];
			$data['car_id']    			= $_POST['car_id'];
			$data['amount'] 			= $_POST['amount'];
			$data['exp_detail']      	= $_POST['exp_detail'];
			
			if($this->db->insert('expense', $data))
			{
				$data['message'] = 'success';
			}
			else
			{
				$data['message'] = 'failed';
			}
		}
		
		echo json_encode($data);
		die();
	}

	public function get_driver_expenses() {
		$driver_id = $_POST['driver_id'];
		$query=$this->db->query("
			SELECT * FROM expense
			JOIN expense_head ON expense_head.exp_head_id = expense.exp_head_id 
			JOIN cars ON cars.car_id = expense.car_id 
			JOIN register ON register.user_id = expense.driver_id 
			WHERE expense.driver_id = '$driver_id'
			ORDER BY expense.exp_id DESC
			");
		$result = $query->result_array();	
   //add the header here
		header('Content-Type: application/json');
		echo json_encode($result, JSON_PRETTY_PRINT);
    //echo json_encode( $result );
	}

}
