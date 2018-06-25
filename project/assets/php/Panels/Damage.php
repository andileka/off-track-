<?php

/**
 * @author matthias
 * @version 03-12-2013
 *
 * @package Albatros
 * @subpackage Panels
 *
 * @property Damage $Damage
 * @property int $DamageId
 * @property bool $SaveButton
 * @property bool $ClearButton
 */
class DamagePanel extends \QCubed\Control\Panel {
	const LEFT_COLUMN_WIDTH				= 170;
	const RIGHT_COLUMN_WIDTH			= 170;

	protected $arrRightColumnControls	= array('Point Of Contact', 'Damage Form');
	protected $arrLeftColumnControls	= array('Damage Date', 'Mileage', 'Opponent Cost', 'Place', 'Opponent', 'Fault', 'Cause');

	/** @var Damage */
	protected $objDamage;

	protected $blnSaveButton			= false;
	protected $blnClearButton			= false;

	public $txtDate;
	public $txtOpponent;
	public $txtMileage;
	public $txtThirdPartyCost;

	public $lstCause;
	public $lstPointOfContact; // aangrijppunt
	public $lstFaultPercent;

	/** @var QDocumentLabel */
	public $lblDamageForm;

	public $pnlHitDirection; // stootrichting
	public $pnlContact;
	public $pnlAddress;

	public $btnEvents;
	public $btnSave;
	public $btnClear;

	public $btnRepairNote;
	public $btnDamageNote;
	public $btnOpponentRemarks;

	public $popText;

	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->BuildControls();
		$this->AddCssClass('data_panel');

