<?php

namespace Hikify\Pages\Maintenance;

class Documents extends \QCubed\Control\Panel {

	/**
	 *
	 * @var \QCubed\Project\Control\FileControl
	 */
	public $flDocument;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button
	 */
	public $btnUpload;
	/** 
	 * 
	 * @var \QCubed\Project\Control\WordTemplateTable
	 */
	public $dgWordTemplate;
	public $arrSelectedTemplates;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		$this->strTemplate		= __TEMPLATES__ .  '/pages/maintenance/documents.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");
		$this->Build();
	}
	
	public function Upload() {
		if($this->flDocument->File){
			\Hikify\Helpers\Reporting::UploadFileToCloud($this->flDocument->File, $this->flDocument->FileName);
		}	
		if($this->flDocument->File) {
			\Hikify\Helpers\Reporting::UploadFileToCloud($this->flDocument->File, $this->flDocument->FileName);
			\QCubed\Project\Application::Redirect('index.php?c=maintenance&a=documents');	
		} else {
			\QCubed\Project\Application::Redirect('index.php?c=maintenance&a=documents');	
		}

	}
	
	public function EditDocument($strMethod, $strWordTemplateName) {
		switch ($strMethod) {
			case 'Edit' : 	$js = " var url = 'https://portal.reporting.cloud/MyTemplates/Edit/?Filename=$strWordTemplateName&datasource=EPM_template_tags.json';
									var win = window.open(url, '_blank');
									win.focus();";
							\QCubed\Project\Application::executeJavaScript($js);
							break;
			case 'Delete' : \Hikify\Helpers\Reporting::DeleteTemplate($strWordTemplateName);
							$this->dgWordTemplate->DataSource = \Hikify\Helpers\Reporting::GetTemplatesList();
							$this->dgWordTemplate->dataBind();
							break;
		}

	}
	private function Build() {			
		$this->dgWordTemplate = new \QCubed\Project\Control\WordTemplateTable($this);
		$this->dgWordTemplate->DataSource = \Hikify\Helpers\Reporting::GetTemplatesList();
		$this->dgWordTemplate->createColumns();
		$this->dgWordTemplate->CssClass	= 'entitytype_table table';
		$this->dgWordTemplate->Register("OnClick","EditDocument",$this);

		$this->flDocument				= new \QCubed\Control\FileControl($this);
		$this->btnUpload				= \QCubed\Project\Jqui\Button::GetFontAwesomeButton($this, tr("Upload Document"), "fas fa-upload");
		$this->btnUpload->addCssClass('btn-fl');
		$this->btnUpload->addAction(new \QCubed\Event\Click(), new \QCubed\Action\ServerControl($this, 'Upload'));
	}

}
