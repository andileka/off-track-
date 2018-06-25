<?php

namespace QCubed\Project\Control;

/**
 * Class Button
 *
 * Button class - You may modify it to contain your own modifications to the
 * Button throughout the framework.
 *
 * @package QCubed\Project\Control
 * @was QButton
 */
class Button extends \QCubed\Control\ButtonBase
{
    ///////////////////////////
    // Button Preferences
    ///////////////////////////

    // Feel free to specify global display preferences/defaults for all QButton controls
   protected $strCssClass = 'button btn';
//		protected $strFontNames = \QCubed\Html::FONT_FAMILY_VERDANA;
//		protected $strFontSize = '10px';
//		protected $blnFontBold = true;
		
		
		
		
		/**
		 * 
		 * @param \QCubed\Project\Control\ControlBase $objParent
		 * @param string $strText Text
		 * @param string $strClassname 
		 * @param string $strAction
		 * @return \QCubed\Project\Control\Button
		 */
		public static function GetFontAwesomeButton($objParent, $strText, $strClassname, $strAction=null, $strBtnClass='btn-primary'){			
			$btn				= new \QCubed\Project\Control\Button($objParent);
			$btn->Text			= '<i class="'.$strClassname.'" aria-hidden="true"></i> '. tr($strText);
			$btn->HtmlEntities	= false;
			$btn->CausesValidation = false;//we'll do this manually in Save
			$btn->AddCssClass($strBtnClass. ' btn-fa');
			$btn->addCssFile("/project/assets/css/button.css");
			$btn->addCssFile("https://use.fontawesome.com/releases/v5.0.6/css/all.css");
			//$btn->addJavascriptFile("https://use.fontawesome.com/releases/v5.0.6/js/all.js");
			
			if($strAction) {
				$btn->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($objParent, $strAction, 'default', false));
			}
			return $btn;
		}
		/**
		 * 
		 * @param \QCubed\Project\Control\ControlBase $objParent
		 * @param string $strText
		 * @return \QCubed\Project\Control\Button
		 */
		public static function GetSaveButton($objParent, $strText=null) {
			if(!$strText) {
				$strText = tr('Save');
			}
			return self::GetFontAwesomeButton($objParent, $strText, 'fas fa-save', 'Save', 'btn-success');
		}
		
		public static function GetSendButton($objParent, $strText=null) {
			if(!$strText) {
				$strText = tr('Send');
			}
			return self::GetFontAwesomeButton($objParent, $strText, 'paper-plane', 'Send', 'btn-success');
		}
		
		public static function GetSelectButton($objParent, $strText=null) {
			if(!$strText) {
				$strText = tr('Select');
			}
			return self::GetFontAwesomeButton($objParent, $strText, 'hand-pointer-o', 'Select');
		}
		
		public static function GetSearchButton($objParent, $strText=null) {
			if(!$strText) {
				$strText = tr('Search');
			}
			return self::GetFontAwesomeButton($objParent, $strText, 'search', 'Search');
		}
		
		/**
		 * 
		 * @param \QCubed\Project\Control\ControlBase $objParent
		 * @param string $strConfirmMessage
		 * @param string $strText
		 * @return \QCubed\Project\Control\Button
		 */
		public static function GetRemoveButton($objParent, $strConfirmMessage=null, $strText=null) {
			if(!$strText) {
				$strText = tr('Remove');
			}
			$btnRemove				= self::GetFontAwesomeButton($objParent, $strText, 'fas fa-trash-alt','','btn-danger');
			
			$btnRemove->addActionArray(new \QCubed\Event\Click(), 
					[
						new \QCubed\Action\Confirm($strConfirmMessage),
						new \QCubed\Action\AjaxControl($objParent, "Remove")
					]	
			);

//			
//			if($strConfirmMessage) {
//				$btnRemove->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Confirm($strConfirmMessage));
//			}
//			$btnRemove->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($objParent, 'Remove'));
			
			return $btnRemove;			
		}
}
