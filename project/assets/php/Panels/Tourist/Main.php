<?php

namespace Hikify\Panels\Job;

use QCubed\Control\Panel;

class Main extends \QCubed\Control\Panel {

	/** @var \Hikify\Panels\Job\Detail */
	public $pnlDetail;
	/** @var \Hikify\Panels\Job\Vehicle */
	public $pnlM_Vehicle;
	/** @var \Hikify\Panels\Job\Entity */
	public $pnlM_Entities;
	/** @var \Hikify\Panels\Job\Damage */
	public $pnlM_Damage;
	/** @var \Hikify\Panels\Job\Vehicle */
	public $pnlC_Vehicle;
	/** @var \Hikify\Panels\Job\Entity */
	public $pnlC_Entities;
	/** @var \Hikify\Panels\Job\Damage */
	public $pnlC_Damage;
	/** @var \Hikify\Panels\Job\Appointment */
	public $pnlAppointment;
	/** @var \Hikify\Panels\Job\Workflow */
	public $pnlWorkflow;
	/** @var \Hikify\Panels\Job\Communication */
	public $pnlCommunication;
	/** @var \Hikify\Panels\Job\Estimates */
	public $pnlM_Estimates;
	/** @var \Hikify\Panels\Job\Estimates */
	public $pnlC_Estimates;
	/** @var \Hikify\Panels\Job\TotalLoss */
	public $pnlM_TotalLoss;
	/** @var \Hikify\Panels\Job\TotalLoss */
	public $pnlC_TotalLoss;
	/** @var \Hikify\Panels\Job\Document */
	public $pnlDocument;
	/** @var \QCubed\Control\Panel */
	public $pnlMandator;
	/** @var \QCubed\Control\Panel  */
	public $pnlAppointmentTitle;
	/** @var \QCubed\Control\Panel */
	public $pnlCounterparty;
	/** @var \QCubed\Project\Control\Button */
	public $btnSave;
	
	public $arrPanels = array(
		'pnlDetail',
		'pnlMandator',	
		'pnlM_Vehicle' , 
		'pnlM_Entities', 
		'pnlM_Damage', 
		'pnlM_TotalLoss',
		'pnlM_Estimates',
		'pnlCounterparty',	
		'pnlC_Vehicle' , 
		'pnlC_Entities', 
		'pnlC_Damage', 
		'pnlC_TotalLoss',
		'pnlAppointmentTitle', 
		'pnlAppointment', 
		'pnlWorkflow', 
		'pnlCommunication', 
		'pnlDocument'
	);
	
