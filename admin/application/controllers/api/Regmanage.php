<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regmanage extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
	}
	public function index()
	{

	}
	public function amphures()
	{
		$this->load->model('model_manage');
		$province_id = $this->input->post('province_id');
		if(!empty($province_id)){
			$amphures = $this->model_manage->getAmphures($province_id);
			echo json_encode($amphures); 
		}else{
			$success = false;
			echo json_encode($success); 
		}
		
	}
	public function districts()
	{
		$this->load->model('model_manage');
		$province_id = $this->input->post('province_id');
		$amphur_id = $this->input->post('amphur_id');
		if(!empty($province_id) AND !empty($amphur_id)){
			$districts = $this->model_manage->getDistricts($province_id,$amphur_id);
			echo json_encode($districts); 
		}else{
			$success = false;
			echo json_encode($success); 
		}
		
	}
	public function zipCodes()
	{
		$this->load->model('model_manage');
		$district_code = $this->input->post('district_code');
		if(!empty($district_code)){
			$zipcodes = $this->model_manage->getZipcodes($district_code);
			echo json_encode($zipcodes); 
		}else{
			$success = false;
			echo json_encode($success); 
		}	
	}
	public function petBreeds()
	{
		$this->load->model('medicalrecords/model_pet');
		$pet_type_id = $this->input->post('pet_type_id');
		$petbreeds = $this->model_pet->getPetBreeds($pet_type_id);
		echo json_encode($petbreeds); 
	}

	public function getpetbyid()
	{
		$this->load->model('medicalrecords/model_pet');
		$pet_id = $this->input->post('pet_id');
		//$pet_id = 28365;
		$pet = $this->model_pet->getPetById($pet_id);
		if(count($pet)>0){
			$petpicture = $pet[0]->petpicture;
			if($petpicture == ''){
				$pet[0]->petpicture = $this->utils->imgModelpet($pet[0]->pettype);
			}
			$typepetname = $this->utils->typePetname($pet[0]->pettype);
			$pet[0]->pettype = $typepetname;
			
			
			
			/*$sprayedorneutereded = $pet[0]->sprayedorneutereded;
			if(!$sprayedorneutereded || $sprayedorneutereded == ""){
				$pet[0]->sprayedorneutereded = 'ยังไม่เคยทำหมัน';
			}*/
			
			$petsex = $this->utils->typeSexname($pet[0]->petsex);
			$pet[0]->petsex = $petsex;
		}
		//print_r($pet);
		echo json_encode($pet);

	}

	public function addpetiscuid()
	{
		$success = false;
		$this->load->model('medicalrecords/model_pet');
		$this->load->model('medicalrecords/model_customer');

        $petbirthday = $this->input->post('petbirthday');
        if(!empty($petbirthday) && $petbirthday != 'ไม่ระบุ'){
        	list($day,$month,$year) = explode('/', $petbirthday);
       		$petbirthday = $year.'-'.$month.'-'.$day;
       		$date = date_create($petbirthday);
			$petbirthday = date_format($date,'Y-m-d H:i:s');
		}

        $cuid = $this->input->post('cuid');

   		if($cuid != ''){

   			$filename = 'file';
        	$path = $this->utils->do_upload($filename);

        	if($petbirthday != 'ไม่ระบุ' && !empty($petbirthday)){
        		$today = date_create(date('Y-m-d H:i:s'));
				$birthday = $date;
   				$interval = date_diff($today,$birthday);
   				$day = $interval->d;
   				$month = $interval->m;
   				$year = $interval->y;
        	}else{
				$day = 0;
   				$month = 0;
   				$year = 0;
        	}
        	
	        $dataPet = array(
				'petid' => 'P'.$this->utils->codePet(),
				'cuid' => $cuid,
				'petname' => $this->input->post('petname'),
				'petpicture' => $path,
				'pettype' => $this->input->post('pettype'),
				'petageday' => $day,
				'petagemonth' =>  $month,
				'petageyear' => $year,
				'petsex' => $this->input->post('petsex'),
				'petbreed' => $this->input->post('petbreed'),
				'sprayedorneutereded' => $this->input->post('sprayedorneutereded'),
				'petcolor' => $this->input->post('petcolor'),
				'petstatus' => 'normal',
				'petdefect' => $this->input->post('petdefect'),
				'petbirthday' => $petbirthday,
				'microship' => $this->input->post('microship'),
			);

			$this->db->insert('pet', $dataPet);
			$pet_id = $this->db->insert_id();
			$success = true;

		}else{
			$pet_id = '';
			$path = '';
		}

        $data = array(
        	'success' => $success,
        	'pet_id' => $pet_id,
        	'full_path' => $path
        );

		echo json_encode($data); 
	}

	public function uploadImage()
	{
		$filename = 'file';
        $path = $this->utils->do_upload($filename);
        $data = array(
        	'full_path' => $path
        );
		echo json_encode($data); 
	}

	public function editpetiscuid(){
		$success = false;
		$this->load->model('medicalrecords/model_pet');
		$this->load->model('medicalrecords/model_customer');

        $petbirthday = $this->input->post('petbirthday');
        if(!empty($petbirthday) && $petbirthday != 'ไม่ระบุ'){
	       	list($day,$month,$year) = explode('/', $petbirthday);
	       	$petbirthday = $year.'-'.$month.'-'.$day;
	       	$date = date_create($petbirthday);
			$petbirthday = date_format($date,'Y-m-d H:i:s');
		}

        $oldimagepet = $this->input->post('oldimagepet');
        $cuid = $this->input->post('cuid');
        $uid = $this->input->post('uid');

   		if($cuid != '' AND $uid != ''){

   			$filename = 'file';
   			if(!isset($oldimagepet)){
   				$path = $this->utils->do_upload($filename);
   			}else{
   				$path = $oldimagepet;
   			}
        	

        	if($petbirthday != 'ไม่ระบุ' && !empty($petbirthday)){
        		$today = date_create(date('Y-m-d H:i:s'));
				$birthday = $date;
   				$interval = date_diff($today,$birthday);
   				$day = $interval->d;
   				$month = $interval->m;
   				$year = $interval->y;
        	}else{
				$day = 0;
   				$month = 0;
   				$year = 0;
        	}
        	
	        $editdataPet = array(
				'petname' => $this->input->post('petname'),
				'petpicture' => $path,
				'pettype' => $this->input->post('pettype'),
				'petageday' => $day,
				'petagemonth' =>  $month,
				'petageyear' => $year,
				'petsex' => $this->input->post('petsex'),
				'petbreed' => $this->input->post('petbreed'),
				'sprayedorneutereded' => $this->input->post('sprayedorneutereded'),
				'petcolor' => $this->input->post('petcolor'),
				'petstatus' => 'normal',
				'petdefect' => $this->input->post('petdefect'),
				'petbirthday' => $petbirthday,
				'microship' => $this->input->post('microship'),
			);

	        $this->db->where('uid', $uid);
			$this->db->update('pet', $editdataPet);
			$success = true;

		}else{
			$path = '';
		}

        $data = array(
        	'success' => $success,
        	'full_path' => $path
        );

		echo json_encode($data);
	}

	public function removepetisid()
	{
		$pet_id = $this->input->post('pet_id');

		$this->db->set('petstatus','dead');
        $this->db->where('uid',$pet_id);
        $this->db->update('pet');

        $data = array(
        	'success' => true
        );

		echo json_encode($data); 
	}


	
}
