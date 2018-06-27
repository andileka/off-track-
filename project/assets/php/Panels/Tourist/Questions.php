<?php

namespace Hikify\Panels\Tourist;

class Questions extends \QCubed\Project\Control\Editor {
	public $objTourist;
	/**
	 *
	 * @var \QuestionList
	 */
	public $pnlQuestions;
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/tourist/questions.tpl.php';
		$this->Build();
		
	}
	
	public function GetAccordionHeader() {
		return tr('Estimates');
	}
	
	public function SetTourist(\Tourist $objTourist=null) {
		if(!$objTourist) {
			return;
		}
		
		$this->objTourist					= $objTourist;
		//set the answers... 
	}
	
	public function Save() {
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT A VALID FORM');
			return;
		}		
	}
	
	public function GetCustomFields(){
		
	}
	public function ClearFields(){
		
	}
	
	public function SetCustomFields(){
		
	}
	
	public function btnedit_click(){
		
	}
	
	public function btndelete_click(){
		
	}
	
	private function Build() {
		$this->pnlQuestions = new \QuestionList($this);
		$this->pnlQuestions->createColumns();
		$this->pnlQuestions->dataBind();
		
	}
}
