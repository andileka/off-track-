<?php

namespace Hikify\Pages\Maintenance;

class Templatesedit extends \QCubed\Control\Panel {
	
	/** @var \QCubed\Bootstrap\Nav */
	public $navLang;
	/** @var \QCubed\Control\Panel */
	public $pnlTemplateNl;
	/** @var \QCubed\Control\Panel */
	public $pnlTemplateFr;
	/** @var \QCubed\Control\Panel */
	public $pnlTemplateEn;
	 /** @var \QCubed\Project\Control\Button */
	public $btnSave;
	 /** @var \QCubed\Project\Control\ListBox */
	public $lstType;
	 /** @var \QCubed\Project\Control\ListBox */
	public $lstTemplateTags;
	 /** @var \CommunicationTemplate */
	private $objCommunicationTemplate;
	/** @var \WordTemplate */
	private $objWordTemplate;
	private $objFile;
	private $arrSelectedTemplates = array();
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/templates-edit.tpl.php';
		$this->Build();
		if(isset($_GET['id'])) {
			$objCommunicationTemplate = \CommunicationTemplate::loadById((int) $_GET['id']);
			$this->objCommunicationTemplate										= $objCommunicationTemplate;
		}
		
		
	}
	public function Save() {
		
		if(!$this->objCommunicationTemplate){
			$this->objCommunicationTemplate = new \CommunicationTemplate();
			\QCubed\Project\Application::Log("New");
		}
		$this->objCommunicationTemplate->BodyNl			= $this->pnlTemplateNl->ckMessage->Value;
		$this->objCommunicationTemplate->SubjectNl		= $this->pnlTemplateNl->txtSubject->Value;
		$this->objCommunicationTemplate->BodyFr			= $this->pnlTemplateFr->ckMessage->Value;
		$this->objCommunicationTemplate->SubjectFr		= $this->pnlTemplateFr->txtSubject->Value;
		$this->objCommunicationTemplate->BodyEn			= $this->pnlTemplateEn->ckMessage->Value;
		$this->objCommunicationTemplate->SubjectEn		= $this->pnlTemplateEn->txtSubject->Value;
		$this->objCommunicationTemplate->Type			= $this->lstType->SelectedValue;
		$this->objCommunicationTemplate->save();
		
		$this->arrSelectedTemplates["nl"] = $this->pnlTemplateNl->lstDocuments->SelectedValues;
		$this->arrSelectedTemplates["fr"] = $this->pnlTemplateFr->lstDocuments->SelectedValues;
		$this->arrSelectedTemplates["en"] = $this->pnlTemplateEn->lstDocuments->SelectedValues;
		
		$this->UploadWordTemplates($this->pnlTemplateNl, "nl");
		$this->UploadWordTemplates($this->pnlTemplateFr, "fr");
		$this->UploadWordTemplates($this->pnlTemplateEn, "en");
		
		
		$this->SaveWordTemplates();
		\QCubed\Project\Application::Redirect('index.php?c=maintenance&a=templates');
		
	}
	private function UploadWordTemplates($objFile,$strLanguage){
		if($objFile->flDocument->File){
			\Hikify\Helpers\Reporting::UploadFileToCloud($objFile->flDocument->File, $objFile->flDocument->FileName);
			$this->arrSelectedTemplates[$strLanguage][] = $objFile->flDocument->FileName;
		}		
	}
	private function SaveWordTemplates(){
		if($this->objCommunicationTemplate->Id){
			/* DELTE ALL WORDDOCS FOR COMMUNICATIONTEMPLATE IF ID IS KNOWN */
			\WordTemplate::deleteByCommunicationId($this->objCommunicationTemplate->Id);
		}
		
		foreach($this->arrSelectedTemplates as $strLanguage => $strFilename){
			for($x=0;$x<count($strFilename);$x++){
				$this->objWordTemplate								= new \WordTemplate();
				$this->objWordTemplate->CommunicationTemplateId		= $this->objCommunicationTemplate->Id;
				$this->objWordTemplate->Language					= $strLanguage;
				$this->objWordTemplate->ReferenceOnReportingCloud	= $strFilename[$x];

				$this->objWordTemplate->Save();
			}	
		}
		
	}
	private function AddTemplateFieldsToPanel(){
		$this->pnlTemplateNl							= new \Hikify\Panels\Maintenance\TemplatesEdit($this->AddPanelToNavigation("Dutch"), "NL");
		$this->pnlTemplateFr							= new \Hikify\Panels\Maintenance\TemplatesEdit($this->AddPanelToNavigation("French"), "FR");
		$this->pnlTemplateEn							= new \Hikify\Panels\Maintenance\TemplatesEdit($this->AddPanelToNavigation("English"), "EN");
	}
	private function AddPanelToNavigation($strTitle){
		$pnl = new \QCubed\Control\Panel ($this->navLang);	 
		$pnl->Name = tr($strTitle);
		$pnl->PreferredRenderMethod				= "RenderFormGroup";
		$pnl->AutoRenderChildren				= true;
		
		return $pnl;
	}
	private function Build() {		
		/* Bullets */
		$this->navLang = new \QCubed\Bootstrap\Nav($this);
		$this->AddTemplateFieldsToPanel($this->navLang);
		$this->btnSave				= \QCubed\Project\Control\Button::GetFontAwesomeButton($this, tr('Save'), 'far fa-save', null, 'btn-success');
		$this->btnSave->addCssFile("/project/assets/css/button.css");
		$this->btnSave->addAction(new \QCubed\Event\Click(), new \QCubed\Action\ServerControl($this, 'Save'));
		
		$this->lstType					= new \QCubed\Project\Control\ListBox($this);
		$this->lstType->Name			= tr("Type");
		$this->lstType->addItem(tr('Email'), 'email');
		$this->lstType->addItem(tr('Letter'), 'letter');
		$this->lstType->addItem(tr('SMS'), 'sms');
		$this->lstType->addItem(tr('Phone'), 'call');

	}
}
