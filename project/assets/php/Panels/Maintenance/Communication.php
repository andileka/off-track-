<?php

namespace Hikify\Panels\Maintenance;

/**
 * @property Communication
 */
class Communication extends \QCubed\Control\Panel {	
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstTemplates;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $lstEntityEmailList;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtSubject;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $ckMessage;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlWarning;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlEntityWarning;
	public $lstLang;
	
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlEntityEmail;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstType;
	private $arrAllFields = array();
	/**
	 *
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnSaveEntity;
	/**
	 *
	 * @var \Communication 
	 */
	private $objCommunication;
	/**
	 *
	 * @var \Job 
	 */
	private $objJob;
	/**
	 *
	 * @var \User 
	 */
	private $objUser;
	/**
	 *
	 * @var \CommunicationEntity
	 */
	private $objCommunicationEntity;
	private $intJobId;
	private $objWordTemplate;
	
	private $arrMailChosen=array();
	private $arrAttachments=array();
	
	public function __construct($objParentObject) {
		parent::__construct($objParentObject);

		$this->objUser			= \Hikify\Helpers\Security::GetLoggedInUser();
		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/communication.tpl.php';
		$this->addCssFile("/project/assets/css/communication.css");
		$this->addCssFile("/project/assets/css/datagrid.css");
		$this->Build();
	}

	public function SetJob(\Job $objJob=null){
		if(!$objJob) {
				return;
		}
		
		$this->objJob				= $objJob;
		$this->lstEntityEmailList	= \EntityJob::GetMailingList($this, $this->objJob->Id);		
		$this->lstEntityEmailList->addAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstEntityEmailClicked'));
	}

