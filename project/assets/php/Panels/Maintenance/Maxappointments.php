<?php
namespace Hikify\Panels\Maintenance;
/**
 * @property string $Title 
 * @property string $MondayStart
 * @property string $MondayEnd
 * @property string $TuesdayStart
 * @property string $TuesdayEnd
 * @property string $WednesdayStart
 * @property string $WednesdayEnd
 * @property string $ThursdayStart
 * @property string $ThursdayEnd
 * @property string $FridayEnd
 * @property string $FridayStart
 * @property string $SaturdayStart
 * @property string $SaturdayEnd
 * @property string $SundayStart
 * @property string $SundayEnd
 * @property array $arrAllDays 
 * 
 */
	class Maxappointments extends \QCubed\Control\Panel {
		/**
		 *
		 * @var Dayschedule
		 */
		public $pnlMonday;
		/**
		 *
		 * @var Dayschedule
		 */
		public $pnlTuesday;
		/**
		 *
		 * @var Dayschedule
		 */
		public $pnlWednesday;
		/**
		 *
		 * @var Dayschedule
		 */
		public $pnlThursday;
		/**
		 *
		 * @var Dayschedule
		 */
		public $pnlFriday;
		/**
		 *
		 * @var Dayschedule
		 */
		public $pnlSaturday;
		/**
		 *
		 * @var Dayschedule
		 */
		public $pnlSunday;
		/**
		 *
		 * @var \QCubed\Control\Label
		 */
		public $lblTitle;
		private $arrDaysOfWeek = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday', 'Sunday');
		public function __construct($objParentObject) {
			
			parent::__construct($objParentObject);	
			$this->build();
			
		}
		
		public function GetAllWeekDaysMaxAppointments(){
			$arrAllDays = array();
			foreach($this->arrDaysOfWeek as $day){	
				if($this->{'pnl'.$day}->Text !==""){
					$arrAllDays[$day]= $this->{'pnl'.$day}->Text;
				}
				
			}
			
			return $arrAllDays;
		}
		
		public function SetAllWeekDays($arrMaxAppointments){
			
			foreach($arrMaxAppointments as $day => $maxAppointments){
				$this->{"pnl".$day}->Text	=	$maxAppointments;
			}
		}
		
		public function __set($strName, $mixValue) {
			switch($strName){
				case "Title":
					$this->lblTitle->Text		= $mixValue;
				break;
				default:
					parent::__set($strName, $mixValue);
				break;
			}
			
		}
		
		protected function GetInnerHtml() {
			$str = 	$this->lblTitle->RenderFormGroup(false);
			foreach($this->arrDaysOfWeek as $day){
				$str.= $this->{'pnl'.$day}->RenderFormGroup(false, ['WrapperCssClass' => '+ col-md-12']);
			}
			
			return $str;
		}
		private function build(){
			$this->lblTitle				= new \QCubed\Control\Label($this);
			foreach($this->arrDaysOfWeek as $day){
				\QCubed\Project\Application::Log($day);
				$this->{'pnl'.$day}		= new \QCubed\Project\Control\TextBox($this);
				$this->{'pnl'.$day}->Name = tr($day);
			}
			
		}
		
	}