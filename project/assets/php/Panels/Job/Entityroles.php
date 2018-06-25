<?php

namespace Hikify\Panels\Job;

use QCubed\Plugin\Bootstrap as Bs;

class Entityroles extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlEntitiesM;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlEntitiesC;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlEntities;
	public $strType;	
	
		/**
	 *
	 * @var \Job 
	 */
    private $objJob;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);	
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/entityrole.tpl.php';
		$this->Build();
		
	}
	
    public function GetAccordionHeader() {
		
		if(!$this->objJob){
			return tr('Entities');
		}else{
			$arrEntityjobs = \EntityJob::LoadArrayByJobIdAndType($this->objJob->Id, $this->strType);
			if(count($arrEntityjobs) > 0){
				$entities = $this->BuildHeader($arrEntityjobs);	
				if(count($entities) >0 && array_key_exists('mandator',$entities)){
					return tr('Entities') . ': ' .implode(' | ',$entities['mandator']);
				}
				if(count($entities) >0 && array_key_exists('counterparty',$entities)){
					return tr('Entities') . ': ' .implode(' | ',$entities['counterparty']);
				}

			}else{
				return tr('Entities');
			}
			
		}
		
		 
	}
	
	public function BuildHeader($arrEntityjobs){
		$arr = [];
		foreach($arrEntityjobs as $jobEntity){
			$arr[$jobEntity->OwnerType][] = (string)$jobEntity;	
		}
		return $arr;
	}
	
    public function SetJob(\Job $objJob=null, $strType="mandator") {
		if(!$objJob) {
			return; 
		}
		$this->objJob									= $objJob;
		$this->strType									= $strType;
		$this->pnlEntities->RemoveChildControls(true);
		
		$arr = \EntityJob::LoadArrayByJobIdAndType($this->objJob->Id, $strType);
		foreach($arr as $entityjob){
			$this->AddToPanel($entityjob);
		}
		
		$pnlEntityJob									= new Entityjob($this->pnlEntities,null, $strType);
		$pnlEntityJob->SetJob($objJob);
		$pnlEntityJob->Register('OnSave', 'EntityJobSaved',$this);
	}
	
	public function EntityJobSaved(){
		$this->Trigger("EntitySaved");
		$this->SetJob($this->objJob);
	}
	
	private function Build() {
		$this->pnlEntities						= new \QCubed\Control\Panel($this);
		$this->pnlEntities->AutoRenderChildren	= true;
	}

	private function AddToPanel(\EntityJob $objEntityJob=null) {
		if($objEntityJob->OwnerType == "mandator"){
			$pnlEntityJob = new Entityjob($this->pnlEntities);
			$pnlEntityJob->SetEntityJob($objEntityJob, $objEntityJob->OwnerType);
			$pnlEntityJob->Register('OnSave', 'EntityJobSaved',$this);
		}else{
			$pnlEntityJob = new Entityjob($this->pnlEntities);
			$pnlEntityJob->SetEntityJob($objEntityJob, $objEntityJob->OwnerType);
			$pnlEntityJob->Register('OnSave', 'EntityJobSaved',$this);
		}
	}
}

