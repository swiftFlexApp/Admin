<?php

/*=========================== Sample Data Start ==========================*/

	function count_cars(){
		$query = $this->db->query("SELECT COUNT(*)as count_cars FROM cars");
		return $query->row_array();
	}

	function saveCar($data)
	{
		$insert= $this->db->insert('cars', $data);
		return $insert;
	}

	function get_cars()
	{
		$query = $this->db->query('SELECT * FROM cars');
		$result = $query->result_array();
		return $result;
	}

	function get_single_car($car_id)
	{
		$query = $this->db->query("SELECT * FROM cars WHERE car_id = '".$car_id."'");
		$result = $query->result_array();
		return $result;
	}


	function duplicateCarCheck($car_number)
	{
		$this->db->select('car_number');
		$this->db->from('cars');  
		$this->db->where('car_number' ,$car_number); 
		$q = $this->db->get();   

		if($q->num_rows()>0)
		{
			return true;
		}
		else{
			return false;
		}

	}

	