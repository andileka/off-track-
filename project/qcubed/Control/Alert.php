<?php
namespace QCubed\Project\Control;

class Alert extends \QCubed\Bootstrap\Alert	{

	public function DisplayXSeconds($intTimeout=5) {
		$this->Display = true;
		\QCubed\Project\Application::executeJavaScript("setTimeout(function() { $('#{$this->ControlId}').fadeOut();},$intTimeout*1000);");
	}
}