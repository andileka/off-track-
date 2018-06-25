<?php

namespace Hikify\Panels\Maintenance;


class VisitingHours extends \QCubed\Control\Panel {	
	/**
	*
	* @var \QCubed\Project\Control\Weekschedule 
	*/
	public $pnlWeek;
	private $strTitle;
	
	public function __construct($objParentObject, $strTitle) {
		parent::__construct($objParentObject);

		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/visitinghours.tpl.php';
		$this->strTitle = $strTitle;
		$this->Build();
	}
	
	public function SetAllWeekDays($amPm, $intId){
		$this->pnlWeek->SetAllWeekDays($this->GetAllDayWeekHours($amPm, $intId));
	}
	public function GetAllWeekDays(){
		return $this->pnlWeek->GetAllWeekDays();
	}
	public function GetAllDayWeekHours($amPm, $intId){
		$Days = array();
		$LoadedArray = \EntityVisitinghour::LoadByAmPmEntityId($amPm,(int) $intId);
		foreach($LoadedArray as $row){
			$Days[$row->Day]['Start'] = "";
			$Days[$row->Day]['End'] = "";
			if($row->From){
				$Days[$row->Day]['Start'] = $row->From->format('H:i');
			}
			if($row->To){
				$Days[$row->Day]['End'] = $row->To->format('H:i');
			}
			
		}
		
		return $Days;
	}
	
	private function Build() {
		$this->pnlWeek						=new \QCubed\Project\Control\Weekschedule($this);
		$this->pnlWeek->Title				= tr($this->strTitle);
	}
	
}
