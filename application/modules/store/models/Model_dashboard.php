<?php
class Model_dashboard extends CI_Model {
	
	public function getStoreByID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id.'');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getCategoryName($id) 
	{     
		$this->db->select('category_name');
		$this->db->from('store_category');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			
			return $result[0]->category_name;
		} else {
			return '-';
		}
	}
	public function getFollowByID($store_id) 
	{     
		$this->db->select('count(member_id) as member_follow');
		$this->db->from('store_follow');
		$this->db->where('store_id',$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getStarAll($store_id) 
	{     
		$this->db->select('sum(review_rating) as review_star_all');
		$this->db->from('review');
		$this->db->where('store_id',$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getRatingAll($store_id) 
	{     
		$this->db->select('count(member_id) as review_rating_all');
		$this->db->from('review');
		$this->db->where('store_id',$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getRatingFive($store_id) 
	{     
		$this->db->select('count(member_id) as review_rating_five');
		$this->db->from('review');
		$this->db->where('store_id',$store_id);
		$this->db->where('review_rating =',5);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getRatingFour($store_id) 
	{     
		$this->db->select('count(member_id) as review_rating_four');
		$this->db->from('review');
		$this->db->where('store_id',$store_id);
		$this->db->where('review_rating =',4);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getRatingThree($store_id) 
	{     
		$this->db->select('count(member_id) as review_rating_three');
		$this->db->from('review');
		$this->db->where('store_id',$store_id);
		$this->db->where('review_rating =',3);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getRatingTwo($store_id) 
	{     
		$this->db->select('count(member_id) as review_rating_two');
		$this->db->from('review');
		$this->db->where('store_id',$store_id);
		$this->db->where('review_rating =',2);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getRatingOne($store_id) 
	{     
		$this->db->select('count(member_id) as review_rating_one');
		$this->db->from('review');
		$this->db->where('store_id',$store_id);
		$this->db->where('review_rating =',1);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getProductOrderByID($store_id) 
	{     
		$this->db->select('count(product_id) as product_order_all');
		$this->db->from('product');
		$this->db->where('store_id',$store_id);
		$this->db->where('relate_id = 0');
		$this->db->where('product_status != 5');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getProductOrderYear($store_id) 
	{     
		$this->db->select('count(DISTINCT product_id) as product_order_year');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('YEAR(timestamp) = YEAR(NOW())');
		// $this->db->group_by('product_id'); 
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	// public function getProductOrderYearDontDelete($store_id) 
	// {     
	// 	$this->db->select('count(DISTINCT product_id) as product_order_year_dontdelete');
	// 	$this->db->from('order');
	// 	$this->db->where('store_id',$store_id);
	// 	$this->db->where('YEAR(timestamp) = YEAR(NOW())');
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0 ) {
	// 		  return $query->result();
	// 	} else {
	// 		return array();
	// 	}
	// }
	public function getProductOrderYearDontDelete($store_id) 
	{     
		$this->db->select('count(DISTINCT order.product_id) as product_order_year_dontdelete');    
		$this->db->from('order');
		$this->db->where('order.store_id',$store_id);
		$this->db->where('YEAR(order.timestamp) = YEAR(NOW())');
		$this->db->where('product.product_status != 5');
		// $this->db->where('product.relate_id = 0');
		$this->db->join('product', 'order.product_id = product.product_id');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}



	// public function getProductNewYear($store_id) 
	// {     
	// 	$this->db->select('count(product_id) as product_order_new');
	// 	$this->db->from('product');
	// 	$this->db->where('store_id',$store_id);
	// 	$this->db->where('relate_id = 0');
	// 	$this->db->where('YEAR(timestamp) = YEAR(NOW())');
		
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0 ) {
	// 		  return $query->result();
	// 	} else {
	// 		return array();
	// 	}
	// }
	public function getProductNewYearDontDelete($store_id) 
	{     
		$this->db->select('count(product_id) as product_order_new');
		$this->db->from('product');
		$this->db->where('store_id',$store_id);
		$this->db->where('relate_id = 0');
		$this->db->where('YEAR(timestamp) = YEAR(NOW())');
		$this->db->where('product_status != 5');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getProductPending($store_id) 
	{     
		$this->db->select('count(product_id) as product_pending');
		$this->db->from('product');
		$this->db->where('store_id',$store_id);
		$this->db->where('relate_id = 0');
		$this->db->where('product_status',2);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getProductSuspend($store_id) 
	{     
		$this->db->select('count(product_id) as product_suspend');
		$this->db->from('product');
		$this->db->where('store_id',$store_id);
		$this->db->where('relate_id = 0');
		$this->db->where('product_show',0);
		$this->db->where('product_status != 5');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getOrderAllByID($store_id) 
	{     
		$this->db->select('count(DISTINCT order_code) as order_all');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getOrderToday($store_id) 
	{     
		$date = date('Y-m-d');
		$this->db->select('count(DISTINCT order_code) as order_today');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('DATE(timestamp)',$date);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getOrderWeek($store_id) 
	{     
		$this->db->select('count(DISTINCT order_code) as order_week');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('YEARWEEK(timestamp) = YEARWEEK(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getOrderMonth($store_id) 
	{     
		$this->db->select('count(DISTINCT order_code) as order_month');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('MONTH(timestamp) = MONTH(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getOrderYear($store_id) 
	{     
		$this->db->select('count(DISTINCT order_code) as order_year');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('YEAR(timestamp) = YEAR(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}

	public function getSellAll($store_id) 
	{     
		$this->db->select('sum(product_price_payment) as product_price_all');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getSellToDay($store_id) 
	{     
		$date = date('Y-m-d');
		$this->db->select('sum(product_price_payment) as product_price_today');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('DATE(timestamp)',$date);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getSellWeek($store_id) 
	{     
		$this->db->select('sum(product_price_payment) as product_price_week');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('YEARWEEK(timestamp) = YEARWEEK(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getSellMonth($store_id) 
	{     
		$this->db->select('sum(product_price_payment) as product_price_month');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('MONTH(timestamp) = MONTH(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getSellYear($store_id) 
	{     
		$this->db->select('sum(product_price_payment) as product_price_year');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('YEAR(timestamp) = YEAR(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDeliveryAll($store_id) 
	{     

		$this->db->select('sum(product_qty) as product_delivery_all');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDeliveryToday($store_id) 
	{     
		$date = date('Y-m-d');
		$this->db->select('sum(product_qty) as product_delivery_today');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$this->db->where('DATE(timestamp)',$date);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDeliveryWeek($store_id) 
	{     
		$this->db->select('sum(product_qty) as product_delivery_week');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$this->db->where('YEARWEEK(timestamp) = YEARWEEK(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDeliveryMonth($store_id) 
	{     
		$this->db->select('sum(product_qty) as product_delivery_month');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$this->db->where('MONTH(timestamp) = MONTH(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDeliveryYear($store_id) 
	{     
		$this->db->select('sum(product_qty) as product_delivery_year');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$this->db->where('YEAR(timestamp) = YEAR(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDepositorCostAll($store_id) 
	{     
		$this->db->select('sum(depositor_cost) as depositor_cost_all');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDepositorCostToday($store_id) 
	{     
		$date = date('Y-m-d');
		$this->db->select('sum(depositor_cost) as depositor_cost_today');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$this->db->where('DATE(timestamp)',$date);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDepositorCostWeek($store_id) 
	{     
		$this->db->select('sum(depositor_cost) as depositor_cost_week');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$this->db->where('YEARWEEK(timestamp) = YEARWEEK(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDepositorCostMonth($store_id) 
	{     
		$this->db->select('sum(depositor_cost) as depositor_cost_month');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$this->db->where('MONTH(timestamp) = MONTH(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getDepositorCostYear($store_id) 
	{     
		$this->db->select('sum(depositor_cost) as depositor_cost_year');
		$this->db->from('order');
		$this->db->where('store_id',$store_id);
		$this->db->where('depositor_store_id !=',0);
		$this->db->where('YEAR(timestamp) = YEAR(NOW())');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
}

?>
