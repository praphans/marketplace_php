<?php
class Model_shop extends CI_Model {
  
  	private $status_product = array(3);// 2 รออนุมัติ 3 อนุมัติแล้ว
	private $status_store = array(2,5); // 2 อนุมัติแล้ว 5 ร้านค้าแนะนำ
	
  	public function getStoreTotalProduct($store_id) 
	{     
		$this->db->select('product_id');
		$this->db->from('product');
		$this->db->where('relate_id',0); 
		$this->db->where_in('product_status',$this->status_product); 
		if(isset($store_id))$this->db->where('store_id',$store_id);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	
  	public function getProductTotalRows($category_id,$subcategory_id,$store_id) 
	{     
		$this->db->select('product_id');
		$this->db->from('product');
		$this->db->where('relate_id',0); 
		$this->db->where('product_show',1); 
		$this->db->where_in('product_status',$this->status_product); // 2 รออนุมัติ 3 อนุมัติแล้ว
		if(isset($store_id))$this->db->where('store_id',$store_id);
		if(isset($category_id) && $category_id != 0)$this->db->where('product_category',$category_id);
		if(isset($subcategory_id) && $subcategory_id != 0)$this->db->where('product_subcategory',$subcategory_id);
		
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getProductList($category_id,$subcategory_id,$store_id,$page_number,$per_page,$post = array()) 
	{     
	
		$view_type = (count($post) && $post["view_type"])?$post["view_type"]:0;
		
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('relate_id',0); 
		$this->db->where('product_show',1); 
		$this->db->where_in('product_status',$this->status_product); // 2 รออนุมัติ 3 อนุมัติแล้ว
		if(isset($store_id))$this->db->where('store_id',$store_id);
		if(isset($category_id) && $category_id != 0)$this->db->where('product_category',$category_id);
		if(isset($subcategory_id) && $subcategory_id != 0)$this->db->where('product_subcategory',$subcategory_id);
		
		
		if($view_type == "popular"){
			$this->db->order_by('product_point','DESC');
		}else if($view_type == "price"){
			$this->db->order_by('product_price_discount','DESC');
		}else if($view_type == "rating"){
			$this->db->order_by('product_rating','DESC');
		}else if($view_type == "news"){
			$this->db->order_by('timestamp','DESC');
		}else{
			$this->db->order_by('timestamp','DESC');
		}
		
		
		$this->db->limit($per_page,$page_number);
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getRecommendProductList($store_id,$limit) 
	{     
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('relate_id',0); 
		$this->db->where('product_show',1); 
		$this->db->where('product_recommend',1);
		$this->db->where_in('product_status',$this->status_product); // 2 รออนุมัติ 3 อนุมัติแล้ว
		if(isset($store_id))$this->db->where('store_id',$store_id);
		
		$this->db->limit($limit);
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	
	public function getProductNumberInStoreSubCategory($sub_category_id,$store_id) 
	{
		$this->db->select('product_id');
		$this->db->from('product');
		$this->db->where('relate_id',0);
		$this->db->where('product_show',1);
		$this->db->where('product_status',3);
		$this->db->where('store_id',$store_id);
		$this->db->where('product_subcategory',$sub_category_id);
		//$this->db->group_by('product_category');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getProductNumberInStoreCategory($main_category_id,$store_id) 
	{
		$this->db->select('product_id');
		$this->db->from('product');
		$this->db->where('relate_id',0);
		$this->db->where('product_show',1);
		$this->db->where('product_status',3);
		$this->db->where('store_id',$store_id);
		$this->db->where('product_category',$main_category_id);
		//$this->db->group_by('product_category');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getCategoryProductHasProductInStore($store_id) 
	{     
		$this->db->select('product_category');
		$this->db->from('product');
		$this->db->where('relate_id',0);
		$this->db->where('product_show',1);
		$this->db->where('product_status',3);
		$this->db->where('store_id',$store_id);
		$this->db->group_by('product_category');
		//$this->db->join('product','product.product_category ==);
		$category_id_query = $this->db->get();
		$category_id_list =  array();
		if($category_id_query->num_rows() > 0 ) {
			$category_id = $category_id_query->result();
			foreach($category_id as $row){
				$product_category = $row->product_category;
				array_push($category_id_list,$product_category);
			}
		}
		
		$this->db->select('*');
		$this->db->from('product_category');
		if(count($category_id_list)>0)$this->db->where_in("id",$category_id_list);
		$query = $this->db->get();
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
	public function getShopListFilter($post,$page_number,$per_page) 
	{     
		$view_type = (count($post) && $post["view_type"])?$post["view_type"]:0;
		$view_follower =  (count($post) && $post["view_follower"])?$post["view_follower"]:0;
		$view_vat =  (count($post) && $post["view_vat"])?$post["view_vat"]:0;
		
		
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where_in('store_status',$this->status_store);
		
		if(isset($view_follower) && $view_follower != 0){
			$member_id = $this->membermanager->member_id();
			if(isset($member_id)){
				$this->db->join("store_follow","store_follow.member_id = ".$member_id." ANDstore_follow.store_id = store.store_id");
			}
		}
		
		if(isset($view_vat) && $view_vat){
			$this->db->where('store_is_vat',1);
		}
		
		
		$this->db->limit($per_page,$page_number);
		
		if($view_type == "popular"){
			$this->db->order_by('store_view','DESC');
		}else if($view_type == "follow"){
			$this->db->order_by('store_follower','DESC');
		}else if($view_type == "rating"){
			$this->db->order_by('store_rating','DESC');
		}else if($view_type == "new"){
			$this->db->order_by('timestamp','DESC');
		}else{
			$this->db->order_by('timestamp','DESC');
		}
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getShopRecommendList($category_id = 0,$per_page) 
	{     
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_status',5); // ร้านค้าแนะนำ
		if(isset($category_id) && $category_id != 0)$this->db->where('store_category',$category_id);
		$this->db->limit($per_page);
		$this->db->order_by('timestamp','DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getShopRecommendListByKeyword($keyword = 0,$per_page) 
	{     
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_status',5); // ร้านค้าแนะนำ
		if(isset($keyword)){
			$this->db->where("(store.store_name LIKE '%".$keyword."%' OR store.store_description LIKE '%".$keyword."%' )", NULL, FALSE);
		}
		$this->db->limit($per_page);
		$this->db->order_by('timestamp','DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getShopRecommendListByPlace($current_amphur_id = 0,$per_page) 
	{     
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_status',5); // ร้านค้าแนะนำ
		if(isset($current_amphur_id)){
			$this->db->where("(store.store_place_list LIKE '%".$current_amphur_id."%')", NULL, FALSE);
		}
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
	public function getShopTotalRowsFilter($post) 
	{    
		$view_type = (count($post) && $post["view_type"])?$post["view_type"]:0;
		$view_follower =  (count($post) && $post["view_follower"])?$post["view_follower"]:0;
		$view_vat =  (count($post) && $post["view_vat"])?$post["view_vat"]:0;
		
		
		$this->db->select('store.store_id');
		$this->db->from('store');
		$this->db->where_in('store_status',$this->status_store); // เฉพาะร้านที่อนุมัติแล้ว
		
		if(isset($view_follower) && $view_follower != 0){
			$member_id = $this->membermanager->member_id();
			if(isset($member_id)){
				$this->db->join("store_follow","store_follow.member_id = ".$member_id." ANDstore_follow.store_id = store.store_id");
			}
		}
		
		if(isset($view_vat) && $view_vat){
			$this->db->where('store_is_vat',1);
		}
		
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getStoreRecommend($store_category) 
	{     
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_category',$store_category);
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
	public function getProductRecommend($product_category = 0,$product_id = 0) 
	{     
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id != ',$product_id); 
		$this->db->where('product_show',1); 
		$this->db->where('product_mode',2); 
		$this->db->where('relate_id',0); 
		//$this->db->where('store.store_id >',0); 
		if(isset($product_category) && $product_category != 0)$this->db->where('product_category',$product_category); 
		$this->db->where_in('product_status',$this->status_product); 
		//$this->db->order_by('product_id', 'RANDOM');
		//$this->db->limit(10);
		
		//$this->db->join('store','product.store_id = store.store_id');
		
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
    	$query = $this->db->query('SELECT * FROM  store_place WHERE store_id = '.$store_id.' AND shipping_type_id = '.$shipping_type_id.' AND place_status != 1 ');
  
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
		$this->db->where('product_show',1); 
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
	
	
	public function getDupProductByID($product_id) 
	{     
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id',$product_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result_array();
		} else {
			return array();
		}
	}
	
	public function getProductInStoreCategory($main_category_id,$store_id) 
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('relate_id',0);
		$this->db->where('product_show',1);
		$this->db->where('product_status',3);
		$this->db->where('store_id',$store_id);
		$this->db->where('product_category',$main_category_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	
}

?>
