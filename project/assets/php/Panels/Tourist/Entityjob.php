<?php

namespace Hikify\Panels\Job;

use QCubed\Plugin\Bootstrap as Bs;
use QCubed\Project\Jqui\Modal;

class Entityjob extends \QCubed\Control\Panel {
	
	/** 
	 * @var \QCubed\Project\Control\ListBox 
	 **/
	public $lstRolesType;
	/** 
	 * @var \QCubed\Project\Control\TextBox  
	 */
	public $txtComment;
	/** 
	 * @var \QCubed\Project\Control\TextBox  
	 */
	public $txtReference;
	/** 
	 * @var \QCubed\Project\Control\Button  
	 */
	public $btnEntitySelect;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstOwnerType;
	/**
	 *
	 * @var \EntityJob
	 */
    public $EntityJob;
	/**
	 *
	 * @var \Entity 
	 */
	public $Entity;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button
	 */
	public $btnDelete;
	/**
	 *
	 * @var \EntityJob 
	 */
    private $objEntityJob;
	/**
	 *
	 * @var Entity 
	 */
	public $pnlEntity;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstSubcontractors;
   
	/**
	 * @var Modal
	 */
    public $modalEntity;
	
	private $ownerType;
	
	public function __construct($objParentObject, $strControlId = null, $OwnerType=null) {
		parent::__construct($objParentObject, $strControlId);
		$this->ownerType							= $OwnerType;
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/entities.tpl.php';
		$this->objEntityJob = new \EntityJob();			
		$this->Build();
		
	}
	
    public function SetJob(\Job $objJob=null) {
		$this->objEntityJob->Job                             = $objJob;
	}
	
    public function SetEntityJob(\EntityJob $objEntityJob=null, $OwnerType='mandator') {
		if(!$objEntityJob) {
			return;
		}        
		
		$this->objEntityJob                         = $objEntityJob;
		$this->lstOwnerType->SelectedValue			= $OwnerType;
		$this->ownerType							= $OwnerType;
		$this->lstOwnerType							= null;
		$this->txtComment->Text                     = $objEntityJob->Comment;
		$this->txtReference->Text					= $objEntityJob->Reference;
		$this->btnEntitySelect->Text				= (string)$objEntityJob->Entity;
		$this->btnEntitySelect->addCssClass(($objEntityJob->OwnerType == 'mandator') ? 'btn-client' : 'btn-opposition');
		$this->lstRolesType->SelectedValue			= $objEntityJob->RoleId;
		$this->btnSave->removeCustomAttribute("disabled");
		$this->btnDelete->removeCustomAttribute("disabled");
		
		$this->CheckHasSubcontractors($objEntityJob);
		
	}
	
	public function CheckHasSubcontractors($objEntityJob){
		if($objEntityJob->Entity->HasSubcontractors){
			$this->lstSubcontractors->ReadOnly		= false;
			$this->lstSubcontractors				= \Subcontractors::GetListBox($this, $objEntityJob->Entity->Id);
			$GetSubcontractor = \EntityJob::loadSubcontractorByJobIdAndEntity($this->objEntityJob->JobId,$this->objEntityJob->EntityId);
			if(!$GetSubcontractor){return;}
			$this->lstSubcontractors->SelectedValue = $GetSubcontractor->EntityId;
		}
	}
        
	public function EntitySaved(\Entity $objEntity){
		$this->objEntityJob->Entity		= $objEntity;
		$this->pnlEntity->Display		= false;
		$this->btnEntitySelect->Text	= (string)$objEntity;
		$this->Entity					= $objEntity;
		$this->Save();
	}
	public function CheckRoleByEntity($JobId=null, $RoleId=null, $EntityId=null){
		if($JobId && $RoleId && $EntityId){
			$EntityJob = \EntityJob::loadByJobidRoleAndEntity($JobId,$RoleId,$EntityId);
			if($EntityJob){
				return true;
			}
			
		}
	}
	private function HasSubcontractors($JobId,$Entity){
		/* 12 => SYSTEMROLE SUBCONTRACTOR */
		if($this->lstSubcontractors->SelectedValue){
			/* INSERT ADDITIONAL SUBCONTRACTOR */
			if(!$this->CheckRoleByEntity($JobId,12,$Entity)){
				$objEntityJob = new \EntityJob();
				$objEntityJob->EntityId		= $this->lstSubcontractors->SelectedValue;
				$objEntityJob->JobId		= $this->objEntityJob->JobId;
			}
			$objEntityJob->RoleId			= 12;
			$objEntityJob->Comment			= $this->txtComment->Text;
			$objEntityJob->Reference		= $this->txtReference->Text;
			if($this->lstOwnerType){
				$objEntityJob->OwnerType	= $this->lstOwnerType->SelectedValue;
			}else{
				$objEntityJob->OwnerType	= $this->ownerType;
			}
			$objEntityJob->Save();
		}
		
	}
	
