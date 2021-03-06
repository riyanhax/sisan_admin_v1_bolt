<?php
class md_city extends MX_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('mo_city');
	}
	function index() {
		$this->fncity();
	}
	function fncity()	{
		$this->load->view('vw_city');
	}
	// ======================================== 'Datagrid User Section'
	function fncityData() {
		$vPage=$this->input->post('page');
		$vRows=$this->input->post('rows');
		$vcityKeyword=$this->input->post('cityKeyword');
		$vSort=$this->input->post('sort');
		$vOrder=$this->input->post('order');
		if(!$vPage) {
			$vPage=1;
		}
		if(!$vRows) {
			$vRows=20;
		}
		if(!$vcustomerKeyword) {
			$vcustomerKeyword='';
		}
		if(!$vSort) {
		
		$vSort='f_city_id';
		
		}
		if(!$vOrder) {
			$vOrder='DESC';
		}
		$vOffset=($vPage-1)*$vRows;
		$vResult=array();
		$vRs=$this->mo_city->fncityCount($vcityKeyword);
		$vResult["total"]=$vRs->selectCount;
		$vResult["rows"]=$this->mo_city->fncityData($vcityKeyword,$vOffset,$vRows,$vSort,$vOrder);
		echo json_encode($vResult);
	}	
	function fncityAdd() {
		$this->load->view('city_add_main');
	}
	function fnProvinceComboData() {
		$vVarQuery = $this->input->post('q');
		if(!$vVarQuery) {
			$vVarQuery='';
		}
		$this->mo_city->fnProvinceComboData($vVarQuery);
	}
	function fncityComboData() {
		$vVarQuery = $this->input->post('q');
		if(!$vVarQuery) {
			$vVarQuery='';
		}
		$this->mo_city->fncityComboData($vVarQuery);
	}

	function fncityCreate() {
		$vData = array(
			'vf_city_name'=>$this->input->post('f_city_name'),
       		
			'vf_province_id'=>$this->input->post('f_province_id'),      				
		);
	$this->mo_city->fnCreatecity($vData);
	}
	function fncityEdit($pcityId) {
		$vData['vcityId'] = $pcityId;
		$this->load->view('city_add_main',$vData);
	}
	function fncityRow($pcityId) {
		$this->mo_city->fncityRow($pcityId);
	}
	
	function fncityDelete() {
		$vDelcityId = intval($_POST['Id']);
		$this->mo_city->fncityDelete($vDelcityId);
	}
	
	function fncityUpdate($pcityId) {
		$vData = array(
       		
			'vf_city_name'=>$this->input->post('f_city_name'),
       		
			'vf_province_id'=>$this->input->post('f_province_id'),
       		

		);
		$this->mo_city->fnUpdatecity($pcityId,$vData);
	}
	function fncityImport() {
		$this->load->view('city_import_main');
	}
	function fncityImportProcess() {	
				
		$this->mo_city->fncityImportProcess();
	}
	
}
?>

	   