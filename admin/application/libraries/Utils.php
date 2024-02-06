<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Utils{
		
	private $CI;
	public function __construct()
		{
			$this->CI =& get_instance();
			$this->CI->load->library("phpmailer");
			$this->CI->load->library('session');
	}
	public function admin_id() {
		return $this->CI->session->userdata("admin_id");
	}
	public function user_type() {
		return $this->CI->session->userdata("user_type");
	}
	public function checkLogin()
	{	

		$logged_in = $this->logged_in();
		if($logged_in){
			$this->permissionUser();
			$this->CI->load->model('model_user');
			$member = $this->CI->model_user->getUserById($this->admin_id());
			if(!empty($member)){
				foreach ($member as $rs) {
					$allow_to_login = $rs->allow_to_login;
				}
				
				if(!$allow_to_login){
					redirect("member/logout");
				}
			}
		}else{
			redirect("member","refresh");
		}
	}
	public function IsLogin()
	{
		$logged_in = $this->logged_in();
		if($logged_in){
			redirect("home","refresh");
		}
	}
	public function logged_in() {
		$this->CI->db->select("logged_in");
		$this->CI->db->from("admin");
		$this->CI->db->where("admin_id",$this->admin_id());
		$query = $this->CI->db->get();
		if($query->num_rows()){
			$result = $query->result();
			$logged_in = $result[0]->logged_in;
		}else{
			$logged_in = 0;
		}
		return $logged_in;
	}
	public function ceiling($number, $significance = 0.5)
	{
		return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
	}
	public function getMimeType($filename)
		{
			if(@is_array(getimagesize($filename))){
				$image = true;
			} else {
				$image = false;
			}
			return $image;
		}
		public function getRandLat(){
			$longitude = (float) 13.00000;
			$latitude = (float) 100.00000;
			$radius = rand(1,10); 
			
			$lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
			$lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
			$lat_min = $latitude - ($radius / 69);
			$lat_max = $latitude + ($radius / 69);
			
			return $lng_min;	
		}
		public function getRandLong(){
			$longitude = (float) 13.00000;
			$latitude = (float) 100.00000;
			$radius = rand(1,10); 
			
			$lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
			$lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
			$lat_min = $latitude - ($radius / 69);
			$lat_max = $latitude + ($radius / 69);
			
			return $lat_min;	
		}
		public function time_elapsed_string($datetime, $full = false) {
			date_default_timezone_set("Asia/Bangkok");
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
		
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
		
			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'minute'
				//'s' => 'second',
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}
			
			if (!$full) $string = array_slice($string, 0, 1);
			
			$string = str_replace('years','ปี',$string);
			$string = str_replace('year','ปี',$string);
			$string = str_replace('months','เดือน',$string);
			$string = str_replace('month','เดือน',$string);
			$string = str_replace('weeks','สัปดาห์',$string);
			$string = str_replace('week','สัปดาห์',$string);
			$string = str_replace('days','วัน',$string);
			$string = str_replace('day','วัน',$string);
			$string = str_replace('hours','ชั่วโมง',$string);
			$string = str_replace('hour','ชั่วโมง',$string);
			$string = str_replace('minutes','นาที',$string);
			$string = str_replace('minute','นาที',$string);
			$string = str_replace('seconds','วินาที',$string);
			$string = str_replace('second','วินาที',$string);
			$i = 0;
			$result = '';
			foreach ($string as $k => &$v) {
				//if($i == 0){
					$result .= $v.' ';
				//}
				$i++;
			}
			//$string = implode(' ', $string);
			
			
			return $string ? $result: 'เมื่อสักครู่';
		}
		
		public function finishTiming($start_time = "",$end_time = "")
		{
			date_default_timezone_set("Asia/Bangkok");
			
			
			if(!$start_time){
				return TRUE;	
			}
			if(!$end_time){
				$end_time = strtotime('+1200 years', $end_time);
			}
			$nowDate = date('Y-m-d H:i');
			$nowDate =  strtotime($nowDate);
			$start = strtotime($start_time);
			$end = strtotime($end_time);
		
			$isFinish = FALSE;
			/*echo 'nowDate : '.$nowDate."<br>";
			echo 'start_time : '.$start_time."<br>";
			echo 'end : '.$end_time;*/
			//echo (($nowDate > $start) && ($nowDate < $end));
			return (($nowDate >= $start) && ($nowDate <= $end));
			
			/*if(!$timestamp){
				return TRUE;	
			}
			$timestamp = strtotime($timestamp);
			$timestamp = time() - $timestamp; 
			$timestamp = ($timestamp<1)? 1 : $timestamp;
			$tokens = array (
				31536000 => 'year',
				2592000 => 'month',
				604800 => 'week',
				86400 => 'day',
				3600 => 'hour',
				60 => 'minute',
				1 => 'second'
			);
		
			foreach ($tokens as $unit => $text) {
				if ($timestamp < $unit) continue;
				$numberOfUnits = floor($timestamp / $unit);
				
			}
			
			$isFinish = FALSE;
			if($numberOfUnits > 1){
				$isFinish = TRUE;
			}else{
				$isFinish = FALSE;
			}
			return $isFinish;*/
		}
		public function finishPublish($timestamp = "")
		{
			date_default_timezone_set("Asia/Bangkok");
			
			if(!$timestamp){
				return TRUE;	
			}
			$timestamp = strtotime($timestamp);
			$timestamp = time() - $timestamp; 
			$timestamp = ($timestamp<1)? 1 : $timestamp;
			$tokens = array (
				31536000 => 'year',
				2592000 => 'month',
				604800 => 'week',
				86400 => 'day',
				3600 => 'hour',
				60 => 'minute',
				1 => 'second'
			);
		
			foreach ($tokens as $unit => $text) {
				if ($timestamp < $unit) continue;
				$numberOfUnits = floor($timestamp / $unit);
				
			}
			
			$isFinish = FALSE;
			if($numberOfUnits > 1){
				$isFinish = TRUE;
			}else{
				$isFinish = FALSE;
			}
			
			return $isFinish;
		}
		public function number_shorten($number, $precision = 2, $divisors = null) {
			//$precision = 2;
			
			if (!isset($divisors)) {
				$divisors = array(
					pow(1000, 0) => '', // 1000^0 == 1
					pow(1000, 1) => 'K', // Thousand
					pow(1000, 2) => 'M', // Million
					pow(1000, 3) => 'B', // Billion
					pow(1000, 4) => 'T', // Trillion
					pow(1000, 5) => 'Qa', // Quadrillion
					pow(1000, 6) => 'Qi', // Quintillion
				);    
			}
			foreach ($divisors as $divisor => $shorthand) {
				if (abs($number) < ($divisor * 1000)) {
					// We found a match!
					break;
				}
			}
			//return number_format($number / $divisor, $precision) . $shorthand;
			//return ($number / $divisor) . $shorthand;
			return number_format($number,$precision);
		}
		public function string_shorten($string,$min_str = 60,$max_str = 60){
			if (strlen($string) >= $max_str) {
				return mb_substr($string, 0, $min_str). " ... ";
			}else {
				return $string;
			}	
		}
		public function getSKUCode($product_id,$length = 5) {
			  $chars = '1234567890';
			  $ret = '';
			  for($i = 0; $i < $length; ++$i) {
				$random = str_shuffle($chars);
				$ret .= $random[0];
			  }
			  return 'K'.$product_id.$ret;
		}
		public function getStoreCode($length = 3) {
			  $chars = '1234567890';
			  $ret = '';
			  for($i = 0; $i < $length; ++$i) {
				$random = str_shuffle($chars);
				$ret .= $random[0];
			  }
			  return 'K'.time();
		}
		public function getCode($length = 8) {
			  $chars = '1234567890abcdefghijklmnopqrstuvwxyz';
			  $ret = '';
			  for($i = 0; $i < $length; ++$i) {
				$random = str_shuffle($chars);
				$ret .= $random[0];
			  }
			  return 'marketplace_'.$ret.''.time();
		}
		public function getVerifyCode($length = 8) {
			  $chars = '1234567890abcdefghijklmnopqrstuvwxyz';
			  $ret = '';
			  for($i = 0; $i < $length; ++$i) {
				$random = str_shuffle($chars);
				$ret .= $random[0];
			  }
			  return 'marketplace_'.$ret;
		}
		public function getInvoiceNumber($length = 10) {
			  $chars = '1234567890';
			  $ret = '';
			  for($i = 0; $i < $length; ++$i) {
				$random = str_shuffle($chars);
				$ret .= $random[0];
			  }
			  $day = date("Y-m-d H:i:s");
			  $day = str_replace("-","",$day);
			  $day = str_replace(":","",$day);
			  $day = str_replace(" ","",$day);
			  return "KW".$day;
		}
		public function getNewPassword($length = 10) {
			  $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
			  $ret = '';
			  for($i = 0; $i < $length; ++$i) {
				$random = str_shuffle($chars);
				$ret .= $random[0];
			  }
			  return $ret;
		}
		public function getFakeMemberID($length = 10) {
			  $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
			  $ret = '';
			  for($i = 0; $i < $length; ++$i) {
				$random = str_shuffle($chars);
				$ret .= $random[0];
			  }
			  return $ret;
		}
		public function getThaiDate($timestamp)
		{
			 $mons = array(1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม", 4 => "เมษายน", 5 => "พฤษภาคม", 6 => "มิถุนายน", 7 => "กรกฎาคม", 8 => "สิงหาคม", 9 => "กันยายน", 10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม");
			
			 $month_arr = explode("-",$timestamp);
			 $month_num = intval($month_arr[1]);
			
			 $month_name = $mons[$month_num];
			 $year_name = $month_arr[0];
			 $date_name = $month_arr[2];
			 $date_arr = explode(" ",$date_name);
			 $date_name = $date_arr[0];
			 return $date_name." ".$month_name." ".$year_name;
		}
		public function dayDiff($timestamp){
			$timestamp_arr = explode("-",$timestamp);
			$your_year = $timestamp_arr[0];
			$your_month = $timestamp_arr[1];
			$your_day = $timestamp_arr[2];
			$current_date = date("U");
			
			$date = date($your_year."-".$your_month."-".$your_day);
			$selected_date_stamp = strtotime($date);
			
			//$selected_date_stamp = mktime(0,0,0,$your_month,$your_day,$your_year);
			$selected_date = date("U",$selected_date_stamp);
			$difference = round (($current_date - $selected_date)/(3600*24));
			return ($difference);
		}
		
		public function get_client_ip() {
			$ipaddress = '';
			if (isset($_SERVER['HTTP_CLIENT_IP']))
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_X_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			else if(isset($_SERVER['REMOTE_ADDR']))
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			else
				$ipaddress = 'UNKNOWN';
			return $ipaddress;
		}
		public function strip($content){
			return strip_tags($content,'<b><p><i><u><ul><ol><li><img>');	
		}
		
		public function stripHTMLtags($str)
		{
			$t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
			$t = htmlentities($t, ENT_QUOTES, "UTF-8");
			return $t;
		}
		public function numberThai($number){ 
			$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
			$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
			$number = str_replace(",","",$number); 
			$number = str_replace(" ","",$number); 
			$number = str_replace("บาท","",$number); 
			$number = explode(".",$number); 
			if(sizeof($number)>2){ 
				return 'ทศนิยมหลายตัวนะจ๊ะ'; 
				exit; 
			} 
			$strlen = strlen($number[0]);  
			$convert = ''; 
			for($i=0;$i<$strlen;$i++){ 
				$n = substr($number[0], $i,1);  
				if($n!=0){ 
					if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
					elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
					elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }  
					else{ $convert .= $txtnum1[$n]; } 
					$convert .= $txtnum2[$strlen-$i-1]; 
				} 
			} 
			
			$convert .= 'บาท'; 
			if($number[1]=='0' OR $number[1]=='00' OR  
				$number[1]==''){ 
				$convert .= 'ถ้วน'; 
			}else{ 
				$strlen = strlen($number[1]); 
				for($i=0;$i<$strlen;$i++){ 
				$n = substr($number[1], $i,1); 
					if($n!=0){ 
						if($i==($strlen-1) AND $n==1){
							$convert .= 'เอ็ด';
						}else if($i==($strlen-2) AND $n==2){ 
							$convert .= 'ยี่';
						}else if($i==($strlen-2) AND $n==1){
							$convert .= '';
						}else{ 
							$convert .= $txtnum1[$n];
						} 
						
						$convert .= $txtnum2[$strlen-$i-1]; 
					} 
				} 
				$convert .= 'สตางค์';  
			} 
			return $convert;  
		} 
		public function getAgeByBirthday($birthDate){
		  $birthDate = explode("-", $birthDate);
		  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
			? ((date("Y") - $birthDate[2]) - 1)
			: (date("Y") - $birthDate[2]));
		  return $age;
		}
		public function sendContact($email,$name,$phone,$message) {
 		
		
		
		$body = '<html>
					<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
						<center>
							<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
								<tr>
									<td align="center" valign="top">
										
										<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
											
											<tr>
												<td align="center" valign="top">
													<!-- // Begin Template Body \\ -->
													<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
														<tr>
															<td colspan="3" valign="top" class="bodyContent">
															
																<!-- // Begin Module: Standard Content \\ -->
																<table border="0" cellpadding="20" cellspacing="0" width="100%">
																	<tr>
																		<td valign="top">
																			<div mc:edit="std_content00">
																				<h3>เรียน marketplace.co.th</h3>
																				<h4>ข้าพเจ้า '.$name.'</h4>
																				เบอร์โทรศัพท์ <b>'.$phone.'</b><br>
																				อีเมล <b>'.$email.'</b><br>
																				'.$message.'<br>
																			</div>
																		</td>
																	</tr>
																</table>
																<!-- // End Module: Standard Content \\ -->
															
															</td>
														
													</table>
													<!-- // End Template Body \\ -->
												</td>
											</tr>
											
											
											<tr>
												<td align="center" valign="top">
													<!-- // Begin Template Body \\ -->
													<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
														<tr>
															<td colspan="3" valign="top" class="bodyContent">
																<br>
																<hr>
																<br>
																<img src="'.$this->logo.'"/><br><br>
																<b>marketplace.co.th รับทำ website และ mobile apps</b><br>
																อีเมล. info@marketplace.co.th<br>
																ที่อยู่. บริษัท marketplace จำกัด ( marketplace.co.th ) 41/94 บางตลาด ปากเกร็ด นนทบุรี
															
															</td>
														
													</table>
													<!-- // End Template Body \\ -->
												</td>
											</tr>
											
											
										</table>
									</td>
								</tr>
							</table>
						</center>
					</body>
				</html>';
		
		//$this->CI->phpmailer->SMTPAuth = TRUE;				
		//$this->CI->phpmailer->SMTPDebug = 2;				
		$this->CI->phpmailer->CharSet = "utf-8";
        $this->CI->phpmailer->Host       = "smtp.gmail.com";     
        $this->CI->phpmailer->Port       = 465;                   
        $this->CI->phpmailer->Username   = "marketplace@gmail.com";  
        $this->CI->phpmailer->Password   = "";           
        $this->CI->phpmailer->SetFrom($email, $name); 
        $this->CI->phpmailer->Subject = 'ติดต่อสอบถามข้อมูล marketplace.co.th';  
        $this->CI->phpmailer->MsgHTML($body);
		$this->CI->phpmailer->ClearAddresses();
        $this->CI->phpmailer->AddAddress('marketplace@gmail.com','Marketplace ติดต่อสอบถามข้อมูล'); 
		
        if(!$this->CI->phpmailer->Send()) { 
           //echo $this->CI->phpmailer->ErrorInfo;
        } else {
           //echo "ส่งอีเมล์สำเร็จ!";
        }
	}
	
	
	public function sendForgotpassword($email,$name,$verify_link) {
 		
		
		
		$body = '<html>
					<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
						<center>
							<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
								<tr>
									<td align="center" valign="top">
										
										<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
											
											<tr>
												<td align="center" valign="top">
													<!-- // Begin Template Body \\ -->
													<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
														<tr>
															<td colspan="3" valign="top" class="bodyContent">
															
																<!-- // Begin Module: Standard Content \\ -->
																<table border="0" cellpadding="20" cellspacing="0" width="100%">
																	<tr>
																		<td valign="top">
																			<div mc:edit="std_content00">
																				<h3>เรียนคุณ '.$name.'</h3> 
																				มีการร้องขอเพื่อเปลี่ยนรหัสผ่านใหม่ หากท่านไม่ได้ร้องขอเพื่อเปลี่ยนรหัสใหม่<br>
																				ให้เพิกเฉยต่ออีเมลฉบับนี้ หากท่านเป็นผู้ร้องขอเปลี่ยนรหัสผ่านใหม่<br>
																				กรุณาคลิกลิงค์ด้านล่าง<br>
																				<br>
																				<a href="'.$verify_link.'">เปลี่ยนรหัสผ่านใหม่</a>
																				<br>
																				เพื่อความปลอดภัยกรุณาเข้าสู่ระบบและเปลี่ยนรหัสผ่านด้วยตัวของท่านเอง
																			</div>
																		</td>
																	</tr>
																</table>
																<!-- // End Module: Standard Content \\ -->
															
															</td>
														
													</table>
													<!-- // End Template Body \\ -->
												</td>
											</tr>
											<tr>
												<td align="center" valign="top">
													<!-- // Begin Template Body \\ -->
													<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
														<tr>
															<td colspan="3" valign="top" class="bodyContent">
																<br>
																<hr>
																<br>
																<img src="'.$this->logo.'"/><br><br>
																<b>marketplace.co.th รับทำ website และ mobile apps</b><br>
																อีเมล. info@marketplace.co.th<br>
																ที่อยู่. บริษัท marketplace จำกัด ( marketplace.co.th ) 41/94 บางตลาด ปากเกร็ด นนทบุรี
															
															</td>
														
													</table>
													<!-- // End Template Body \\ -->
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
							</table>
						</center>
					</body>
				</html>';
		
						
		$this->CI->phpmailer->CharSet = "utf-8";
        $this->CI->phpmailer->Host       = "smtp.gmail.com";     
        $this->CI->phpmailer->Port       = 465;                   
        $this->CI->phpmailer->Username   = "marketplace@gmail.com";  
        $this->CI->phpmailer->Password   = "";                
        $this->CI->phpmailer->SetFrom('marketplace@gmail.com', 'บริษัท Marketplace จำกัด ( marketplace.co.th )');  
        $this->CI->phpmailer->Subject = 'รหัสผ่านใหม่สำหรับเข้าสู่ระบบ marketplace.co.th'; 
        $this->CI->phpmailer->MsgHTML($body);
		$this->CI->phpmailer->ClearAddresses();
        $this->CI->phpmailer->AddAddress($email,$name);
		
		
        if(!$this->CI->phpmailer->Send()) {
            //echo $this->phpmailer->ErrorInfo;
        } else {
           //echo "ส่งอีเมล์สำเร็จ!";
        }
	}
	
	public function sendRegister($email,$name,$verify_link) {
 		
		
		//$verify_link = base_url("member/verify/".$member_verify_code);
		$body = '<html>
					<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
						<center>
							<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
								<tr>
									<td align="center" valign="top">
										
										<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
											
											<tr>
												<td align="center" valign="top">
													<!-- // Begin Template Body \\ -->
													<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
														<tr>
															<td colspan="3" valign="top" class="bodyContent">
															
																<!-- // Begin Module: Standard Content \\ -->
																<table border="0" cellpadding="20" cellspacing="0" width="100%">
																	<tr>
																		<td valign="top">
																			<div mc:edit="std_content00">
																				<h3>เรียนคุณ '.$name.'</h3>
																				ท่านได้สมัครสมาชิกกับเว็บไซต์ marketplace.co.th เรียบร้อยแล้ว เพื่อการใช้งานอย่างสมบูรณ์ กรุณากดลิงค์ยืนยันตัวต้นด้านล่าง
																				<br>
																				<a href="'.$verify_link.'">ยืนยันการสมัครสมาชิก</a>
																				<br>
																				<h4>ข้อมูลสำหรับผู้เริ่มต้น</h4>
																				เริ่มต้นเป็นนักเขียนออนไลน์ เขียนเรื่องราวประทับใจ สร้างเนื้อหาที่เป็นประโยชน์และแบ่งปันประสบการณ์ดี ๆ กับผู้คนทั่วโลก marketplace.co.th เป็นโอกาส เป็นสื่อกลาง และยังเป็นอีกหนึ่งช่องทางในการสร้างรายได้ให้กับนักเขียน มืออาชีพและนักเขียนมือสมัครเล่นจากทุกมุมโลก เพียงสมัครเป็นสมาชิกเว็บไซต์เขียนหนังสือ การ์ตูนหรือ อัพโหลดอนิเมชั่นที่เป็นผลงานของท่าน และเผยแพร่ ผลงานสู่สาธารณชน
																			</div>
																		</td>
																	</tr>
																</table>
																<!-- // End Module: Standard Content \\ -->
															
															</td>
														
													</table>
													<!-- // End Template Body \\ -->
												</td>
											</tr>
											<tr>
												<td align="center" valign="top">
													<!-- // Begin Template Body \\ -->
													<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
														<tr>
															<td colspan="3" valign="top" class="bodyContent">
																<br>
																<hr>
																<br>
																<img src="'.$this->logo.'"/><br><br>
																<b>marketplace.co.th รับทำ website และ mobile apps</b><br>
																อีเมล. info@marketplace.co.th<br>
																ที่อยู่. Marketplace จำกัด ( marketplace.co.th )
															
															</td>
														
													</table>
													<!-- // End Template Body \\ -->
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
							</table>
						</center>
					</body>
				</html>';
		
						
		$this->CI->phpmailer->CharSet = "utf-8";
        $this->CI->phpmailer->Host       = "smtp.gmail.com";     
        $this->CI->phpmailer->Port       = 465;                   
        $this->CI->phpmailer->Username   = "marketplace@gmail.com";  
        $this->CI->phpmailer->Password   = "";                
        $this->CI->phpmailer->SetFrom('marketplace@gmail.com', 'บริษัท Marketplace จำกัด ( marketplace.co.th )'); 
        $this->CI->phpmailer->Subject = 'รายละเอียดสมัครสมาชิก marketplace.co.th'; 
        $this->CI->phpmailer->MsgHTML($body);
		$this->CI->phpmailer->ClearAddresses();
        $this->CI->phpmailer->AddAddress($email,$name);
		
		
        if(!$this->CI->phpmailer->Send()) {
            //echo $this->phpmailer->ErrorInfo;
        } else {
           //echo "ส่งอีเมล์สำเร็จ!";
        }
	}
	
	
	
		
	public function utf8_strlen($s) 
	{
		$s = strip_tags($s);
		$s = html_entity_decode($s, ENT_COMPAT, 'UTF-8');
	 	$s = str_replace(' ', '', $s); // Replaces all spaces with hyphens.
	   	$s = preg_replace('/[^a-zA-Z0-9ก-๙เแ_ \<\>\+\@\#\!\{\}\*\,\'\"\?\%\[\]\.\(\)%&-]/u', '', $s);
		$s = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($s));
	
		$s = strip_tags($s);
		$s = preg_replace("/\s/", "", $s);
		$s = trim(preg_replace('/\s\s+/', ' ', $s));
		$s = str_replace(PHP_EOL, '', $s);
		$s = str_replace(array("\n","\r"), '', $s);
		
		$c = strlen($s); $l = 0;

		for ($i = 0; $i < $c; ++$i) if ((ord($s[$i]) & 0xC0) != 0x80) ++$l;
		//return strlen($s);
		return $l;

	}
	public function clean($s)
	{
		$s = strip_tags($s,"<i><br><b><p><span><l><u><ul><li><img><font><div>");
		$s = str_replace("&lt;!--[if gte mso 9]--&gt;","",$s);
		$s = str_replace("&lt;!--[if !supportFootnotes]--&gt;","",$s);
		$s = str_replace("&lt;!--[if !supportLists]--&gt;","",$s);
		$s = str_replace("&lt;!--[endif]--&gt;","",$s);
		$s = str_replace("<o:p>","",$s);
		$s = str_replace("</o:p>","",$s);
		return $s;
	}
	public function urlClean($s){
			//$name_arr = explode(" ",$s);
			//$s = $name_arr[0];
			$s = strip_tags($s); 
			$s = str_replace(" ","-",$s);
			$s = str_replace("/","",$s);
			$s = str_replace("\\","",$s);
			$s = str_replace("'","",$s);
			$s = str_replace('"',"",$s);
			$s = str_replace("(","",$s);
			$s = str_replace(")","",$s);
			$s = str_replace("[","",$s);
			$s = str_replace("]","",$s);
			$s = str_replace("{","",$s);
			$s = str_replace("}","",$s);
			$s = str_replace(".","",$s);
			$s = str_replace("*","",$s);
			$s = str_replace("#","",$s);
			$s = str_replace("%","",$s);
			$s = str_replace("<","",$s);
			$s = str_replace(">","",$s);
			return $s;
	}
	
	public function shareClean($s){ 
			$s = strip_tags($s);
			
			
			$s = str_replace(PHP_EOL, '', $s);
			$s = str_replace(array("\n","\r"), '', $s);
			$s = str_replace("/","",$s);
			$s = str_replace("\\","",$s);
			$s = str_replace("'","",$s);
			$s = str_replace('"',"",$s);
			$s = str_replace(".","",$s);
			$s = str_replace("*","",$s);
			$s = str_replace("#","",$s);
			$s = str_replace("%","",$s);
			$s = str_replace("<","",$s);
			$s = str_replace(">","",$s);
			$s = str_replace("/","",$s);
			$s = str_replace("\\","",$s);
			$s = str_replace("'","",$s);
			$s = str_replace('"',"",$s);
			$s = str_replace(".","",$s);
			$s = str_replace("*","",$s);
			$s = str_replace("#","",$s);
			$s = str_replace("%","",$s);
			$s = str_replace("<","",$s);
			$s = str_replace(">","",$s);
			return $s;
	}
	public function upload_multiple_file($path, $title, $files, $_w = "", $_h = "",$ratio = TRUE){
        $config = array(
            'upload_path'   => $path,
			//'encrypt_name' = TRUE,
            'allowed_types' => 'svg|gif|jpg|png|doc|doc',
            'overwrite'     => 1,                       
        );
        $this->CI->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'.$this->getCode(10).'_'.$image;

            $images[] = $path."/".$fileName;

            $config['file_name'] = $fileName;
			$config['quality'] = 100;
			
			
			
            $this->CI->upload->initialize($config);

            if ($this->CI->upload->do_upload('images[]')) {
                $image_data = $this->CI->upload->data();
				if($_w && $_h){
					$config['image_library'] = 'gd2';
					$config['maintain_ratio'] = $ratio;
					$config['master_dim'] = 'width';
					$config['width'] = $_w;
					$config['height'] = $_h; 
					$config['source_image'] = $image_data['full_path'];
					$this->CI->load->library('image_lib', $config); 
					$this->CI->image_lib->resize();
					$this->CI->image_lib->crop();
				}
            } else {
                return false;
            }
        }

        return $images;
	}

	public function name() {
		return $this->CI->session->userdata("name");
	}

	public function permissionUser()
	{	

		$modules_name = $this->CI->uri->segment(1);
		$this->CI->load->model('model_user');
		$permission_result = $this->CI->model_user->getPermissionByModuls($modules_name);
		if(count($permission_result)>0){
			$per_user_type = $permission_result[0]['per_user_type'];
			$per_name_th = $permission_result[0]['per_name_th'];
			$modulesList_val = explode(',', $per_user_type);
		}else{
		 	$per_user_type = "";
			$per_name_th = "";
			$modulesList_val = explode(',', $per_user_type);
		 	redirect("member/logout");
		}

		if(!empty($modulesList_val)){
			if(!in_array($this->user_type(), $modulesList_val)){
				$error_title = '';
				$error_message = 'คุณไม่สามารถเข้าถึง ส่วนของ '.$per_name_th.' ได้';
				$this->errorMessage($error_title,$error_message);
				redirect("statistics",'refresh');
			}
		}
		
	}

	public function permissionUser2()
	{	
		//user_type = 1 => admin 
		//user_type = 2 => เจ้าหน้าที่ 
		$modulesList = array(
			
			// 'contact' => array( 'name' => 'ติดต่อเรา', 'user_type' => array(1,2)),
			// 'contactmassage' => array( 'name' => 'ช้อความติดต่อ', 'user_type' => array(1,2)),
			// 'massage' => array( 'name' => 'ประวัติการสนทนา', 'user_type' => array(1,2)),

			'category' => array( 'name' => 'หมวดหมู่', 'user_type' => array(1,2)),
			'faq' => array( 'name' => 'ช่วยเหลือ', 'user_type' => array(1,2)),
			'feature' => array( 'name' => 'feature', 'user_type' => array(1,2)),
			'inboxs' => array( 'name' => 'inbox', 'user_type' => array(1,2)),
			'member' => array( 'name' => 'รายการสมาชิก', 'user_type' => array(1,2)),
			'message_inbox' => array( 'name' => 'ประวัติการสนทนา', 'user_type' => array(1,2)),
			'news' => array( 'name' => 'ข่าวสาร', 'user_type' => array(1,2)),
			'order' => array( 'name' => 'รายการคำสั่งซื้อ', 'user_type' => array(1,2)),
			'place' => array( 'name' => 'สถานที่ส่งสินค้า', 'user_type' => array(1,2)),
			'popular' => array( 'name' => 'Popular products', 'user_type' => array(1,2)),
			'product' => array( 'name' => 'สินค้า', 'user_type' => array(1,2)),
			'productset' => array( 'name' => 'สินค้าตั้งแสดง', 'user_type' => array(1,2)),
			'promotions' => array( 'name' => 'โปรโมชั่น', 'user_type' => array(1,2)),
			'review' => array( 'name' => 'รีวิว', 'user_type' => array(1,2)),
			'settings' => array( 'name' => 'ตั้งค่า', 'user_type' => array(1,15)),
			'slidebanner' => array( 'name' => 'Slide banner', 'user_type' => array(1,2)),
			'statistics' => array( 'name' => 'ผลรวมสถิติ', 'user_type' => array(1,2,15)),
			'store' => array( 'name' => 'ร้านค้า', 'user_type' => array(1,2)),
			'topup' => array( 'name' => 'เหรียญ', 'user_type' => array(1,2)),
		);

		$modules_name = $this->CI->uri->segment(1);
		if(!empty($modulesList[$modules_name]['user_type'])){
			if(!in_array($this->user_type(), $modulesList[$modules_name]['user_type'])){
				$error_title = '';
				$error_message = 'คุณไม่สามารถเข้าถึง ส่วนของ '.$modulesList[$modules_name]['name'].' ได้';
				$this->errorMessage($error_title,$error_message);
				redirect("statistics",'refresh');
			}
		}

	}

	public function errorMessage($error_title,$error_message)
	{
		if($error_title == ''){
			$error_title = 'ข้อความจากระบบ';
		}
		$this->CI->session->set_flashdata('error_title', $error_title);
		$this->CI->session->set_flashdata('error_message', $error_message);
	}

	function time_ago($datetime, $full = false) {
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
		
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
		
			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'minute',
				's' => 'second',
			);
			
			$string = str_replace('years','ปี',$string);
			$string = str_replace('year','ปี',$string);
			$string = str_replace('months','เดือน',$string);
			$string = str_replace('month','เดือน',$string);
			$string = str_replace('weeks','สัปดาห์',$string);
			$string = str_replace('week','สัปดาห์',$string);
			$string = str_replace('days','วัน',$string);
			$string = str_replace('day','วัน',$string);
			$string = str_replace('hours','ชั่วโมง',$string);
			$string = str_replace('hour','ชั่วโมง',$string);
			$string = str_replace('minutes','นาที',$string);
			$string = str_replace('minute','นาที',$string);
			$string = str_replace('seconds','วินาที',$string);
			$string = str_replace('second','วินาที',$string);
			
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
				} else {
					unset($string[$k]);
				}
			}
		
			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' ที่แล้ว' : 'เมื่อสักครู่';
		}

	

}