	public function Save() {
		if(!$this->objEntityJob){return;}
		$objEntityJob						= $this->objEntityJob;

		foreach($this->lstRolesType->SelectedValues as $RoleId){
			if(!$this->CheckRoleByEntity($objEntityJob->JobId,$RoleId,$this->objEntityJob->EntityId)){
				$objEntityJob = new \EntityJob();
				$objEntityJob->EntityId		= $this->objEntityJob->EntityId;
				$objEntityJob->JobId		= $this->objEntityJob->JobId;
			}
			$objEntityJob->RoleId			= $RoleId;
			$objEntityJob->Comment			= $this->txtComment->Text;
			$objEntityJob->Reference		= $this->txtReference->Text;
			if($this->lstOwnerType){
				$objEntityJob->OwnerType	= $this->lstOwnerType->SelectedValue;
			}else{
				$objEntityJob->OwnerType	= $this->ownerType;
			}
			$objEntityJob->Save();
		}
		if(isset($RoleId)){
			$this->HasSubcontractors($this->objEntityJob->JobId,$RoleId,$this->objEntityJob->EntityId);
		}
		
		
		$this->Trigger('OnSave', array());
		\QCubed\Project\Application::Redirect('/?c=job&a=edit&id='.$_GET['id']); 
	}
	public function Remove(){
		if($this->objEntityJob->Id){
			$this->objEntityJob->delete();
			\QCubed\Project\Application::Redirect('/?c=job&a=edit&id='.$_GET['id']);
		}
	}
	private function Build() {
		
		$this->lstOwnerType						= new \QCubed\Project\Control\ListBox($this);			
		$this->lstOwnerType->addItem(tr('Mandator'), 'mandator');
		$this->lstOwnerType->addItem(tr('Counterparty'), 'counterparty');
		$this->lstOwnerType->SelectedValue		= $this->ownerType;
		
		$this->txtComment						= new \QCubed\Project\Control\TextBox($this);
		$this->txtComment->Placeholder					= tr('Comment');
		$this->txtComment->Required				= false;
		
		$this->txtReference						= new \QCubed\Project\Control\TextBox($this);
		$this->txtReference->Placeholder				= tr('Reference');
		$this->txtReference->Required			= false;
		
		$this->lstRolesType						= \JobRole::GetListBox($this);
		$this->lstRolesType->SelectionMode		= "Multiple";
				
		$this->btnEntitySelect					= \QCubed\Project\Control\Button::GetSelectButton($this, tr('Select Entity'));
		$this->btnEntitySelect->AddCssClass('col-md-12');

		$this->pnlEntity						= new Entity($this);
		$this->pnlEntity->Display				= false;
		$this->pnlEntity->Register('OnSave', 'EntitySaved');

		$this->modalEntity						= new \QCubed\Project\Jqui\Modal($this);
		$this->modalEntity->PANEL = $this->pnlEntity;
		$this->modalEntity->TITLE = tr('Entity');
		
		$this->lstSubcontractors				= new \QCubed\Project\Control\ListBox($this);
		$this->lstSubcontractors->ReadOnly		= true;
		$this->lstSubcontractors->AddItem(tr("No Subcontractors"), null);
		
		$this->btnSave							= \QCubed\Project\Control\Button::GetSaveButton($this);
		$this->btnSave->setCustomAttribute("disabled",true);
		
		$this->btnDelete						= \QCubed\Project\Control\Button::GetRemoveButton($this, sprintf(t('Are you SURE you want to DELETE this %s?'), t('Entity')));
		$this->btnDelete->setCustomAttribute("disabled",true);
	}

	protected function Select(){	
		$this->pnlEntity->Show($this->objEntityJob->Entity, $this->lstRolesType->SelectedValue);
		$this->modalEntity->Open();
	}
}

