<?php

namespace Hikify\Panels\Tourist;

class Event extends \QCubed\Project\Control\Editor {
	
	/**
	 *
	 * @var \Tourist
	 */
	private $objTourist;

	/**
	 *
	 * @var \EventList
	 */
	public $pnlEvents;

	/**
	 *
	 * @var \QCubed\Project\Control\Mapbox
	 */
	public $mpbox;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/tourist/event.tpl.php';
		$this->Build();
		
	}
	
	public function SetTourist(\Tourist $objTourist=null) {
		if(!$objTourist) {
			return; 
		}
		$this->objTourist								= $objTourist;
		
		$this->pnlEvents->Condition = \QCubed\Query\QQ::andCondition(
			\QCubed\Query\QQ::equal(\QQN::event()->Device->DeviceTourist->TouristId, $this->objTourist->Id)
		);
		$this->pnlEvents->Clauses	= array(
			\QCubed\Query\QQ::orderBy(\QQN::event()->Datetime, false),
			\QCubed\Query\QQ::expand(\QQN::event()->Position)
		);
		$this->pnlEvents->addWrapperCssClass("table-responsive");
		$this->pnlEvents->CssClass				= 'table no-margin';
		
		$this->pnlEvents->CreateColumns();
		$this->pnlEvents->dataBind();
		$this->DraWMap();
	}

	private function Build() {
		$this->pnlEvents = new \EventList($this);
	}


	protected function DrawMap(){
		$arrEvents = $this->pnlEvents->DataSource;
		if(!count($arrEvents)) {
			return;
		}

		$this->mpbox				= new \QCubed\Project\Control\Mapbox($this);
		$this->mpbox->Name			= tr("Mapview");

		
		foreach($arrEvents as $objEvent) {
			$arrCoordinates[] = (string)$objEvent->Position;
			$arrProperties [] = array('title'=>(string)$objEvent->Type,'description'=>$objEvent->Datetime->format('Y-m-d H:i'),'className'=>'counter','dataid'=>$objEvent->Datetime->format('H:i'));
		}

		$this->mpbox->Draw($arrCoordinates,$arrProperties);

	}
}
