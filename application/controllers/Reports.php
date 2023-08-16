<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Reports_Model');
		$this->load->model('Main_Model');
	}

	public function reports()
	{
		$this->load->view('reports/reports');
	}

	public function sale_report()
	{
		$data['products']= $this->Main_Model->getPosRecord();
		$this->load->view('reports/sale_report', $data);
	}

	public function sale_model_wise()
	{
		$data['products']= $this->Main_Model->getPosRecord();
		$this->load->view('reports/sale_model_wise', $data);
	}

	public function sale_summary()
	{
		$data['products']= $this->Main_Model->getPosRecord();
		$this->load->view('reports/sale_sumary', $data);
	}

	public function invoice_search()
	{
		$sale_id = $this->input->post('sale_id');		
		redirect(base_url().'Welcome/invoice?sale_id='.$sale_id);
	}


	public function stock_report()
	{
		$data['products']= $this->Main_Model->getPosRecord();
		$this->load->view('reports/stock_report', $data);
	}
	public function bank_balance()
	{
		$data['result']= $this->Main_Model->getBankBalance();
		$this->load->view('reports/bank_balance', $data);
	}

	public function customer_balance()
	{
		$data['customers']= $this->Main_Model->getCustomer();
		$this->load->view('reports/customer_balance', $data);
	}

	public function due_summary()
	{
		$data['customers']= $this->Main_Model->getCustomer();
		$this->load->view('reports/due_summary', $data);
	}

	public function supplier_balance()
	{
		$data['suppliers']= $this->Main_Model->getSupplier();
		$this->load->view('Reports/supplier_balance', $data);
	}

	public function attendance()
	{
		$data['staff']= $this->Main_Model->getStaff();
		$this->load->view('Reports/attendance', $data);
	}

	public function trial_balance()
	{
		$data['bankbalance']= $this->Main_Model->getBankBalance();
		$data['customerbalance']= $this->Main_Model->getCustomerBalance();
		$data['supplierbalance']= $this->Main_Model->getSupplierBalance();
		$data['dipp']= $this->Main_Model->getDipp();
		$data['app']= $this->Main_Model->appData();
		$this->load->view('trial_balance', $data);
	}

	/*=========================== dipp Record Start ==========================*/

	public function dipp()
	{
		$data['result']= $this->Main_Model->getPosRecord();
		$this->load->view('reports/dipp');
	}

	public function get_dipp()
	{
		$product_id = $this->input->post('product_id');		
		if($data['report'] = $this->Reports_Model->getDipp($date, $product_id))
		{
			$data['result']= $this->Main_Model->getDipp();
			$this->load->view('reports/dipp', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'reports/dipp');
		}		

	}

	/*=========================== dipp Record End ==========================*/

	
	public function get_product_sale()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$product_id = $this->input->post('product_id');	
		if($data['report'] = $this->Reports_Model->getPosRecord($product_id,$from_date, $to_date))
		{
			$data['products']= $this->Main_Model->getPosRecord();
			$this->load->view('reports/sale_report', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Reports/sale_report');
		}		

	}

	public function get_sale_summary()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$product_id = $this->input->post('product_id');		
		if($data['report'] = $this->Reports_Model->getSaleSummary($product_id, $from_date, $to_date))
		{
			$data['products']= $this->Main_Model->getPosRecord();
			$this->load->view('reports/sale_sumary', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Reports//sale_summary');
		}		

	}

	public function get_sale_model_wise()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$product_id = $this->input->post('product_id');	
		$product_model = $this->input->post('product_model');	
		if($data['report'] = $this->Reports_Model->getSaleModelWise($product_id, $product_model, $from_date, $to_date))
		{
			$data['products']= $this->Main_Model->getPosRecord();
			$this->load->view('Reports/sale_model_wise', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Reports/sale_model_wise');
		}		

	}


	public function get_customer_balance_old()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$customer_id = $this->input->post('customer_id');	
		if($data['report'] = $this->Reports_Model->getCustomerBalance($customer_id, $from_date, $to_date))
		{
			$data['customers']= $this->Main_Model->getCustomer();
			$this->load->view('customer_balance', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Welcome/customer_balance');
		}		

	}

	public function detail_individual()
	{
		$from_date = '2019-01-01';
		$to_date = date('Y-m-d');
		$id=$this->input->get("id");
		$data['user']= $this->Main_Model->get_single_individual($id);
		//$data['report'] = $this->_get_daily_actbalance_data($id, $from_date, $to_date);
		$this->load->view('detail_individual', $data);
		//$this->load->view('errors/html/error_general',['heading'=>"Page Under Construction",'message'=>"Kindly Check back within 48 hrs"]);
	}

	public function detail_business()
	{
		/*$from_date = '2019-01-01';
		$to_date = date('Y-m-d');
		$id=$this->input->get("id");
		$data['business']= $this->Main_Model->get_single_business($id);
		$data['report'] = $this->_get_daily_actbalance_data_supplier($id, $from_date, $to_date);
		$this->load->view('detail_business', $data);*/
		$this->load->view('errors/html/error_general',['heading'=>"Page Under Construction",'message'=>"Kindly Check back within 48 hrs"]);;
	}

	public function get_customer_balance()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$customer_id = $this->input->post('customer_id');
		if($data['report'] = $this->_get_daily_actbalance_data($customer_id, $from_date, $to_date))
		{
			$data['customers']= $this->Main_Model->getCustomer();
			$data['cstmr']= $this->Main_Model->get_single_customer($customer_id);
			$this->load->view('reports/customer_balance', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Reports/customer_balance');
		}	


	}

	private function _get_daily_actbalance_data($id, $from_date, $to_date) {

		$data = array();

		$start = strtotime($from_date);
		$end   = strtotime($to_date);
		$days  = ceil(abs($end - $start) / 86400)+1;
		$j = 0;
		for ($i = 0; $i < $days; $i++) {           

			$date = date('Y-m-d', strtotime($from_date . '+' . $i . ' day'));
			
			$receiving = $this->Reports_Model->get_receiving_by_date($id, $date);
			if(!empty($receiving)){
				
				foreach($receiving as $rcv){
					$data[$j+1]['sale_id'] = 0;                       
					$data[$j+1]['date'] = $date;
					$data[$j+1]['sale_amount'] = 0;
					$data[$j+1]['inv_discount'] = 0;
					$data[$j+1]['paid'] = 0;
					$data[$j+1]['due'] = 0;
					$data[$j+1]['payment_id'] = $rcv->status;
					$data[$j+1]['rcv_amount'] = $rcv->amount;
					$j++;
				}
			}
			
			$credit = $this->Reports_Model->get_credit_by_date($id, $date);
			if(!empty($credit)){
				
				foreach($credit as $cr){
					$data[$j+1]['sale_id'] = $cr->sale_id;                       
					$data[$j+1]['date'] = $date;
					$data[$j+1]['sale_amount'] = $cr->amount;
					$data[$j+1]['inv_discount'] = $cr->status;
					$data[$j+1]['paid'] = $cr->paid;
					$data[$j+1]['due'] = $cr->due;
					$data[$j+1]['payment_id'] = 0;
					$data[$j+1]['rcv_amount'] = 0;
					$j++;
				}
			}

			
		}

		return $data;
		
	}



	public function get_supplier_balance()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$supplier_id = $this->input->post('supplier_id');
		if($data['report'] = $this->_get_daily_actbalance_data_business($supplier_id, $from_date, $to_date))
		{
			$data['suppliers']= $this->Main_Model->getSupplier();
			$data['splr']= $this->Main_Model->get_single_business($supplier_id);
			$this->load->view('Reports/supplier_balance', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Reports/supplier_balance');
		}	


	}

	private function _get_daily_actbalance_data_business($id, $from_date, $to_date) {

		$data = array();

		$start = strtotime($from_date);
		$end   = strtotime($to_date);
		$days  = ceil(abs($end - $start) / 86400)+1;
		$j = 0;
		for ($i = 0; $i < $days; $i++) {           

			$date = date('Y-m-d', strtotime($from_date . '+' . $i . ' day'));
			
			$receiving = $this->Reports_Model->get_paid_by_date_supplier($supplier_id, $date);
			if(!empty($receiving)){
				
				foreach($receiving as $rcv){
					$data[$j+1]['purchase_id'] = 0;                       
					$data[$j+1]['date'] = $date;
					$data[$j+1]['purchase_amount'] = 0;
					$data[$j+1]['payment_id'] = $rcv->payment_id;
					$data[$j+1]['paid_amount'] = $rcv->amount;
					$j++;
				}
			}
			
			$credit = $this->Reports_Model->get_purchase_by_date_supplier($supplier_id, $date);
			if(!empty($credit)){
				
				foreach($credit as $cr){
					$data[$j+1]['purchase_id'] = $cr->purchase_id;
					$data[$j+1]['date'] = $date;
					$data[$j+1]['purchase_amount'] = $cr->purchase_amount;
					$data[$j+1]['payment_id'] = 0;
					$data[$j+1]['paid_amount'] = 0;
					$j++;
				}
			}

			
		}

		return $data;
		
	}


	public function get_due_summary()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$customer_id = $this->input->post('customer_id');		
		if($data['report'] = $this->Reports_Model->getDueSummary($customer_id, $from_date, $to_date))
		{
			$data['customers']= $this->Main_Model->getCustomer();
			$this->load->view('reports/due_summary', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Reports/due_summary');
		}		

	}

	public function get_attendance()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$staff_id = $this->input->post('staff_id');		
		if($data['report'] = $this->Reports_Model->getAttendance($staff_id, $from_date, $to_date))
		{
			$data['staff']= $this->Main_Model->getStaff();
			$this->load->view('Reports/attendance', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Reports/attendance');
		}	

	}

	public function day_book()
	{
		$this->load->view('Reports/day_book');
	}

	public function get_day_book()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		if($data['report'] = $this->_get_daily_accounting($from_date, $to_date))
		{
			$this->load->view('Reports/day_book', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Reports/day_book');
		}	


	}

	private function _get_daily_accounting($from_date, $to_date) {

		$data = array();

		$start = strtotime($from_date);
		$end   = strtotime($to_date);
		$days  = ceil(abs($end - $start) / 86400)+1;
		$j = 0;
		for ($i = 0; $i < $days; $i++) {           

			$date = date('Y-m-d', strtotime($from_date . '+' . $i . ' day'));
			
			$receiving = $this->Reports_Model->get_income_by_date($date);
			if(!empty($receiving)){
				
				foreach($receiving as $rcv){
					$data[$j+1]['inc_id'] = $rcv->inc_id;                      
					$data[$j+1]['date'] = $date;
					$data[$j+1]['inc_amount'] = $rcv->inc_amount; 
					$data[$j+1]['inc_heading'] = $rcv->inc_heading;
					$data[$j+1]['exp_id'] = 0;
					$data[$j+1]['exp_amount'] = 0;
					$data[$j+1]['exp_heading'] = 0;
					$j++;
				}
			}
			
			$credit = $this->Reports_Model->get_expense_by_date($date);
			if(!empty($credit)){
				
				foreach($credit as $cr){
					$data[$j+1]['inc_id'] = 0;                    
					$data[$j+1]['inc_amount'] = 0;
					$data[$j+1]['inc_heading'] = 0;
					$data[$j+1]['exp_id'] = $cr->exp_id;
					$data[$j+1]['date'] = $date;
					$data[$j+1]['exp_amount'] = $cr->exp_amount;
					$data[$j+1]['exp_heading'] = $cr->exp_heading;
					$j++;
				}
			}

			
		}

		return $data;
		
	}

	

}
