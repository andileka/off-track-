<?php

namespace Hikify\Panels\Job;

/**
 * @property Document
 */
class Document extends \QCubed\Control\Panel {	
	/**
	 *
	 * @var \Gallery 
	 */
	public $pnlGallery;
	/**
	 *
	 * @var \Job 
	 */
	public $objJob;
	/**
	 * @var \DocumentList
	 */
	public $objDocumentList;
	/**
	 * @var \QCubed\Control\FileControl
	 */
	public $flDocument;
	/**
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnUpload;
	/**
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNr;
	private $strTitle;
	
	public function __construct($objParentObject) {
		parent::__construct($objParentObject);
		$this->strTemplate	= __TEMPLATES__ . '/panels/job/document.tpl.php';
		$this->Build();
	}
	
	public function __get($strName) {
		switch($strName) {
			default:
				return parent::__get($strName);
		}
	}
	
	
	public function __set($strName, $strValue) {
		switch($strName) {
			default:
				return parent::__set($strName, $strValue);
		}
	}
	
	public function GetAccordionHeader() {
		if($this->objJob && ($intDocumentCount = count(\Document::loadArrayByJobId($this->objJob->Id)))) {
			return tr('Document:') . ' ' . $intDocumentCount;
		}
		return tr('Document');
	}
	
	public function SetJob(\Job $objJob=null){
		if(!$objJob) {
				return;
		}
		
		$this->objJob		= $objJob;	
		$this->pnlGallery	= new Gallery($this);
		$this->pnlGallery->SetJob($this->objJob);
	}
	
	private function Build() {		
		$this->flDocument				= new \QCubed\Project\Control\FileControl($this);
		
		$this->btnUpload				= \QCubed\Project\Jqui\Button::GetFontAwesomeButton($this, tr("Upload"), "fas fa-upload");
		$this->btnUpload->addAction(new \QCubed\Event\Click(), new \QCubed\Action\ServerControl($this, 'reload'));
	}
	
	public function reload() {
		\QCubed\Project\Application::redirect('/?c=job&a=edit&id='.$this->objJob->Id);
	}
}
