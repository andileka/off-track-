<?php

namespace QCubed\Project\Control;

/**
 * Class WordTemplateTable
 *
 * @was QHtmlTable
 * @package QCubed\Project\Control
 */
class WordTemplateTable extends \QCubed\Control\TableBase
{
	public function createColumns() {
		$this->createCallableColumn(tr("Name")			, [$this,'renderName'])->HtmlEntities = false;
		$this->createCallableColumn(tr("Edit")			, [$this,'renderEditButton'])->HtmlEntities = false;
		$this->createCallableColumn(tr("Delete")		, [$this,'renderDeleteButton'])->HtmlEntities = false;
	}
	public function renderName($param) {
		return $param;
	}
	public function renderEditButton($strWordTemplate) {
		$objControlId = "editButton" . $this->CurrentRowIndex;
		if (!$objControl = $this->getChildControl($objControlId)) {
			$objControl = new \QCubed\Bootstrap\Button($this, $objControlId);
			$objControl->WrapperCssClass = 'show';
			$objControl->Text = '<i class="fas fa-cloud" aria-hidden="true"></i>';
			$objControl->HtmlEntities = false;
			$objControl->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "renderEditButton_Click"));
			$objControl->ActionParameter = $strWordTemplate;
			$objControl->CausesValidation = false;
		}
		return $objControl->render(false);
	}

	public function renderDeleteButton($strWordTemplate) {
		$objControlId = "deleteButton" . $this->CurrentRowIndex;
		if (!$objControl = $this->getChildControl($objControlId)) {
			$objControl = new \QCubed\Bootstrap\Button($this, $objControlId);
			$objControl->WrapperCssClass = 'show';
			$objControl->Text = '<i class="fas fa-trash-alt" aria-hidden="true"></i>';
			$objControl->HtmlEntities = false;
			$objControl->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "renderDeleteButton_Click"));
			$objControl->ActionParameter = $strWordTemplate;
			$objControl->CausesValidation = false;
		}
		return $objControl->render(false);
	}

	public function renderEditButton_Click(\QCubed\Action\ActionParams $params) {
		$strWordTemplateName = $params->ActionParameter;
		$this->Trigger('OnClick', array('Edit',$strWordTemplateName));
	}
	public function renderDeleteButton_Click(\QCubed\Action\ActionParams $params) {
		$strWordTemplateName = $params->ActionParameter;
		$this->Trigger('OnClick', array('Delete',$strWordTemplateName));
	}

}

