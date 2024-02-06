<?php
class Model_product extends CI_Model {
  
  	private $status_product = array(3);// 2 รออนุมัติ 3 อนุมัติแล้ว
	private $status_store = array(2,5); // 2 อนุมัติแล้ว 5 ร้านค้าแนะนำ
	
  	public function getProductTotalRows2($post = array(),$keyword,$amphur_id = 0) 
	{     
		
		$store_id_list = (isset($post["store_id_list"]))?$post["store_id_list"]:array();
		$view_page_number = (isset($post["view_page_number"]))?$post["view_page_number"]:0;
		$view_per_page = (isset($post["view_per_page"]))?$post["view_per_page"]:0;
		$main_category_id = (isset($post["main_category_id"]))?$post["main_category_id"]:0;
		$sub_category_id = (isset($post["sub_category_id"]))?$post["sub_category_id"]:0;
		$new_product = (isset($post["new_product"]))?$post["new_product"]:0;
		$service_delivery = (isset($post["service_delivery"]))?$post["service_delivery"]:0;
		$second_hand_product = (isset($post["second_hand_product"]))?$post["second_hand_product"]:0;
		$is_delivery = (isset($post["is_delivery"]))?$post["is_delivery"]:0;
		$no_delivery = (isset($post["no_delivery"]))?$post["no_delivery"]:0;
		$gateway_type_1 = (isset($post["gateway_type_1"]))?$post["gateway_type_1"]:0;
		$gateway_type_2 = (isset($post["gateway_type_2"]))?$post["gateway_type_2"]:0;
		$gateway_type_3 = (isset($post["gateway_type_3"]))?$post["gateway_type_3"]:0;
		$featured = (isset($post["featured"]))?$post["featured"]:0;
		
		$gateway = array();
		$type = array();
		
		if(isset($gateway_type_1) && $gateway_type_1 != 0)array_push($gateway,$gateway_type_1);
		if(isset($gateway_type_2) && $gateway_type_2 != 0)array_push($gateway,$gateway_type_2);
		if(isset($gateway_type_3) && $gateway_type_3 != 0)array_push($gateway,$gateway_type_3);
		
		
		if(isset($new_product) && $new_product != 0)array_push($type,$new_product);
		if(isset($second_hand_product) && $second_hand_product != 0)array_push($type,$second_hand_product);
		
		if(isset($service_delivery) && $service_delivery != 0){
			$this->db->like("store.store_shipping",$service_delivery);
		}
		
		
		$this->db->select('*');
		$this->db->from('product');
		
		
		$this->db->where("product.product_show",1);
		$this->db->where("product.product_status",3);
		$this->db->where("product.relate_id",0);
		
		//if(isset($amphur_id) && $amphur_id != 0)$this->db->where('store.amphur',$amphur_id);
		if(isset($amphur_id) && $amphur_id != 0)$this->db->where("(store.store_place_list LIKE '%".$amphur_id."%')", NULL, FALSE);
		if(isset($keyword)){
			$this->db->where("(product.product_name LIKE '%".$keyword."%' OR product.product_brand LIKE '%".$keyword."%' OR product.product_version LIKE '%".$keyword."%' OR product.product_price LIKE '%".$keyword."%' OR product.product_price_discount LIKE '%".$keyword."%' OR store.store_name LIKE '%".$keyword."%' OR store.store_description LIKE '%".$keyword."%' OR product.product_code LIKE '%".$keyword."%' OR store.store_code LIKE '%".$keyword."%')", NULL, FALSE);

			// original 
			// $this->db->where("(product.product_name LIKE '%".$keyword."%' OR product.product_description LIKE '%".$keyword."%' OR product.product_brand LIKE '%".$keyword."%' OR product.product_version LIKE '%".$keyword."%' OR product.product_price LIKE '%".$keyword."%' OR product.product_price_discount LIKE '%".$keyword."%' OR store.store_name LIKE '%".$keyword."%' OR store.store_description LIKE '%".$keyword."%')", NULL, FALSE);
			// end original
			
		}
		if(count($store_id_list)>0)$this->db->where_in("product.store_id",$store_id_list);
		if(count($gateway)>0)$this->db->where_in("product.gateway_type_id",$gateway);
		if(count($type)>0)$this->db->where_in("product.product_type",$type);
		
		$this->db->where_in("store.store_status",array(2,5));
		
		if(isset($main_category_id) && $main_category_id != 0)$this->db->where("product.product_category",$main_category_id);
		if(isset($sub_category_id) && $sub_category_id != 0)$this->db->where("product.product_subcategory",$sub_category_id);
		if(isset($featured) && $featured != 0)$this->db->where("product.product_featured",$featured);
		
		$this->db->join("store","store.store_id = product.store_id");
		//$this->db->join("store_place","store.store_id = product.store_id");
		//$this->db->join("product_category_customer","product_category_customer.id = product.product_category_customer");
		$query = $this->db->get();
		return $query->num_rows();
	}
 	
