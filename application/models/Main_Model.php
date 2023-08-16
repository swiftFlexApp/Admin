<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Model extends CI_Model {

	function appData(){
		$this->db->select('*');
		$this->db->from('app_data');
		$query = $this->db->get(); 
		$result = $query->result_array();
		return $result;
	}

	function vInvoice($vehicle_in_id)
	{
		$this->db->select('*');
		$this->db->from('vehicle_in_detail as v');
		$this->db->join('vehicle_in as vi', 'vi.vehicle_in_id = v.vehicle_in_id');
		$this->db->join('product as p', 'p.product_id = v.product_id');
		$this->db->where('v.vehicle_in_id', $vehicle_in_id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

// ========== Finance Report ==========

	function agent_report()
	{
		$this->db->select("t.amount, a.fee");
		$this->db->from("transactions as t");
		$this->db->join('agent_fees as a','t.agent_id = a.user_id');
		$this->db->where("t.agent_id IS NOT NULL",null,false);
		$query = $this->db->get();
		return $query->result_array();
	}

// ========== Withdrawal Request ========

	function getWithdrawalRequests($type)
	{
		$this->db->select("t.*, u.fname , u.lname");
		$this->db->from("transfer_request as t");
		$this->db->join("users as u", "t.user_id = u.id");
		$this->db->where("transfer_status", $type);
		$query = $this->db->get();
		return $query->result_array();
	}

	function getWithdrawalRequest($id)
	{
		$this->db->select("*");
		$this->db->from("transfer_request");
		$this->db->where("id", $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function updateTransfer($id, $data)
	{
		$this->db->where('id', $id);
		$result = $this->db->update('transfer_request', $data);
		return $result;
	}

// ========== Business ==============

	function saveBusiness($data)
	{
		$insert= $this->db->insert('users', $data);
		return $insert;
	}

	function getBusiness()
	{
		$this->db->select('*');          
		$this->db->from('users');
		$this->db->join('account_balance','users.id = account_balance.user_id');
		$this->db->where('account', 2); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_single_business($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('account_balance as a','users.id = a.user_id');
		//$this->db->where('users.account', 2); 
		$this->db->where('users.id', $id); 
		$query = $this->db->get();
		$result = $query->result_array();
		log_message('error',json_encode($result));
		return $result;
	}

	function updateBusiness($business_id, $data, $amount)
	{
		
		$this->db->where('id', $business_id);
		$result = $this->db->update('users', $data);
		return $result;
	}

	function updateProfile($user_id, $data)
	{
		
		$this->db->where('memberID', $user_id);
		$result = $this->db->update('members', $data);
		return $result;
	}

	function deleteSupplier($supplier_id)
	{
		$query=$this->db->query("DELETE FROM supplier WHERE supplier_id='".$supplier_id."'");
		return $query;
	}
	

// ========== Supplier ==============

// ========== Staff ==============

	function saveStaff($data)
	{
		$insert= $this->db->insert('staff', $data);
		return $insert;
	}

	function getStaff()
	{
		$this->db->select('*');          
		$this->db->from('staff');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_single_staff($staff_id)
	{
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where('staff_id', $staff_id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function updateStaff($staff_id, $data)
	{
		$this->db->where('staff_id', $staff_id);
		$result = $this->db->update('staff', $data);
		return $result;
	}

	function deleteStaff($staff_id)
	{
		$query=$this->db->query("DELETE FROM staff WHERE staff_id='".$staff_id."'");
		return $query;
	}

	function getAttendance()
	{
		$this->db->select('*');          
		$this->db->from('attendance');
		$this->db->join('staff', 'staff.staff_id=attendance.staff_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getPaidSalary()
	{
		$query = $this->db->query("
			SELECT * FROM salary as s
			LEFT JOIN staff as f ON f.staff_id = s.staff_id
			");
		return $query->result_array();
	}

	function getTotalPaidSalary()
	{
		$this->db->select('sum(total_salary) as paid');          
		$this->db->from('salary');
		$query = $this->db->get();
		return $query->result_array();
	}
	// ========== Customer Receiving Start ==============

	function saveRcustomer($data)
	{
		$insert= $this->db->insert('receiving_customer', $data);
		return $insert;
	}

	// ========== Receiving End ==============


	// ========== Customer ==============

	function saveCustomer($data)
	{
		$insert= $this->db->insert('customer', $data);
		return $insert;
	}

	function getIndividuals()
	{
		$this->db->select('*');          
		$this->db->from('users as u');
		$this->db->join('account_balance as a', 'u.id = a.user_id');
		$this->db->where('u.account', 1); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getNewlyRegistered(){
	    $result = $this->db->query('SELECT COUNT(id) AS count FROM users WHERE date >= NOW() - INTERVAL 1 DAY');
	    return $result->result_array();
	}



	function get_single_individual($id)
	{
		$this->db->select('*');          
		$this->db->from('users as u');
		$this->db->join('account_balance as a', 'u.id = a.user_id');
		//$this->db->where('u.account', 1); 
		$this->db->where('u.id', $id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function updateIndividual($id, $data, $balance)
	{
		
		$this->db->where('id', $id);
		$result = $this->db->update('users', $data);
		if($result){
			$this->db->where('user_id', $id);
			$result = $this->db->update('account_balance',$balance);
		}
		return $result;
	}

	function lockIndividual($id)
	{
		$query=$this->db->query("UPDATE users SET verify='4' WHERE id='".$id."'");
		return $query;
	}
	function unlockAccount($id)
	{
		$query=$this->db->query("UPDATE users SET verify='0' WHERE id='".$id."'");
		return $query;
	}

	function getCustomerPayment()
	{
		$this->db->select('*');          
		$this->db->from('customer_payment as p');
		$this->db->join('customer as c', 'c.customer_id = p.customer_id');
		$query = $this->db->get();
		return $query->result_array();		
	}

	function getSupplierPayment()
	{
		$this->db->select('*');          
		$this->db->from('supplier_payment as p');
		$this->db->join('supplier as s', 's.supplier_id = p.supplier_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getSinglePayment($payment_id)
	{
		$this->db->select('*');          
		$this->db->from('customer_payment as p');
		$this->db->join('customer as c', 'c.customer_id = p.customer_id');
		$this->db->where('p.payment_id', $payment_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function updateCustomerPayment($payment_id, $data)
	{
		
		$this->db->where('payment_id', $payment_id);
		$result = $this->db->update('customer_payment', $data);
		return $result;
	}

	function updateSupplierPayment($payment_id, $data)
	{
		
		$this->db->where('payment_id', $payment_id);
		$result = $this->db->update('supplier_payment', $data);
		return $result;
	}

// ========== Customer ==============

	// // ========== Product ==============
	// function saveProduct($data)
	// {
	// 	$insert= $this->db->insert('product', $data);
	// 	return $insert;
	// }

	function getOrders()
	{
		$this->db->select('*');          
		$this->db->from('orders');
		$this->db->join('customer', 'customer.customer_id=orders.customer_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getPosRecord()
	{
		$this->db->select('*');          
		$this->db->from('product');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_single_product($product_id)
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id', $product_id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function updateProduct($product_id, $data)
	{
		
		$this->db->where('product_id', $product_id);
		$result = $this->db->update('product', $data);
		return $result;
	}

	function deleteProduct($product_id)
	{
		$query=$this->db->query("DELETE FROM product WHERE product_id='".$product_id."'");
		return $query;
	}

// ========== Product ==============
function deleteOrder($order_id)
	{
		$query=$this->db->query("DELETE FROM orders WHERE order_id='".$order_id."'");
		return $query;
	}

	function deletePurchase($purchase_id)
	{
		$delete_purchase=$this->db->query("DELETE FROM purchase WHERE purchase_id='".$purchase_id."'");
		$delete_purchase_detail=$this->db->query("DELETE FROM purchase_detail WHERE purchase_id='".$purchase_id."'");
		return $delete_purchase;
		return $delete_purchase_detail;
	}

	function deleteSale($sale_id)
	{
		$delete_sale=$this->db->query("DELETE FROM sale WHERE sale_id='".$sale_id."'");
		$delete_sale_detail=$this->db->query("DELETE FROM sale_detail WHERE sale_id='".$sale_id."'");
		return $delete_sale;
		return $delete_sale_detail;
	}

// ========== Bank ==============

	function saveBank($data)
	{
		$insert= $this->db->insert('bank', $data);
		return $insert;
	}

	function getBank()
	{
		$this->db->select('*');          
		$this->db->from('bank');
		$query = $this->db->get();
		return $query->result_array();
	}

	function updateBank($bank_id, $data)
	{
		
		$this->db->where('bank_id', $bank_id);
		$result = $this->db->update('bank', $data);
		return $result;
	}

	function deleteBank($bank_id)
	{
		$query=$this->db->query("DELETE FROM bank WHERE bank_id='".$bank_id."'");
		return $query;
	}

// ========== Bank ==============

	// ========== Expense ==============

	function saveExpense($data)
	{
		$insert= $this->db->insert('expense', $data);
		return $insert;
	}

	function getExpense()
	{
		$this->db->select('*');          
		$this->db->from('expense');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getIncome()
	{
		$this->db->select('*');          
		$this->db->from('income');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_single_expense($exp_id)
	{
		$this->db->select('*');
		$this->db->from('expense');
		$this->db->where('exp_id', $exp_id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	function get_single_income($inc_id)
	{
		$this->db->select('*');
		$this->db->from('income');
		$this->db->where('inc_id', $inc_id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function updateExpense($exp_id, $data)
	{
		
		$this->db->where('exp_id', $exp_id);
		$result = $this->db->update('expense', $data);
		return $result;
	}

	function updateIncome($inc_id, $data)
	{
		$this->db->where('inc_id', $inc_id);
		$result = $this->db->update('income', $data);
		return $result;
	}


	function deleteExpense($exp_id)
	{
		$query=$this->db->query("DELETE FROM expense WHERE exp_id='".$exp_id."'");
		return $query;
	}

	function deleteIncome($inc_id)
	{
		$query=$this->db->query("DELETE FROM income WHERE inc_id='".$inc_id."'");
		return $query;
	}

// ========== Expense ==============

// ========== Login ==============
	function checkUser($email,$password)
	{
		$this->db->select('*');
		$this->db->from('members');  
		$this->db->where('email' ,$email); 
		$this->db->where('password' ,md5($password));  
		$q = $this->db->get();   

		if($q->num_rows())
		{
			$this->session->set_flashdata('success', 'Your are Loggen in...!!');
			return $q;
		}
		else{
			$this->session->set_flashdata('error', 'Email or Password Not Matched...!!');
			redirect(base_url().'Welcome/index');
		}

	}

	
	/*=========================== User start==========================*/
	function saveUser($data)
	{
		$insert= $this->db->insert('members', $data);
		return $insert;
	}

	function updateUser($user_id, $data)
	{
		
		$this->db->where('memberID', $user_id);
		$result = $this->db->update('members', $data);
		return $result;
	}

	
	function get_users()
	{
		$this->db->select('*');
		$this->db->from('members');
		$this->db->order_by('memberID', 'desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function get_single_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('memberID', $user_id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function get_single_bank($bank_id)
	{
		$this->db->select('*');
		$this->db->from('bank');
		$this->db->where('bank_id', $bank_id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function get_single_sale($sale_id)
	{
		$this->db->select('*');
		$this->db->from('sale');
		$this->db->where('sale_id', $sale_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function get_single_sale_product($sale_id)
	{
		$this->db->select('*');
		$this->db->from('sale_detail as s');
		$this->db->join('product as p', 'p.product_id=s.product_id');
		$this->db->join('sale as i', 'i.sale_id = s.sale_id');
		$this->db->where('s.sale_id', $sale_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function get_single_sale_customer($sale_id)
	{
		$this->db->select('*');
		$this->db->from('customer as c');
		$this->db->join('sale as s', 's.customer_id = c.customer_id');
		$this->db->where('s.sale_id', $sale_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function get_single_sale_bank($sale_id)
	{
		$this->db->select('*');
		$this->db->from('bank as b');
		$this->db->join('sale as s', 's.bank_id = b.bank_id');
		$this->db->where('s.sale_id', $sale_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function get_single_purchase($purchase_id)
	{
		$this->db->select('*');
		$this->db->from('purchase');
		$this->db->where('purchase_id', $purchase_id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function get_single_purchase_product($purchase_id)
	{
		$this->db->select('*');
		$this->db->from('purchase_detail as s');
		$this->db->join('product as p', 'p.product_id=s.product_id');
		$this->db->join('purchase as i', 'i.purchase_id = s.purchase_id');
		//$this->db->join('customer as c', 'c.customer_id = i.customer_id');
		$this->db->where('s.purchase_id', $purchase_id);
		//$this->db->group_by('c.customer_idd'); 
		$query = $this->db->get();
		$result = $query->result_array();
		//$result = $this->db->get()->row_array();
		return $result;
	}
	
	function get_single_purchase_supplier($purchase_id)
	{
		$this->db->select('*');
		$this->db->from('supplier as c');
		$this->db->join('purchase as s', 's.supplier_id = c.supplier_id');
		//$this->db->join('customer as c', 'c.customer_id = i.customer_id');
		$this->db->where('s.purchase_id', $purchase_id);
		//$this->db->group_by('c.customer_idd'); 
		$query = $this->db->get();
		$result = $query->result_array();
		//$result = $this->db->get()->row_array();
		return $result;
	}

	function get_single_purchase_bank($purchase_id)
	{
		$this->db->select('*');
		$this->db->from('bank as b');
		$this->db->join('purchase as p', 'p.bank_id = b.bank_id');
		$this->db->where('p.purchase_id', $purchase_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	function duplicateUserCheck($email, $phone)
	{
		$this->db->select('email');
		$this->db->from('register');  
		$this->db->where('email' ,$email); 
		$this->db->or_where('phone' ,$phone);  
		$q = $this->db->get();   

		if($q->num_rows()>0)
		{
			return true;
		}
		else{
			return false;
		}

	}


	function deleteUser($user_id)
	{
		$query=$this->db->query("DELETE FROM members WHERE memberID='".$user_id."'");
		return $query;
	}

	function updatePas($cnpassword, $user_id)
	{
		$q=$this->db->query("UPDATE members SET password='$cnpassword'  WHERE user_id='$user_id'");
		if ($q) {
			return true;
		}
		else{
			false;
		}
		
	}

	function saveAppData($data)
	{
		$insert= $this->db->insert('app_data', $data);
		return $insert;
	}


	function count_business(){
		$query = $this->db->query("SELECT COUNT(*) as count_business FROM users WHERE account=2");
		return $query->row_array();
	}

	function count_individuals(){
		$query = $this->db->query("SELECT COUNT(*)as count_individuals FROM users WHERE account=1");
		return $query->row_array();
	}

	function total_debit(){
		$query = $this->db->query("SELECT SUM(flx_transfer_amount)as total_debit FROM flutterwave_transfers");
		return $query->row_array();
	}

	function count_banks(){
		$query = $this->db->query("SELECT COUNT(*)as count_banks FROM bank");
		return $query->row_array();
	}

	function getSale()
	{
		$this->db->select('*');          
		$this->db->from('sale as s');
		$this->db->join('customer as c', 'c.customer_id = s.customer_id');
		//$this->db->join('bank as b', 'b.bank_id = s.bank_id');
		$this->db->order_by('s.sale_id', "DESC");
		$query = $this->db->get();
		return $query->result_array();
		
	}
	function getVehicleSale()
	{
		$this->db->select('*');          
		$this->db->from('sale as s');
		$this->db->join('customer as c', 'c.customer_id = s.customer_id');
		$this->db->where('s.sale_from', '1');
		$this->db->order_by('s.sale_id', "DESC");
		$query = $this->db->get();
		return $query->result_array();
		
	}
	function getLoading()
	{
		$this->db->select('*');          
		$this->db->from('vehicle_in');
		$this->db->order_by('vehicle_in_id', "DESC");
		$query = $this->db->get();
		return $query->result_array();
		
	}

	function getPurchase()
	{
		$this->db->select('*');          
		$this->db->from('purchase as p');
		$this->db->join('supplier as s', 's.supplier_id = p.supplier_id');
		$this->db->order_by('p.purchase_id', "DESC");
		$query = $this->db->get();
		return $query->result_array();
	}

	function getCreditSale()
	{
		$query = $this->db->query("
			SELECT * FROM sale as s 
			JOIN customer as c ON c.customer_id = s.customer_id 
			WHERE s.due !=''
			ORDER BY s.sale_id DESC
			");
		return $query->result_array();
	}

	function getUser($id){
		$this->db->select('fname, lname');
	    $this->db->from('users');
		$this->db->where('id', $id);
	    $query = $this->db->get();
		if($query->result_array()){
			return $query->result_array()[0]['fname']." ".$query->result_array()[0]['lname'];
		}
		return "Unknown";
	}

	function getTransaction()
	{
		$query = $this->db->query("
			SELECT * FROM transactions
			ORDER BY id DESC LIMIT 5
			");
		$result = $query->result_array();
		
		foreach($result as &$r){
			$r['user_from'] = $this->getUser(intval($r['user_from']));
			$r['user_to'] = $this->getUser(intval($r['user_to']));
		}
			//log_message('error', $result);
		return $result;
	}

	function total_received()
	{
		$query = $this->db->query("SELECT SUM(flx_paid_amount) as total_received FROM flutterwave_payment_transactions");
		return $query->row_array();
	}

	function getPayable()
	{
		$query = $this->db->query("SELECT SUM(purchase_amount) as payable FROM purchase WHERE payment_method = 'Credit'");
		return $query->row_array();
	}

	function getExpensee()
	{
		$query = $this->db->query("SELECT SUM(amount) as expense FROM expense");
		return $query->row_array();
	}

	function getTotalSale()
	{
		$query = $this->db->query("SELECT SUM(sale_amount) as totalSale FROM sale");
		return $query->row_array();
	}

	function getTotalPurchase()
	{
		$query = $this->db->query("SELECT SUM(purchase_amount) as totalPurchase FROM purchase");
		return $query->row_array();
	}

	function getStock()
	{
		$query = $this->db->query("SELECT * FROM view_stock");
		return $query->result_array();
	}
	function getSingleStock($product_id)
	{
		$query = $this->db->query("SELECT * FROM stock as s JOIN product as p ON s.product_id=p.product_id");
		return $query->result_array();
	}


	function getDipp()
	{
		$query = $this->db->query("
			SELECT i.product_id, i.product_name, sqty, pqty 
			FROM
			(SELECT sum(qty) as pqty, product_id
			FROM 
			purchase_detail
			GROUP BY product_id
			)p
			LEFT OUTER JOIN 
			(SELECT sum(qty) as sqty, product_id
			FROM 
			sale_detail
			GROUP BY product_id
			)s ON s.product_id = p.product_id
			JOIN 
			product i ON i.product_id = p.product_id
			");
		return $query->result_array();
	}

	function getVehicleStock()
	{
		$query = $this->db->query("
			SELECT * FROM view_vehicle_stock
			");
		return $query->result_array();
	}

	function getCustomerBalance()
	{
		$query = $this->db->query("
			SELECT customer.customer_name, sale.customer_id,
			sum(if(sale.payment_method='Cash', sale.sale_amount, 0)) as cash,
			sum(if(sale.payment_method='Credit', sale.sale_amount, 0)) as credit,
			sum(if(sale.payment_method='Bank', sale.sale_amount, 0)) as bank
			FROM sale
			JOIN customer ON customer.customer_id = sale.customer_id
			GROUP BY customer_id
			");
		return $query->result_array();
	}

	function getBankBalance()
	{
		$query = $this->db->query("
			SELECT b.bank_id, b.bank_name, b.balance,
			SUM(s.sale_amount) as sale,	
			SUM(p.purchase_amount) as purchase
			FROM bank as b
			LEFT JOIN sale as s ON s.bank_id = b.bank_id
			LEFT JOIN purchase as p ON p.bank_id = b.bank_id
			GROUP BY b.bank_id
			");
		return $query->result_array();
	}

	function getSupplierBalance()
	{
		$query = $this->db->query("
			SELECT s.supplier_name, s.supplier_id,
			sum(if(p.payment_method='Cash', p.purchase_amount, 0)) as cash,
			sum(if(p.payment_method='Credit', p.purchase_amount, 0)) as credit,
			sum(if(p.payment_method='Bank', p.purchase_amount, 0)) as bank
			FROM purchase as p
			JOIN supplier as s ON s.supplier_id = p.supplier_id
			GROUP BY supplier_id
			");
		return $query->result_array();
	}

	function getContactBook()
	{
		$this->db->select('*');          
		$this->db->from('contact_book');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_single_Cb($id)
	{
		$this->db->select('*');
		$this->db->from('contact_book');
		$this->db->where('id', $id); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function updateCb($id, $data)
	{
		
		$this->db->where('id', $id);
		$result = $this->db->update('contact_book', $data);
		return $result;
	}

	function getStaffAttendance($staff_id)
	{
		$query=$this->db->query("SELECT * FROM attendance WHERE staff_id='".$staff_id."' ORDER BY date DESC");
		$result = $query->result_array();
		return $result;
		//return $query;
	}

	function getStaffPayroll($staff_id)
	{
		$query=$this->db->query("SELECT * FROM salary WHERE staff_id='".$staff_id."' ORDER BY date DESC");
		$result = $query->result_array();
		return $result;
		//return $query;
	}

	function getRoles(){
		$this->db->select('*');
		$this->db->from('roles');
		$query = $this->db->get(); 
		$result = $query->result_array();
		return $result;
	}

	function get_single_role($role_id){
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where('role_id', $role_id);
		$query = $this->db->get(); 
		$result = $query->result_array();
		return $result;
	}

	function deleteRole($role_id)
	{
		$query=$this->db->query("DELETE FROM roles WHERE role_id='".$role_id."'");
		return $query;
	}

	function getModules(){
		$this->db->select('*');
		$this->db->from('modules');
		$query = $this->db->get(); 
		$result = $query->result_array();
		return $result;
	}

	function get_sub_modules($module_id){
		$this->db->select('*');
		$this->db->from('sub_modules');
		$this->db->where('module_id', $module_id);
		$query = $this->db->get(); 
		$result = $query->result_array();
		return $result;
	}
	
	//Airtime to Cash
	function getAirtime($id){
	    $this->db->select('*');
	    $this->db->from('air_transactions');
		$this->db->where('status', '0');
	    $query = $this->db->get();
	    $result = $query->result_array();
	    return $result;
	}
	function approveAirtime($id,$data){
	    $this->db->where('id',$id);
	    $result = $this->db->update('air_transactions',$data);
	    return $result;
	}
}