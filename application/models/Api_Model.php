<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Model extends CI_Model {

    function check_login($email, $password)
	{
	    $this->db->select('*');
		$this->db->from('register');
		$this->db->join('cars', 'cars.car_id=register.car_id');  
		$this->db->where('email' ,$email); 
		$this->db->where('password' ,$password);  
		
		$q = $this->db->get(); 
		
		if($q->num_rows())
		{
		    return $q->row();
		}
		else
		{
		    return false;
		}
	}
}