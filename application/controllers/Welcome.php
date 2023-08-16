<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		/*load Model*/
		$this->load->library('cart');
		$this->load->library('curl');
		$this->load->model('Main_Model');
	}

	public function index()
	{
		$data['app']= $this->Main_Model->appData();
		$this->load->view('login', $data);
	}

	/*=========================== Dashboard Start ==========================*/
	public function dashboard()
	{	
		$user_id=$this->session->userdata('user_id');
		$type=$this->session->userdata('type');
		
		$data['count_business']= $this->Main_Model->count_business();
		$data['count_individuals']= $this->Main_Model->count_individuals();
		$data['total_debit']= $this->Main_Model->total_debit();
		$data['result']= $this->Main_Model->getTransaction();
		$data['total_received']= $this->Main_Model->total_received();
		$data['new_users'] = $this->Main_Model->getNewlyRegistered();	
		/*$data['expense']= $this->Main_Model->getExpensee();
		$data['totalSale']= $this->Main_Model->getTotalSale();
		$data['totalPurchase']= $this->Main_Model->getTotalPurchase();*/
		
		if ($user_id!='' AND $type==0) {
			$this->load->view('dashboard', $data);
		}
		else{
			$this->session->set_flashdata('error', 'You Need to Login First or to be Authorised');
			redirect(base_url().'Welcome/index');
		}
	}
	/*=========================== Dashboard End ==========================*/

	// ========== Finance Report ==========

	function agent_report()
	{
		$result = $this->Main_Model->agent_report();
		$totalAmount = 0;
		$totalFee = 0;
		foreach($result as $r)
		{
			$totalAmount = $totalAmount + intval($r['amount']);
			$totalFee = $totalFee + intval($r['fee']);
		}
		$data['totalAmount'] = $totalAmount;
		$data['totalFee'] = $totalFee;
		$this->load->view('reports/finance/agent',$data);
	}


	public function withdrawal_requests()
	{
		$data['data'] = $this->Main_Model->getWithdrawalRequests('pending');
		$this->load->view('withdrawal_requests', $data);
	}

	public function approved_requests()
	{
		$data['data'] = $this->Main_Model->getWithdrawalRequests('approved');
		$this->load->view('withdrawal_requests', $data);
	}

	public function rejected_requests()
	{
		$data['data'] = $this->Main_Model->getWithdrawalRequests('rejected');
		$this->load->view('withdrawal_requests', $data);
	}
	
	public function approve_w_request()
	{
		$id = $this->input->get('id');
		$transfer_data = $this->Main_Model->getWithdrawalRequest($id);
		$data = array(
			'account_bank' => $transfer_data[0]['bank_code'], // Bank code
			'account_number' => $transfer_data[0]['bank_account_number'], // Beneficiary's account number
			'amount' => $transfer_data[0]['transfer_amount'], // Amount to withdraw
			'narration' => $transfer_data[0]['transfer_narration'], // Reason for payout
			'currency' => 'NGN',
            "reference" => $transfer_data[0]['transfer_reference'],
		); 
		$url = 'https://api.flutterwave.com/v3/transfers';
		$headers = array(
			'Authorization: Bearer FLWSECK-a00c00c09d2b7ffc045328b79f2236cb-X',
			'Content-Type: application/json',
		);

		$response = $this->curl->post($url, json_encode($data), array('headers' => $headers));
        $responseJsonDecoded = json_decode($response, true);
		if($responseJsonDecoded['status'] === 'success') {
			$data = [
				'transfer_status' => 'approved'
			];
			$this->Main_Model->updateTransfer($id,$data);
			$this->session->set_flashdata('success', 'Transfer Approved Successfully');
			redirect(base_url().'Welcome/withdrawal_requests');
		}
		$this->session->set_flashdata('error', 'Transfer Error'.'---'.$responseJsonDecoded['message']);
		redirect(base_url().'Welcome/withdrawal_requests');
	}

	public function reject_w_request()
	{
		$id = $this->input->get('id');
		$data = [
			'transfer_status' => 'rejected'
		];
		$this->Main_Model->updateTransfer($id,$data);
		$this->session->set_flashdata('success', 'Transfer Rejected Successfully');
		redirect(base_url().'Welcome/rejected_requests');

	}

	public function list_business()
	{
		$data['result']= $this->Main_Model->getBusiness();
		$this->load->view('list_business', $data);
	}

	public function edit_business()
	{
		$id=$this->input->get("id");
		$data['result']= $this->Main_Model->get_single_business($id);
		$this->load->view('edit_business', $data);
	}

	public function update_business()
	{
		$business_id=$this->input->post('business_id');
		$data=[
			//'business_name'=>$this->input->post('business_name'),
			'phone'=>$this->input->post('business_contact'),
			'address'=>$this->input->post('business_address')
			
		];
		$amount = ['balance'=>$this->input->post('business_amount')];
		$update=$this->Main_Model->updateBusiness($business_id, $data, $amount);
		if($update)
		{
			$this->session->set_flashdata('success', 'Business Account Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_business');
	}

	public function lock_business()
	{
		$id=$this->input->get('id');
		$delete = $this->Main_Model->lockIndividual($id);
		if($delete)
		{			
			$this->session->set_flashdata('success','Account locked successfully');
		}
		else{
			$this->session->set_flashdata('error','Account not locked, Error');			
		}
		redirect(base_url().'Welcome/list_business');
		//$this->load->view('errors/html/error_general',['heading'=>"Page Under Construction",'message'=>"Kindly Check back within 48 hrs"]);
	}



	/*=========================== Business End ==========================*/

    public function unlock_account()
    {
        $id=$this->input->get('id');
		$delete = $this->Main_Model->unlockAccount($id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Account unlocked successfully');
		}
		else{
			$this->session->set_flashdata('error','Account not unlocked, Error');			
		}
		redirect(base_url().'Welcome/list_individuals');
    }
	/*=========================== Add individual Start ==========================*/
	public function ad_customer()
	{
		$this->load->view('ad_customer');
	}
	
	public function save_customer()
	{
		$data=[
			'customer_name'=>$this->input->post('customer_name'),
			'customer_contact'=>$this->input->post('customer_contact'),
			'customer_contact2'=>$this->input->post('customer_contact2'),
			'customer_contact3'=>$this->input->post('customer_contact3'),
			'whatsapp_no'=>$this->input->post('whatsapp_no'),
			'customer_address'=>$this->input->post('customer_address')
		];	

		$save=$this->Main_Model->saveCustomer($data);
		$customer_id = $this->db->insert_id();
		$previous = $this->input->post('previous_balance');
		if ($previous>0) {
			$data1=[
				'customer_id' => $this->db->insert_id(),
				'sale_type'=>'Previous Balance',
				'due'=>$this->input->post('previous_balance'),
				'date'=>date('Y-m-d')
			];	
			$insert= $this->db->insert('sale', $data1);
		}

		$data2=[
			'customer_id'=>$customer_id,
			'name'=>$this->input->post('customer_name'),
			'contact'=>$this->input->post('customer_contact'),
			'contact2'=>$this->input->post('customer_contact2'),
			'contact3'=>$this->input->post('customer_contact3'),
			'whatsapp_no'=>$this->input->post('whatsapp_no'),
			'detail'=>$this->input->post('customer_address')
		];

		$contact= $this->db->insert('contact_book', $data2);		

		if($save=1 && $contact=1)
		{
			$this->session->set_flashdata('success', 'Customer Added Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/list_customer');

	}

	public function list_individuals()
	{
		$data['result']= $this->Main_Model->getIndividuals();
		$this->load->view('list_individuals', $data);
	}

	public function edit_individual()
	{
		$id=$this->input->get("id");
		$data['result']= $this->Main_Model->get_single_individual($id);
		$this->load->view('edit_individuals', $data);
	}

	

	public function update_individual()
	{
		$id=$this->input->post("individual_id");
		$data=[
			'phone'=>$this->input->post('phone'),
			'address'=>$this->input->post('address')
		];
		$balance = ['balance' => $this->input->post('balance')];
		
		$update=$this->Main_Model->updateIndividual($id, $data, $balance);
		
		if($update==True)
		{
			$this->session->set_flashdata('success', 'Account Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_individuals');
	}

	public function lock_individual()
	{
		$id=$this->input->get('id');
		$delete = $this->Main_Model->lockIndividual($id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Account locked successfully');
		}
		else{
			$this->session->set_flashdata('error','Account not locked, Error');			
		}
		redirect(base_url().'Welcome/list_individuals');
		//$this->load->view('errors/html/error_general',['heading'=>"Page Under Construction",'message'=>"Kindly Check back within 48 hrs"]);
	}


	/*===========================customer End ==========================*/

	public function daily_shift()
	{
		$this->load->view('daily_shift');
	}
	

	public function daily_sheet()
	{
		$date=$this->input->post("date");
		$data['app']= $this->Main_Model->appData();
		$data['result']= $this->Main_Model->getShiftReading($date);
		$data['sale']= $this->Main_Model->getShiftSale($date);
		$data['dipp']= $this->Main_Model->getDipp();
		$this->load->view('daily_sheet', $data);
	}



	public function ad_order()
	{
		$data['customers']= $this->Main_Model->getCustomer();
		$this->load->view('ad_order', $data);
	}

	/*=========================== Add product Start ==========================*/
	public function ad_product()
	{
		$this->load->view('ad_product');
	}

	public function save_order()
	{
		$data=[
			'customer_id'=>$this->input->post('customer_id'),
			'product_name'=>$this->input->post('product_name'),
			'delivery_date'=>$this->input->post('d_date'),
			'committed_price'=>$this->input->post('price'),
			'advance'=>$this->input->post('advance'),
			'detail'=>$this->input->post('product_description')
		];
		$save_product= $this->db->insert('orders', $data);
		
		if($save_product)
		{
			$this->session->set_flashdata('success', 'Order Successfully Saved');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/list_orders');

	}

	public function list_orders()
	{
		$data['result']= $this->Main_Model->getOrders();
		$this->load->view('list_orders', $data);
	}

	public function delete_order()
	{
		$order_id=$this->input->post('order_id');
		$delete = $this->Main_Model->deleteOrder($order_id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Deleted Successfully');
		}
		else{
			$this->session->set_flashdata('error','Not Deleted, Error');			
		}
		redirect(base_url().'Welcome/list_orders');
	}
	
	public function save_product()
	{
		$data=[
			'product_name'=>$this->input->post('product_name'),
			'price'=>$this->input->post('price'),
			'product_model'=>$this->input->post('product_model'),
			'product_description'=>$this->input->post('product_description'),
		];
		$save_product= $this->db->insert('product', $data);
		
		if($save_product)
		{
			$this->session->set_flashdata('success', 'Product Successfully Saved');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/list_product');

	}

	public function edit_product()
	{
		$product_id=$this->input->post("product_id");
		$data['result']= $this->Main_Model->get_single_product($product_id);
		$this->load->view('edit_product', $data);
	}
	
	public function list_product()
	{
		$data['result']= $this->Main_Model->getProduct();
		$this->load->view('list_product', $data);
	}

	public function update_product()
	{
		$product_id=$this->input->post('product_id');
		$data=[
			'product_name'=>$this->input->post('product_name'),
			'price'=>$this->input->post('price'),
			'product_description'=>$this->input->post('product_description')
		];
		$update=$this->Main_Model->updateProduct($product_id, $data);
		if($update)
		{
			$this->session->set_flashdata('success', 'product_id Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_product');
	}

	public function delete_product()
	{
		$product_id=$this->input->post('product_id');
		$delete = $this->Main_Model->deleteProduct($product_id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Product deleted successfully');
		}
		else{
			$this->session->set_flashdata('error','Product not deleted, Error');			
		}
		redirect(base_url().'Welcome/list_product');
	}


	/*===========================List product End ==========================*/

	/*===========================  Staff Start ==========================*/
	public function ad_staff()
	{
		$this->load->view('ad_staff');
	}
	
	public function save_staff()
	{
		$data=[
			'staff_name'=>$this->input->post('staff_name'),
			'staff_phone'=>$this->input->post('staff_phone'),
			'salary'=>$this->input->post('salary'),
			'staff_address'=>$this->input->post('staff_address')
		];	

		$save=$this->Main_Model->saveStaff($data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Successfully Added');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/list_staff');

	}
	
	public function list_staff()
	{
		$data['result']= $this->Main_Model->getStaff();
		$this->load->view('list_staff', $data);
	}

	public function edit_staff()
	{
		$staff_id=$this->input->get("staff_id");
		$data['result']= $this->Main_Model->get_single_staff($staff_id);
		$this->load->view('edit_staff', $data);
	}

	public function update_staff()
	{
		$staff_id=$this->input->post('staff_id');
		$data=[
			'staff_name'=>$this->input->post('staff_name'),
			'staff_phone'=>$this->input->post('staff_phone'),
			'salary'=>$this->input->post('salary'),
			'staff_address'=>$this->input->post('staff_address')
		];
		$update=$this->Main_Model->updateStaff($staff_id, $data);
		if($update)
		{
			$this->session->set_flashdata('success', 'staff Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_staff');
	}

	public function delete_staff()
	{
		$staff_id=$this->input->get('staff_id');
		$delete = $this->Main_Model->deleteStaff($staff_id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Staff deleted successfully');
		}
		else{
			$this->session->set_flashdata('error','Staff not deleted, Error');			
		}
		redirect(base_url().'Welcome/list_staff');
	}

	/*=========================== Attendance ===========================*/
	public function attendance()
	{
		$data['result']= $this->Main_Model->getStaff();
		$this->load->view('attendance', $data);
	} 

	public function save_attendance()
	{
		$i = 0;
		foreach($this->input->post('staff_id') as $row){

			$data['staff_id'] = $this->input->post('staff_id')[$i];
			$data['presence'] = $this->input->post('presence')[$i];
			$data['date'] = $this->input->post('date')[$i];			
			$q = $this->db->insert("attendance", $data);
			$i++;
		}

		if($q)
		{
			$this->session->set_flashdata('success', 'Attendance Saved Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/attendance');

	}

	public function list_attendance()
	{
		$data['result']= $this->Main_Model->getAttendance();
		$this->load->view('list_attendance', $data);
	} 

	/*===========================List staff End ==========================*/

	public function pay_salary()
	{
		$data['result']= $this->Main_Model->getStaff();
		$this->load->view('pay_salary', $data);
	}

	public function paid_salaries()
	{
		$data['result']= $this->Main_Model->getStaff();
		$data['salary']= $this->Main_Model->getPaidSalary();
		$this->load->view('paid_salaries', $data);
	}

	public function save_salary()
	{
		$data=[
			'date'=>$this->input->post('date'),
			'staff_id'=>$this->input->post('staff_id'),
			'paid_salary'=>$this->input->post('salary'),
			'over_time'=>$this->input->post('over_time'),
			'deduction'=>$this->input->post('deduction'),
			'total_salary'=>$this->input->post('total_salary')
		];

		$q = $this->db->insert("salary", $data);

		if($q)
		{
			$this->session->set_flashdata('success', 'Salary Saved Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/paid_salaries');

	}
	
	/*=========================== Add sales Start ==========================*/
	public function ad_sales()
	{
		$data['customers']= $this->Main_Model->getCustomer();
		$data['products']= $this->Main_Model->getProduct();
		$this->load->view('ad_sales', $data);
	}
	public function sale_from_vehicle()
	{
		$data['customers']= $this->Main_Model->getCustomer();
		$data['products']= $this->Main_Model->getProduct();
		$this->load->view('sale_from_vehicle', $data);
	}

	public function ad_in_vehicle()
	{
		$data['products']= $this->Main_Model->getProduct();
		$this->load->view('ad_in_vehicle', $data);
	}

	public function getProductDetails($request){
		$query=$this->db->query("
			SELECT p.product_id, p.product_name, p.price, sale, purchase
			FROM product AS p
			LEFT JOIN (
			SELECT s.product_id, sum(s.qty) as sale
			FROM sale_detail as s
			GROUP BY product_id
			)s
			ON s.product_id = p.product_id
			LEFT JOIN (
			SELECT pd.product_id, sum(pd.qty) as purchase
			FROM purchase_detail as pd
			GROUP BY product_id
			)pd
			ON pd.product_id = p.product_id			
			WHERE p.product_id = $request
			");
		$result = $query->result_array();	
		echo json_encode($result);
	}
	public function getVehicleProductDetails($request){
		$query=$this->db->query("
			SELECT p.product_id, p.product_name, p.w_price, p.l_price, sale, purchase
			FROM product AS p
			LEFT JOIN (
			SELECT s.product_id, sum(s.qty) as sale
			FROM sale_detail as s
			JOIN sale ON sale.sale_id=s.sale_id
			WHERE sale.is_vehicle_sale = 1
			GROUP BY product_id
			)s
			ON s.product_id = p.product_id
			LEFT JOIN (
			SELECT pd.product_id, sum(pd.qty) as purchase
			FROM vehicle_in_detail as pd
			GROUP BY product_id
			)pd
			ON pd.product_id = p.product_id			
			WHERE p.product_id = $request
			");
		$result = $query->result_array();	
		echo json_encode($result);
	}

	public function getPreviousBalance($request){
		$query=$this->db->query("
			SELECT SUM(due) as due FROM sale
			WHERE customer_id = $request
			");
		$result = $query->result_array();	
		echo json_encode($result);
	}

	public function getPreviousPayments($request){
		$query=$this->db->query("
			SELECT sum(amount) as previous_payment FROM customer_payment
			WHERE customer_id = $request
			");
		$result = $query->result_array();	
		echo json_encode($result);
	}

	
	public function list_sales()
	{
		$data['result']= $this->Main_Model->getSale();
		$this->load->view('list_sales', $data);
	}
	public function list_vehicle_sales()
	{
		$data['result']= $this->Main_Model->getVehicleSale();
		$this->load->view('list_vehicle_sales', $data);
	}
	public function list_loading()
	{
		$data['result']= $this->Main_Model->getLoading();
		$this->load->view('list_loading', $data);
	}

	public function sale_detail()
	{
		$sale_id=$this->input->post("sale_id");
		$data['result']= $this->Main_Model->get_single_sale($sale_id);
		$this->load->view('sale_detail', $data);
	}

	public function invoice()
	{
		$sale_id=$this->input->get('sale_id', TRUE);
		$data['sale']= $this->Main_Model->get_single_sale($sale_id);
		$data['customer']= $this->Main_Model->get_single_sale_customer($sale_id);
		$data['product']= $this->Main_Model->get_single_sale_product($sale_id);
		$data['app']= $this->Main_Model->appData();
		$this->load->view('invoice', $data);
	}

	public function invoice_print()
	{
		$sale_id=$this->input->post("sale_id");
		$data['sale']= $this->Main_Model->get_single_sale($sale_id);
		$data['customer']= $this->Main_Model->get_single_sale_customer($sale_id);
		$data['product']= $this->Main_Model->get_single_sale_product($sale_id);
		$data['app']= $this->Main_Model->appData();
		$this->load->view('invoice_print', $data);
	}

	public function vehicle_in_invoice()
	{
		$vehicle_in_id=$this->input->get("vehicle_in_id");
		$data['app']= $this->Main_Model->appData();
		$data['vehicle']= $this->Main_Model->vInvoice($vehicle_in_id);
		$this->load->view('vehicle_in_invoice', $data);
	}

	public function invoice_vehicle()
	{
		$vehicle_in_id=$this->input->get("vehicle_in_id");
		$data['app']= $this->Main_Model->appData();
		$data['vehicle']= $this->Main_Model->vInvoice($vehicle_in_id);
		$this->load->view('invoice_vehicle', $data);
	}

	public function edit_sale()
	{
		
		$sale_id = $this->input->get('sale_id', TRUE);
		$data['customers']= $this->Main_Model->getCustomer();		
		$data['products']= $this->Main_Model->getProduct();

		$data['sale']= $this->Main_Model->get_single_sale($sale_id);
		$data['customer']= $this->Main_Model->get_single_sale_customer($sale_id);
		$data['product']= $this->Main_Model->get_single_sale_product($sale_id);
		$this->load->view('edit_sales', $data);
		
	}

	public function update_sale()
	{
		$sale_id = $this->input->post('sale_id');

		$data=[
			'updated'=>$this->input->post('date'),
			'customer_id'=>$this->input->post('customer_id'),
			'sale_type'=>$this->input->post('sale_type'),
			'sale_amount'=>array_sum($this->input->post('total')),
			'inv_discount'=>$this->input->post('invoice_discount'),
			'paid'=>$this->input->post('paid'),
			'due'=>$this->input->post('due')
		];	

		$this->db->where('sale_id', $sale_id);
		$update = $this->db->update('sale', $data);

		$this->db->where('sale_id', $sale_id);
		$delete = $this->db->delete('sale_detail');

		if ($update && $delete) {
			// $i = 0;
			// foreach($this->input->post('product_id') as $row){
			// 	$data1['sale_id'] = $sale_id;
			// 	$data1['product_id'] = $this->input->post('product_id')[$i];
			// 	$data1['selling_price'] = $this->input->post('selling_price')[$i];
			// 	$data1['qty'] = $this->input->post('qty')[$i];
			// 	$data1['total'] = $this->input->post('total')[$i];
			// 	$this->db->insert("sale_detail",$data1);
			// 	$i++;

			$i = 0;
			$type = $this->input->post('sale_type');
			foreach($this->input->post('product_id') as $row){
				$data1['sale_id'] = $sale_id;
				$data1['product_id'] = $this->input->post('product_id')[$i];
				if ($type =='Whole Sale') {
					$data1['selling_price'] = $this->input->post('w_price')[$i];
				}
				if ($type =='Local Sale') {
					$data1['selling_price'] = $this->input->post('l_price')[$i];
				}
				$data1['qty'] = $this->input->post('qty')[$i];
				$data1['discount'] = $this->input->post('discount')[$i];
				$data1['total'] = $this->input->post('total')[$i];
				$this->db->insert("sale_detail",$data1);
				$i++;
			}
			$this->session->set_flashdata('success', 'Updated Successfully');			
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}
		redirect(base_url().'Welcome/list_sales');
	}


	public function purchase()
	{
		//$purchase_id=$this->input->post("purchase_id");
		$purchase_id = $this->input->get('purchase_id', TRUE);
		$data['purchase']= $this->Main_Model->get_single_purchase($purchase_id);
		$data['supplier']= $this->Main_Model->get_single_purchase_supplier($purchase_id);
		$data['product']= $this->Main_Model->get_single_purchase_product($purchase_id);
		$data['app']= $this->Main_Model->appData();
		$this->load->view('purchase', $data);
	}

	public function purchase_print()
	{
		$purchase_id=$this->input->post("purchase_id");
		$data['purchase']= $this->Main_Model->get_single_purchase($purchase_id);
		$data['supplier']= $this->Main_Model->get_single_purchase_supplier($purchase_id);
		$data['product']= $this->Main_Model->get_single_purchase_product($purchase_id);
		$data['app']= $this->Main_Model->appData();
		$this->load->view('purchase_print', $data);
	}

	public function purchase_detail()
	{
		$purchase_id=$this->input->post("purchase_id");
		$data['result']= $this->Main_Model->get_single_purchase($purchase_id);
		$this->load->view('purchase_detail', $data);
	}

	
	/*===========================List Sale End ==========================*/

	/*=========================== Add Purchase Start ==========================*/
	public function ad_purchase()
	{
		$data['suppliers']= $this->Main_Model->getSupplier();
		$data['products']= $this->Main_Model->getProduct();
		$data['banks']= $this->Main_Model->getBank();
		$this->load->view('ad_purchase', $data);
	}
	
	public function list_purchase()
	{
		$data['result']= $this->Main_Model->getPurchase();
		$this->load->view('list_purchase', $data);
	}

	public function edit_purchase()
	{
		$purchase_id = $this->input->get('purchase_id', TRUE);
		$data['suppliers']= $this->Main_Model->getSupplier();
		$data['products']= $this->Main_Model->getProduct();
		
		$data['purchase']= $this->Main_Model->get_single_purchase($purchase_id);
		$data['supplier']= $this->Main_Model->get_single_purchase_supplier($purchase_id);
		$data['product']= $this->Main_Model->get_single_purchase_product($purchase_id);
		$this->load->view('edit_purchase', $data);
		
	}

	public function update_purchase()
	{
		$purchase_id = $this->input->post('purchase_id');

		$data=[
			'updated'=>$this->input->post('date'),
			'supplier_id'=>$this->input->post('supplier_id'),
			'purchase_amount'=>array_sum($this->input->post('total'))
		];	

		$this->db->where('purchase_id', $purchase_id);
		$update = $this->db->update('purchase', $data);

		$this->db->where('purchase_id', $purchase_id);
		$delete = $this->db->delete('purchase_detail');

		if ($update && $delete) {
			$i = 0;
			foreach($this->input->post('product_id') as $row){
				$data1['purchase_id'] = $purchase_id;
				$data1['product_id'] = $this->input->post('product_id')[$i];
				$data1['purchase_price'] = $this->input->post('purchase_price')[$i];
				$data1['qty'] = $this->input->post('qty')[$i];
				$data1['total'] = $this->input->post('total')[$i];
				$this->db->insert("purchase_detail",$data1);
				$i++;
			}
			$this->session->set_flashdata('success', 'Updated Successfully');			
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}
		redirect(base_url().'Welcome/list_purchase');
	}

	public function delete_purchase()
	{
		$purchase_id = $this->input->get('purchase_id', TRUE);
		$delete = $this->Main_Model->deletePurchase($purchase_id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Purchase deleted successfully');
		}
		else{
			$this->session->set_flashdata('error','Purchase not deleted, Error');			
		}
		redirect(base_url().'Welcome/list_purchase');
	}

	public function delete_sale()
	{
		$sale_id = $this->input->get('sale_id', TRUE);
		$delete = $this->Main_Model->deleteSale($sale_id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Sale deleted successfully');
		}
		else{
			$this->session->set_flashdata('error','Sale not deleted, Error');			
		}
		redirect(base_url().'Welcome/list_sales');
	}

	/*===========================Transaction End ==========================*/

	/*=========================== Add Dues Start ==========================*/
	/*public function dues()
	{
		$data['result']= $this->Main_Model->getCreditSale();
		$this->load->view('dues', $data);
	}*/
	/*=========================== Ad dues End ==========================*/

	/*=========================== Add sales return Start ==========================*/
	public function ad_sales_return()
	{
		$this->load->view('ad_sales_return');
	}
	
	public function list_sales_return()
	{
		//$data['result']= $this->Main_Model->get_sale();
		$this->load->view('list_sales_return');
	}
	/*===========================Add sales return End ==========================*/

	/*=========================== Add product Start ==========================*/
	public function ad_purchase_return()
	{
		$this->load->view('ad_purchase_return');
	}
	/*=========================== Ad product  End ==========================*/

	/*===========================List purchase Start ==========================*/
	public function list_purchase_return()
	{
		
		$this->load->view('list_purchase_return');
	}
	/*===========================List purchase End ==========================*/

	/*===========================  bank Start ==========================*/
	public function ad_bank()
	{
		
		$this->load->view('ad_bank');
	}
	
	public function save_bank()
	{
		$data=[
			'bank_name'=>$this->input->post('bank_name'),
			'account_number'=>$this->input->post('account_number'),
			'balance'=>$this->input->post('balance'),
			'bank_detail'=>$this->input->post('bank_detail')
		];	

		$save=$this->Main_Model->saveBank($data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/list_bank');

	}
	
	public function list_bank()
	{
		$data['result']= $this->Main_Model->getBank();
		$this->load->view('list_bank', $data);
	}

	public function edit_bank()
	{
		$bank_id=$this->input->post("bank_id");
		$data['result']= $this->Main_Model->get_single_bank($bank_id);
		$this->load->view('edit_bank', $data);
	}

	public function update_bank()
	{
		$bank_id=$this->input->post('bank_id');
		$data=[
			'bank_name'=>$this->input->post('bank_name'),
			'bank_detail'=>$this->input->post('bank_detail')
		];
		$update=$this->Main_Model->updateBank($bank_id, $data);
		if($update)
		{
			$this->session->set_flashdata('success', 'Bank Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_bank');
	}

	public function delete_bank()
	{
		$bank_id=$this->input->post('bank_id');
		$delete = $this->Main_Model->deleteBank($bank_id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Bank deleted successfully');
		}
		else{
			$this->session->set_flashdata('error','Bank not deleted, Error');			
		}
		redirect(base_url().'Welcome/list_bank');
	}

	/*===========================List bank End ==========================*/

	/*===========================  Expense Start ==========================*/
	public function ad_expense()
	{
		
		$this->load->view('ad_expense');
	}
	
	public function save_expense()
	{
		$data=[
			'heading'=>$this->input->post('heading'),
			'amount'=>$this->input->post('amount'),
			'detail'=>$this->input->post('detail')
		];	

		$save=$this->Main_Model->saveExpense($data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/list_expense');

	}
	
	public function list_expense()
	{
		$data['result']= $this->Main_Model->getExpense();
		$this->load->view('list_expense', $data);
	}

	public function edit_expense()
	{
		$exp_id=$this->input->post("exp_id");
		$data['result']= $this->Main_Model->get_single_expense($exp_id);
		$this->load->view('edit_expense', $data);
	}

	public function update_expense()
	{
		$exp_id=$this->input->post('exp_id');
		$data=[
			'heading'=>$this->input->post('heading'),
			'amount'=>$this->input->post('amount'),
			'detail'=>$this->input->post('detail')
		];
		$update=$this->Main_Model->updateExpense($exp_id, $data);
		if($update)
		{
			$this->session->set_flashdata('success', 'Expense Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_expense');
	}

	public function delete_expense()
	{
		$exp_id=$this->input->post('exp_id');
		$delete = $this->Main_Model->deleteExpense($exp_id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Expense deleted successfully');
		}
		else{
			$this->session->set_flashdata('error','Bank not deleted, Error');			
		}
		redirect(base_url().'Welcome/list_expense');
	}

	/*===========================Expense End ==========================*/

	/*===========================  Expense Start ==========================*/
	public function ad_income()
	{
		
		$this->load->view('ad_income');
	}
	
	public function save_income()
	{
		$data=[
			'heading'=>$this->input->post('heading'),
			'amount'=>$this->input->post('amount'),
			'detail'=>$this->input->post('detail')
		];	

		$save=$this->db->insert('income',$data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Successfully Added');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/list_income');

	}
	
	public function list_income()
	{
		$data['result']= $this->Main_Model->getIncome();
		$this->load->view('list_income', $data);
	}

	public function edit_income()
	{
		$inc_id=$this->input->get("inc_id");
		$data['result']= $this->Main_Model->get_single_income($inc_id);
		$this->load->view('edit_income', $data);
	}

	public function update_income()
	{
		$inc_id=$this->input->post('inc_id');
		$data=[
			'heading'=>$this->input->post('heading'),
			'amount'=>$this->input->post('amount'),
			'detail'=>$this->input->post('detail')
		];
		$update=$this->Main_Model->updateIncome($inc_id, $data);
		if($update)
		{
			$this->session->set_flashdata('success', 'Income Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_income');
	}

	public function delete_income()
	{
		$inc_id=$this->input->get('inc_id');
		$delete = $this->Main_Model->deleteIncome($inc_id);
		if($delete)
		{			
			$this->session->set_flashdata('error','Income Deleted Successfully');
		}
		else{
			$this->session->set_flashdata('error','Not deleted, Error');			
		}
		redirect(base_url().'Welcome/list_income');
	}

	/*===========================Expense End ==========================*/

	public function register()
	{ 
		$data['roles']= $this->Main_Model->getRoles();
		$this->load->view('register', $data);
	}

	public function edit_user()
	{
		$user_id=$this->input->post("user_id");
		$data['user']= $this->Main_Model->get_single_user($user_id);
		$this->load->view('edit_user', $data);
	}	

	public function manage_users()
	{
		$data['result']= $this->Main_Model->get_users();
		$this->load->view('manage_users', $data);
	}
	
	public function reports()
	{
		$this->load->view('reports/reports');
		//$this->load->view('errors/html/error_general',['heading'=>"Page Under Construction",'message'=>"Kindly Check back within 48 hrs"]);
	}

	public function profile()
	{
		$this->load->view('profile');
	}

	public function change_password()
	{
		$this->load->view('change_password');
	}

	public function app_data()
	{
		$data['result']= $this->Main_Model->appData();
		$this->load->view('app_data', $data);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function change_pas()
	{
		$user_id=$this->session->userdata('user_id');
		$email=$this->session->userdata('email');
		$cpassword=$this->input->post("npassword");
		$cnpassword=$this->input->post("cnpassword");
		
		if($password==$cpassword)
		{
			//$update=$this->Main_Model->updatePas($cnpassword, $user_id);
			$q=$this->db->query("UPDATE members SET password='md5($cnpassword)' WHERE email = '$email'");
			
			if($q)
			{
				$this->session->set_flashdata('success', 'Password Changed Successfully');
				redirect(base_url().'Welcome/change_password');
				var_dump($q);
			}
			else{
				$this->session->set_flashdata('error', 'Password Not Changed, Error');
				redirect(base_url().'Welcome/change_password');
			}			
			
		}

		else{
			$this->session->set_flashdata('error', 'Current Password is Not Correct');
			redirect(base_url().'Welcome/change_password');	
		}
	}

	/*===========================Login Start ==========================*/
	public function login()
	{
		$email=$this->input->post("email");
		$password=$this->input->post("password");
		$result=$this->Main_Model->checkUser($email,$password);
		
		if($result->num_rows()>0)
		{
			$data = $result->row_array();
			$user_id = $data['memberID'];
			//$type = $data['type'];
			$name = $data['username'];
			//$phone = $data['phone'];
			$email = $data['email'];
			$pic = $data['pic'];
			//$detail = $data['detail'];

			$sesdata = array(
				'user_id' =>$user_id,
				//'type' =>$type,
				'name' =>$name,
				//'phone' =>$phone,
				'email' =>$email,
				'pic' =>$pic,
				//'detail' =>$detail
			);

			$this->session->set_userdata($sesdata);
			redirect(base_url().'Welcome/dashboard');
		}

		else{
			redirect(base_url().'Welcome/index');
		}
	}
	/*===========================Login End ==========================*/	

	/*===========================Save User start==========================*/
	public function save_user()
	{
		// ==== upload image =====
		$config['upload_path']           = './assets/uploads/profile';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 0;
		$config['min_size']            = 0;
		$config['max_width']            =0;
		$config['max_height']           = 0;
		$config['min_width']            = 0;
		$config['min_height']           = 0;
		$config['overwrite']           = TRUE;
		$config['file_name']           = 'user-'.time() ;
		$this->load->library('upload', $config);
		$done=$this->upload->do_upload('pic');
		if(!$done){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata("error","Error in Upload Picture");
		}
		
		$upload_data = $this->upload->data();
		$file_name = $upload_data['file_name'];
		$data=[
			'type'=>$this->input->post('type'),
			'username'=>$this->input->post('name'),			
			'phone'=>$this->input->post('phone'),
			'email'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password')),			
			'detail'=>$this->input->post('detail'),			
			'pic'=>$file_name			
		];

		$this->load->model('Main_Model');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		if($this->Main_Model->duplicateUserCheck($email, $phone))
		{
			$this->session->set_flashdata('error', 'Email or Phone Exist Already');
			//echo "<script>alert('Email is Registred Already')</script>";
			redirect(base_url().'Welcome/register');
		}

		else{

			$this->load->model('Main_Model');
			$save=$this->Main_Model->saveUser($data);
			if($save)
			{
				$this->session->set_flashdata('success', 'User Registered Successfully');
			}
			else{
				$this->session->set_flashdata('error', 'Not Saved, Error');
			}
		}
		redirect(base_url().'Welcome/register');

	}
	/*===========================Save User End ==========================*/
	/*=========================== Add customer_payment Start ==========================*/
	public function customer_payment()
	{
		$data['customers']= $this->Main_Model->getCustomer();
		$this->load->view('customer_payment', $data);
	}

	public function save_customer_payment()
	{
		$data=[
			'customer_id'=>$this->input->post('customer_id'),
			'amount'=>$this->input->post('amount'),
			'ref'=>$this->input->post('ref'),
			'detail'=>$this->input->post('detail')
		];	

		$save=$this->db->insert('customer_payment',$data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Successfully Saved');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/customer_payment');

	}

	public function save_customer_payment2()
	{
		$customer_id=$this->input->post('customer_id');
		$data=[
			'customer_id'=>$this->input->post('customer_id'),
			'amount'=>$this->input->post('amount'),
			'ref'=>$this->input->post('ref'),
			'detail'=>$this->input->post('detail')
		];	

		$save=$this->db->insert('customer_payment',$data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Successfully Saved');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Reports/detail_customer/?customer_id='.$customer_id);

	}

	public function list_customer_payment()
	{
		$data['result']= $this->Main_Model->getCustomerPayment();
		$this->load->view('list_customer_payment', $data);
	}

	public function delete_customer_payment()
	{
		$payment_id = $this->input->get('payment_id');
		$delete=$this->db->query("DELETE FROM customer_payment WHERE payment_id='".$payment_id."'");
		if($delete)
		{
			$this->session->set_flashdata('success', 'Successfully Deleted');
		}
		else{
			$this->session->set_flashdata('error', 'Not Deleted, Error');
		}
		redirect(base_url().'Welcome/list_customer_payment');		
	}

	public function edit_customer_payment()
	{
		$payment_id = $this->input->get('payment_id');
		$data['customers'] = $this->Main_Model->getCustomer();
		$data['payment'] = $this->Main_Model->getSinglePayment($payment_id);
		//$data['payment']= $this->db->query("SELECT * FROM customer_payment WHERE payment_id='".$payment_id."'");
		$this->load->view('edit_customer_payment', $data);
	}

	public function update_customer_payment()
	{
		$payment_id=$this->input->post('payment_id');
		$data=[
			'customer_id'=>$this->input->post('customer_id'),
			'amount'=>$this->input->post('amount'),
			'ref'=>$this->input->post('ref'),
			'detail'=>$this->input->post('detail')
		];	
		$update=$this->Main_Model->updateCustomerPayment($payment_id, $data);
		if($update)
		{
			$this->session->set_flashdata('success', 'Payment Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_customer_payment');
	}

	public function supplier_payment()
	{
		$data['suppliers']= $this->Main_Model->getSupplier();
		$this->load->view('supplier_payment', $data);
	}

	public function save_supplier_payment()
	{
		$data=[
			'supplier_id'=>$this->input->post('supplier_id'),
			'amount'=>$this->input->post('amount'),
			'ref'=>$this->input->post('ref'),
			'detail'=>$this->input->post('detail')
		];	

		$save=$this->db->insert('supplier_payment',$data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Successfully Saved');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/supplier_payment');

	}

	public function save_supplier_payment2()
	{
		$supplier_id=$this->input->post('supplier_id');
		$data=[
			'supplier_id'=>$this->input->post('supplier_id'),
			'amount'=>$this->input->post('amount'),
			'ref'=>$this->input->post('ref'),
			'detail'=>$this->input->post('detail')
		];	

		$save=$this->db->insert('supplier_payment',$data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Successfully Saved');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Reports/detail_supplier/?supplier_id='.$supplier_id);

	}

	public function list_supplier_payment()
	{
		$data['result']= $this->Main_Model->getSupplierPayment();
		$this->load->view('list_supplier_payment', $data);
	}

	public function delete_supplier_payment()
	{
		$payment_id = $this->input->get('payment_id');
		$delete=$this->db->query("DELETE FROM supplier_payment WHERE payment_id='".$payment_id."'");
		if($delete)
		{
			$this->session->set_flashdata('success', 'Successfully Deleted');
		}
		else{
			$this->session->set_flashdata('error', 'Not Deleted, Error');
		}
		redirect(base_url().'Welcome/list_supplier_payment');		
	}

	public function edit_supplier_payment()
	{
		$payment_id = $this->input->get('payment_id');
		$data['suppliers'] = $this->Main_Model->getSupplier();
		$query= $this->db->query("SELECT * FROM supplier_payment as p JOIN supplier as s ON s.supplier_id= p.supplier_id WHERE p.payment_id='".$payment_id."'");
		$data['payment'] = $query->result_array();
		$this->load->view('edit_supplier_payment', $data);
	}

	public function update_supplier_payment()
	{
		$payment_id=$this->input->post('payment_id');
		$data=[
			'supplier_id'=>$this->input->post('supplier_id'),
			'amount'=>$this->input->post('amount'),
			'ref'=>$this->input->post('ref'),
			'detail'=>$this->input->post('detail')
		];	
		$update=$this->Main_Model->updateSupplierPayment($payment_id, $data);
		if($update)
		{
			$this->session->set_flashdata('success', 'Payment Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_supplier_payment');
	}

	/*=========================== receiving_customer End ==========================*/

	/*===========================Delete User start==========================*/
	public function delete_user()
	{
		$user_id=$this->input->post('user_id');
		$delete = $this->Main_Model->deleteUser($user_id);
		if($delete)
		{
			
			$this->session->set_flashdata('error','User deleted successfully');
			redirect(base_url().'Welcome/manage_users');
		}
		else{
			$this->session->set_flashdata('error','User not deleted, Error');
			redirect(base_url().'Welcome/manage_users');
		}
	}


	/*===========================Save User start==========================*/
	public function update_user()
	{
		// ==== upload image =====
		 $config['upload_path']           = './assets/uploads/profile';
		 $config['allowed_types']        = 'jpg|png|jpeg';
		 $config['max_size']             = 0;
		 $config['min_size']            = 0;
		 $config['max_width']            =0;
		 $config['max_height']           = 0;
		 $config['min_width']            = 0;
		 $config['min_height']           = 0;
		 $config['overwrite']           = TRUE;
		 $config['file_name']           = 'user-'.time() ;
		 $this->load->library('upload', $config);
		 $done=$this->upload->do_upload('pic');
		 if(!$done){
		 	$error = array('error' => $this->upload->display_errors());
		 	$this->session->set_flashdata("error","Error in Upload Picture");
		 }
		
		 $upload_data = $this->upload->data();
	     $file_name = $upload_data['file_name'];
		$user_id=$this->input->post('user_id');
		$data=[
			'type'=>$this->input->post('type'),
			'username'=>$this->input->post('name'),			
			'phone'=>$this->input->post('phone'),
			'email'=>$this->input->post('email'),
			'password'=>$this->input->post('password'),
			'detail'=>$this->input->post('detail'),
			'pic'=>$file_name			
		];

		// $this->load->model('Main_Model');
		// $email=$this->input->post('email');
		// $phone=$this->input->post('phone');
		// if($this->Main_Model->duplicateUserCheck($email, $phone))
		// {
		// 	$this->session->set_flashdata('error', 'Email or Phone Exist Already');
		// 	//echo "<script>alert('Email is Registred Already')</script>";
		// 	redirect(base_url().'Welcome/edit_driver');
		// }

		// else{

		$this->load->model('Main_Model');
		$save=$this->Main_Model->updateUser($user_id, $data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}
		//}
		redirect(base_url().'Welcome/manage_users');
	}

	
	public function save_sale()
	{
		$data=[
			'date'=>$this->input->post('date'),
			'customer_id'=>$this->input->post('customer_id'),
			'sale_amount'=>array_sum($this->input->post('total')),
			'inv_discount'=>$this->input->post('invoice_discount'),
			'paid'=>$this->input->post('paid'),
			'due'=>$this->input->post('due'),
			'due_promise'=>$this->input->post('due_promise'),
			'invoice_note'=>$this->input->post('invoice_note')
		];	
		$insert= $this->db->insert('sale', $data);
		$id = $this->db->insert_id();
		if ($insert) {
			$i = 0;
			$type = $this->input->post('sale_type');
			foreach($this->input->post('product_id') as $row){
				$data1['sale_id'] = $id;
				$data1['product_id'] = $this->input->post('product_id')[$i];
				$data1['selling_price'] = $this->input->post('price')[$i];
				$data1['qty'] = $this->input->post('qty')[$i];
				$data1['discount'] = $this->input->post('discount')[$i];
				$data1['total'] = $this->input->post('total')[$i];
				$this->db->insert("sale_detail",$data1);
				$i++;
			}
			$this->session->set_flashdata('success', 'Added Successfully');			
		}
		else{
			$this->session->set_flashdata('error', 'Not Added, Error');
		}
		redirect(base_url().'Welcome/invoice?sale_id='.$id);
	}

	public function save_vehicle_sale()
	{
		$data=[
			'date'=>$this->input->post('date'),
			'customer_id'=>$this->input->post('customer_id'),
			'sale_type'=>$this->input->post('sale_type'),
			'sale_amount'=>array_sum($this->input->post('total')),
			'inv_discount'=>$this->input->post('invoice_discount'),
			'paid'=>$this->input->post('paid'),
			'due'=>$this->input->post('due'),
			'is_vehicle_sale' =>1
		];	
		$insert= $this->db->insert('sale', $data);
		$id = $this->db->insert_id();
		if ($insert) {
			$i = 0;
			$type = $this->input->post('sale_type');
			foreach($this->input->post('product_id') as $row){
				$data1['sale_id'] = $id;
				$data1['product_id'] = $this->input->post('product_id')[$i];
				if ($type =='Whole Sale') {
					$data1['selling_price'] = $this->input->post('w_price')[$i];
				}
				if ($type =='Local Sale') {
					$data1['selling_price'] = $this->input->post('l_price')[$i];
				}
				$data1['qty'] = $this->input->post('qty')[$i];
				$data1['discount'] = $this->input->post('discount')[$i];
				$data1['total'] = $this->input->post('total')[$i];
				$this->db->insert("sale_detail",$data1);
				$i++;
			}
			$this->session->set_flashdata('success', 'Added Successfully');			
		}
		else{
			$this->session->set_flashdata('error', 'Not Added, Error');
		}
		redirect(base_url().'Welcome/invoice?sale_id='.$id);
	}

	public function vehicle_in()
	{
		$data=[
			'date'=>$this->input->post('date')
		];	
		$insert= $this->db->insert('vehicle_in', $data);
		$id = $this->db->insert_id();
		if ($insert) {
			$i = 0;
			foreach($this->input->post('product_id') as $row){
				$data1['vehicle_in_id'] = $id;
				$data1['product_id'] = $this->input->post('product_id')[$i];
				$data1['qty'] = $this->input->post('qty')[$i];
				$this->db->insert("vehicle_in_detail",$data1);
				$i++;
			}
			$this->session->set_flashdata('success', 'Added Successfully');			
		}
		else{
			$this->session->set_flashdata('error', 'Not Added, Error');
		}
		redirect(base_url().'Welcome/invoice_vehicle?vehicle_in_id='.$id);
	}

	public function save_purchase()
	{
		$data=[
			'date'=>$this->input->post('date'),
			'supplier_id'=>$this->input->post('supplier_id'),
			'purchase_amount'=>array_sum($this->input->post('total'))
		];	
		$insert= $this->db->insert('purchase', $data);
		$id = $this->db->insert_id();
		if ($insert) {
			$i = 0;
			foreach($this->input->post('product_id') as $row){
				$data1['purchase_id'] = $id;
				$data1['product_id'] = $this->input->post('product_id')[$i];
				$data1['purchase_price'] = $this->input->post('purchase_price')[$i];
				$data1['qty'] = $this->input->post('qty')[$i];
				$data1['total'] = $this->input->post('total')[$i];
				$this->db->insert("purchase_detail",$data1);
				$i++;
			}
			$this->session->set_flashdata('success', 'Added Successfully');			
		}
		else{
			$this->session->set_flashdata('error', 'Not Added, Error');
		}
		redirect(base_url().'Welcome/ad_purchase');
	}

	public function stock()
	{
		$data['result']= $this->Main_Model->getStock();
		$this->load->view('stock', $data);
	}

	public function vehicle_stock()
	{
		$data['result']= $this->Main_Model->getVehicleStock();
		$this->load->view('vehicle_stock', $data);
	}

	/*******************************************************************/
	/*						Start for backup create  				   */
	/*******************************************************************/
	public function create_backup()
	{
		/***  Check user login or not ***/ 
		if($this->session->userdata('user_id') && !empty($this->session->userdata('user_id')))
		{
			$this->load->dbutil();
			$conf = array(
				'format' => 'zip',
				'filename' => 'database-backup.sql'
			);
			$backup = $this->dbutil->backup($conf);
			$this->load->helper('download');
			force_download('database-backup.zip', $backup);
		}else{ 
			redirect(base_url());
		}

	}
	/*******************************************************************/
	/*					    	END for backup create  		  		   */
	/*******************************************************************/

	public function update_profile()
	{
		$data = array();
	// echo '<pre>';
	// print_r($_FILES);
	// die;
		if($this->input->post('user_id') && !empty($this->input->post('user_id')))
		{
			$logo_file_name = '';
			if(isset($_FILES['pic']['name']) && !empty($_FILES['pic']['name']))
			{
				$config['upload_path'] = './assets/uploads/profile';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = 5024;
				$config['encrypt_name'] = true;  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('pic')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata("error","Error in Uploading Logo");
				} else {
					$fileData = $this->upload->data();
				// $data['logo'] = $fileData['file_name'];
					$logo_file_name =  $fileData['file_name'];
				}  
			}else{
				$logo_file_name = $this->input->post('hidden_pic');
			}

			$user_id = $this->input->post('user_id');
			$data['username']= $this->input->post('name');
			//$data['phone']=$this->input->post('phone');
			$data['email']=$this->input->post('email');
			//$data['detail']=$this->input->post('detail');
			$data['pic'] = $logo_file_name;
		// print_r($data);
		// die();
		//$update=$this->db->update('register', $data);
		//$this->db->where('user_id', $user_id);
			$update = $this->Main_Model->updateProfile($user_id, $data);
			if($update)
			{
				$this->session->set_flashdata('success', 'Data Update Successfully');
			}
			else{
				$this->session->set_flashdata('error', 'Data Not Update, Error');
			}

		}else{
			$config['upload_path'] = './assets/uploads/profile';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size'] = 5024;
			$config['encrypt_name'] = true;  

			$this->load->library('upload', $config);

			$data['name']= $this->input->post('name');
			$data['phone']=$this->input->post('phone');
			$data['email']=$this->input->post('email');
			$data['detail']=$this->input->post('detail');

			if (!$this->upload->do_upload('pic')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata("error","Error in Uploading Logo");
			} else {
				$fileData = $this->upload->data();
				$data['pic'] = $fileData['file_name'];
			}

		// print_r($data);
		// die();
			$save=$this->db->insert('register', $data);
			if($save)
			{
				$this->session->set_flashdata('success', 'Data Saved Successfully');
			}
			else{
				$this->session->set_flashdata('error', 'Data Not Saved, Error');
			}

		}	
				// ==== upload Logo =====


		redirect(base_url().'Welcome/profile');
	}
	
	/*******************************************************************/
	/*						Start for Save app data 				   */
	/*******************************************************************/


	public function save_settings()
	{
		$data = array();
	// echo '<pre>';
	// print_r($_FILES);
	// die;
		if($this->input->post('hidden_setting') && !empty($this->input->post('hidden_setting')))
		{
			$logo_file_name = '';
			$favicon_file_name = '';
			if(isset($_FILES['logo']['name']) && !empty($_FILES['logo']['name']))
			{
				$config['upload_path'] = './assets/uploads/company';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = 5024;
				$config['encrypt_name'] = true;  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('logo')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata("error","Error in Uploading Logo");
				} else {
					$fileData = $this->upload->data();
				// $data['logo'] = $fileData['file_name'];
					$logo_file_name =  $fileData['file_name'];
				}  
			}else{
				$logo_file_name = $this->input->post('hidden_website_logo');
			}
			if(isset($_FILES['favicon']['name']) && !empty($_FILES['favicon']['name']))
			{
				$config['upload_path'] = './assets/uploads/company';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = 5024;
				$config['encrypt_name'] = true;  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('favicon')) {
					$error = array('error' => $this->upload->display_errors()); 
				} else {
					$fileData = $this->upload->data();
				// $data['favicon'] =  = $fileData['file_name'];
					$favicon_file_name = $fileData['file_name'];
				}

			}else{
				$favicon_file_name = $this->input->post('hidden_favicon_logo');
			}

			$data['id'] = $this->input->post('hidden_setting');
			$data['app_name']= $this->input->post('app_name');
			$data['app_phone']=$this->input->post('app_phone');
			$data['app_phone2']=$this->input->post('app_phone2');
			$data['app_phone3']=$this->input->post('app_phone3');
			$data['app_email']=$this->input->post('app_email');	
			$data['app_address']=$this->input->post('app_address');
			$data['logo'] = $logo_file_name;
			$data['favicon'] = $favicon_file_name;

		// print_r($data);
		// die();
			$save=$this->db->update('app_data', $data);
			if($save)
			{
				$this->session->set_flashdata('success', 'Data Update Successfully');
			}
			else{
				$this->session->set_flashdata('error', 'Data Not Update, Error');
			}

		}else{
			$config['upload_path'] = './assets/uploads/company';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size'] = 5024;
			$config['encrypt_name'] = true;  

			$this->load->library('upload', $config);

			$data['app_name']= $this->input->post('app_name');
			$data['app_phone']=$this->input->post('app_phone');
			$data['app_phone2']=$this->input->post('app_phone2');
			$data['app_phone3']=$this->input->post('app_phone3');
			$data['app_email']=$this->input->post('app_email');	
			$data['app_address']=$this->input->post('app_address');

			if (!$this->upload->do_upload('logo')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata("error","Error in Uploading Logo");
			} else {
				$fileData = $this->upload->data();
				$data['logo'] = $fileData['file_name'];
			}

			if (!$this->upload->do_upload('favicon')) {
				$error = array('error' => $this->upload->display_errors()); 
			} else {
				$fileData = $this->upload->data();
				$data['favicon'] = $fileData['file_name'];
			}
		// print_r($data);
		// die();
			$save=$this->db->insert('app_data', $data);
			if($save)
			{
				$this->session->set_flashdata('success', 'Data Saved Successfully');
			}
			else{
				$this->session->set_flashdata('error', 'Data Not Saved, Error');
			}

		}	
				// ==== upload Logo =====


		redirect(base_url().'Welcome/app_data');
	}



	public function save_app_data()
	{
		date_default_timezone_set('Asia/Karachi'); 
		
		$data=[
			'app_name' => $this->input->post('app_name') && !empty($this->input->post('app_name'))?$this->input->post('app_name'):'-',
			'app_phone'=> $this->input->post('app_phone') && !empty($this->input->post('app_phone'))?$this->input->post('app_phone'):'0',
			'phone2' => $this->input->post('phon2') && $this->input->post('phon2')?$this->input->post('phon2'):'00',
			'phone3'=> $this->input->post('phon3') && !empty($this->input->post('phon3'))?$this->input->post('phon3'):'0',
			'app_email'=>$this->input->post('app_email') && !empty($this->input->post('app_email'))?$this->input->post('app_email'):'-',
			'logo'=>isset($_FILES['logo']['tmp_name']) && !empty($_FILES['logo']['tmp_name'])?$_FILES['logo']['tmp_name']:'',
			'back_path'=>isset($_FILES['back_path']['tmp_name']) && !empty($_FILES['back_path']['tmp_name'])?$_FILES['back_path']['tmp_name']:'-',
			'app_address'=>$this->input->post('app_address') && !empty($this->input->post('app_address'))?$this->input->post('app_address'):'-',
			'time'=>date('Y-m-d h:i:s a') 
		];	 
		$save=$this->db->insert('app_data',$data);
		if($save)
		{
			$this->session->set_flashdata('success', 'Successfully Saved');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/dashboard');
	}
	
	/*******************************************************************/
	/*						 End for Save app data 					   */
	/*******************************************************************/ 


	/*=========================== Add customer Start ==========================*/
	public function ad_contact_book()
	{
		$this->load->view('ad_contact_book');
	}

	public function save_contact_book()
	{
		$data = array();
				// ==== upload Logo =====
		$config['upload_path'] = './assets/uploads/contact_book';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 5024;
		$config['encrypt_name'] = true;  

		$this->load->library('upload', $config);

		$data['name']= $this->input->post('name');
		$data['contact']= $this->input->post('contact');
		$data['contact2']=$this->input->post('contact2');
		$data['contact3']= $this->input->post('contact3');
		$data['whatsapp_no']=$this->input->post('whatsapp_no');
		$data['detail']=$this->input->post('detail');


		if (!$this->upload->do_upload('picture')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata("error","Error in Uploading Logo");
		} else {
			$fileData = $this->upload->data();
			$data['picture'] = $fileData['file_name'];
		}

		$save=$this->db->insert('contact_book', $data);

		if($save)
		{
			$this->session->set_flashdata('success', 'Data Saved Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Data Not Saved, Error');
		}

		redirect(base_url().'Welcome/list_contact_book');
	}

	public function list_contact_book()
	{
		$data['result']= $this->Main_Model->getContactBook();
		$this->load->view('list_contact_book', $data);
	}

	public function edit_contact_book()
	{
		$id=$this->input->get("id");
		$data['result']= $this->Main_Model->get_single_Cb($id);
		$this->load->view('edit_contact_book', $data);
	}

	public function update_contact_book()
	{
		$id=$this->input->post("id");
		$data=[
			'name'=>$this->input->post('name'),
			'contact'=>$this->input->post('contact'),
			'contact2'=>$this->input->post('contact2'),
			'contact'=>$this->input->post('contact3'),
			'whatsapp_no'=>$this->input->post('whatsapp_no'),			
			'detail'=>$this->input->post('detail')
		];
		
		$update=$this->Main_Model->updateCb($id, $data);
		
		if($update==True)
		{
			$this->session->set_flashdata('success', 'Updated Successfully');
		}
		else{
			$this->session->set_flashdata('error', 'Not Updated, Error');
		}

		redirect(base_url().'Welcome/list_contact_book');
	}

	public function delete_contact_book()
	{
		$id=$this->input->get('id');
		$delete = $this->db->query("DELETE FROM contact_book WHERE id='".$id."'");
		if($delete)
		{			
			$this->session->set_flashdata('error','Deleted successfully');
		}
		else{
			$this->session->set_flashdata('error','Not Deleted, Error');			
		}
		redirect(base_url().'Welcome/list_contact_book');
	}


	/*===========================customer End ==========================*/


	public function detail_staff_attendance()
	{
		$staff_id = $this->input->get("staff_id");
		
		if($data['report'] = $this->Main_Model->getStaffAttendance($staff_id))
		{
			$data['staff']= $this->Main_Model->get_single_staff($staff_id);
			$this->load->view('detail_staff_attendance', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Welcome/detail_staff_attendance');
		}			
		
	}

	public function detail_staff_payroll()
	{
		$staff_id = $this->input->get("staff_id");
		
		if($data['report'] = $this->Main_Model->getStaffPayroll($staff_id))
		{
			$data['staff']= $this->Main_Model->get_single_staff($staff_id);
			$this->load->view('detail_staff_payroll', $data);
		}
		else{
			$this->session->set_flashdata('error', 'Not Record Found');
			redirect(base_url().'Welcome/detail_staff_payroll');
		}			
		
	}

	public function roles()
	{
		$data['roles']= $this->Main_Model->getRoles();
		$this->load->view('roles', $data);
	}

	public function delete_role()
	{
		$role_id=$this->input->get("role_id");
		$delete = $this->Main_Model->deleteRole($role_id);
		if($delete)
		{			
			$this->session->set_flashdata('error', 'Role Deleted successfully');
		}
		else{
			$this->session->set_flashdata('error','Role not deleted, Error');			
		}
		redirect(base_url().'Welcome/roles');
	}

	public function save_role()
	{
		$data=[
			'role_name'=>$this->input->post('role_name'),
			'role_note'=>$this->input->post('role_note')
		];	
		
		$save= $this->db->insert('roles', $data);		

		if($save=1)
		{
			$this->session->set_flashdata('success', 'Successfully Added');
		}
		else{
			$this->session->set_flashdata('error', 'Not Saved, Error');
		}
		redirect(base_url().'Welcome/roles');

	}

	public function role_permisions()
	{
		$role_id=$this->input->get('role_id');
		$data=array();
			$data['role']= $this->Main_Model->get_single_role($role_id);
		
		$data['modules']= $this->Main_Model->getModules();	

		foreach ($data['modules'] as $sb) {
			$module_id = $sb['module_id'];

			$data['sub_module'][]= $this->Main_Model->get_sub_modules($module_id);
						
		} 
		//$data['sub_module'] =$sub_data_array;
		// echo "<pre>";
		// print_r($data['sub_module']);
		// die();
		$this->load->view('role_permisions', $data);
	}
	
	//Airtime to Cash 
	public function airtime_cash()
	{
	    $data['data'] = $this->Main_Model->getAirtime(0);
	    $this->load->view('list_air_cash',$data);
	}
	public function approve_air(){
	    $id = $this->input->get('id');
	    $data = ['status' => 1 ];
	    $query = $this->Main_Model->approveAirtime($id,$data);
	    if($query){
	        $this->session->set_flashdata('success', 'Successfully Approved');
	        redirect(base_url().'Welcome/airtime_cash');
	    }else{
	        $this->session->set_flashdata('error', 'Unable to Approve now');
	        redirect(base_url().'Welcome/airtime_cash');
	    }
	}

}
