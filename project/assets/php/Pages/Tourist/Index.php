<?php

namespace Hikify\Pages\Tourist;

class Index extends \QCubed\Control\Panel {
		
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		header('Location: index.php?c=tourist&a=listing');

	}


}
