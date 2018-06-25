<?php
namespace QCubed\Project\Control;
	class BooleanButton extends RadioButtonGroup {
		public $blnAddUnknown=true;
		
		public function __construct($objParentObject, $blnAddUnknown=true) {
			$this->blnAddUnknown = $blnAddUnknown;
			parent::__construct($objParentObject);			
		}
		
		
		public function AddRadioButtons() {
			$this->AddItem(tr('Yes')		, 'yes');
			
			if($this->blnAddUnknown) {
				$this->AddItem(tr('No')			, 'no');			
				$this->AddItem(tr('Unknown')	, 'unknown', true);
				$this->AddButtonClassnames([
					'green',
					'red',
					''
				]);
			} else {
				$this->AddItem(tr('No')			, 'no', true);
				$this->AddButtonClassnames([
					'green',
					'red'
				]);
			}
		}
	}