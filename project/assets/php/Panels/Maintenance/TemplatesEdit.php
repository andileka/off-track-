<?php

namespace Hikify\Panels\Maintenance;

/**
 * @property Address $Address Description
 */
class TemplatesEdit extends \QCubed\Control\Panel {
	/** @var \QCubed\Project\Control\FileControl */
	public $flDocument;
	/** @var \QCubed\Control\Panel  */
	public $pnlEdit;
	/** @var \QCubed\Project\Control\TextBox */
	public $txtSubject;
	/** @var \QCubed\Project\Control\TextBox */
	public $ckMessage;
	/** @var \QCubed\Codegen\Generator\ListBox */
	public $lstDocuments;
	/** @var \QCubed\Codegen\Generator\ListBox */
	public $lstTemplateTags;
	/** @var \CommunicationTemplate */
	private $objCommunicationTemplate;
	/** @var \WordTemplate */
	private $objWordTemplates;
	/** @var \QCubed\Project\Control\Button */
	public $btnExportTags;
	
	private $strLanguage;
	private $arrTags = array();
	
	public function __construct($objParentObject, $strLanguage) {
		parent::__construct($objParentObject, null);

		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/template-edit.tpl.php';
		$this->addCssFile("/project/assets/css/communication.css");
		$this->addJavascriptFile("/vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js");
		$this->addCssFile("/vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css");
		
		$this->Build();
		if(isset($_GET['id'])) {
			$objCommunicationTemplate = \CommunicationTemplate::loadById((int) $_GET['id']);
			$arrTmpWordTemplates		  = \WordTemplate::loadByIdAndLanguage($_GET['id'], $strLanguage );
			
			$arrWordTemplates = array_map(function(\WordTemplate $objWordTemplate) {
												return $objWordTemplate->Reference;
											}, $arrTmpWordTemplates);
			$this->lstDocuments->SelectedValues = $arrWordTemplates;

			$this->objCommunicationTemplate										= $objCommunicationTemplate;
			$this->SetTemplateByLanguage($strLanguage,$objCommunicationTemplate);
		}
		
	}
	
	public function SetTemplateByLanguage($strLanguage, $objCommunicationTemplate=null) {
		switch($strLanguage){
			case "FR":
				$this->ckMessage->Value				= $this->objCommunicationTemplate->BodyFr;
				$this->txtSubject->Value			= $this->objCommunicationTemplate->SubjectFr;
				break;
			case "EN":
				$this->ckMessage->Value				= $this->objCommunicationTemplate->BodyEn;
				$this->txtSubject->Value			= $this->objCommunicationTemplate->SubjectEn;
				break;
			default:
				$this->ckMessage->Value				= $this->objCommunicationTemplate->BodyNl;
				$this->txtSubject->Value			= $this->objCommunicationTemplate->SubjectNl;
				break;
		}
		
	}
	public function ExportTags() {
		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename="filename.csv"');
		echo implode(",", $this->arrTags);
		exit();
	}
	
	private function Build() {
		$this->flDocument				= new \QCubed\Control\FileControl($this);
		$this->flDocument->Name			= tr('Upload file');
		
		$this->txtSubject				= new \QCubed\Project\Control\TextBox($this);
		$this->txtSubject->Name			= tr('Subject');
		
		$this->ckMessage				= new \QCubed\Bootstrap\TextBox($this);
		$this->ckMessage->TextMode		= \QCubed\Control\TextBoxBase::MULTI_LINE;
		
		$this->lstTemplateTags = new \QCubed\Project\Control\ListBox($this);
		$this->lstTemplateTags->Width = '620';
		$this->lstTemplateTags->Name = tr("Template Tags");
		foreach ($this->GetAllTemplateTags() as $strObjName => $arrTags) {
			foreach ($arrTags as $strTagName => $value) {
				$this->arrTags[] = $strTagName;
				$this->lstTemplateTags->addItem($strTagName, "[".$strTagName."]", false, tr($strObjName));
			}
		}
		$this->lstTemplateTags->addAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'FillTemplateTag'));
		$this->btnExportTags = \QCubed\Bootstrap\Button::GetFontAwesomeButton($this, tr('Export Tags'), 'fas fa-download');
		$this->btnExportTags->addAction(new \QCubed\Event\Click(), new \QCubed\Action\ServerControl($this, 'ExportTags'));
		
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
		$reportingHelper				= new \Hikify\Helpers\Reporting($this);
		$this->lstDocuments				= $reportingHelper->GetTemplatesListbox($this);
		
	}
	public function FillTemplateTag() {
		//I made a change request on https://github.com/almasaeed2010/AdminLTE/compare/master...DomienJ:patch-1 for this to make it work. Hopefully we get a quick approve :)
		\QCubed\Project\Application::executeJavaScript("var wysihtml5Editor = $('#".$this->ckMessage->ControlId."').data('wysihtml5').editor;"
													 . "wysihtml5Editor.composer.commands.exec('insertHTML','".$this->lstTemplateTags->SelectedValue."');");
	}
	private function GetAllTemplateTags() {
		$arrObjects = ["Vehicle", "VehicleType", "Make", "Model", "Job", "Appointment", "Entity", "Address", "User" ,"Damage"];
		foreach($arrObjects as $k=>$v) {
			$object = new $v;
			$arrTemplateTags[$v] = $object->GetTemplateTags();
		}
		return $arrTemplateTags;
	}
	
}
