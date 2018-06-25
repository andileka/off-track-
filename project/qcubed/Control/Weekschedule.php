<?php
namespace QCubed\Project\Control;
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
	class Weekschedule extends \QCubed\Control\Panel {
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
			$this->addJavascriptFile("/project/assets/js/timepicker.min.js");
			$this->addCssFile("/project/assets/css/timepicker.min.css");
			$this->build();
			
			/*\QCubed\Project\Application::executeJavaScript("timeFormat: 'hh:mm p',
			// year, month, day and seconds are not important
			minTime: new Date(0, 0, 0, 8, 0, 0),
			maxTime: new Date(0, 0, 0, 15, 0, 0),
			// time entries start being generated at 6AM but the plugin 
			// shows only those within the [minTime, maxTime] interval
			startHour: 6,
			// the value of the first item in the dropdown, when the input
			// field is empty. This overrides the startHour and startMinute 
			// options
			startTime: new Date(0, 0, 0, 8, 20, 0),
			// items in the dropdown are separated by at interval minutes
			interval: 10,
			change: function(time) {
				var element = $(this), text, color;
				var timepicker = element.timepicker();

				color = '#' + (~~(Math.random() * 16777215)).toString(16);
				element.css({'background': color});
			}");*/
			
		}
		public function __get($strName) {
			switch($strName){
				case "Title":
					return $this->lblTitle->Text;
				default:
					$strDay = str_replace(array('Start','End'),'',$strName);
					if(isset ($this->arrDaysOfWeek[$strDay])){
						if(\QCubed\QString::EndsWith($strName, 'End')){
							return $this->{'pnl'.$strDay}->End;
						}
						if(\QCubed\QString::EndsWith($strName, 'Start')){
							return $this->{'pnl'.$strDay}->Start;
						}
					}
					return parent::__get($strName);
			}
			
		}
		public function GetAllWeekDays(){
			$arrAllDays = array();
			foreach($this->arrDaysOfWeek as $day){	
				if($this->{'pnl'.$day}->Start !==""){
					$arrAllDays[$day]['Start'] = new \QCubed\QDateTime($this->{'pnl'.$day}->Start.':00');
				}
				if($this->{'pnl'.$day}->End !==""){
					$arrAllDays[$day]['End'] = new \QCubed\QDateTime($this->{'pnl'.$day}->End.':00');
				}
				
				
			}
			
			return $arrAllDays;
		}
		
		public function SetAllWeekDays($weekDayHours){
			foreach($weekDayHours as $day => $hours){
				$this->{"pnl".ucfirst($day)}->Start	=	$hours['Start'];
				$this->{"pnl".ucfirst($day)}->End	=	$hours['End'];
			}
		}
		
		public function __set($strName, $mixValue) {
			switch($strName){
				case "Title":
					$this->lblTitle->Text		= $mixValue;
				break;
				default:
					$strDay = str_replace(array('Start','End'),'',$strName);
					if(isset ($this->arrDaysOfWeek[$strDay])){
						if(\QCubed\QString::EndsWith($strName, 'End')){
							return $this->{'pnl'.$strDay}->End		= $mixValue;
						}
						if(\QCubed\QString::EndsWith($strName, 'Start')){
							return $this->{'pnl'.$strDay}->Start	= $mixValue;
						}
					}
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
				$this->{'pnl'.$day}		= new Dayschedule($this);
				$this->{'pnl'.$day}->Title = tr($day);
			}
			
		}
		
	}