	/** @var \Job */
	private $objJob;
	private $Panels;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->strTemplate = __TEMPLATES__ . '/panels/job/main.tpl.php';
		$this->addCssFile('https://use.fontawesome.com/releases/v5.0.10/css/all.css');
		/* 
		 * CHECK IF JOB IS KNOWN 
		 * IF NOT SHOW ONLY JOB DETAILPANEL 
		 */
		(!isset($_GET['id'])) ? $this->arrPanels = array('pnlDetail') : /* do nothing */ '' ;
		$this->Build();
	}

	public function DetailSaved($objJob, $blnNewJob=false) {
			\QCubed\Project\Application::redirect('/?c=job&a=edit&id='.$objJob->Id); 	
	}
	public function VehicleCSaved($objVehicle) {
		if($objVehicle) {
			$this->objJob->VehicleIdCounterparty = $objVehicle->Id;
			$this->objJob->Save();//link the vehicle to the job if needed
			\QCubed\Project\Application::redirect('/?c=job&a=edit&id='.$this->objJob->Id); 	
		}
	}
	public function VehicleMSaved($objVehicle) {
		if($objVehicle) {
			$this->objJob->Vehicle = $objVehicle;
			$this->objJob->Save();//link the vehicle to the job if needed
			\QCubed\Project\Application::redirect('/?c=job&a=edit&id='.$this->objJob->Id); 	
		}

	}
	
	public function DamageMSaved($objDamage) {	
			$this->objJob->Damage = $objDamage;
			$this->objJob->Save();//link the vehicle to the job if needed
			\QCubed\Project\Application::redirect('/?c=job&a=edit&id='.$this->objJob->Id); 	
	}
	public function DamageCSaved($objDamage) {	
			$this->objJob->DamageIdCounterparty = $objDamage->Id;
			$this->objJob->Save();//link the vehicle to the job if needed
			\QCubed\Project\Application::redirect('/?c=job&a=edit&id='.$this->objJob->Id); 	
	}
	
	public function AppointmentSaved() {
		\QCubed\Project\Application::redirect('/?c=job&a=edit&id='.$this->objJob->Id); 	
	}
	public function CommunicationSaved(){
		\QCubed\Project\Application::redirect('/?c=job&a=edit&id='.$this->objJob->Id); 	
	}
		
	public function SetJob(\Job $objJob=null) {
		if($objJob) {
			
			$this->objJob = $objJob;
			$this->pnlDetail->SetTourist($this->objJob);
			
			$this->pnlM_Vehicle->SetVehicle($this->objJob->Vehicle);		
			$this->pnlM_Entities->SetJob($this->objJob, "mandator");
			$this->pnlM_Damage->SetDamage($this->objJob->Damage, $this->objJob->Vehicle);
			$this->pnlM_TotalLoss->SetTotalLoss($this->objJob->Damage);
			
			$this->pnlC_Vehicle->SetVehicle($this->objJob->VehicleIdCounterpartyObject);
			$this->pnlC_Entities->SetJob($this->objJob, "counterparty");
			$this->pnlC_Damage->SetDamage($this->objJob->DamageIdCounterpartyObject, $this->objJob->VehicleIdCounterpartyObject);
			$this->pnlC_TotalLoss->SetTotalLoss($this->objJob->DamageIdCounterpartyObject);
			
			$this->pnlWorkflow->SetJob($this->objJob);
			$this->pnlAppointment->SetJob($this->objJob);
			$this->pnlCommunication->SetJob($this->objJob);
			$this->pnlDocument->SetJob($this->objJob);
			$this->pnlMandator->Disable();
			$this->pnlAppointmentTitle->Disable();
			$this->pnlCounterparty->Disable();
			$this->IsTotalLoss($this->objJob);
			
			$this->pnlM_Estimates->SetEstimate($this->objJob);
			/* GET APPOINTMENTLIST */
			$arrAppointment = \Appointment::loadArrayByJobId($this->objJob->Id);
			\Hikify\Panels\Navigator::SetJobInfoInMenu($this->objJob, end($arrAppointment));
		} else {
			//create a new job
			$this->objJob			= new \Job();
			$this->pnlM_Vehicle->SetVehicle(new \Vehicle());
			$this->arrPanels = array('pnlDetail');
		}

		
	}
	public function IsTotalLoss(\Job $objJob){
		if(!$this->objJob->DamageId){
				$this->UnsetPanelArray('pnlM_TotalLoss');	
			}else{
				if($this->objJob->Damage->TotalLoss !== 'yes'){
					$this->UnsetPanelArray('pnlM_TotalLoss');
				}
			}
			
			if(!$this->objJob->DamageIdCounterparty){
				$this->UnsetPanelArray('pnlC_TotalLoss');
				
			}else{
				if($this->objJob->DamageIdCounterpartyObject->TotalLoss !== 'yes'){					
					$this->UnsetPanelArray('pnlC_TotalLoss');
				}
			}
	}
	
	public function UnsetPanelArray($strKey){
		unset($this->arrPanels[array_search($strKey, $this->arrPanels)]);
		unset($this->Panels[$strKey]);
	}

		
	private function Build() {
		$this->pnlDetail		= new Detail($this);
		
		$this->pnlMandator		= new Title($this,null, tr("Mandator"));
		
		$this->pnlAppointmentTitle		= new Title($this,null, tr("Planning / Handling"));
		
		$this->pnlM_Entities		= new Entityroles($this);
		$this->pnlM_Entities->Register('EntitySaved', 'EntityRoleSaved');
		
		$this->pnlM_Vehicle		= new Vehicle($this);
		$this->pnlM_Vehicle->Register('OnSave', 'VehicleMSaved');
		
		$this->pnlM_Damage		= new Damage($this);
		$this->pnlM_Damage->Register('OnSave', 'DamageMSaved');
		
		$this->pnlM_Estimates	= new Estimates($this);
		$this->pnlM_TotalLoss	= new TotalLoss($this);
		$this->pnlCounterparty	= new Title($this,null, tr("Counterparty"));
		
		$this->pnlC_Entities		= new Entityroles($this);
		$this->pnlC_Entities->Register('EntitySaved', 'EntityRoleSaved');
		
		$this->pnlC_Vehicle		= new Vehicle($this);
		$this->pnlC_Vehicle->Register('OnSave', 'VehicleCSaved');
		
		$this->pnlC_Damage		= new Damage($this);
		$this->pnlC_Damage->Register('OnSave', 'DamageCSaved');
		
		$this->pnlC_Estimates	= new Estimates($this);
		$this->pnlC_TotalLoss	= new TotalLoss($this);
		
		$this->pnlAppointment	= new Appointment($this);
		$this->pnlWorkflow		= new Workflow($this);
		$this->pnlCommunication	= new Communication($this);
		$this->pnlDocument		= new Document($this);
		$this->pnlDetail->Register('OnSave', 'DetailSaved');
		
		$this->pnlAppointment->Register('OnSave', 'AppointmentSaved');
		$this->pnlCommunication->Register('OnSave', 'CommunicationSaved');



	}

}
