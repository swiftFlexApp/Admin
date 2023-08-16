<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Model extends CI_Model {


	function getNozzleSale($date, $nozzle_id)
	{       
        $this->db->select('*');          
        $this->db->from('reading');
        $this->db->join('nozzle', 'nozzle.nozzle_id = reading.nozzle_id');

        if ($nozzle_id!='') {
           $this->db->where('reading.nozzle_id', $nozzle_id);
       }

       if ($date!='') {
           $this->db->where('reading.date', $date);
       }
       $query = $this->db->get();
       return $query->result_array();
   }


   function getDipp($product_id)
   {       
    $this->db->select('*');          
    $this->db->from('product');
            // $this->db->join('product', 'product.product_id = product.product_id');

    if ($product_id!='') {
        $this->db->where('product.product_id', $product_id);
    }

    $query = $this->db->get();
    return $query->result_array();
}

function getHotelSale($hotel_id, $from_date, $to_date)
{

    $this->db->select('*');          
    $this->db->from('bill');
    $this->db->join('cars', 'cars.car_id = bill.car_id');
    $this->db->join('register', 'register.user_id = bill.driver_id');
    $this->db->join('hotels', 'hotels.hotel_id = bill.hotel_id');

    if ($hotel_id!='') {
        $this->db->where('bill.hotel_id', $hotel_id);
    }

    if ($from_date!='') {
        $this->db->where("bill.date BETWEEN '$from_date' AND '$to_date'");
    }

    $query = $this->db->get();
    return $query->result_array();
}

function getExpense($driver_id, $exp_head_id, $from_date, $to_date)
{

    $this->db->select('*');          
    $this->db->from('expense');
    $this->db->join('expense_head', 'expense_head.exp_head_id = expense.exp_head_id');
    $this->db->join('register', 'register.user_id = expense.driver_id');

    if ($driver_id!='') {
        $this->db->where('expense.driver_id', $driver_id);
    }

    if ($exp_head_id!='') {
        $this->db->where('expense.exp_head_id', $driver_id);
    }

    if ($from_date!='') {
        $this->db->where("DATE(expense.time) BETWEEN '$from_date' AND '$to_date'");
    }
            //$this->db->where('DATE(date_time_col)', $date);
    $query = $this->db->get();
    return $query->result_array();
}

function getCustomerBalance($customer_id, $from_date, $to_date)
{

    $this->db->select('*');          
    $this->db->from('sale');
    $this->db->join('customer', 'customer.customer_id = sale.customer_id');

    if ($customer_id!='') {
        $this->db->where('sale.customer_id', $customer_id);
    }

    if ($from_date!='') {
        $this->db->where("date BETWEEN '$from_date' AND '$to_date'");
    }
            //$this->db->where('DATE(date_time_col)', $date);
    $query = $this->db->get();
    return $query->result_array();
}

function getDueSummary($customer_id, $from_date, $to_date)
{

    $this->db->select('SUM(sale.due) as due, sale.sale_id, customer.customer_name, customer.customer_contact');          
    $this->db->from('sale');
    $this->db->join('customer', 'customer.customer_id = sale.customer_id');

    if ($customer_id!='') {
        $this->db->where('sale.customer_id', $customer_id);
    }

    if ($from_date!='') {
        $this->db->where("date BETWEEN '$from_date' AND '$to_date'");
    }
    $this->db->where('sale.due!=','0');
    $this->db->group_by('sale.customer_id');
            //$this->db->where('DATE(date_time_col)', $date);
    $query = $this->db->get();
    return $query->result_array();
}

function getPosRecord($product_id, $from_date, $to_date)
{   
    $this->db->select('i.date, p.product_id, p.product_name, qty');
    $this->db->from('sale_detail as s');
    $this->db->join('product as p', 'p.product_id = s.product_id');
    $this->db->join('sale as i', 'i.sale_id = s.sale_id');
    $this->db->where('s.product_id', $product_id);
    $this->db->group_by('i.date');
    //$this->db->where("date BETWEEN '$from_date' AND '$to_date'");
    $query = $this->db->get();
    return $query->result_array();
}

function getSaleSummary($product_id, $from_date, $to_date)
{   
    $this->db->select('p.product_id, p.product_name, sum(s.qty) as qty');          
    $this->db->from('sale_detail as s');
    $this->db->join('product as p', 'p.product_id = s.product_id');
    $this->db->join('sale as i', 'i.sale_id = s.sale_id');
    if ($product_id!='') {
        $this->db->where('s.product_id', $product_id);
    }            
    $this->db->where("i.date BETWEEN '$from_date' AND '$to_date'");
    $this->db->group_by('s.product_id');
    $query = $this->db->get();
    return $query->result_array();
}

function getSaleModelWisee($product_id, $product_model, $from_date, $to_date)
{   
    $query = $this->db->query("
        SELECT i.date, p.product_id, p.product_name, p.product_model, c.customer_name, SUM(qty) as qty 
        FROM sale_detail as s 
        JOIN product as p ON p.product_id = s.product_id
        JOIN sale as i ON i.sale_id = s.sale_id 
        JOIN customer as c ON c.customer_id=i.customer_id
        WHERE s.product_id = '$product_id' AND p.product_model = '$product_model' AND date BETWEEN '$from_date' AND '$to_date' 
        GROUP BY c.customer_id
        ");
    $result = $query->result_array();
    return $result;
}

function getSaleModelWise($product_id, $product_model, $from_date, $to_date)
{   
    $this->db->select('i.date, p.product_id, p.product_name, p.product_model, p.product_description, c.customer_id, c.customer_name, s.qty');          
    $this->db->from('sale_detail as s');
    $this->db->join('product as p', 'p.product_id = s.product_id');
    $this->db->join('sale as i', 'i.sale_id = s.sale_id');
    $this->db->join('customer as c', 'c.customer_id=i.customer_id');
    if ($from_date!='') {
        $this->db->where("i.date BETWEEN '$from_date' AND '$to_date'");
    }            
    $this->db->where('s.product_id', $product_id);
    $this->db->where('p.product_model', $product_model);
    $this->db->group_by('c.customer_id');
    $query = $this->db->get();
    return $query->result_array();
}


function getAttendance($staff_id, $from_date, $to_date)
{   
    $query = $this->db->query("
        SELECT * FROM attendance as a
        JOIN staff as s ON s.staff_id = a.staff_id
        WHERE a.staff_id ='$staff_id' AND date BETWEEN '$from_date' AND '$to_date'
        ");
    $result = $query->result_array();
    return $result;
}

function get_credit_by_date($id, $date)
{
    $this->db->select('*');          
    $this->db->from('transactions');
    $this->db->where('user_from', $id);
    //$this->db->where('date', $date);
    return $this->db->get()->result();
}

function get_purchase_by_date_supplier($supplier_id, $date)
{
    $this->db->select('*');          
    $this->db->from('purchase');
    $this->db->where('purchase.supplier_id', $supplier_id);
    $this->db->where('date', $date);
    return $this->db->get()->result();
}

function get_receiving_by_date($id, $date)
{
    $this->db->select('*');          
    $this->db->from('transactions');
    $this->db->where('user_to', $id);
    //$this->db->where('date', $date);
    return $this->db->get()->result();
}

function get_paid_by_date_supplier($supplier_id, $date)
{
    $this->db->select('*');          
    $this->db->from('supplier_payment');
    $this->db->where('supplier_id', $supplier_id);
    $this->db->where('date', $date);
    return $this->db->get()->result();
}

function get_income_by_date($date)
{
    $this->db->select('inc_id, amount as inc_amount, heading as inc_heading');
    $this->db->from('income');
    $this->db->where('date', $date);
    return $this->db->get()->result();
}

function get_expense_by_date($date)
{
    $this->db->select('exp_id, amount as exp_amount, heading as exp_heading');
    $this->db->from('expense');
    $this->db->where('date', $date);
    return $this->db->get()->result();
}


}