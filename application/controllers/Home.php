<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model(['HomeModel'=>'hm']);
	}

	/*====================== LAYOUT FOR HEADER, FOOTER AND ASIDE ============================*/
	private function header(){
		$data = array();
		return $this->load->view('layouts/header', $data, true);
	}
	private function footer(){
		$data = array();
		return $this->load->view('layouts/footer', $data, true);
	}
	private function aside(){
		$data = array();
		return $this->load->view('layouts/aside', $data, true);
	}
	/*===========================================================================================*/

	/*============================================ Get Category ==================================*/
	public function getCategories(){
		$output = array();
		$default = (object)array('id'=>"", "cat_name"=>"Select any category");
		array_push($output, $default);
		$result = $this->hm->getCategories();
		if(!empty($result)){
			foreach($result as $row){
				$output[] = $row;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	/*=======================================================================================================*/

	/*============================================ Get Sub-Category By CID ==================================*/
	public function getSubCategoriesByCid(){
		$output = array();
		$cid = $_POST['cid'];
		$default = (object)array('id'=>"", "cat_name"=>"Select any sub-category");
		array_push($output, $default);
		$result = $this->hm->getSubCategoriesByCid($cid);
		if(!empty($result)){
			foreach($result as $row){
				$output[] = $row;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*===========================================================================================*/

	/*============================================ Get Child ==================================*/
	public function getChilds(){
		$output = array();
		$default = (object)array('id'=>"", "title"=>"Select any child");
		array_push($output, $default);
		$result = $this->hm->getChilds();
		if(!empty($result)){
			foreach($result as $row){
				$output[] = $row;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/*===========================================================================================*/

	/*============================================ Get Best Offer ==================================*/
	public function getBestOffers(){
		$output = array();
		$default = (object)array('id'=>"", "title"=>"Select any Best Offer");
		array_push($output, $default);
		$result = $this->hm->getBestOffers();
		if(!empty($result)){
			foreach($result as $row){
				$output[] = $row;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	/*===========================================================================================================*/

	/*============================================ Get City ==================================*/
	public function getCities(){
		$output = array();
		$default = (object)array('id'=>"", "cname"=>"Select any city");
		array_push($output, $default);
		$result = $this->hm->getCities();
		if(!empty($result)){
			foreach($result as $row){
				$output[] = $row;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	/*=======================================================================================================*/

	/*============================================ Get Brand ==================================*/
	public function getBrands(){
		$output = array();
		$default = (object)array('id'=>"", "cname"=>"Select any brand");
		array_push($output, $default);
		$result = $this->hm->getBrands();
		if(!empty($result)){
			foreach($result as $row){
				$output[] = $row;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	/*=======================================================================================================*/

	/*======================= Login, Logout and Login System ====================================================*/
	public function login(){
		if($this->session->userdata( 'userData' )){
			redirect(base_url('home/index'));
		}else{
			$data = array();
			$this->load->view('pages/login',$data);
		}
	}

	public function logout(){
		if($this->session->userdata( 'userData' )){
			$this->session->sess_destroy();
			redirect(base_url('home/login'));
		}else{
			redirect(base_url('home/index'));
		}
	}

	public function auth(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$remember = $_POST['remember'];
		$result   = $this->hm->auth($username,md5($password));
		if($result){
			$userData = array(
				'id' => $result[0]->id,
				'username' => $result[0]->username,
			);
			$this->session->set_userdata('userData', $username);
			if($remember == "on"){
				set_cookie('set_username',$username,'86400');
				set_cookie('set_password',$password,'86400');
			}else{
				delete_cookie('set_username');
				delete_cookie('set_password');
			}
			redirect(base_url('home/index'));
		}else{
			$this->session->set_flashdata('item','username and password not matched');
			redirect(base_url('home/login'));
		}
	}
	/*==================================================================================*/

	/*=============================== Dashboard =========================================*/
	public function index(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/dashboard';
			$totalUser     = $this->hm->totalUser();
			$totalPartner  = $this->hm->totalPartner();
			$totalOrder    = $this->hm->totalOrder();
			$totalIncome   = $this->hm->totalIncome();
			$totalTax      = $this->hm->totalTax();
			$productList   = $this->hm->productList();
			$mothlyRevenue = $this->hm->getMonthlyRevenue();
			$orderList     = $this->hm->orderList();
			$data['pageData'] = array(
				'Total Uer' => $totalUser,
				'Total Partner' => $totalPartner,
				'Total Order' => $totalOrder,
				'Totla Income' => $totalIncome[0]->p_amt,
				'Total Tax' => $totalTax[0]->c_amt,
				'productList' => $productList,
				'monthlyRevenue' => $mothlyRevenue,
				'orderList'      => $orderList
			);
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	/*========================================================================================*/

	/*================================== Banner ==============================================*/
	public function banner(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/banner';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function BannerList(){
		$results = $this->bm->getBannerList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = '<img src="'.$result->img.'" width="150">';
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-success btn-sm mx-3" onclick="bannerDetailsView('.$result->id.')"><i class="fa fa-eye"></i> View Other Details</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteBanner('.$result->id.', `'.$result->img.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="BannerStatusChange('.$result->status.','.$result->id.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bm->count_all_data(),
			"recordsFiltered" => $this->bm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertBanner(){
		$image    = '';
		$url      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');

		if(!empty($_FILES['formFile']['name'])){
			$img = $_FILES['formFile']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formFile')){
				$file = $this->upload->data();
				$image = "{$url}{$file['file_name']}";
			}else{
				echo $this->upload->display_errors();
			}
		}

		$data = array('img' => $image);

		if($this->bm->insertBanner($data)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteBanner(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$path = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $path);
		}
		if($this->bm->deleteBanner($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeBannerStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->bm->changeBannerStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getBannerDetailsById(){
		$id     = $_POST['id'];
		$result = $this->bm->getBannerDetailsById($id);
		if($result){
			$response = array('status'=>'success', 'message'=>'Successfull', 'data'=>$result);
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild', 'data'=>[]);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function updateBannerOtherDetails(){
		$id  = $_POST['id'];
		$cid = !empty($_POST['cid'])?$_POST['cid'] : 0;
		$sid = !empty($_POST['sid'])?$_POST['sid'] : 0;
		$response = array();
		if($cid !== 0){
			$data = array(
				'sid' => $sid,
				'cid' => $cid
			);
			if($this->bm->updateBannerOtherDetails($data, $id)){
				$response = array('status'=>'success', 'message'=>'Successfull');
			}else{
				$response = array('status'=>'faild', 'message'=>'Faild');
			}
		}else{
			$response = array('status'=>'success', 'message'=>'Successfull');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*============================================================================================*/

	/*======================================= City ================================================*/
	public function city(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/city';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function cityList(){
		$results = $this->cm->getCityList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = '<img src="'.$result->img.'" width="150">';
			$row[] = $result->cname;
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteCity('.$result->id.', `'.$result->img.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="cityStatusChange('.$result->status.','.$result->id.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->cm->count_all_data(),
			"recordsFiltered" => $this->cm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}


	public function insertUpdateCity(){
		$city     = $_POST['city'];
		$id       = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image    = '';
		$url      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');

		if(!empty($_FILES['formFile']['name'])){
			$img = $_FILES['formFile']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formFile')){
				$file = $this->upload->data();
				$image = "{$url}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}

		$data = array(
			'cname' => $city,
			'img' => $image
		);

		if($this->cm->insertUpdateCity($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getCityDetailsById(){
		$id = $_POST['id'];
		$output = $this->cm->getCityDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function changeCityStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->cm->changeCityStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteCity(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$path = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $path);
		}
		if($this->cm->deleteCity($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*========================================================================================================================*/

	/*================================================== category =============================================================*/

	public function category(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/category';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function categoryList(){
		$results = $this->catm->getCategoryList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->cat_name;
			$row[] = $result->cat_subtitle;
			$row[] = '<img src="'.$result->cat_img.'" width="150" alt="image">';
			$row[] = !empty($result->cat_video)? '<video width="250" height="200" controls  src="'.$result->cat_video.'"></video>' : '';
			$row[] = ($result->cat_status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-primary btn-sm mx-3" onclick="addVideoModal('.$result->id.')"><i class="fa fa-plus"></i> Add Video</button>
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteCategory('.$result->id.',`'.$result->cat_img.'`,`'.$result->cat_video.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeCategoryStatus('.$result->id.','.$result->cat_status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->catm->count_all_data(),
			"recordsFiltered" => $this->catm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateCategory(){
		$title       = $_POST['title'];
		$subtitle    = $_POST['subtitle'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';

		$imgUrl      = base_url()."assets/images/img/";
		
		$response = array('status'=>'', 'message'=>'');

		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'cat_subtitle' => $subtitle ,
			'cat_name' => $title,
			'cat_img' => $image,
		);
		if($this->catm->insertUpdateCategory($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function insertUpdateCategoryVideo(){
		$id          = $_POST['cid'];
		$preVideo    = !empty($_POST['preVideo'])?$_POST['preVideo'] : null;
		$video       = '';
		$url         = base_url()."assets/images/video/";
		$response    = array('status'=>'', 'message'=>'');

		// print_r($_FILES['formVideo']);
		// echo $id; exit;

		if(!empty($_FILES['formVideo']['name'])){
			if($_FILES['formVideo']['size'] <= 10000000){
				$vid = $_FILES['formVideo']['name'];
				$config['upload_path']   = "./assets/images/video/"; 
				$config['allowed_types'] = 'wmv|mp4|avi|mov'; 
				$config['file_name']  = time().$vid;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('formVideo')){
					$file = $this->upload->data();
					$video = "{$url}{$file['file_name']}";
					if(!empty($preVideo)){
						$path = str_replace(base_url(), '', $preVideo);
						unlink(FCPATH. $path);
					}
				}else{
					echo $this->upload->display_errors();
				}
				$data = array(
					'cat_video' => $video,
				);
				if($this->catm->insertUpdateCategory($data, $id)){
					$response = array('status'=>'success', 'message'=>'Successfull');
				}else{
					$response = array('status'=>'faild', 'message'=>'Faild');
				}
			}else{
				$response = array('status'=>'warning', 'message'=>'Void not more than 10MB');
			}
		}else{
			$response = array('status'=>'warning', 'message'=>'There is no video available');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeCategoryStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'cat_status' => $status
		);
		if($this->catm->changeCategoryStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getCategoryDetailsById(){
		$id = $_POST['id'];
		$output = $this->catm->getCategoryDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function deleteCategory(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->catm->deleteCategory($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*=======================================================================================================================================*/


	/*===================================================== Sub-Category =====================================================================*/
	public function sub_category(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/sub-category';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function sub_categoryList(){
		$results = $this->scatm->getSubCategoryList();
		//print_r($this->scatm->count_filtered_data());exit;
		// var_dump($results);die;
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->title;
			$row[] = '<img src="'.$result->img.'" width="150" alt="image">';
			$row[] = !empty($result->video)? '<video width="250" height="200" controls  src="'.$result->video.'"></video>' : '';
			$row[] = $result->cat_name;
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-primary btn-sm mx-3" onclick="addVideoModal('.$result->id.')"><i class="fa fa-plus"></i> Add Video</button>
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteSubCategory('.$result->id.',`'.$result->img.'`,`'.$result->video.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeSubCategoryStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->scatm->count_all_data(),
			"recordsFiltered" => $this->scatm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateSubCategory(){
		$title       = $_POST['title'];
		$category    = $_POST['category'];
		$cities      = json_encode($_POST['cities']);
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'cid' => $category,
			'title' => $title,
			'img' => $image,
			'city_id' => $cities
		);
		if($this->scatm->insertUpdateSubCategory($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getSubCategoryDetailsById(){
		$id = $_POST['id'];
		$output = $this->scatm->getSubCategoryDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}


	public function insertUpdateSubCategoryVideo(){
		$id          = $_POST['sid'];
		$preVideo    = !empty($_POST['preVideo'])?$_POST['preVideo'] : null;
		$video       = '';
		$url         = base_url()."assets/images/video/";
		$response    = array('status'=>'', 'message'=>'');

		// print_r($_FILES['formVideo']);
		// echo $id; exit;

		if(!empty($_FILES['formVideo']['name'])){
			if($_FILES['formVideo']['size'] <= 10000000){
				$vid = $_FILES['formVideo']['name'];
				$config['upload_path']   = "./assets/images/video/"; 
				$config['allowed_types'] = 'wmv|mp4|avi|mov'; 
				$config['file_name']  = time().$vid;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('formVideo')){
					$file = $this->upload->data();
					$video = "{$url}{$file['file_name']}";
					if(!empty($preVideo)){
						$path = str_replace(base_url(), '', $preVideo);
						unlink(FCPATH. $path);
					}
				}else{
					echo $this->upload->display_errors();
				}
				$data = array(
					'video' => $video,
				);
				if($this->scatm->insertUpdateSubCategory($data, $id)){
					$response = array('status'=>'success', 'message'=>'Successfull');
				}else{
					$response = array('status'=>'faild', 'message'=>'Faild');
				}
			}else{
				$response = array('status'=>'warning', 'message'=>'Void not more than 10MB');
			}
		}else{
			$response = array('status'=>'warning', 'message'=>'There is no video available');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}


	public function changeSubCategoryStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->scatm->changeSubCategoryStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteSubCategory(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->scatm->deleteSubCategory($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*===============================================================================================================================*/

	/*======================================================= Child ==================================================================*/
	public function child(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/child';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function childList(){
		$results = $this->chm->getChildList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->title;
			$row[] = $result->description;
			$row[] = $result->price;
			$row[] = '<img src="'.$result->img.'" width="150" alt="image">';
			$row[] = $result->cat_name;
			$row[] = $result->subcat_name;
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteChild('.$result->id.',`'.$result->img.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeChildStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->chm->count_all_data(),
			"recordsFiltered" => $this->chm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getChildDetailsById(){
		$id = $_POST['id'];
		$output = $this->chm->getChildDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateChild(){
		$title       = $_POST['title'];
		$description = $_POST['description'];
		$price       = $_POST['price'];
		$category    = $_POST['category'];
		$subcategory = $_POST['subcategory'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'cid'         => $category,
			'sid'         => $subcategory,
			'title'       => $title,
			'img'         => $image,
			'description' => $description,
			'price'       => $price
		);
		if($this->chm->insertUpdateChild($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeChildStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->chm->changeChildStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteChild(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->chm->deleteChild($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*===============================================================================================================================*/

	/*======================================================= Child Service =========================================================*/
	public function childService(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/child-service';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function childServiceList(){
		$results = $this->csm->getChildServiceList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->child_title;
			$row[] = $result->title;
			$row[] = $result->description;
			$row[] = $result->price;
			$row[] = '<img src="'.$result->img.'" width="150" alt="image">';
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteChildService('.$result->id.',`'.$result->img.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeChildServiceStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->csm->count_all_data(),
			"recordsFiltered" => $this->csm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getChildServiceDetailsById(){
		$id = $_POST['id'];
		$output = $this->csm->getChildServiceDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateChildService(){
		$title       = $_POST['title'];
		$description = $_POST['description'];
		$price       = $_POST['price'];
		$child    = $_POST['child'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'child_id'    => $child,
			'title'       => $title,
			'img'         => $image,
			'description' => $description,
			'price'       => $price
		);
		if($this->csm->insertUpdateChildService($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeChildServiceStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->csm->changeChildServiceStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteChildService(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		// if(!empty($_POST['video'])){
		// 	$pathVideo = str_replace(base_url(), '', $_POST['video']);
		// 	unlink(FCPATH. $pathVideo);
		// }
		if($this->csm->deleteChildService($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*===============================================================================================================================*/

	/*======================================================= AddOn ==================================================================*/
	public function addon(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/addon';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function addonList(){
		$results = $this->addm->getAddonList();
		//print_r($this->scatm->count_filtered_data());exit;
		// var_dump($results);die;
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->title;
			$row[] = $result->price;
			$row[] = '<img src="'.$result->img.'" width="150" alt="image">';
			$row[] = $result->cat_name;
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteAddon('.$result->id.',`'.$result->img.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeAddonStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->addm->count_all_data(),
			"recordsFiltered" => $this->addm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getAddonDetailsById(){
		$id = $_POST['id'];
		$output = $this->addm->getAddonDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateAddon(){
		$title       = $_POST['title'];
		$price       = $_POST['price'];
		$category    = $_POST['category'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'cid'         => $category,
			'title'       => $title,
			'img'         => $image,
			'price'       => $price
		);
		if($this->addm->insertUpdateAddon($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeAddonStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->addm->changeAddonStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteAddon(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->addm->deleteAddon($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	/*===============================================================================================================================*/

	/*======================================================= Offer ==================================================================*/
	public function offer(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/offer';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function offerList(){
		$results = $this->ofm->getOfferList();
		//print_r($this->scatm->count_filtered_data());exit;
		// var_dump($results);die;
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->name;
			$row[] = $result->description;
			$row[] = '<img src="'.$result->img.'" width="150" alt="image">';
			$row[] = !empty($result->video)? '<video width="250" height="200" controls  src="'.$result->video.'"></video>' : '';
			$row[] = $result->cat_name;
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-primary btn-sm mx-3" onclick="addVideoModal('.$result->id.')"><i class="fa fa-plus"></i> Add Video</button>
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteOffer('.$result->id.',`'.$result->img.'`,`'.$result->video.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeOfferStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ofm->count_all_data(),
			"recordsFiltered" => $this->ofm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getOfferDetailsById(){
		$id = $_POST['id'];
		$output = $this->ofm->getOfferDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateOffer(){
		$name        = $_POST['name'];
		$description = $_POST['description'];
		$category    = $_POST['category'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'cid'         => $category,
			'name'        => $name,
			'img'         => $image,
			'description' => $description
		);
		if($this->ofm->insertUpdateOffer($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function insertUpdateOfferVideo(){
		$id          = $_POST['ofid'];
		$preVideo    = !empty($_POST['preVideo'])?$_POST['preVideo'] : null;
		$video       = '';
		$url         = base_url()."assets/images/video/";
		$response    = array('status'=>'', 'message'=>'');

		// print_r($_FILES['formVideo']);
		// echo $id; exit;

		if(!empty($_FILES['formVideo']['name'])){
			if($_FILES['formVideo']['size'] <= 10000000){
				$vid = $_FILES['formVideo']['name'];
				$config['upload_path']   = "./assets/images/video/"; 
				$config['allowed_types'] = 'wmv|mp4|avi|mov'; 
				$config['file_name']  = time().$vid;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('formVideo')){
					$file = $this->upload->data();
					$video = "{$url}{$file['file_name']}";
					if(!empty($preVideo)){
						$path = str_replace(base_url(), '', $preVideo);
						unlink(FCPATH. $path);
					}
				}else{
					echo $this->upload->display_errors();
				}
				$data = array(
					'video' => $video,
				);
				if($this->ofm->insertUpdateOffer($data, $id)){
					$response = array('status'=>'success', 'message'=>'Successfull');
				}else{
					$response = array('status'=>'faild', 'message'=>'Faild');
				}
			}else{
				$response = array('status'=>'warning', 'message'=>'Void not more than 10MB');
			}
		}else{
			$response = array('status'=>'warning', 'message'=>'There is no video available');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeOfferStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->ofm->changeOfferStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteOffer(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->ofm->deleteOffer($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*===============================================================================================================================*/
	
	/*========================================================= Best Offer ===========================================================*/

	public function bestOffer(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/best-offer';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function getBestOfferDetailsById(){
		$id = $_POST['id'];
		$output = $this->bsom->getBestOfferDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function bestOfferList(){
		$results = $this->bsom->getBestOfferList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->title;
			$row[] = $result->subtitle;
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				'.(($result->is_child == 0)? '<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteBestOffer('.$result->id.')"><i class="fa fa-trash"></i> Delete</button>' : '').'
				<button class="btn btn-outline-warning btn-sm" onclick="changeBestOfferStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bsom->count_all_data(),
			"recordsFiltered" => $this->bsom->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateBestOffer(){
		$title        = $_POST['title'];
		$subtitle = $_POST['subtitle'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$response = array('status'=>'', 'message'=>'');
	
		$data = array(
			'title'        => $title,
			'subtitle' => $subtitle
		);
		if($this->bsom->insertUpdateBestOffer($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeBestOfferStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->bsom->changeBestOfferStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteBestOffer(){
		$id     = $_POST['id'];
		if($this->bsom->deleteBestOffer($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*===============================================================================================================================*/
	
	/*========================================================= Best Offer Services===========================================================*/

	public function bestOfferServices(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/best-offer-services';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function bestOfferServiceList(){
		$results = $this->bosm->getBestOfferServicesList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->bestOffer;
			$row[] = $result->category;
			$row[] = $result->subCategory;
			$row[] = $result->title;
			$row[] = $result->description;
			$row[] = '<img src="'.$result->img.'" width="150" alt="image">';
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteBestOfferServices('.$result->id.', '.$result->hid.',`'.$result->img.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeBestOfferServicesStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bosm->count_all_data(),
			"recordsFiltered" => $this->bosm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}


	public function getBestOfferServicesDetailsById(){
		$id = $_POST['id'];
		$output = $this->bosm->getBestOfferServicesDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}


	public function insertUpdateBestOfferServices(){
		$title       = $_POST['title'];
		$description = $_POST['description'];
		$hid         = $_POST['bestOffer'];
		$cid         = $_POST['category'];
		$sid         = $_POST['subcategory'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'hid' 		   => $hid,
			'cid' 		   => $cid,
			'sid' 		   => $sid,
			'title'        => $title,
			'description'  => $description,
			'img'          => $image,
		);
		if($this->bosm->insertUpdateBestOfferServices($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeBestOfferServicesStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->bosm->changeBestOfferServicesStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteBestOfferServices(){
		$id     = $_POST['id'];
		$hid    = $_POST['hid'];

		$getCount = $this->bosm->getCountOfIsChildOfParent($hid);
		$count = $getCount[0]->is_child;
		$data = array(
			'is_child' => (int)$count - 1
		);

		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->bosm->deleteBestOfferServices($id) && $this->bosm->updateCountOfIsChildOfParent($hid, $data)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	/*===============================================================================================================================*/

	/*======================================================= Brand ==================================================================*/
	public function brand(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/brand';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function brandList(){
		$results = $this->brdm->getBrandList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = '<img src="'.$result->img.'" width="150">';
			$row[] = $result->brand;
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteBrand('.$result->id.', `'.$result->img.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeBrandStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->brdm->count_all_data(),
			"recordsFiltered" => $this->brdm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getBrandDetailsById(){
		$id = $_POST['id'];
		$output = $this->brdm->getBrandDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateBrand(){
		$brand       = $_POST['brand'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'brand'       => $brand,
			'img'         => $image,
		);
		if($this->brdm->insertUpdateBrand($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeBrandStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->brdm->changeBrandStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteBrand(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->brdm->deleteBrand($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	/*==================================================================================================================================*/

	/*======================================================= Product ==================================================================*/
	public function product(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/product';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function productList(){
		$results = $this->pdm->getProductList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->name;
			$row[] = '<img src="'.$result->img.'" width="150">';
			$row[] = $result->brand;
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteProduct('.$result->id.', `'.$result->img.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeProductStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pdm->count_all_data(),
			"recordsFiltered" => $this->pdm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getProductDetailsById(){
		$id = $_POST['id'];
		$output = $this->pdm->getProductDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateProduct(){
		$product     = $_POST['product'];
		$brand       = $_POST['brand'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'name'      => $product,
			'bid'       => $brand,
			'img'       => $image,
		);
		if($this->pdm->insertUpdateProduct($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeProductStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->pdm->changeProductStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteProduct(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->pdm->deleteProduct($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	/*==================================================================================================================================*/

	/*======================================================= Sanitization ==================================================================*/
	public function sanitization(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/sanitization';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function sanitizationList(){
		$results = $this->sm->getSanitizationList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->title;
			$row[] = '<img src="'.$result->img.'" width="150">';
			$row[] = !empty($result->video)? '<video width="250" height="200" controls  src="'.$result->video.'"></video>' : '';
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-primary btn-sm mx-3" onclick="addVideoModal('.$result->id.')"><i class="fa fa-plus"></i> Add Video</button>
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteSanitization('.$result->id.', `'.$result->img.'`, `'.$result->video.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeSanitizationStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->sm->count_all_data(),
			"recordsFiltered" => $this->sm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getSanitizationDetailsById(){
		$id = $_POST['id'];
		$output = $this->sm->getSanitizationDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateSanitization(){
		$title       = $_POST['title'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'title'     => $title,
			'img'       => $image,
		);
		if($this->sm->insertUpdateSanitization($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function insertUpdateSanitizationVideo(){
		$id          = $_POST['sid'];
		$preVideo    = !empty($_POST['preVideo'])?$_POST['preVideo'] : null;
		$video       = '';
		$url         = base_url()."assets/images/video/";
		$response    = array('status'=>'', 'message'=>'');

		if(!empty($_FILES['formVideo']['name'])){
			if($_FILES['formVideo']['size'] <= 10000000){
				$vid = $_FILES['formVideo']['name'];
				$config['upload_path']   = "./assets/images/video/"; 
				$config['allowed_types'] = 'wmv|mp4|avi|mov'; 
				$config['file_name']  = time().$vid;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('formVideo')){
					$file = $this->upload->data();
					$video = "{$url}{$file['file_name']}";
					if(!empty($preVideo)){
						$path = str_replace(base_url(), '', $preVideo);
						unlink(FCPATH. $path);
					}
				}else{
					echo $this->upload->display_errors();
				}
				$data = array(
					'video' => $video,
				);
				if($this->sm->insertUpdateSanitization($data, $id)){
					$response = array('status'=>'success', 'message'=>'Successfull');
				}else{
					$response = array('status'=>'faild', 'message'=>'Faild');
				}
			}else{
				$response = array('status'=>'warning', 'message'=>'Void not more than 10MB');
			}
		}else{
			$response = array('status'=>'warning', 'message'=>'There is no video available');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeSanitizationStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->sm->changeSanitizationStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteSanitization(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->sm->deleteSanitization($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*==================================================================================================================================*/

	/*======================================================== Testimonial =============================================================*/
	public function testimonial(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/testimonial';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function getTestimonialDetailsById(){
		$id = $_POST['id'];
		$output = $this->tesm->getTestimonialDetailsById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function testimonialList(){
		$results = $this->tesm->getTestimonialList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->title;
			$row[] = '<img src="'.$result->img.'" width="150">';
			$row[] = !empty($result->video)? '<video width="250" height="200" controls  src="'.$result->video.'"></video>' : '';
			$row[] = ($result->status == 1)? 'Published' : 'Unpublished';
			$row[] = '
				<button class="btn btn-outline-primary btn-sm mx-3" onclick="addVideoModal('.$result->id.')"><i class="fa fa-plus"></i> Add Video</button>
				<button class="btn btn-outline-success btn-sm mx-3" onclick="openModal('.$result->id.')"><i class="fa fa-pencil"></i> Edit</button>
				<button class="btn btn-outline-danger btn-sm mx-3" onclick="deleteTestimonial('.$result->id.', `'.$result->img.'`, `'.$result->video.'`)"><i class="fa fa-trash"></i> Delete</button>
				<button class="btn btn-outline-warning btn-sm" onclick="changeTestimonialStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tesm->count_all_data(),
			"recordsFiltered" => $this->tesm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function insertUpdateTestimonial(){
		$title       = $_POST['title'];
		$id          = !empty($_POST['id'])?$_POST['id'] : null;
		$preImage    = !empty($_POST['preImage'])?$_POST['preImage'] : null;
		$image       = '';
		$imgUrl      = base_url()."assets/images/img/";
		$response = array('status'=>'', 'message'=>'');
		if(!empty($_FILES['formImage']['name'])){
			$img = $_FILES['formImage']['name'];
			$config['upload_path']   = "./assets/images/img/"; 
			$config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
			$config['file_name']  = time().$img;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('formImage')){
				$file = $this->upload->data();
				$image = "{$imgUrl}{$file['file_name']}";
				if(!empty($preImage)){
					$path = str_replace(base_url(), '', $preImage);
					unlink(FCPATH. $path);
				}
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$image = $preImage;
		}	
		
		$data = array(
			'title'     => $title,
			'img'       => $image,
		);
		//print_r($data);exit;
		if($this->tesm->insertUpdateTestimonial($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function insertUpdateTestimonialVideo(){
		$id          = $_POST['sid'];
		$preVideo    = !empty($_POST['preVideo'])?$_POST['preVideo'] : null;
		$video       = '';
		$url         = base_url()."assets/images/video/";
		$response    = array('status'=>'', 'message'=>'');

		if(!empty($_FILES['formVideo']['name'])){
			if($_FILES['formVideo']['size'] <= 10000000){
				$vid = $_FILES['formVideo']['name'];
				$config['upload_path']   = "./assets/images/video/"; 
				$config['allowed_types'] = 'wmv|mp4|avi|mov'; 
				$config['file_name']  = time().$vid;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('formVideo')){
					$file = $this->upload->data();
					$video = "{$url}{$file['file_name']}";
					if(!empty($preVideo)){
						$path = str_replace(base_url(), '', $preVideo);
						unlink(FCPATH. $path);
					}
				}else{
					echo $this->upload->display_errors();
				}
				$data = array(
					'video' => $video,
				);
				if($this->tesm->insertUpdateTestimonial($data, $id)){
					$response = array('status'=>'success', 'message'=>'Successfull');
				}else{
					$response = array('status'=>'faild', 'message'=>'Faild');
				}
			}else{
				$response = array('status'=>'warning', 'message'=>'Void not more than 10MB');
			}
		}else{
			$response = array('status'=>'warning', 'message'=>'There is no video available');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function changeTestimonialStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->tesm->changeTestimonialStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deleteTestimonial(){
		$id     = $_POST['id'];
		if(!empty($_POST['img'])){
			$pathImg = str_replace(base_url(), '', $_POST['img']);
			unlink(FCPATH. $pathImg);
		}
		if(!empty($_POST['video'])){
			$pathVideo = str_replace(base_url(), '', $_POST['video']);
			unlink(FCPATH. $pathVideo);
		}
		if($this->tesm->deleteTestimonial($id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	/*==================================================================================================================================*/
	
	/*======================================================= User ==================================================================*/
	public function user(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/user';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function userList(){
		$results = $this->um->getUserList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = !empty($result->uimg)?'<img src="'.$result->uimg.'" width="80">' : '<img src="'.base_url().'assets/images/common/profile.png" width="80">';
			$row[] = $result->name;
			$row[] = $result->email;
			$row[] = $result->mobile;
			$row[] = $result->wallet;
			$row[] = ($result->status == 1)? 'Active' : 'In-active';
			$row[] = '
			    <button class="btn btn-outline-warning btn-sm" onclick="changeUserStatus('.$result->id.','.$result->status.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			    <button class="btn btn-outline-primary btn-sm" onclick="changeWallet('.$result->id.',`'.$result->wallet.'`,`'.$result->name.'`)"><i class="fa fa-unlock-alt"></i> Change Walet Ballnce</button>
			 ';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->um->count_all_data(),
			"recordsFiltered" => $this->um->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function changeUserStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'status' => $status
		);
		if($this->um->changeUserStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	
	public function updateUserWallet(){
		$getTNum = $this->um->getLastTNum();
		$amt     = '';
		$date    = date('Y-m-d');
		$time    = date('H:i:s A');
		$month   = date('m');
		$year    = date('Y');
		$t_num   = '';
		$ammount = $_POST['ammount'];
		$status  = $_POST['status'];
		$message = $_POST['message'];
		$id      = $_POST['id'];
		$balance = $_POST['balance'];

		if($status === "credit"){
			$amt = (double)$balance + (double)$ammount;
		}else{
			$amt = (double)$balance - (double)$ammount;
		}

		if(!empty($getTNum)){
			$t_num = (double)$getTNum[0]->t_number + 1;
		}else{
			$t_num = 1000000000;
		}
		$transaction_id	= "D&DPAY{$t_num}";

		$data = array(
			"wallet" => $amt
		);
		
		$data1 = array(
			"uid"            => $id,
			"transaction_id" => $transaction_id,
			"t_number"       => $t_num,
			"message"        => $message,
			"status"         => $status,
			"amt"            => (double)$ammount,
			"date"           => $date,
			"month"          => $month,
			"year"           => $year,
			"time"           => $time,
		);

		if($this->um->updateUserWallet($data, $id)){
			if($this->um->insertTransaction($data1)){
				$response = array('status'=>'success', 'message'=>'Successfull');
			}else{
				$response = array('status'=>'faild', 'message'=>'Faild');
			}
			
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	/*==================================================================================================================================*/
	
	/*======================================================= Partner ==================================================================*/
	public function partner(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/partner';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function partnerList(){
		$results = $this->pm->getPartnerList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = !empty($result->pimg)?'<img src="'.$result->pimg.'" width="80">' : '<img src="'.base_url().'assets/images/common/profile.png" width="80">';
			$row[] = $result->name;
			$row[] = $result->email;
			$row[] = $result->mobile;
			$row[] = $result->wallet;
			$row[] = ($result->is_active == 1)? 'Active' : 'In-active';
			$row[] = '
			    <button class="btn btn-outline-warning btn-sm" onclick="changePartnerStatus('.$result->id.','.$result->is_active.')"><i class="fa fa-unlock-alt"></i> Change Status</button>
			    <button class="btn btn-outline-primary btn-sm" onclick="changeWallet('.$result->id.',`'.$result->wallet.'`,`'.$result->name.'`)"><i class="fa fa-unlock-alt"></i> Change Walet Ballnce</button>
			    <button class="btn btn-outline-success btn-sm" onclick="viewServices('.$result->id.',`'.$result->name.'`)"><i class="fa fa-eye"></i> View Services</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pm->count_all_data(),
			"recordsFiltered" => $this->pm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function changePartnerStatus(){
		$id     = $_POST['id'];
		$status = ($_POST['status'] == 1)? 0 : 1;
		$data   = array(
			'is_active' => $status
		);
		if($this->pm->changePartnerStatus($data, $id)){
			$response = array('status'=>'success', 'message'=>'Successfull');
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	
	public function updatePartnerWallet(){
		$getTNum = $this->pm->getLastTNum();
		$amt     = '';
		$date    = date('Y-m-d');
		$time    = date('H:i:s A');
		$month   = date('m');
		$year    = date('Y');
		$t_num   = '';
		$ammount = $_POST['ammount'];
		$status  = $_POST['status'];
		$message = $_POST['message'];
		$id      = $_POST['id'];
		$balance = $_POST['balance'];

		if($status === "credit"){
			$amt = (double)$balance + (double)$ammount;
		}else{
			$amt = (double)$balance - (double)$ammount;
		}

		if(!empty($getTNum)){
			$t_num = (double)$getTNum[0]->t_number + 1;
		}else{
			$t_num = 1000000000;
		}
		$transaction_id	= "D&DPAY{$t_num}";

		$data = array(
			"wallet" => $amt
		);
		
		$data1 = array(
			"pid"            => $id,
			"transaction_id" => $transaction_id,
			"t_number"       => $t_num,
			"message"        => $message,
			"status"         => $status,
			"amt"            => (double)$ammount,
			"date"           => $date,
			"month"          => $month,
			"year"           => $year,
			"time"           => $time,
		);

		if($this->pm->updatePartnerWallet($data, $id)){
			if($this->pm->insertTransaction($data1)){
				$response = array('status'=>'success', 'message'=>'Successfull');
			}else{
				$response = array('status'=>'faild', 'message'=>'Faild');
			}
			
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));

	}
	
	public function getPartnerServices(){
		$id = $_POST['id'];
		$output = $this->pm->getPartnerServices($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	
	/*==================================================================================================================================*/
	
	/*======================================================= Payout ==================================================================*/
	public function payout(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/payout';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}

	public function PayoutList(){
		$results = $this->pom->getPayoutList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = !empty($result->pimg)?'<img src="'.$result->pimg.'" width="80">' : '<img src="'.base_url().'assets/images/common/profile.png" width="80">';
			$row[] = $result->name;
			$row[] = $result->amt;
			$row[] = $result->trans_id;
			$row[] = $result->bname;
			$row[] = $result->ifsc;
			$row[] = $result->acno;
			$row[] = $result->upi;
			$row[] = date('F d, Y', strtotime($result->date));
			$row[] = ($result->status == 1)? 'Approved' : 'Pendding';
			$row[] = ($result->status == 0)?'<button class="btn btn-outline-warning btn-sm" onclick="openModel('.$result->id.','.$result->pid.',`'.$result->amt.'`)"><i class="fa fa-unlock-alt"></i> Change Status</button>':'';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pom->count_all_data(),
			"recordsFiltered" => $this->pom->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updatePayout(){
		$id      = $_POST['id'];
		$pid     = $_POST['pid'];
		$transId = $_POST['transId'];
		$amt     = (double)$_POST['amt'];

		$getPartnerWallet = $this->pom->getPartnerWallet($pid);
		$walletBalance = $getPartnerWallet[0]->wallet;
		$totalBalance = (double)$walletBalance - $amt;
		
		$data   = array(
			'trans_id' => $transId,
			'status' => 1
		);

		$data1  = array(
			'pid' => $pid,
			'transaction_id' => $transId,
			'message' => 1,
			'status'  => 'debite',
			'amt'    => $amt,
			'date'  => date('Y-m-d'),
			'month' => $month,
			'year'  => $year,
			'time'  => $time,
		);

		if($this->pom->updatePayout($data, $id)){
			if($this->pom->partnerCredit($data1, $pid)){
				if($this->pom->updatePartnerWallet($pid, $totalBalance)){
					$response = array('status'=>'success', 'message'=>'Successfull');
				}else{
					$response = array('status'=>'faild', 'message'=>'Faild');
				}
			}else{
				$response = array('status'=>'faild', 'message'=>'Faild');
			}
		}else{
			$response = array('status'=>'faild', 'message'=>'Faild');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	
		/*==================================================================================================================================*/
	
	/*======================================================= Order ==================================================================*/
	public function order(){
		if($this->session->userdata('userData')){
			$data = array();
			$data['header'] = $this->header();
			$data['aside'] = $this->aside();
			$data['footer'] = $this->footer();
			$data['content'] = 'pages/order';
			$this->load->view('index',$data);
		}else{
			redirect(base_url('home/login'));
		}
	}
	
	public function getOrderList(){
		$results = $this->om->getOrderList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = $result->name;
			$row[] = $result->cat_name;
			$row[] = $result->title;
			$row[] = date('F d, Y', strtotime($result->odate));
			$row[] = date('H:i:s A', strtotime($result->otime));
			$row[] = $result->address;
			$row[] = $result->o_status;
			$row[] = $result->subtotal;
			$row[] = $result->mobile;
			$row[] = date('F d, Y', strtotime($result->datetime));
			$row[] = '
			    <button class="btn btn-outline-primary btn-sm mr-3" onclick="subOrderModal('.$result->id.','.$result->uid.')">Sub Orders</button>
			    <button class="btn btn-outline-primary btn-sm" onclick="invoiceModal('.$result->id.','.$result->uid.')">Invoices</button>
			';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->om->count_all_data(),
			"recordsFiltered" => $this->om->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	
	public function getInvoice(){
		$id = $_POST['id'];
		$uid = $_POST['uid'];
		$output = $this->om->getInvoice($id, $uid);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	
	public function getSubOrder(){
		$id = $_POST['id'];
		$uid = $_POST['uid'];
		$output = $this->om->getSubOrder($id, $uid);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	
		public function getInvoiceList(){
		$results = $this->inm->getInvoiceList();
		$data = [];
		$no = $_POST['start'];
		foreach($results as $result){
			$row = array();
			$row[] = ++$no;
			$row[] = "OrderID: {$result->oid}";
			$row[] = $result->user_name;
			$row[] = $result->partner_name;
			$row[] = '<a href="{$result->recipt_invoice}" class="btn btn-primary btn-sm" download>Download</a>';
			$row[] = '<a href="{$result->tax_invoice}" class="btn btn-primary btn-sm" download>Download</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->inm->count_all_data(),
			"recordsFiltered" => $this->inm->count_filtered_data(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
}
