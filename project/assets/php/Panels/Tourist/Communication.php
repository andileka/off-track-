<?php

namespace Hikify\Panels\Job;

class Communication extends \QCubed\Project\Control\Editor {
	
	
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlCommunication;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlGallery;
	/**
	 *
	 * @var \CommunicationList 
	 */
	public $dgCommunications;

	private $pnlRowCommunication;
	
	
	/**
	 *
	 * @var \Job
	 */
	public $objJob;
	private $arrCommunicationPanels=array();
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/communication.tpl.php';
		$this->Build();
		
	}
	
	public function GetAccordionHeader() {
			
		return tr('Communication');
	}
	public function SetJob(\Job $objJob=null){
		if(!$objJob) {
				return;
		}
		
		$this->objJob = $objJob;
		$this->AddToCommunicationPanel();
		$this->dgCommunications->Condition = \QCubed\Query\QQ::equal(\QQN::communication()->JobId, $this->objJob->Id);
		$this->pnlGallery->SetJob($this->objJob);
	}
	
	private function AddToCommunicationPanel(\Communication $objCommunication=null){
		$this->pnlRowCommunication = new \Hikify\Panels\Maintenance\Communication($this->pnlCommunication);
		$this->pnlRowCommunication->SetJob($this->objJob);
		$this->pnlRowCommunication->SetCommunication($objCommunication);
		$this->arrCommunicationPanels[] = $this->pnlRowCommunication;
		return $this->pnlRowCommunication;
	}
	public function setAttachments($arrAttachments) {
		$this->pnlRowCommunication->setAttachments($arrAttachments);
	}
	public function GetSelectedMailing(\QCubed\Action\ActionParams $objMethodParam){
		$this->pnlCommunication			= new \QCubed\Control\Panel($this);
		$this->pnlCommunication->AutoRenderChildren			= true;
		
		$intMailingId			= (int) $objMethodParam->ActionParameter;
		$objCommunication		= \Communication::loadById($intMailingId);
		
		$this->AddToCommunicationPanel($objCommunication);
	} 
	private function Build() {
		$this->pnlCommunication				= new \QCubed\Control\Panel($this);
		$this->pnlCommunication->AutoRenderChildren			= true;
		$this->pnlCommunication->AddCssClass('col-md-12 navigator-panel');
		
		$this->dgCommunications				= new \CommunicationList($this);
	
		$this->dgCommunications->createColumns();
		$this->dgCommunications->AddAjaxRowAction($this, 'GetSelectedMailing');
		
		$this->pnlGallery					= new Gallery($this, true);
		
		$this->addJavascriptFile("/vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js");
		$this->addCssFile("/vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css");
		
		
	}
}
