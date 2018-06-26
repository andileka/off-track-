<?php

namespace QCubed\Project\Jqui;

class ChartJS extends \QCubed\Control\Panel{
	
	/**
	 *
	 * @var Panel
	 */
	public $pnlChart;
	
	public function __construct($objParentObject, $strControlId = null) {

		parent::__construct($objParentObject, $strControlId);
		$this->addCssFile(__VIRTUAL_DIRECTORY__."/project/assets/css/Chartjs.css");
		$this->addJavascriptFile(__VIRTUAL_DIRECTORY__."/project/assets/js/Chart.min.js");
		$this->addJavascriptFile(__VIRTUAL_DIRECTORY__."/project/assets/js/ChartJS.js");
		$this->strTemplate			= __TEMPLATES__ .  '/pages/charts.tpl.php';
		
		\QCubed\Project\Application::executeJavaScript("ChartJS.init('".$this->ControlId."')");
	}
	public function SetLabels($arrLabels){
		\QCubed\Project\Application::executeJavaScript("ChartJS.SetLabels('".json_encode($arrLabels)."')");
	}
	public function SetType($strType="bar"){	
		\QCubed\Project\Application::executeJavaScript("ChartJS.SetType('".$strType."')");
	}
	public function SetRandomDataSet($strType="bar", $arrData){
		$this->SetType($strType);
		$this->SetLabels($arrData['Labels']);
		\QCubed\Project\Application::executeJavaScript("ChartJS.SetColor('".$this->GenerateColorCode()."')");
		\QCubed\Project\Application::executeJavaScript("ChartJS.SetDataSet('".json_encode($arrData['DataSet'])."')");	
	}
	public function SetPieDataSet($strType="pie", $arrData){
		if(!isset($arrData['Labels'])) {
			return;
		}
		$this->SetType($strType);
		$this->SetLabels($arrData['Labels']);
		for($x=0;$x<count($arrData['DataSet']);$x++){
			$color[] = $this->GenerateColorCode();
		}
		
		\QCubed\Project\Application::executeJavaScript("ChartJS.SetLegend('false')");
		\QCubed\Project\Application::executeJavaScript("ChartJS.SetColor('".json_encode($color)."')");
		\QCubed\Project\Application::executeJavaScript("ChartJS.SetDataSet('".json_encode($arrData['DataSet'])."')");	
	}
	public function SetDataSet($strType="bar", $arrData){
		if(!isset($arrData[2])) {
			return;
		}
		$this->SetType($strType);
		$arrLabels = $arrData[2];
		
		$this->SetLabels($arrLabels);
		$arrDataSet = array(
				array(
					"label"					=> tr("Booked slots"),
					"data"					=> $arrData[0],
					"backgroundColor"		=> [$this->GenerateColorCode()],
					"borderWidth"			=> 2,
				),
				array(
						"label"					=> tr("Open slots"),
						"data"					=> $arrData[1],
						"backgroundColor"		=> $this->GenerateColorCode(),
						"borderWidth"			=> 2,
					),
			);
		\QCubed\Project\Application::executeJavaScript("ChartJS.SetDataSet('".json_encode($arrDataSet)."')");		
	}
	public function GenerateColorCode(){	
		return 'rgba(' . rand(0,255) . ','.rand(0, 255) .',' . rand(0, 155) . ',1)';
	}
	public function DrawStacked(){
		\QCubed\Project\Application::executeJavaScript("ChartJS.DrawStacked()");
	}
	public function Draw(){
		\QCubed\Project\Application::executeJavaScript("ChartJS.Draw()");
	}
	

	

}