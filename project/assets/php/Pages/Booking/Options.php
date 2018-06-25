<?php

namespace Hikify\Pages\Booking;

class Options extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlOptions;
	
	private $objAppointment;
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/booking/options.tpl.php';
		\QCubed\Project\Application::executeJavaScript('
														var height = $(".wrapper").outerHeight();
														$(".content-wrapper").css("min-height",height+"px");
														$(".content-wrapper").css("height",height+"px")
													');
		$this->addCssFile("/project/assets/css/booking.css");	
		
//		$this->addJavascriptFile("/project/assets/js/round-button.js");
		$this->Build();
		
		
	}
	public function Save(){
		foreach($this->pnlOptions->getChildControls() as $Checkbox){
			if($Checkbox->Checked){
				$objTask					= new \AppointmentTasks();
				$objTask->AppointmentId		= $this->objAppointment->Id;
				$objTask->TaskId			= $Checkbox->getCustomAttribute("taskid");
				$objTask->Save();
			}
		}
	}
	public function SetAppointment($objAppointment){
		$this->objAppointment = $objAppointment;
	}
	
	private function GetAllTaskTypes(){
		foreach(\AppointmentTaskType::loadAll() as $objTask){
			$chkSelect				= new \QCubed\Project\Jqui\Checkbox($this->pnlOptions);
			$chkSelect->HtmlBefore	= "<label class='chk_select_label'>";
			$chkSelect->addWrapperCssClass("chk_select col-md-3");
			$chkSelect->setCustomAttribute("taskid", $objTask->Id);
			$chkSelect->HtmlAfter		= "<span>".$objTask->{\QCubed\Project\Application::$LocaleName}."</span></label>";
		}
	}
	private function Build() {
		$this->pnlOptions									= new \QCubed\Control\Panel($this);
		$this->pnlOptions->AutoRenderChildren				= true;
		$this->pnlOptions->addCssClass("display-container");
		
		$this->GetAllTaskTypes();
	}
	
}
