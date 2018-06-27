<?php

namespace Hikify\Pages\Tourist;

class Edit extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Control\Label 
	 */
	public $lblTemp;

	/**
	 *
	 * @var \Hikify\Panels\Tourist\Detail
	 */
	public $pnlTourist;

	/**
	 *
	 * @var \Hikify\Panels\Tourist\Questions
	 */
	public $pnlQuestions;
	public $pnlEvents;
	public $pnlMap;
			
	public $btnSave;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/tourist/edit.tpl.php';
		$this->Build();
		
		
	}

	public function Save() {
		$this->pnlTourist->Save();
	}

	private function Build() {
		$objTourist				= \Tourist::loadById($_GET['id']);
		$this->lblTemp			= new \QCubed\Control\Label($this);
		$this->lblTemp->Text	= tr("Edit");

		$this->pnlTourist		= new \Hikify\Panels\Tourist\Detail($this);
		$this->pnlTourist->SetTourist($objTourist);

		$this->btnSave			= \QCubed\Project\Jqui\Button::GetSaveButton($this,'Save');


		
		$this->pnlEvents		= new \Hikify\Panels\Tourist\Event($this);
		$this->pnlEvents->SetTourist($objTourist);

		$this->pnlQuestions		= new \Hikify\Panels\Tourist\Questions($this);
		$this->pnlQuestions->SetTourist($objTourist);
	}

	
}