	public function lstEntityEmailClicked() {
		if($this->pnlEntityEmail->Display) {
			$this->ToggleEntityEmail(false);
		} else {
			foreach($this->lstEntityEmailList->getChildControls() as $ChosenMail){
				if($ChosenMail->getCustomAttribute("value") == "no-email" && $ChosenMail->Checked){
					if($this->pnlEntityEmail->Display) {
						$this->ToggleEntityEmail(false);
					} else {
						$this->ToggleEntityEmail(true);
						$this->btnSaveEntity->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'SaveEntity'));
						$this->btnSaveEntity->ActionParameter = $ChosenMail->ActionParameter;
					}
				}
			
			}
		}

	}
	
	public function SaveEntity(\QCubed\Action\ActionParams $params) {
		$objEntity = \Entity::loadById($params->ActionParameter);
		$this->pnlEntityEmail->Save($objEntity);
		\QCubed\Project\Application::redirect('?c=job&a=edit&id='.$this->objJob->Id);
	}
	private function GetJobRepairerInfo($field) {
		$arrEntityJob	= \EntityJob::loadArrayByRoleIdJobId(4, $this->objJob->Id);
		switch($field) {
			case 'Name' : return array_map(function($objEntityJob){return $objEntityJob->Entity->Name;}, $arrEntityJob);
			case 'Email' : return array_map(function($objEntityJob){return is_object(\EntityEmail::loadEntityEmailWorkAddress($objEntityJob->Entity->Id)) ? \EntityEmail::loadEntityEmailWorkAddress($objEntityJob->Entity->Id)->Address : '';}, $arrEntityJob);
			case 'Phone' : return array_map(function($objEntityJob){return is_object(\EntityPhone::loadEntityPhoneWorkNumber($objEntityJob->Entity->Id)) ? \EntityPhone::loadEntityPhoneWorkNumber($objEntityJob->Entity->Id)->Nr : '';}, $arrEntityJob);
		}
	}
	public function setArrayOfMergeableFields(){
		if($this->objJob->VehicleId){
			$objAppointment = \Appointment::loadByJobId($this->objJob->Id);
			$objUser		= \Hikify\Helpers\Security::GetLoggedInUser();
			$this->arrAllFields = array(
				"job" => $this->objJob->Id, 
				"jobnumber" => $this->objJob->Number, 
				"vehicletype" => $this->objJob->Vehicle ? $this->objJob->Vehicle->Type : '', 
				"appointmenttype"=> $objAppointment ? $objAppointment->Type : '', 
				"make"=> $this->objJob->Vehicle && $this->objJob->Vehicle->Make ? $this->objJob->Vehicle->Make->Name : '', 
				"model"=> $this->objJob->Vehicle && $this->objJob->Vehicle->Model ? $this->objJob->Vehicle->Model->Name : '', 
				"vehiclemodeltype"=> $this->objJob->Vehicle ? $this->objJob->Vehicle->ModelType : '', 
				"vehicleplate"=> $this->objJob->Vehicle ? $this->objJob->Vehicle->Plate : '', 
				"vehiclemileage"=> $this->objJob->Vehicle ? $this->objJob->Vehicle->Milage : '', 
				"appointmentpreferredtime"=> $objAppointment ? strtoupper($objAppointment->PreferredTime)  : '', 
				"vehiclevin"=> $this->objJob->Vehicle ? $this->objJob->Vehicle->Vin : '', 
				"appointmentpreferreddate"=> $objAppointment && $objAppointment->PreferredDate ? $objAppointment->PreferredDate->format('d-m-Y') : '', 
				"vehiclecolour"=> $this->objJob->Vehicle ? $this->objJob->Vehicle->Colour : '', 
				"vehiclefirstregistrationdate"=> $this->objJob->Vehicle->FirstRegistrationDate ?  $this->objJob->Vehicle->FirstRegistrationDate->format('d-m-Y') : '' , 
				"vehiclelastregistrationdate"=> $this->objJob->Vehicle->LastRegistrationDate ?  $this->objJob->Vehicle->LastRegistrationDate->format('d-m-Y') : '', 
				"expertname"=> $objAppointment ? $objAppointment->Expert->User->LastName .','. $objAppointment->Expert->User->FirstName : '', 
				"vehicleretailvalue"=> $this->objJob->Vehicle ? $this->objJob->Vehicle->RetailValue : '', 
				"expertemail"=> $objAppointment ? $objAppointment->Expert->User->Email : '', 
				"vehiclecurrentvalue"=> $this->objJob->Vehicle ? $this->objJob->Vehicle->CurrentValue : '', 
				"expertphone"=> $objAppointment ? $objAppointment->Expert->User->MobilePhone : '', 
				"userfirstname"=> $objUser->FirstName , 
				"userlastname"=> $objUser->LastName, 
				"repairername"=> implode(',',$this->GetJobRepairerInfo('Name')), 
				"repaireremail"=> implode(',',$this->GetJobRepairerInfo('Email')), 
				"repairerphone"=> implode(',',$this->GetJobRepairerInfo('Phone')), 
			);
		}
	}
	public function setCommunication(\Communication $objCommunication=null){
		if(!$objCommunication) {
			return; 
		}
		$this->setArrayOfMergeableFields();
		$this->txtSubject->Text				= $objCommunication->Subject;
		$this->ckMessage->Text				= $objCommunication->Body;
		$this->lstLang->SelectedValue		= $objCommunication->Language;
		$this->objCommunication				= $objCommunication;
		$arrSelectedEmailIds = array();
		$arrSelectedEmails = \CommunicationEntity::loadArrayByCommunicationId($objCommunication->Id);
		foreach($arrSelectedEmails as $emailId){
			$arrSelectedEmailIds[] = $emailId->EntityEmailId;
		}
		
		$this->lstEntityEmailList = \EntityJob::GetMailingList($this,$objCommunication->JobId,$arrSelectedEmailIds);
		/* Add all variable fields into array $arrAllFields */
		
	}
	
	public function setAttachments($arrDocumentIds) {
		$this->arrAttachments = array();
		$arrAdded = array();
		foreach($arrDocumentIds as $intDocumentId) {
			if(in_array($intDocumentId, $arrAdded)) {
				continue;
			}
			$objDocument			= \Document::loadById($intDocumentId);
			$this->arrAttachments[] = \Postmark\Models\PostmarkAttachment::fromFile(\Hikify\Helpers\Datacontainer::GetUrl($objDocument->Hash), $objDocument->Name, $objDocument->Type);
			$arrAdded[] = $intDocumentId;
		}
	}
	public function Save($intJobId){
		if($this->lstTemplates->SelectedValue) {
			$this->setArrayOfMergeableFields();
		}
		\QCubed\Project\Application::Log($this->lstTemplates->SelectedValue);
		if($this->ShouldLineBeSaved()){
			if(!$this->objCommunication){
				$this->objCommunication = new \Communication();
				$this->objCommunication->JobId			= $this->objJob->Id;
			}
			\QCubed\Project\Application::Log("Save");
			/* Communication table */
			$this->objCommunication->Body			= $this->ckMessage->Value;
			$this->objCommunication->Subject		= $this->txtSubject->Text;
			$this->objCommunication->Language		= $this->lstLang->SelectedValue;
			$this->objCommunication->UserId			= $this->objUser->Id;
			
			
			$this->objCommunication->save();
			
			if($this->objCommunication->Id && count($this->arrMailChosen) > 0){
				\CommunicationEntity::deleteByCommunicationId($this->objCommunication->Id);
			}
			
			foreach($this->arrMailChosen as $intMailId=>$intEntityId){
				$this->objCommunicationEntity	= new \CommunicationEntity();
				$this->objCommunicationEntity->CommunicationId = $this->objCommunication->Id;
				$this->objCommunicationEntity->EntityEmailId = $intMailId;
				$this->objCommunicationEntity->Save();

				$Entity = \Entity::loadById($intEntityId);
				
				$this->arrAllFields["entityfirstname"]		= $Entity->FirstName;
				$this->arrAllFields["entitylastname"]		= $Entity->LastName;
				$this->arrAllFields["entitycompanyname"]	= $Entity->CompanyName;
				$this->arrAllFields["entitycompanynr"]		= $Entity->CompanyNr;
				$this->arrAllFields["entityaddressstreet"]	= $Entity->Address ? $Entity->Address->Street : '';
				$this->arrAllFields["entityaddressnr"]		= $Entity->Address ? $Entity->Address->Nr : '';
				
				/* Check if template has WordDocument */
				$objPostmarkAttachments = array();
				if($this->lstTemplates){
					foreach(\WordTemplate::loadArrayByCommunicationIdAndLanguage($this->lstTemplates->SelectedValue, $this->lstLang->SelectedValue) as $objWordTemplate){
						$objPostmarkAttachments[] = \Hikify\Helpers\Reporting::GetMergeableFields($objWordTemplate->ReferenceOnReportingCloud, $this->arrAllFields);
					}
				}
				
				if(count($objPostmarkAttachments) > 0 && count($this->arrAttachments) > 0) {
					$objPostmarkAttachments = array_merge($objPostmarkAttachments, $this->arrAttachments);
				} elseif(count($objPostmarkAttachments) == 0 && count($this->arrAttachments) > 0) {
					$objPostmarkAttachments = $this->arrAttachments;
				}

				}
				\Hikify\Helpers\Postmark::sendEmail($this->objCommunicationEntity->EntityEmail->Address, $this->objCommunication->Subject, $this->objCommunication->Body, $objPostmarkAttachments);				
			}
			$this->pnlWarning		= new \QCubed\Control\Panel($this);
			$this->pnlWarning->Text	= tr('Message send success');
			$this->pnlWarning->addCssClass("alert alert-success alert-dismissible");
			
	}
	
	public function getSelectedMailing(){
		$this->arrMailChosen = "";
		foreach($this->lstEntityEmailList->getChildControls() as $ChosenMail){
			if($ChosenMail->Checked){
				$this->arrMailChosen[$ChosenMail->getCustomAttribute("data-key")] = $ChosenMail->getCustomAttribute("data-value");
			}
			
		}

		return $this->arrMailChosen;
	}
	
	public function ShouldLineBeSaved() {
		/* check if subject is not empty and min 1 mail is selected */
		return ($this->txtSubject->Text && $this->getSelectedMailing());
	}
	private function FillTemplateTags(\Hikify\Helpers\Template $helper) {
		$arrObjects		= array("Vehicle", "Damage");
		$collector		= new \Hikify\Helpers\DataCollector();
		if($this->objJob->Vehicle && $this->objJob->Vehicle->Make) {
			$collector->Load($this->objJob->Vehicle->Make);
		}
		if($this->objJob->Vehicle && $this->objJob->Vehicle->Model) {
			$collector->Load($this->objJob->Vehicle->Model);
		}
		$collector->Load($this->objUser);
		foreach($arrObjects as $obj) {
			$this->LoadEntities($collector);
			$this->LoadAppointments($collector);
			if(is_object($this->objJob->{$obj})) {
				$collector->Load($this->objJob->{$obj});		
			}
		}
		return $collector->Parse($helper);
	}
	private function LoadEntities(\Hikify\Helpers\DataCollector $collector) {
		//Load all entities
		$arrEntities = \EntityJob::loadArrayByJobId($this->objJob->Id);
		foreach($arrEntities as $objEntityJob) {
			$collector->Load($objEntityJob->Entity);
		}
	}
	private function LoadMakeAndModel(\Hikify\Helpers\DataCollector $collector) {
		//Load all entities
		$arrMake = \EntityJob::loadArrayByJobId($this->objJob->Id);
		foreach($arrEntities as $objEntityJob) {
			$collector->Load($objEntityJob->Entity);
		}
	}
	private function LoadAppointments(\Hikify\Helpers\DataCollector $collector) {
		//Load all appointments
		$arrAppointments = \Appointment::loadArrayByJobId($this->objJob->Id);
		foreach($arrAppointments as $objAppointment) {
			$collector->Load($objAppointment);
		}
	}

	public function lstTemplatesChanged(){
		$objTemplate	= \CommunicationTemplate::loadById($this->lstTemplates->SelectedValue);
		$strSubject		= "";
		$helper			= new \Hikify\Helpers\Template();

		
		switch($this->lstLang->SelectedValue){
			case "fr":
					$helper->Header	= $objTemplate->SubjectFr;
					$helper->Html	= $objTemplate->BodyFr;
				break;
			case "en":
					$strSubject		= $objTemplate->SubjectEn;
					$helper->Html	= $objTemplate->BodyEn;
				break;
			default:
					$strSubject		= $objTemplate->SubjectNl;
					$helper->Html	= $objTemplate->BodyNl;
				break;
		}
		$strBody					= $this->FillTemplateTags($helper);	
		$this->txtSubject->Value	= $strSubject;
		/* Set new body value */
		\QCubed\Project\Application::executeJavaScript("
					$('iframe').contents().find('.wysihtml5-editor').html('".$strBody."');
					qc.formObjsModified['".$this->ckMessage->ControlId."'] = true;
				");
	}
	
	public function blnTypeChanged(){
		\QCubed\Project\Application::Log("changed".$this->lstType->SelectedValue);
		\QCubed\Project\Application::Log($this->lstType->SelectedValue);
	}
	
	private function Build() {
		$this->pnlWarning				= new \QCubed\Control\Panel($this);
		
		$this->pnlEntityWarning			= new \QCubed\Control\Panel($this);
		$this->pnlEntityWarning->Text	= tr("Please enter an email address for this entity and click 'Save Entity'");
		$this->pnlEntityWarning->addCssClass("callout callout-warning");
		$this->pnlEntityWarning->Display= false;
		
		$this->lstTemplates				= \CommunicationTemplateList::GetListBox($this);
		$this->lstTemplates->addAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstTemplatesChanged'));
		
		$this->pnlEntityEmail			= new \Hikify\Panels\Maintenance\Email($this);
		$this->pnlEntityEmail->Display	= false;
		
		$this->btnSaveEntity			= \QCubed\Project\Control\Button::GetFontAwesomeButton($this, 'Save Entity', 'fas fa-save', 'SaveEntity', 'btn-success');
		$this->btnSaveEntity->Display	= false;
		
		$this->txtSubject				= new \QCubed\Project\Control\TextBox($this);
		$this->txtSubject->Name			= tr('Subject');
		
		$this->ckMessage				= new \QCubed\Bootstrap\TextBox($this);
		$this->ckMessage->TextMode		= \QCubed\Control\TextBoxBase::MULTI_LINE;
		
		\QCubed\Project\Application::executeJavaScript(""
			. "$('#".$this->ckMessage->ControlId."').wysihtml5({
				'events': {
					'blur': function(event) {
						var document = $(this.composer.doc.body);
						$('#".$this->ckMessage->ControlId."').val(document.html());
						qc.formObjsModified['".$this->ckMessage->ControlId."'] = true;
					}
				}
				});
				
		");
		
		$this->lstLang					= new \QCubed\Project\Control\ListBox($this);
		$this->lstLang->Name			= tr('Language');
		$this->lstLang->AddItem(tr('NL'), 'nl');
		$this->lstLang->AddItem(tr('FR'), 'fr');
		$this->lstLang->AddItem(tr('EN'), 'en');
		$this->lstLang->addAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstTemplatesChanged'));
		
		$this->lstType					= new \QCubed\Project\Control\ListBox($this);
		$this->lstType->Name			= tr("Type");
		$this->lstType->addItem(tr('Email'), 'email');
		$this->lstType->addItem(tr('Phone'), 'phone');
		$this->lstType->addAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'blnTypeChanged'));
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetFontAwesomeButton($this, tr("Send"), "fas fa-paper-plane", 'Save', $strBtnClass='btn-success'); 
	}
	
	private function ToggleEntityEmail($blnDisplay) {
		$this->pnlEntityEmail->Display	= $blnDisplay;
		$this->btnSaveEntity->Display	= $blnDisplay;
		$this->pnlEntityWarning->Display= $blnDisplay;
	}
	
}
