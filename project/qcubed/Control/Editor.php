<?php

namespace QCubed\Project\Control;

class Editor extends \QCubed\Control\Panel {

	public function Validate() {

		$isValid = true;
		foreach ($this->GetChildControls() as $childControl) {
			if (!$childControl->Validate()) {
				$isValid = false;
			}
		}

		return $isValid;
	}

}
