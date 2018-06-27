<?php

namespace Hikify\Pages\Planning;

class Listing extends \QCubed\Control\Panel {
		
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		header('Location: index.php?c=tourist&a=listing');
		
	}


	
}
