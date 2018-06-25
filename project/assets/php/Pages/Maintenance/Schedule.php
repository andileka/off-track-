<?php

namespace Hikify\Pages\Maintenance;

class Schedule extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Project\Control\DataGrid
	 */
	public $dgExpertSchedule;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/schedule.tpl.php';
		$this->addCssFile("/project/assets/css/datagrid.css");
		$this->Build();
		
	}
	public function dg_OnExpertChanged($intEnityId, $strDay, $intExpertId){
		$objEntityExpert = \EntityExpert::loadByEntityAndDay($intEnityId, $strDay);
		
		if(!$intExpertId){
			$objEntityExpert->delete();
		}
		if(!$objEntityExpert){
			\QCubed\Project\Application::Log("New");
			$objEntityExpert = new \EntityExpert();
			
		}
		$objEntityExpert->EntityId = $intEnityId;
		$objEntityExpert->Day = $strDay;
		$objEntityExpert->ExpertId = $intExpertId;
		$objEntityExpert->Save();
		
		$this->dgExpertSchedule->dataBind();
	}
	private function Build() {		
		$this->dgExpertSchedule			= new \EntityList($this);
		/* Show all entities from the type repairer */
		$this->dgExpertSchedule->Condition = \QCubed\Query\QQ::orCondition(
													\QCubed\Query\QQ::equal(\QQN::entity()->TypeId, 4)
												);
	
		$this->dgExpertSchedule->createListOverview();
		$this->dgExpertSchedule->addCssClass("datagrid");
		$this->dgExpertSchedule->Register('OnExpertChanged', 'dg_OnExpertChanged', $this);
	}	

}
