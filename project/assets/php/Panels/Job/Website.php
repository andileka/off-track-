<?php

namespace Hikify\Panels\Job;

class Ubench extends \QCubed\Control\Panel {
	/** 
	 * 
	 * @var \JobList  
	 */
	public $dgUbench;

	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/ubench.tpl.php';
		$this->Build();
		
	}
	
	public function GetAccordionHeader() {
		$count = count(\Job::loadAll());
		if($count > 0) {
			return 'Website' . ': ' . $count;
		}
		return 'Ubench';
	}
	
	
	private function Build() {
		$this->dgUbench				= new \JobList($this); 
		$this->dgUbench->CssClass	= 'jobs_table table';		
		$this->dgUbench->CreateColumns();
	}
}
