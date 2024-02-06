<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_libs{
	public $CI;
	public function __construct() {
		$this->CI =& get_instance();
	}
	
	public function getThaiDate($timestamp)
		{
			if(!$timestamp)return "";
			 $mons = array(1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม", 4 => "เมษายน", 5 => "พฤษภาคม", 6 => "มิถุนายน", 7 => "กรกฎาคม", 8 => "สิงหาคม", 9 => "กันยายน", 10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม");
			
			 $month_arr = explode("-",$timestamp);
			 $month_num = intval($month_arr[1]);
			
			 if(empty($mons[$month_num]))return "";
			 $month_name = $mons[$month_num];
			 $year_name = $month_arr[0];
			 $date_name = $month_arr[2];
			 $date_arr = explode(" ",$date_name);
			 $date_name = $date_arr[0];
			 return $date_name." ".$month_name." ".$year_name;
		}

		
}