		$this->strTemplate = __TEMPLATES__ . '/panels/damage.tpl.php';
	}

	private function BuildControls() {
		$this->txtDate						= new \QCubed\Control\Calendar($this, $this->strControlId.'Date');
		$this->txtDate->Name				= 'Damage Date';
		$this->txtDate->Maximum				= \QCubed\QDateTime::NOW;

		$this->txtMileage					= new \QCubed\Control\IntegerTextBox($this, $this->strControlId.'Mileage');
		$this->txtMileage->Name				= 'Mileage';
		$this->txtMileage->Minimum			= 0;

		$this->txtThirdPartyCost			= new \QCubed\Control\FloatTextBox($this, $this->strControlId.'ThirdPartyCost');
		$this->txtThirdPartyCost->Name		= 'Opponent Cost';
		$this->txtThirdPartyCost->Minimum	= 0;

		$this->lstCause						= Damage::GetCauseListBox($this, $this->strControlId.'Cause');
		$this->lstFaultPercent				= Damage::GetFaultListBox($this, $this->strControlId.'FaultPercent');
		$this->lstPointOfContact			= Damage::GetPointOfContactListBox($this, $this->strControlId.'PointOfContact');

		$this->lblDamageForm				= new QDocumentLabel($this,$this->strControlId.'DamageForm');
		$this->lblDamageForm->Name			= 'Damage Form';
		$this->lblDamageForm->Removable		= Usergroup::In(Usergroup::MASTER, Usergroup::DEV);
		$this->lblDamageForm->OnUpload		= 'SetDamageFormDocument';
		$this->lblDamageForm->OnRemove		= 'SetDamageFormDocument';

		$this->pnlHitDirection				= Damage::GetHitDirectionClickMap($this, $this->strControlId.'HitDirection', null, 'SetHitDirection');

		$this->pnlAddress					= new QEditorLabel($this, $this->strControlId.'Address');
		$this->pnlAddress->Editor			= new AddressEditor($this->pnlAddress);
		$this->pnlAddress->Name				= 'Place';
		$this->pnlAddress->Strict			= false;
		$this->pnlAddress->Callback			= 'SetAddress';

		$this->txtOpponent					= new \QCubed\Project\Control\TextBox($this,$this->strControlId.'Opponent');
		$this->txtOpponent->Name			= 'Opponent';

		/* Permissions */
		if(Usergroup::NotIn(Usergroup::MASTER, Usergroup::OWNER, Usergroup::DEV) && !(Usergroup::IsBoth(Usergroup::EXPERT, Usergroup::REPAIRER))){
//			$this->lblDamageForm->Enabled		= false;
//			$this->pnlHitDirection->Enabled		= false;
			\QCubed\Project\Control\ControlBase::MakeReadOnly($this->txtDate);
			\QCubed\Project\Control\ControlBase::MakeReadOnly($this->pnlAddress);
			\QCubed\Project\Control\ControlBase::MakeReadOnly($this->txtOpponent);
//			\QCubed\Project\Control\ControlBase::MakeReadOnly($this->txtThirdPartyCost);
//			\QCubed\Project\Control\ControlBase::MakeReadOnly($this->lstCause);
//			\QCubed\Project\Control\ControlBase::MakeReadOnly($this->lstFaultPercent);
//			\QCubed\Project\Control\ControlBase::MakeReadOnly($this->lstPointOfContact);

			if(Usergroup::IsNot(Usergroup::REPAIRER)){
				\QCubed\Project\Control\ControlBase::MakeReadOnly($this->txtMileage);
			}

			if(Usergroup::In(Usergroup::SENTBY, Usergroup::INSPARTY)){
				$this->lblDamageForm->Enabled		= false;
				$this->pnlHitDirection->Enabled		= false;
				\QCubed\Project\Control\ControlBase::MakeReadOnly($this->txtThirdPartyCost);
				\QCubed\Project\Control\ControlBase::MakeReadOnly($this->lstCause);
				\QCubed\Project\Control\ControlBase::MakeReadOnly($this->lstFaultPercent);
				\QCubed\Project\Control\ControlBase::MakeReadOnly($this->lstPointOfContact);
			}
		}

		$this->popText						= new TextPopup($this);
		$this->popText->Callback			= 'SaveText';

		/* buttons */
		$this->btnOpponentRemarks			= new \QCubed\Project\Control\Button($this,$this->strControlId.'OpponentRemarks');
		$this->btnOpponentRemarks->Text		= t('Opponent Note');
		$this->btnOpponentRemarks->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this,'OpenOpponentNote'));

		$this->btnRepairNote				= new \QCubed\Project\Control\Button($this,$this->strControlId.'RepairNote');
		$this->btnRepairNote->Text			= t('Repair Note');
		$this->btnRepairNote->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this,'OpenRepairNote'));

		$this->btnDamageNote				= new \QCubed\Project\Control\Button($this,$this->strControlId.'DamageNote');
		$this->btnDamageNote->Text			= t('Damage Note');
		$this->btnDamageNote->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this,'OpenDamageNote'));

		$this->SetWidths();
	}

	private function SetWidths(){
		foreach($this->GetChildControls() as $control){
			if(!$control->Name){
				continue;
			}
			if(in_array($control->Name, $this->arrRightColumnControls)){
				$control->Width = self::RIGHT_COLUMN_WIDTH;
			} elseif(in_array($control->Name, $this->arrLeftColumnControls)){
				$control->Width = self::LEFT_COLUMN_WIDTH;
			}
		}
	}

	public function SetDamageFormDocument(Document $document = null){
		if($document){
			$this->objDamage->DamageForm	= $document;
		} else {
			$this->objDamage->DamageForm	= null;
		}
		$this->objDamage->SaveDamageForm();
	}

	public function SetHitDirection(){
		$this->objDamage->HitDirection		= $this->pnlHitDirection->SelectedValue ?: '';
		$this->objDamage->SaveHitDirection();
	}

	/**
	 * callback function for AddressEditor
	 * @see AddressEditor::Save()
	 * @param Address $address
	 */
	public function SetAddress(Address $address = null) {
		$this->Damage->Address		= $address;
		$this->Save();
	}

	public function OpenRepairNote() {
		$this->popText->Object		= $this->Damage->RepairNote;
		$this->popText->Type		= Text::REPAIR_NOTE;
		$this->popText->Enabled		= Usergroup::In(Usergroup::MASTER, Usergroup::REPAIRER, Usergroup::DEV);
		$this->popText->Open();
	}

	public function OpenOpponentNote() {
		$this->popText->Object		= $this->Damage->OpponentRemarks;
		$this->popText->Type		= Text::REMARKS;
		$this->popText->Enabled		= Usergroup::In(Usergroup::MASTER, Usergroup::OWNER, Usergroup::DEV) || Usergroup::IsBoth(Usergroup::EXPERT, Usergroup::REPAIRER);
		$this->popText->Open();
	}

	public function OpenDamageNote() {
		$this->popText->Object		= $this->Damage->DamageNote;
		$this->popText->Type		= Text::DAMAGE_NOTE;
		$this->popText->Enabled		= Usergroup::In(Usergroup::MASTER, Usergroup::OWNER, Usergroup::DEV) || Usergroup::IsBoth(Usergroup::EXPERT, Usergroup::REPAIRER);
		$this->popText->Open();
	}

	/**
	 * callback function for TextPopup
	 * @see TextPopup::Save()
	 */
	public function SaveText(Text $text = null) {
		if($this->popText->Type == Text::REPAIR_NOTE) {
			$this->Damage->RepairNoteId			= $text ? $text->Id : null;
			$this->btnRepairNote->FontBold		= (bool) $this->Damage->RepairNoteId;
		} elseif ($this->popText->Type == Text::DAMAGE_NOTE) {
			$this->Damage->DamageNoteId			= $text ? $text->Id : null;
			$this->btnDamageNote->FontBold		= (bool) $this->Damage->DamageNoteId;
		} else {
			$this->Damage->OpponentRemarksId	= $text ? $text->Id : null;
			$this->btnOpponentRemarks->FontBold	= (bool) $this->Damage->OpponentRemarksId;
		}

		if($this->objDamage->Id){
			$this->objDamage->Save();
		}
	}

	public function fillFields() {
		if(!$this->objDamage){
			$this->objDamage = new Damage();
		}

		$this->txtDate->DateTime				= $this->objDamage->Date;
		$this->txtMileage->Text					= $this->objDamage->Mileage;
		$this->txtOpponent->Text				= $this->objDamage->Opponent;
		$this->txtThirdPartyCost->Text			= $this->objDamage->ThirdPartyCost;

		$this->lstCause->SelectedValue			= $this->objDamage->Cause;
		$this->lstFaultPercent->SelectedValue	= $this->objDamage->Fault;
		$this->lstPointOfContact->SelectedValue	= $this->objDamage->PointOfContact;

		$this->lblDamageForm->Document			= $this->objDamage->DamageForm;

		$this->pnlHitDirection->SelectedValue	= $this->objDamage->HitDirection;

		$this->pnlAddress->Editor->Address		= $this->objDamage->Address;

		$this->btnRepairNote->FontBold			= (bool) $this->objDamage->RepairNoteId;
		$this->btnDamageNote->FontBold			= (bool) $this->objDamage->DamageNoteId;
		$this->btnOpponentRemarks->FontBold		= (bool) $this->objDamage->OpponentRemarksId;
	}

	/**
	 * Save the panel and return the damage id
	 * @return int
	 */
	public function Save(){
		if(Usergroup::In(Usergroup::REPAIRER, Usergroup::MASTER, Usergroup::OWNER, Usergroup::DEV)){
			if(!($this->txtDate->Validate())){
				\QCubed\Project\Application::displayAlert($this->txtDate->ValidationError);
				return false;
			}
			if(!$this->objDamage){
				$this->objDamage = new Damage();
			}

			$this->objDamage->Date					= $this->txtDate->DateTime;
			$this->objDamage->Mileage				= $this->txtMileage->Text;
			$this->objDamage->Opponent				= $this->txtOpponent->Text;
			$this->objDamage->ThirdPartyCost		= $this->txtThirdPartyCost->Text;

			$this->objDamage->Cause					= $this->lstCause->SelectedValue;
			$this->objDamage->Fault					= $this->lstFaultPercent->SelectedValue;
			$this->objDamage->PointOfContact		= $this->lstPointOfContact->SelectedValue;
			$this->objDamage->HitDirection			= $this->pnlHitDirection->SelectedValue ? $this->pnlHitDirection->SelectedValue : '';

			try {
				$this->objDamage->Save();
			} catch(\QCubed\Database\Exception\OptimisticLocking $e){
				\QCubed\Project\Application::displayAlert('Another session has modified %s since you opened it. You will have to redo your changes.', t('this panel'));
				$this->objDamage->Reload();
				$this->fillFields();
				return false;
			}

			return $this->objDamage->Id;
		}
	}

	public function Clear(){

	}

	public function __get($name) {
		switch ($name) {
			case 'Damage'		:
				if(!$this->objDamage){
					$this->objDamage = new Damage();
				}
				return $this->objDamage;
			case 'DamageId'		: return $this->objDamage ? $this->objDamage->Id : null;

			default:
				try {
					return parent::__get($name);
				} catch (\QCubed\Exception\Caller $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}

	public function __set($name, $value) {
		switch ($name) {
			case 'Damage' :
				if($value instanceof Damage){
					$this->objDamage	= $value;
					$this->fillFields();
				}
				break;
			case 'DamageId':
					$this->objDamage = Damage::LoadById($value,
						\QCubed\Query\QQ::Clause(
							\QCubed\Query\QQ::Expand(QQN::Damage()->Opponent)
						));
					$this->fillFields();
				break;

			case 'SaveButton' :
				$this->blnSaveButton = (bool) $value;
				$this->SetButtons();
				break;

			case 'ClearButton' :
				$this->blnClearButton = (bool) $value;
				$this->SetButtons();
				break;

			default:
				try {
					return (parent::__set($name, $value));
				} catch (\QCubed\Exception\Caller $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}
}