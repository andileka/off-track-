<?php

namespace Hikify\Pages\Maintenance;

class Controltype extends \QCubed\Control\Panel {

	public $lblFilter;
	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	public $pnlFilter;
	public $txtNumber;
	public $txtEntity;
	public $lstType;
	public $btnNew;
	/** @var \JobRole */
	public $lstJobRole;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/jobrole.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");	
		$this->addJavascriptFile("/project/assets/js/sortable.js");	
		$this->Build();
		
	}
	public function CorrectOrder(){
		$x = 1;
		foreach($this->lstJobRole->SelectedOrder as $order){
			$objJobRole = \JobRole::load($order);
			if(!$objJobRole) { return false;}
			$objJobRole->Step	= $x;
			$objJobRole->Save();
			$x++;
		}
	}
	public function btnedit_click($intSelectedJobRow){
		\QCubed\Project\Application::redirect('/?c=maintenance&a=jobroleedit&id='.$intSelectedJobRow); 	
	}
	
	private function Build() {		
		$this->pnlIndex							= new \QCubed\Control\Panel($this);
		$this->pnlIndex->Text					= tr('Jobrole page');
		
		$this->lblFilter						= new \QCubed\Control\Label($this);
		$this->lblFilter->Text					= tr('Filter');
		
		$this->pnlFilter						= self::ShowFilter();
		
		$this->btnNew							= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text						= tr('New Role');
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=controltypeedit'));
		
		$this->lstJobRole						= new \AppointmentTypeList($this);
		$this->lstJobRole->CssClass				= 'appointmenttype_table table';
		$this->lstJobRole->AddJavascriptRowAction('maintenance','controltypeedit');
		$this->lstJobRole->CreateColumns();
		
	}
	
	protected function ShowFilter(){
		$this->lblFilter				= new \QCubed\Control\Label($this);
		$this->lblFilter->Text			= tr('Filter');
		
		$this->txtNumber				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNumber->Placeholder	= tr('Number');
		
		$this->txtEntity				= new \QCubed\Project\Control\TextBox($this);
		$this->txtEntity->Placeholder	= tr('Entity');
		
		$this->lstType					= \EntityType::GetListBox($this);
		
	}
	
}