	public function getProductList2($post,$main_category_id,$sut_category_id,$per_page,$page_number,$keyword,$amphur_id = 0){
		
		$store_id_list = (isset($post["store_id_list"]))?$post["store_id_list"]:array();
		$view_page_number = (isset($post["view_page_number"]))?$post["view_page_number"]:0;
		$view_per_page = (isset($post["view_per_page"]))?$post["view_per_page"]:0;
		$main_category_id = (isset($post["main_category_id"]))?$post["main_category_id"]:0;
		$sub_category_id = (isset($post["sub_category_id"]))?$post["sub_category_id"]:0;
		$new_product = (isset($post["new_product"]))?$post["new_product"]:0;
		$second_hand_product = (isset($post["second_hand_product"]))?$post["second_hand_product"]:0;
		$service_delivery = (isset($post["service_delivery"]))?$post["service_delivery"]:0;
		$is_delivery = (isset($post["is_delivery"]))?$post["is_delivery"]:0;
		$no_delivery = (isset($post["no_delivery"]))?$post["no_delivery"]:0;
		$gateway_type_1 = (isset($post["gateway_type_1"]))?$post["gateway_type_1"]:0;
		$gateway_type_2 = (isset($post["gateway_type_2"]))?$post["gateway_type_2"]:0;
		$gateway_type_3 = (isset($post["gateway_type_3"]))?$post["gateway_type_3"]:0;
		$featured = (isset($post["featured"]))?$post["featured"]:0;
		$view_type = (count($post) && $post["view_type"])?$post["view_type"]:0;
		
		
		$gateway = array();
		$type = array();
		
		if(isset($gateway_type_1) && $gateway_type_1 != 0)array_push($gateway,$gateway_type_1);
		if(isset($gateway_type_2) && $gateway_type_2 != 0)array_push($gateway,$gateway_type_2);
		if(isset($gateway_type_3) && $gateway_type_3 != 0)array_push($gateway,$gateway_type_3);
		
		if(isset($new_product) && $new_product != 0)array_push($type,$new_product);
		if(isset($second_hand_product) && $second_hand_product != 0)array_push($type,$second_hand_product);
		
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where("product.product_show",1);
		$this->db->where("product.product_status",3);
		$this->db->where("product.relate_id",0);
		//if(isset($amphur_id) && $amphur_id != 0)$this->db->where('store.amphur',$amphur_id);
		if(isset($amphur_id) && $amphur_id != 0)$this->db->where("(store.store_place_list LIKE '%".$amphur_id."%')", NULL, FALSE);
		if(isset($keyword)){
			$this->db->where("(product.product_name LIKE '%".$keyword."%' OR product.product_brand LIKE '%".$keyword."%' OR product.product_version LIKE '%".$keyword."%' OR product.product_price LIKE '%".$keyword."%' OR product.product_price_discount LIKE '%".$keyword."%' OR store.store_name LIKE '%".$keyword."%' OR store.store_description LIKE '%".$keyword."%' OR product.product_code LIKE '%".$keyword."%' OR store.store_code LIKE '%".$keyword."%')", NULL, FALSE);

			// original 
			// $this->db->where("(product.product_name LIKE '%".$keyword."%' OR product.product_description LIKE '%".$keyword."%' OR product.product_brand LIKE '%".$keyword."%' OR product.product_version LIKE '%".$keyword."%' OR product.product_price LIKE '%".$keyword."%' OR product.product_price_discount LIKE '%".$keyword."%' OR store.store_name LIKE '%".$keyword."%' OR store.store_description LIKE '%".$keyword."%')", NULL, FALSE);

			// end original
		}
		if(count($store_id_list)>0)$this->db->where_in("product.store_id",$store_id_list);
		if(count($gateway)>0)$this->db->where_in("product.gateway_type_id",$gateway);
		if(count($type)>0)$this->db->where_in("product.product_type",$type);
		$this->db->where_in("store.store_status",array(2,5));
		
		if(isset($service_delivery) && $service_delivery != 0){
			$this->db->like("store.store_shipping",$service_delivery);
		}
		
		
		if(isset($main_category_id) && $main_category_id != 0)$this->db->where("product.product_category",$main_category_id);
		if(isset($sut_category_id) && $sut_category_id != 0)$this->db->where("product.product_subcategory",$sut_category_id);
		if(isset($featured) && $featured != 0)$this->db->where("product.product_featured",$featured);
		
		if($view_type == "popular"){
			$this->db->order_by('product.product_point','DESC');
		}else if($view_type == "price_hight"){
			$this->db->order_by('product.product_price_discount','DESC');
		}else if($view_type == "price_low"){
			$this->db->order_by('product.product_price_discount','ASC');
		}else if($view_type == "rating"){
			$this->db->order_by('product.product_rating','DESC');
		}else if($view_type == "news"){
			$this->db->order_by('product.timestamp','DESC');
		}else{
			$this->db->order_by('product.timestamp','DESC');
		}
		$this->db->join("store","store.store_id = product.store_id");
		//$this->db->join("product_category_customer","product_category_customer.id = product.product_category_customer");
		$offset = $per_page*$page_number;
		$this->db->limit($per_page,$offset);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
		  	return $query->result();
		} else {
		  	return array();
		}
	}
	
	
	
  	public function getProductTotalRows($category_id,$subcategory_id,$keyword,$amphur_id = 0) 
	{     
	
		$this->db->select('product.product_id');
		$this->db->from('product');
		$this->db->where("product.relate_id",0);
		$this->db->where('product.product_status',3); // 2 รออนุมัติ 3 อนุมัติแล้ว
		if(isset($amphur_id) && $amphur_id != 0)$this->db->where('store.amphur',$amphur_id);
		if(isset($keyword)){
			$this->db->where("(product.product_name LIKE '%".$keyword."%' OR product.product_brand LIKE '%".$keyword."%' OR product.product_version LIKE '%".$keyword."%' OR product.product_price LIKE '%".$keyword."%' OR product.product_price_discount LIKE '%".$keyword."%' OR store.store_name LIKE '%".$keyword."%' OR store.store_description LIKE '%".$keyword."%')", NULL, FALSE);
			
			// original 
			// $this->db->where("(product.product_name LIKE '%".$keyword."%' OR product.product_description LIKE '%".$keyword."%' OR product.product_brand LIKE '%".$keyword."%' OR product.product_version LIKE '%".$keyword."%' OR product.product_price LIKE '%".$keyword."%' OR product.product_price_discount LIKE '%".$keyword."%' OR store.store_name LIKE '%".$keyword."%' OR store.store_description LIKE '%".$keyword."%')", NULL, FALSE);
			// end original

			/*$this->db->like("product.product_name",$keyword);
			$this->db->or_like(array('product.product_description' => $keyword, 'product.product_brand' => $keyword, 'product.product_version' => $keyword, 'product.product_price' => $keyword, 'product.product_price_discount' =>$keyword,'store.store_name' =>$keyword, 'store.store_description' =>$keyword));
			
			$this->db->like("product.product_name",$keyword);
			$this->db->or_like("product.product_description",$keyword);
			$this->db->or_like("product.product_brand",$keyword);
			$this->db->or_like("product.product_version",$keyword);
			$this->db->or_like("product.product_price",$keyword);
			$this->db->or_like("product.product_price_discount",$keyword);
			
			$this->db->or_like("store.store_name",$keyword);
			$this->db->or_like("store.store_description",$keyword);*/
			
		}
		
		if(isset($category_id) && $category_id != 0)$this->db->where('product.product_category',$category_id);
		if(isset($subcategory_id) && $subcategory_id != 0)$this->db->where('product.product_subcategory',$subcategory_id);
		
		$this->db->join("store","store.store_id = product.store_id");
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getProductList($category_id,$subcategory_id,$page_number,$per_page,$keyword,$amphur_id) 
	{     
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where("product.relate_id",0);
		$this->db->where('product.product_status',3);
		if(isset($amphur_id) && $amphur_id != 0)$this->db->where('store.amphur',$amphur_id);
		//$this->db->where_in('product.product_status',$this->status_product); // 2 รออนุมัติ 3 อนุมัติแล้ว
		if(isset($keyword)){
			$this->db->where("(product.product_name LIKE '%".$keyword."%' OR product.product_brand LIKE '%".$keyword."%' OR product.product_version LIKE '%".$keyword."%' OR product.product_price LIKE '%".$keyword."%' OR product.product_price_discount LIKE '%".$keyword."%' OR store.store_name LIKE '%".$keyword."%' OR store.store_description LIKE '%".$keyword."%')", NULL, FALSE);
			
			// original 
			// $this->db->where("(product.product_name LIKE '%".$keyword."%' OR product.product_description LIKE '%".$keyword."%' OR product.product_brand LIKE '%".$keyword."%' OR product.product_version LIKE '%".$keyword."%' OR product.product_price LIKE '%".$keyword."%' OR product.product_price_discount LIKE '%".$keyword."%' OR store.store_name LIKE '%".$keyword."%' OR store.store_description LIKE '%".$keyword."%')", NULL, FALSE);
			// end original


			//$this->db->like("product.product_name",$keyword);
			//$this->db->or_like(array('product.product_description' => $keyword, 'product.product_brand' => $keyword, 'product.product_version' => $keyword, 'product.product_price' => $keyword, 'product.product_price_discount' =>$keyword,'store.store_name' =>$keyword, 'store.store_description' =>$keyword));
			
			/*$this->db->like("product.product_name",$keyword);
			$this->db->or_like("product.product_description",$keyword);
			$this->db->or_like("product.product_brand",$keyword);
			$this->db->or_like("product.product_version",$keyword);
			$this->db->or_like("product.product_price",$keyword);
			$this->db->or_like("product.product_price_discount",$keyword);
			
			$this->db->or_like("store.store_name",$keyword);
			$this->db->or_like("store.store_description",$keyword);*/
		}
		
		if(isset($category_id) && $category_id != 0)$this->db->where('product.product_category',$category_id);
		if(isset($subcategory_id) && $subcategory_id != 0)$this->db->where('product.product_subcategory',$subcategory_id);
		$this->db->join("store","store.store_id = product.store_id");
		$this->db->limit($per_page,$page_number);
		
		$query = $this->db->get();
		//print_r($this->db->last_query());    
		//print_r($query->result());
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	
    public function getCategoryProduct() 
	{     
		$this->db->select('*');
		$this->db->from('product_category');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getCategoryProductByID($category_id) 
	{     
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('id',$category_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getSubCategoryProductByID($category_id) 
	{     
		$this->db->select('*');
		$this->db->from('product_subcategory');
		$this->db->where('id',$category_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getSubCategoryProductByCategoryID($category_id) 
	{     
		$this->db->select('*');
		$this->db->from('product_subcategory');
		$this->db->where('category_id',$category_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getCategory() 
	{     
		$this->db->select('*');
		$this->db->from('store_category');
		$this->db->where('category_status',1);
		$query = $this->db->get();
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
	public function getShopList($page_number,$per_page) 
	{     
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where_in('store_status',$this->status_store);
		$this->db->limit($per_page,$page_number);
		$this->db->order_by('timestamp','DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getShopRecommendList($per_page) 
	{     
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_status',5); // ร้านค้าแนะนำ
		$this->db->limit($per_page);
		$this->db->order_by('timestamp','DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getShopByStoreURL($store_url) 
	{     
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_url',$store_url);
		
		$this->db->where_in('store_status',$this->status_store);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getShopTotalRows() 
	{     
		$this->db->select('store_id');
		$this->db->from('store');
		$this->db->where_in('store_status',$this->status_store); // เฉพาะร้านที่อนุมัติแล้ว
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getStoreRecommend() 
	{     
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where_in('store_status',$this->status_store); 
		$this->db->order_by('store_id', 'RANDOM');
		$this->db->limit(5);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getProductRecommend() 
	{     
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where_in('product_status',$this->status_product); 
		$this->db->order_by('product_id', 'RANDOM');
		$this->db->limit(10);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	
	public function getShopByStoreID($store_id) 
	{     
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_id',$store_id);
		$this->db->where_in('store_status',$this->status_store);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getPlaceById($store_id,$shipping_type_id)
  	{
    	$query = $this->db->query('SELECT * FROM  store_place WHERE store_id = '.$store_id.' AND shipping_type_id = '.$shipping_type_id.' AND place_status = 1');
  
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getProductByID($product_id) 
	{     
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id',$product_id); // 2 รออนุมัติ 3 อนุมัติแล้ว
		$this->db->where_in('product_status',$this->status_product); // 2 รออนุมัติ 3 อนุมัติแล้ว
		//if(isset($store_id))$this->db->where('store_id',$store_id);
		//if(isset($category_id) && $category_id != 0)$this->db->where('product_category',$category_id);
		//if(isset($subcategory_id) && $subcategory_id != 0)$this->db->where('product_subcategory',$subcategory_id);
		
		//$this->db->limit($per_page,$page_number);
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getProductRelate($product_id)
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('relate_id',$product_id); // 2 รออนุมัติ 3 อนุมัติแล้ว
		$this->db->where_in('product_status',$this->status_product); // 2 รออนุมัติ 3 อนุมัติแล้ว
		$this->db->order_by('timestamp','DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getFeaturedNameByID($product_featured)
	{
		$this->db->select('featured_name');
		$this->db->from('product_featured');
		$this->db->where('id',$product_featured);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result[0]->featured_name;
		} else {
			return "";
		}
	}
	
}

?>
