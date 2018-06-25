<?php

namespace QCubed\Project\Control;

class RadioButtonGroup extends \QCubed\Bootstrap\RadioList {

	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->ButtonMode = \QCubed\Control\RadioButtonList::BUTTON_MODE_SET;

		$this->AddRadioButtons();
		$this->AddCssClass('boolean-button');
		
	}

	/**
	 * pass an array of css classnames to this method to apply css rules to the buttons. These css classes can be used to set the colours or anything else on those buttons
	 * 
	 * @param string[] $arrCssClassNames
	 */
	public function AddButtonClassnames($arrCssClassNames) {
		foreach ($arrCssClassNames as $intIndex => $strCssClass) {
			$objItem = $this->GetItem($intIndex);
			$itemstyle = $objItem->GetStyle();
			$itemstyle->AddCssClass('btn btn-default ' . $strCssClass);
			$this->addCssFile("/project/assets/css/boolean-button.css");
			$this->addCssFile("/project/assets/css/colors.css");
		}
	}

	public function AddRadioButtons() {
		
	}

	public function RenderOutput($strOutput, $blnDisplayOutput, $blnForceAsBlockElement = false) {
		\QCubed\Project\Application::executeJavaScript('$("#'.$this->strControlId.' label").click('
					. 'function(event) {'
						. 'if(event.target.nodeName!="INPUT") {'
							. '$(this).find("input").click();'
						. '}'
					. '}'
				. ')'//end click()
		);
		return parent::RenderOutput($strOutput, $blnDisplayOutput, $blnForceAsBlockElement);
	}

	/**
	* Re-Override of superclass to bugfix a bug introduced in bootstrap plugin
	*/
	protected function RefreshSelection() {
		$this->blnModified = true;
	}
}
