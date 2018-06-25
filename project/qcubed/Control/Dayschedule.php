<?php
namespace QCubed\Project\Control;
/**
 * @property string $Title Description
 * @property string $Start e.g. 08:45
 * @property string $End e.g. 08:45
 */
	class Dayschedule extends \QCubed\Control\Panel {
		/**
		 *
		 * @var \QCubed\Control\Label 
		 */
		public $lblTitle;
		/**
		 *
		 * @var \QCubed\Project\Control\TextBox
		 */
		public $txtStart;
		/**
		 *
		 * @var \QCubed\Project\Control\TextBox
		 */
		public $txtEnd;
		
		
		public function __construct($objParentObject) {
			
			parent::__construct($objParentObject);	
			$this->build();
			$this->addJavascriptFile("/project/assets/js/dayschedule.js");
			
		}
		
		public function __get($strName) {
			switch($strName){
				case "Title":
					return $this->lblTitle->Text;
				case "Start":
					return $this->txtStart->Text;
				case "End":
					return $this->txtEnd->Text;
				default:
					return parent::__get($strName);
			}
			
		}
		
		public function __set($strName, $mixValue) {
			switch($strName){
				case "Title":
					$this->lblTitle->Text		= $mixValue;
				break;
				case "Start":
					$this->txtStart->Text		= $mixValue;
				break;
				case "End":
					$this->txtEnd->Text			= $mixValue;
				break;
				default:
					parent::__set($strName, $mixValue);
				break;
			}
			
		}
		protected function GetInnerHtml() {
			return	"<div class='row'>".
					$this->lblTitle->RenderFormGroup(false, ['WrapperCssClass' => '+ col-md-3']) 
					. $this->txtStart->RenderFormGroup(false, ['WrapperCssClass' => '+ col-md-3']) . 
					$this->txtEnd->RenderFormGroup(false, ['WrapperCssClass' => '+ col-md-3'])
					. "</div>";
		}
		
		private function build(){
			$this->lblTitle			= new \QCubed\Control\Label($this);
			$this->lblTitle->addWrapperCssClass("col-sm-12 col-md-3");
			$this->txtStart			= new \QCubed\Project\Control\TextBox($this);
			$this->txtStart->Name	= tr('Start');
			$this->txtStart->addWrapperCssClass("col-sm-6 col-md-3");
			\QCubed\Project\Application::executeJavaScript("
				$('#".$this->txtStart->ControlId."').timepicker({
						timeFormat: 'h:mm',
						interval: 30,
						minTime: '1:00',
						maxTime: '12:00',
						dynamic: false,
						dropdown: true,
						scrollbar: true,
						change: function(time) {
							var id = $(this).attr('id');
							var element = $(this), text, color;
							var timepicker = element.timepicker();
							var selectedTime = timepicker.selectedTime.toTimeString().substring(0,5);
							qc.formObjsModified['".$this->txtStart->ControlId."'] = true;
							console.log(id + selectedTime);
						}
				});
			");
			$this->txtEnd			= new \QCubed\Project\Control\TextBox($this);
			$this->txtEnd->Name		= tr('End');
			$this->txtEnd->addWrapperCssClass("col-sm-6 col-md-3");
			\QCubed\Project\Application::executeJavaScript("
				$('#".$this->txtEnd->ControlId."').timepicker({
						timeFormat: 'h:mm',
						interval: 30,
						minTime: '12:00',
						maxTime: '19:00',
						dynamic: false,
						dropdown: true,
						scrollbar: true,
						change: function(time) {
							var id = $(this).attr('id');
							var element = $(this), text, color;
							var timepicker = element.timepicker();
							var selectedTime = timepicker.selectedTime.toTimeString().substring(0,5);
							qc.formObjsModified['".$this->txtEnd->ControlId."'] = true;
							console.log(id + selectedTime);
						}
				});
			");
			$this->txtEnd->addCssClass("timepicker");
		}
		
	}