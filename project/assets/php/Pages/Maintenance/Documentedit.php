<?php

namespace Hikify\Pages\Maintenance;

class Documentedit extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Project\Control\FileControl
	 */
	public $flDocument;
	public $btnSave;
	/** @var \QCubed\Control\Panel **/
	public $pnlEdit;
	/** @var \QCubed\Project\Control\ListBox **/
	public $lstTemplates;
	private $objEntities;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/document-edit.tpl.php';
		//$this->objEntities			= new \EntityType();	
		$this->Build();
		
		/*if(isset($_GET['id'])) {
			$objEntities = \EntityType::Load((int) $_GET['id']);
			$this->txtNameEn->Text									= $objEntities->NameEn;
			$this->txtNameNl->Text									= $objEntities->NameNl;
			$this->txtNameFr->Text									= $objEntities->NameFr;
			$this->chkActive->Checked								= ($objEntities->Active == 1) ? true : false;
			
			$this->objEntities										= $objEntities;
		}*/
		
	}
	public function GetDocumentViewer(\QCubed\Action\ActionParams $params) {
		$docString			= \Hikify\Helpers\Reporting::GetShareDocument($params->ActionParameter);
		$parsedDocString	= str_replace('"', '', $docString);
		$iframe = '<div data-document="'.$parsedDocString.'" id="reportingcloud-documentviewer" style="height: 100%"></div>
				   <script async src="https://portal.reporting.cloud/scripts/reportingcloud.js" charset="utf-8"></script>';
		$this->pnlEdit->HtmlBefore	= $iframe;
		$this->pnlEdit->Display		= true;
	}
	public function Save() {
		\Hikify\Helpers\Reporting::UploadFileToCloud($this->flDocument->File, $this->flDocument->FileName);
	}
	
	private function Build() {		
		$this->pnlEdit = new \QCubed\Control\Panel($this);
		$this->pnlEdit->Display = false;
		$this->lstTemplates = \Hikify\Helpers\Reporting::GetTemplatesListbox($this);
		//$this->lstTemplates->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'GetDocumentViewer'));
		//$this->lstTemplates->ActionParameter = $this->lstTemplates->SelectedName;

		$this->flDocument				= new \QCubed\Project\Control\FileControl($this);
		$this->btnSave = \QCubed\Project\Control\Button::GetSaveButton($this, tr('Upload Document'));
	}

	
}
