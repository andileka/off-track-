<?php
namespace QCubed\Project\Control;
	/**
	 * @property-read \QCubed\QDateTime $DateTime Description
	 * @property-write int $FirstDay Description
	 * @property-write \QCubed\QDateTime $MinDate Description
	 * @property-write \QCubed\QDateTime $MaxDate Description
	 * @property-write \QCubed\QDateTime $DefaultDate
	 * @property-write string[] $DayNamesMin Description
	 * 
	 * 
	 * @property $Availabilities
	 * @property $CurrentYear
	 * @property $CurrentMonth
	 */
	class Datepickerwrapper extends \QCubed\Control\Panel{
		/**
		 *
		 * @var \QCubed\Project\Jqui\Datepicker
		 */
		public $txtDatepicker;
		/**
		*
		* @var \QCubed\Control\Proxy 
		*/
		public $objProxy;
		
		
		private $arrProperty;
		private $arrAvailabilities;
		
		private $intCurrentYear;
		private $intCurrentMonth;
		
		public function __construct($objParent, $strControlId = null) {
			parent::__construct($objParent, $strControlId);
			$this->AutoRenderChildren	= true;
			$this->intCurrentYear		= date('Y');
			$this->intCurrentMonth		= date('m');
			$this->AddJavascriptFile('/project/assets/js/qdatepickerwrapper.js');
			$this->addCssFile("/project/assets/css/datepicker.css");
			
		}		
		
		public function __get($strName) {
			switch($strName){
				case 'DateTime':
					return $this->txtDatepicker->DateTime;
					
				case 'CurrentYear':
					return $this->intCurrentYear;

				case 'CurrentMonth':
					return $this->intCurrentMonth;
					
		
				default:
					return parent::__get($strName);
			}
		}
		
		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'FirstDay':
				case 'DayNamesMin':
				case 'DateTime':
				case 'MinDate':
				case 'MaxDate':
				case 'DefaultDate':
					$this->arrProperty[$strName]	= $mixValue;
					break;
				case 'Availabilities':
					$this->arrAvailabilities		= $mixValue;
					break;
				case 'CurrentYear':
					$this->intCurrentYear			= (int)$mixValue;
					break;
				case 'CurrentMonth':
					$this->intCurrentMonth			= (int)$mixValue;
					break;
				default:
					parent::__set($strName, $mixValue);
					break;
			}
		}
		
		/**
		 * This will return which month is shown on screen. e.g. 2017-12-01 -> 2017-12-31
		 * @return \QCubed\QDateTime[]
		 */
		public function GetCurrentDateFork() {
			$dttStartOfMonth= new \QCubed\QDateTime($this->CurrentYear.'-'.$this->CurrentMonth.'-01');
			$dttEndOfMonth	= new \QCubed\QDateTime($dttStartOfMonth->format('Y-m-t'));
			return [$dttStartOfMonth, $dttEndOfMonth];
		}
		
		
		
		public function txtDatepicker_Selected() {
			$this->Trigger('OnSelect', [$this->txtDatepicker->DateTime]);
		}
		
		public function txtDatePicker_ChangedMonthYear($_, $__, $arrYearAndMonth) {
			unset($this->arrProperty['DateTime']);
			unset($this->arrProperty['DefaultDate']);
			
			$this->intCurrentYear	= $arrYearAndMonth['year'];
			$this->intCurrentMonth	= $arrYearAndMonth['month'];
			$this->DefaultDate		= $this->GetCurrentDateFork()[0];
			$this->Trigger('OnYearMonthChange',[$arrYearAndMonth['year'],$arrYearAndMonth['month']]);
			
		}
		
		
		public function Show() {
			//eerst availabilities doorsturen
			$json = json_encode($this->arrAvailabilities);
			\QCubed\Project\Application::executeJavaScript("appointment.setAvailability($json)",\QCubed\ApplicationBase::PRIORITY_HIGH);//needs to happen BEFORE the txtDate gets rendered
						
			$this->RemoveChildControls(true);
			
			$this->txtDatepicker					= new \QCubed\Project\Jqui\Datepicker($this);
			
			foreach($this->arrProperty as $prop=>$value) {
				\QCubed\Project\Application::Log($prop);
				$this->txtDatepicker->$prop = $value;
			}
			/*$this->txtDatepicker->OnBeforeShow		= 'appointment.addCustomInformation();';
			$this->txtDatepicker->OnChangeMonthYear	= 'appointment.addCustomInformation();';
			$this->txtDatepicker->OnSelect			= 'appointment.addCustomInformation();';*/
			$this->txtDatepicker->BeforeShowDay	= new \QCubed\Js\Closure('return ['
														. 'appointment.isDateAvailable(date), '// [0]: true/false indicating whether or not this date is selectable
														. 'appointment.getAvailabiltyCssClass(date),'//[1]: a CSS class name to add to the date's cell or "" for the default presentation
														. 'appointment.getAvailabilityDisplay(date)' //  [2]: an optional popup tooltip for this date
													. ']',array('date'));
			
			
			$this->txtDatepicker->ActionParameter	= new \QCubed\Js\Closure('return appointment.getYearAndMonth()');			
			$this->txtDatepicker->AddAction(new \QCubed\Jqui\Event\DatepickerSelect2()				, new \QCubed\Action\AjaxControl($this, 'txtDatepicker_Selected'));
			
			
			$this->objProxy						= new \QCubed\Control\Proxy($this);
			$this->objProxy->ActionParameter	= new \QCubed\Js\Closure('return appointment.getYearAndMonth()');
			$this->objProxy->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'txtDatePicker_ChangedMonthYear'));
			
			$this->txtDatepicker->OnChangeMonthYear = new \QCubed\Js\Closure('console.log("month changed " + month);appointment.setYearAndMonth(year,month);'.$this->objProxy->renderAsScript('Click'),array('year','month','inst'));
			
			
		}
		
		
		
		
		
		
		
		
		/**
		 * 
		 * @return array
		 */
		public static function GetDayNameArray() {
			return [
				'sunday'		=>tr('Sunday'),
				'monday'		=>tr('Monday'),
				'tuesday'		=>tr('Tuesday'),
				'wednesday'		=>tr('Wednesday'),
				'thursday'		=>tr('Thursday'),
				'friday'		=>tr('Friday'),
				'saturday'		=>tr('Saturday'),
			];
		}
	}
	
	class Datepickerwrapper_availability implements \JsonSerializable {
		public $isAvailable;
		public $ClassName;
		public $Display;
		
		public function __construct($blnIsAvailable, $strClassName, $strDisplay) {
			$this->isAvailable	= $blnIsAvailable;
			$this->ClassName	= $strClassName;
			$this->Display		= $strDisplay;
		}
		public function jsonSerialize() {
			return $this;
		}
	}