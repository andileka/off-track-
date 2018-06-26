<?php

namespace Hikify\Pages\Tourist;

class Device extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \Hikify\Panels\Tourist\Detail
	 */
	public $pnlTourist;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/tourist/device.tpl.php';

		$this->addCssFile("/project/assets/css/datatables.css");	
		$this->Build();
	}
			
	private function Build() {		
		$devicetourist = \DeviceTourist::querySingle(
			\QCubed\Query\QQ::andCondition(
				\QCubed\Query\QQ::lessOrEqual(\QQN::deviceTourist()->StartDate, \QCubed\QDateTime::now()),
				\QCubed\Query\QQ::isNull(\QQN::deviceTourist()->EndDate),
				\QCubed\Query\QQ::equal(\QQN::deviceTourist()->Device->Serial, $_GET['device'])
			),

			\QCubed\Query\QQ::clause(
				\QCubed\Query\QQ::expand(\QQN::deviceTourist()->Tourist)
			)
		);
		if($devicetourist) {
			error_log("device tourist found");
			$this->pnlTourist = new \Hikify\Panels\Tourist\Detail($this);
			$this->pnlTourist->SetTourist($devicetourist->Tourist);
		} else {
			$this->pnlTourist = new \QCubed\Control\Label($this);
			$this->pnlTourist->Text = tr("Sorry, device not found");
		}
				
	}
	
}
