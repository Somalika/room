<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Model 
{  
	function __construct()
    {
        parent::__construct();
		$this->load->library('excel');  
		
    }   
	// export receive report
	function export($sql,$obj){
		$this->excel = PHPExcel_IOFactory::createReader('Excel2007'); 
		$this->excel = $this->excel->load($_SERVER['DOCUMENT_ROOT'] .$this->config->config['file_path'].'/template/export_report.xlsx');   
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle($obj->filename); 
		 
		
		// looping 
		$r=1;
		$i=4;  
		
		$this->excel->getActiveSheet()->setCellValue('A1', $obj->filename .' for '.$f); 
		
		foreach($sql as $row){
			$this->excel->getActiveSheet()->setCellValue('A'.$i, $r); // no
			$this->excel->getActiveSheet()->setCellValue('B'.$i, $obj->department."-".str_pad($row["ticket_id"], 6, '0', STR_PAD_LEFT)); // ticket code
			$this->excel->getActiveSheet()->setCellValue('C'.$i, $row["opendate"]);  //  item opendate 
			$this->excel->getActiveSheet()->setCellValue('D'.$i, $row["request_type"]); // request_type
			 
			$this->excel->getActiveSheet()->setCellValue('E'.$i, $row["ticket_title"]); // ticket_title 
			$this->excel->getActiveSheet()->setCellValue('F'.$i, $row["lastest_note"]); // lastest_note   
			$this->excel->getActiveSheet()->setCellValue('G'.$i, $row["requestor"]); // requestor   
			$this->excel->getActiveSheet()->setCellValue('H'.$i, $row["isTicket"]); // priority    
			$this->excel->getActiveSheet()->setCellValue('I'.$i, $row["priority"]); // priority  
			
			$r++;
			$i++;
			 
		} 
				  
		header('Content-Type: application/vnd.ms-excel');  
		header('Content-Disposition: attachment;filename="'.$obj->filename.'.xlsx"');  
		header('Cache-Control: max-age=0'); //no cache 
					 
		ob_end_clean();
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');   
		$objWriter->save('php://output');
		exit;
	}
		 
}