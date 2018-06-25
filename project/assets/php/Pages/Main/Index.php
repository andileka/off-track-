<?php

namespace Hikify\Pages\Main;
use QQN;
use UserList;

class Index extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Project\Control\Button 
	 */
	public $btnTest;
	/**
	 *
	 * @var \QCubed\Project\Jqui\ChartJS 
	 */
	public $pnlChartJob;
	/**
	 *
	 * @var \JobList
	 */
	public $dgJobList;
	/**
	 *
	 * @var \QCubed\Project\Jqui\ChartJS 
	 */
	public $pnlChartAppointment;
	
	/**
	 *
	 * @var \QCubed\Project\Jqui\ChartJS 
	 */
	public $pnlChartJobType;
	
	/**
	 *
	 * @var UserList 
	 */
	public $lstUsers;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/main/index.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");
		$this->Build();
		
	}
	
	public function btnTest_Clicked() {
		$this->btnTest->RemoveCssClass("btn btn-danger");
		$this->btnTest->AddCssClass("btn btn-success");
	}
	
	private function Build() {
		$this->lstUsers	= new UserList($this);
		$this->lstUsers->CssClass = 'users_table';
		$this->lstUsers->createNodeColumn('hup', \QQN::User()->Email);
		$this->lstUsers->createPropertyColumn("FirstName", "FirstName");
		$this->lstUsers->createPropertyColumn("LastName", "LastName");
		
		$this->pnlChartJob					= new \QCubed\Project\Jqui\ChartJS($this);
		$this->pnlChartJob->Name			= tr("Chartview");
		$this->pnlChartJob->SetRandomDataSet("bar",$this::SetJobChartData());
		$this->pnlChartJob->setCssStyle("height", "40vh");
		$this->pnlChartJob->setCssStyle("width", "70vw");
		$this->pnlChartJob->DrawStacked();
		
		$this->pnlChartAppointment				= new \QCubed\Project\Jqui\ChartJS($this);
		$this->pnlChartAppointment->Name			= tr("Chartview");
		$this->pnlChartAppointment->SetRandomDataSet("bar",$this::SetAppointmentChartData());
		$this->pnlChartAppointment->setCssStyle("height", "40vh");
		$this->pnlChartAppointment->setCssStyle("width", "70vw");
		$this->pnlChartAppointment->DrawStacked();
		
		$this->pnlChartJobType				= new \QCubed\Project\Jqui\ChartJS($this);
		$this->pnlChartJobType->Name			= tr("Chartview");
		$this->pnlChartJobType->SetPieDataSet("doughnut",$this::SetTypeChartData());
		$this->pnlChartJobType->DrawStacked();
		
		
		$this->btnTest			= new \QCubed\Project\Control\Button($this);
		$this->btnTest->Text	= "woot";
		$this->btnTest->AddCssClass("btn btn-danger");
		$this->btnTest->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this,'btnTest_Clicked'));
		
	}
	protected function SetAppointmentChartData(){
		$months = array();
		foreach($this->GetMonthArray() as $intNumeric => $strmonth){
			$Data[] = rand(1,50);
			$months[] = $strmonth;
		}
		$arrData['Labels'] = $months;
		$arrData['DataSet'] = $Data;
		
		return $arrData;
	}
	
	protected function SetTypeChartData(){
		return [];
	}
	
	protected function SetJobChartData(){
		$months = array();
		foreach($this->GetMonthArray() as $intNumeric => $strmonth){
			$Data[] = rand(1,50);
			$months[] = $strmonth;
		}
		$arrData['Labels'] = $months;
		$arrData['DataSet'] = $Data;
		
		return $arrData;
	}
	
	protected function GetMonthArray(){
		return array(
			"01" => tr("January"),
			"02" => tr("February"),
			"03" => tr("March"),
			"04" => tr("April"),
			"05" => tr("Mei"),
			"06" => tr("June"),
			"07" => tr("July"),
			"08" => tr("August"),
			"09" => tr("September"),
			"10" => tr("October"),
			"11" => tr("November"),
			"12" => tr("December")
		);
	}
}
