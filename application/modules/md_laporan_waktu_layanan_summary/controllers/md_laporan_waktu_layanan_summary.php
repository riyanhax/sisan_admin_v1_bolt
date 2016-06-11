<?php
class md_laporan_waktu_layanan_summary extends MX_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('mo_laporan_waktu_layanan_summary');

	
		
	}
	function index() {
		$this->fnlaporan();
	}
	function fnlaporan()	{
		$vData["pilihLayanan"]=$this->mo_laporan_waktu_layanan_summary->getPilihLayanan();
		$vData["pilihLoket"]=$this->mo_laporan_waktu_layanan_summary->getPilihLoket();
		$vData["pilihUser"]=$this->mo_laporan_waktu_layanan_summary->getPilihUser();
		$this->load->view('vw_laporan_waktu_layanan_summary', $vData);
	}
	// ======================================== 'Datagrid User Section'
	function fntransaksiData() {
	
		$vPage=$this->input->post('page');
		$vRows=$this->input->post('rows');		
		//$vemployeeKeyword=$this->input->post('#search')	;	
		$vStartKeyword=$this->input->post('StartKeyword');
		$vFinishKeyword=$this->input->post('FinishKeyword');
		$vPilihanKeyword=$this->input->post('PilihanKeyword');
		$vUnitTimeKeyword=$this->input->post('UnitTimeKeyword');
		$vLayananKeyword=$this->input->post('LayananKeyword');
		$vLoketKeyword=$this->input->post('LoketKeyword');
		$vUserKeyword=$this->input->post('UserKeyword');
		$vSort=$this->input->post('sort');
		$vOrder=$this->input->post('order');
		if(!$vPage) {
			$vPage=1;
		}
		if(!$vRows) {
			$vRows=20;
		}
		if(!$vSort) {
		
		$vSort='id_transaksi';
		
		}
		if(!$vOrder) {
			$vOrder='DESC';
		}
		$vOffset=($vPage-1)*$vRows;
		$vResult=array();
		$vRs=$this->mo_laporan_waktu_layanan_summary->fntransaksiCount($vStartKeyword,$vFinishKeyword,$vLayananKeyword,$vLoketKeyword,$vUserKeyword,$vPilihanKeyword,$vUnitTimeKeyword);
		$vResult["total"]=$vRs;
		$vResult["rows"]=$this->mo_laporan_waktu_layanan_summary->fntransaksiData($vStartKeyword,$vFinishKeyword,$vLayananKeyword,$vLoketKeyword,$vUserKeyword,$vPilihanKeyword,$vUnitTimeKeyword,$vOffset,$vRows,$vSort,$vOrder);		
		echo json_encode($vResult);
	}	

	
//===========Print Report================================================

	function fntransaksiDataPrint($vcityKeyword,$vkecKeyword,$vLayananKeyword,$vLoketKeyword,$vUserKeyword,$vPilihanKeyword,$vUnitTimeKeyword,$excel=true){

			$pdf_filename = tempnam(sys_get_temp_dir(), "Data_Antrian_");
		   $pdf_file= "Data Antrian";
   
			$sts_scty=FALSE;
			$direct_download=TRUE;
		
		   $data_header=array('title'=>'PDF',);   
		   
         $data_master['data_master'] = $this->mo_laporan_waktu_layanan_summary->fntransaksiDataPrint($vcityKeyword,$vkecKeyword,$vLayananKeyword,$vLoketKeyword,$vUserKeyword,$vPilihanKeyword,$vUnitTimeKeyword);        		   

         $data_master['data_company'] = $this->mo_laporan_waktu_layanan_summary->getDataCompany();
		   
		   if($excel) {
		   	$output=$this->load->view('transaksi_excel',$data_master,true);
		   } else {
		   	$output=$this->load->view('transaksi_report_text',$data_master,true);
		   }

			$scty="";

         echo $output;	
   }	

   function fntransaksiDataPrintText($vcityKeyword,$vkecKeyword,$vLayananKeyword,$vLoketKeyword,$vUserKeyword,$vPilihanKeyword,$vUnitTimeKeyword){
		$this->fntransaksiDataPrint($vcityKeyword,$vkecKeyword,$vLayananKeyword,$vLoketKeyword,$vUserKeyword,$vPilihanKeyword,$vUnitTimeKeyword,false);
   }

   function fntransaksiDataPrintChart($vcityKeyword,$vkecKeyword,$vLayananKeyword,$vLoketKeyword,$vUserKeyword,$vPilihanKeyword,$vUnitTimeKeyword) {
		
		$vData['result'] = $this->mo_laporan_waktu_layanan_summary->fntransaksiDataPrintChart($vcityKeyword,$vkecKeyword,$vLayananKeyword,$vLoketKeyword,$vUserKeyword,$vPilihanKeyword,$vUnitTimeKeyword);
		$vData['data_company'] = $this->mo_laporan_waktu_layanan_summary->getDataCompany();
		$this->load->view('transaksi_chart',$vData);

	}
      
}
?>

	   