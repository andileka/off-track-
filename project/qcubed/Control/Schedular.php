<?php
namespace QCubed\Project\Control;

	class Schedular extends \QCubed\Control\Panel {
		/* Schedular*/
		public $pnlCal;
		
		public function __construct($objParentObject) {
			
			parent::__construct($objParentObject);	
			$this->strTemplate = __TEMPLATES__ . '/pages/maintenance/schedular.tpl.php';
			$this->addCssFile("/project/assets/js/jqwidgets/styles/jqx.base.css");	
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxcore.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxbuttons.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxscrollbar.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxdata.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxdata.export.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxdate.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxscheduler.js');		
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxscheduler.api.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxdatetimeinput.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxmenu.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxcalendar.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxtooltip.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxwindow.js');		
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxcheckbox.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxlistbox.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxdropdownlist.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxnumberinput.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxradiobutton.js');
			$this->addJavascriptFile('/project/assets/js/jqwidgets/jqxinput.js');	
			$this->addJavascriptFile('/project/assets/js/schedular.js');
			
			\QCubed\Project\Application::executeJavaScript("scheduler.init('$this->ControlId')");
			
			$this->build();
			
		}
		public function SetClosingDays(){
			$this->setSource();
			\QCubed\Project\Application::executeJavaScript("scheduler.SetClosingDays()");
		}
		public function setSource(){
			\QCubed\Project\Application::executeJavaScript("scheduler.setSource()");
		}
		public function Draw() {
			$this->setSource();
			\QCubed\Project\Application::executeJavaScript("scheduler.setToday('".date('Y,m,d')."')");
			\QCubed\Project\Application::executeJavaScript("scheduler.DrawCalendar()");
			\QCubed\Project\Application::executeJavaScript("scheduler.getSelectedDates()");
			
			//\QCubed\Project\Application::Log(($arrTest));
		}
		
		private function build(){
			$this->pnlCal		= new \QCubed\Control\Panel($this,'scheduler');			
		}
		
	}