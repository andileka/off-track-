<?php

namespace Hikify\Panels\Job;

/**
 * @property Document
 */
class Gallery extends \QCubed\Control\Panel {	
	/**
	 *
	 * @var \QCubed\Control\Image
	 */
	public $objImage;
	/**
	 * @var \DocumentList
	 */
	public $objDocumentList;
	/**
	 * @var \Job
	 */
	public $objJob;
	/**
	 * Array
	 */
	public $arrImages = array();
	/**
	 *
	 * @var \QCubed\Bootstrap\Checkbox
	 */
	public $chkSelect;
	public $blnCheckable = false;
	public $arrCheckedDocuments = array();
	
	public function __construct($objParentObject, $blnCheckable = null) {
		parent::__construct($objParentObject);
		$this->strTemplate	= __TEMPLATES__ . '/panels/job/gallery.tpl.php';
		$this->addCssFile("/project/assets/css/gallery.css");
		$this->addJavascriptFile('/project/assets/js/image-gallery.js');
		$this->addJavascriptFile("/vendor/drmonty/ekko-lightbox/js/ekko-lightbox.min.js");
		$this->blnCheckable = $blnCheckable;
	}
	
	public function __get($strName) {
		switch($strName) {
			default:
				return parent::__get($strName);
		}
	}
	
	
	public function __set($strName, $mixValue) {
		switch($strName) {
			case 'blnCheckable' : $this->blnCheckable = $mixValue;
			default:
				return parent::__set($strName, $mixValue);
		}
	}
	
	public function SetJob(\Job $objJob=null) {
		if($objJob && $objJob->Id) {
			$this->objJob = $objJob;	
			$this->Build();
		}
	}
	
	public function GetAccordionHeader() {		
		return tr('Document');
	}
	
	public function ImageClicked(\QCubed\Action\ActionParams $params) {
		if(in_array($params->ActionParameter, $this->arrCheckedDocuments)) {
			if (($key = array_search($params->ActionParameter, $this->arrCheckedDocuments)) !== false) {
				unset($this->arrCheckedDocuments[$key]);
			}
		} else {
			$this->arrCheckedDocuments[] = $params->ActionParameter;
		}
		$this->objParentControl->setAttachments($this->arrCheckedDocuments);
	}
	
	public function GetCheckedDocuments() {
		return $this->arrCheckedDocuments;
	}
	
	private function Build() {
		if(!$this->blnCheckable) {
			\QCubed\Project\Application::executeJavaScript('$(document).on("click", "[data-toggle=\"lightbox\"]", function(event) {event.preventDefault();$(this).ekkoLightbox({alwaysShowClose: true});});');
		}
		$this->arrImages = array();
		
		$arrDocuments = $this->GetDocuments();
		foreach($arrDocuments as $objDocument) {
			$this->objImage				= new \QCubed\Project\Control\Image($this);
			$this->objImage->ImageUrl	= $this->GetDocumentUrl($objDocument);
			$this->objImage->addCssClass("img-responsive");
			if(!$this->blnCheckable) {
				$this->objImage->addWrapperCssClass("wrapper-img-responsive"); 
				$this->arrImages[$this->objImage->ControlId]['image'] = $this->objImage;		
			} else {
				$this->objImage->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'ImageClicked'));
				$this->objImage->ActionParameter = $objDocument->Id;
				$this->arrImages[$this->objImage->ControlId]['image'] = $this->objImage;		
			}	
		}
	}
	
	private function GetDocuments() {
		if(!$this->objJob) {
			return false;
		}
		return \Document::loadArrayByJobId($this->objJob->Id);
	}
	
	private function GetDocumentUrl(\Document $objDocument) {
		return \Hikify\Helpers\Datacontainer::GetUrl($objDocument->Hash);	
	}
}