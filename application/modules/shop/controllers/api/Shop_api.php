<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_api extends MX_Controller {

	public $PAGE; 
	public function __construct() {
        parent::__construct();
		$this->load->model('model_shop');
		$this->load->model("model_category"); 
		$this->load->model("message/model_message");
	}

	public function getShop()
	{
		
		$view_type = $this->input->post("view_type");
		$view_per_page = $this->input->post("view_per_page");
		$view_follower = $this->input->post("view_follower");
		$view_vat = $this->input->post("view_vat");
		$view_page_number = $this->input->post("view_page_number");
		$category_id = $this->input->post("category_id");
		
		$post = $this->input->post();
		
		
		$page_number = $view_page_number;
		if(isset($category_id) && $category_id){
			$total_rows = $this->model_category->getShopCategoryTotalRows($post,$category_id);
		}else{
			$total_rows = $this->model_shop->getShopTotalRowsFilter($post);
		}
		$this->load->library('pagination');
		$config['base_url'] = base_url('shop/api/shop_api/getShop/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = $view_per_page;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		//$config['use_page_numbers'] = TRUE;
		//$config['enable_query_strings'] = TRUE;
		
		$this->pagination->initialize($config);
		$this->PAGE['category'] = $this->model_shop->getCategory();
		
		$this->PAGE['shop_recommend'] = $this->model_shop->getShopRecommendList($category_id,10);
		
		$offset = $page_number*$per_page;
		
		if(isset($category_id) && $category_id){
			$this->PAGE['shop'] = $shop = $this->model_category->getShopCategoryList($post,$offset,$per_page,$category_id);
		}else{
			$this->PAGE['shop'] = $shop = $this->model_shop->getShopListFilter($post,$offset,$per_page);
		}
		
		
		
		//$pages = ceil($total_rows/$per_page);
		
		/*$min_page = ($page_number+1);
		$max_page = count($shop);
		$max_page = $min_page+($max_page-1);
		*/
		//$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->load->view("shop/templates/shop_load_view",$this->PAGE);	
	}
	public function getProduct()
	{
		
		$view_type = $this->input->post("view_type");
		$view_per_page = $this->input->post("view_per_page");
		$store_url = $this->input->post("view_store_url");
		$view_page_number = $this->input->post("view_page_number");
		$category_id = $this->input->post("view_category_id");
		$subcategory_id = $this->input->post("view_subcategory_id");
		
		
		//$store_url = ($this->uri->segment(1) != '')?$this->uri->segment(1):0; 
		//$category_id = ($this->uri->segment(2) != '')?$this->uri->segment(2):0; 
		//$subcategory_id = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
		
		$post = $this->input->post();
		
		$mystore = $this->model_shop->getShopByStoreURL($store_url);
		$store_id = (count($mystore)>0)?$mystore[0]->store_id:0;
		
		$page_number = $view_page_number;
		$total_rows = $this->model_shop->getProductTotalRows($category_id,$subcategory_id,$store_id,$post);
		
		
		
		$this->load->library('pagination');
		$config['base_url'] = base_url();
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = $view_per_page;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$this->PAGE['product_recommend'] = $this->model_shop->getRecommendProductList($store_id,10);
		
		$offset = $page_number*$per_page;
		$this->PAGE['product'] = $product = $this->model_shop->getProductList($category_id,$subcategory_id,$store_id,$offset,$per_page,$post);
		
		/*$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($product);
		$max_page = $min_page+($max_page-1);*/
		//$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		
		
		$mystore = $this->model_shop->getShopByStoreURL($store_url);
		$this->PAGE['store_id'] = $store_id;
		$this->PAGE['mystore'] = $mystore;
		$this->load->view("shop/templates/product_load_view",$this->PAGE);	
		
		
		
	}
	
	public function minusCart()
	{
		$respond = array();
		$respond['success'] = false;
		$product_qty = 1;
		$product_id = $this->input->post("product_id");
		$current_product_qty = $this->input->post("current_product_qty");
		
		
		
		$this->db->select("product_id");
		$this->db->from("cart");
		if($this->membermanager->isLoggedIn()){
			$member_id  = $this->membermanager->member_id();
			$this->db->where("member_id",$member_id);
		}else{
			$sess_id = $this->session->userdata("sess_id");
			if(empty($sess_id))$sess_id = 0;
			$this->db->where("sess_id",$sess_id);
		}
		
		$this->db->where("product_id",$product_id);
		$query = $this->db->get();
		if($query->num_rows()>1){
		
			
			if($this->membermanager->isLoggedIn()){
				$member_id  = $this->membermanager->member_id();
				$this->db->where("member_id",$member_id);
				
				
			}else{
				$sess_id = $this->session->userdata("sess_id");
				if(empty($sess_id))$sess_id = 0;
				$this->db->where("sess_id",$sess_id);
				
				
			}
			$this->db->where("product_id",$product_id);
			$this->db->limit(1); 
			$this->db->delete("cart");
		}
		
		
		$respond['success'] = true;
		echo json_encode($respond);
	}
	
	public function removeFromCart()
	{
		$respond = array();
		$respond['success'] = false;
		
		$product_id = $this->input->post("product_id");
		if($this->membermanager->isLoggedIn()){
			$member_id  = $this->membermanager->member_id();
			$this->db->where("member_id",$member_id);
		}else{
			$sess_id = $this->session->userdata("sess_id");
			if(empty($sess_id))$sess_id = 0;
			$this->db->where("sess_id",$sess_id);
		}
		$this->db->where("product_id",$product_id);
		$query = $this->db->delete("cart");
		
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	public function addToCart($is_add_to_cart = 0)
	{
		// is_add_to_cart = 0 ดึงข้อมูลไปแสดง
		// is_add_to_cart = 1 เพิ่มเข้า ตะกร้า
		// is_add_to_cart = 2 เพิ่มเข้า wishlist
		$respond = array();
		$respond['title'] = "ตะกร้าสินค้า";
		$respond['success'] = false;
		$respond['description'] = 'มีบางอย่างผิดพลาด';
		$wishlist_has_already = false;
		
		$product_id = $product_id_request = $this->input->post("product_id");
		$store_id = $this->input->post("store_id");
		$product_name = $this->input->post("product_name");
		$product_image = $this->input->post("product_image");
		$product_qty = $product_qty_request = $this->input->post("product_qty");
		$product_price_discount = $this->input->post("product_price_discount");
		$key_add_to_cart = $this->input->post("key_add_to_cart");
		

		$product_qty_in_cart = 0;
		$product_qty_in_stock = 0;
		$product_qty_total = 0;
		$product_qty_in_stock = 0;
		if(isset($product_id) && $product_id != 0){
			$product_qty_in_stock = 0;
			$products = $this->model_cart->getProductByID($product_id);
			foreach($products as $row){
				$product_qty_in_stock = $row->product_qty;
				$product_price_discount = $row->product_price_discount;
				$product_cart_id = $row->product_id;
			}
			
		
		
		
			if($product_qty_in_stock <= 0 && $is_add_to_cart == 1){
				$respond['title'] = "สินค้าหมด";
				$respond['description'] = "จำนวนสินค้าในคลังหมดแล้ว กรุณาติดต่อผู้ขาย ";
				echo json_encode($respond);
				exit();
			}
		}
		if($is_add_to_cart != 0){
			if($is_add_to_cart == 1){
				$table = "cart";
			}else{
				$table = "wishlist";
			}
			
			
			if(isset($key_add_to_cart) && $key_add_to_cart == 1){
				if($this->membermanager->isLoggedIn()){
					$member_id  = $this->membermanager->member_id();
					$this->db->where("member_id",$member_id);
				}else{
					if($this->session->userdata("sess_id")){
						$sess_id = $this->session->userdata("sess_id");
						$this->db->where("sess_id",$sess_id);
					}
				}
				if(isset($member_id) || isset($sess_id)){
					
					$this->db->where("product_id",$product_id);
					$this->db->where("store_id",$store_id);
					$this->db->delete($table);
				}
			}
						
			
			$wishlist_has_already = $this->model_cart->getWishlistHasAlready($product_id);
			if(!$wishlist_has_already || $is_add_to_cart == 1){
			
				if($this->membermanager->isLoggedIn()){
					$member_id  = $this->membermanager->member_id();
					$this->db->set("member_id",$member_id);
				}else{
					if($this->session->userdata("sess_id")){
						$sess_id = $this->session->userdata("sess_id");
						$this->db->set("sess_id",$sess_id);
					}else{
						$sess_id  = $this->utils->getFakeMemberID(100);
						$this->session->set_userdata("sess_id",$sess_id);
						$this->db->set("sess_id",$sess_id);
					}
				}
				
				$product_qty_in_cart = 0;
				$product_qty_in_stock = 0;
				$cart_res = $this->model_cart->getProductCart($product_id_request);
				$stock_res = $this->model_cart->getProductByID($product_id_request);
				
				$product_qty_in_cart = count($cart_res);
				/*foreach($cart_res as $row2){
					$product_qty_in_cart = $row2->product_qty;
				}
				echo count($cart_res)."<br>";*/
				foreach($stock_res as $row3){
					$product_qty_in_stock = $row3->product_qty;
				}
				
					
				
				
				
					
					
				if($is_add_to_cart == 2){
					$wishlist = $this->model_shop->getDupProductByID($product_id);
					$query = $this->db->insert($table,$wishlist[0]);
				}else{
					if(($product_qty_request+$product_qty_in_cart) <= $product_qty_in_stock){
						
						$this->db->set("product_id",$product_id);
						$this->db->set("store_id",$store_id);
						$this->db->set("product_name",$product_name);
						$this->db->set("product_image",$product_image);
						$this->db->set("product_qty",$product_qty);
						$this->db->set("product_price_discount",$product_price_discount);
						$query = $this->db->insert($table);
					}
				}
			}
		}
		
		
		/*if(($product_qty_request+$product_qty_total) > $product_qty_in_stock){
			$respond['success'] = false;
			$respond['title'] = "สินค้าไม่พอ";
			$respond['description'] = "จำนวนสินค้าคงเหลือในคลังไม่เพียงพอ<br>กรุณาระบุจำนวนสินค้าตามจำนวนคงเหลือ ";
		}else{
			$respond['success'] = true;
		}*/
		
		$cart_total_price = 0;
		$cart_item = '';
		$product_qty_total = 0;
		$product_qty_total_all = 0;
		$product_price_discount_total = 0;
		$result_group = $this->model_cart->getGroupProductCart();
		foreach($result_group as $row){
			$cart_id = $row->cart_id;
			$product_id = $row->product_id;
			$product_name = $row->product_name;
			$product_image = base_url($row->product_image);
			$product_qty = $row->product_qty;
			$product_price_discount = $row->product_price_discount;
			
			$result = $this->model_cart->getProductCart($product_id);
			$product_qty_total = 0;
			$product_price_discount_total = 0;
			foreach($result as $row2){
				
				
				//$uniqe_product_id += $row2->product_id;
				$product_qty_total += $row2->product_qty;
				$product_price_discount_total += ($row2->product_price_discount*$row2->product_qty);
				$product_price_discount = $row2->product_price_discount;
				
				/*$uniqe_products = $this->model_cart->getProductByID($uniqe_product_id);
				$respond['description'] = "จำนวนสินค้าในคลังไม่เพียงพอ กรุณาระบุจำนวนสินค้าตามจำนวนคงเหลือ ";
				echo json_encode($respond);
				exit();*/
				
			}
			$product_details = $this->model_productmanager->getProductByID($product_id);
			foreach($product_details as $d){
				$product_status = $d->product_status;
				$product_show = $d->product_show;
			}
			if($product_status == 3 && $product_show == 1){
			$link = $this->utils->getProductLink($product_id);
			$cart_item .= '<div class="animated_item">
								<div class="clearfix sc_product">
									<a href="'.$link.'" class="product_thumb"><img src="'.$product_image.'" alt=""></a>
									<a href="'.$link.'" class="product_name shopping_cart_productname">'.$product_name.'</a>
									<p>'.$product_qty_total.' x '.number_format($product_price_discount,2).'</p>
									<button class="close" product_id="'.$product_id.'"></button>
								</div>
							</div>';
			$product_qty_total_all += $product_qty_total;	
			$cart_total_price += $product_price_discount_total;
			}
		}
		
		//echo ($product_qty_request+$product_qty_in_cart);
		
		if(($product_qty_request+$product_qty_in_cart) > $product_qty_in_stock){
			$respond['success'] = false;
			$respond['title'] = "สินค้าไม่พอ";
			$respond['description'] = "จำนวนสินค้าคงเหลือในคลังไม่เพียงพอ<br>กรุณาระบุจำนวนสินค้าตามจำนวนคงเหลือ ";
		}else{
			$respond['success'] = true;
		}
				
				
		$wishlist = $this->model_cart->getWishlistProductCart();
		//$inbox = $this->model_cart->getInboxUnread();
		$member_id  = $this->membermanager->member_id();
		if($this->membermanager->isLoggedIn()){
			$inbox = $this->model_cart->getInboxUnread($member_id,"receive",0);
			//$inbox_number = count($inbox);
		}else{
			$inbox = 0;
		}
		$respond['cart_total_price'] = '฿'.number_format($cart_total_price,2);
		$respond['cart_total_item'] = $product_qty_total_all;
		$respond['cart_item'] = $cart_item;
		$respond['wishlist_number'] = count($wishlist);
		$respond['inbox_number'] = $inbox;//count($inbox);
		$respond['wishlist_has_already'] = $wishlist_has_already;
		
		
		echo json_encode($respond);
	}
	
	public function getCurrentProductPriceDiscount(){
		
		$respond = array();
		$respond['success'] = true;
		
		$product_id = $this->input->post("product_id");
		$products = $this->model_cart->getProductByID($product_id);
		foreach($products as $row){
			$product_price_discount = $row->product_price_discount;
		}
		$respond['product_price_discount'] = $product_price_discount;
		echo json_encode($respond);
	}
	
}
