<?php

namespace Hikify\Pages\Maintenance;

class Customfieldedit extends \QCubed\Project\Control\Editor {
	/**
	 *
	 * @var \QCubed\Project\Control\Checkbox 
	 */
	public $ckActive;
	
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNameEn;

	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNameFr;

	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNameNl;

	/**
	 *
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnSave;

	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstType;

	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtPossibleValues;
	/**
	 *
	 * @var \QCubed\Project\Control\Checkbox
	 */
	public $ckRequired;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstContainer;

	/** @var \CustomFieldType */
	private $objCustomFieldType;

	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->strTemplate = __TEMPLATES__ . '/pages/maintenance/customfield-edit.tpl.php';
		$this->objCustomFieldType = new \CustomFieldType();
		$this->addCssFile("/project/assets/css/boolean-button.css");
		$this->Build();

		if (isset($_GET['id'])) {
			$objCustomFieldType = \CustomFieldType::loadById((int) $_GET['id']);
			$this->txtNameEn->Text = $objCustomFieldType->NameEn;
			$this->txtNameNl->Text = $objCustomFieldType->NameNl;
			$this->txtNameFr->Text = $objCustomFieldType->NameFr;
			$this->lstType->SelectedValue = $objCustomFieldType->Type;
			$this->lstContainer->SelectedValue = $objCustomFieldType->Container;
			$this->txtPossibleValues->Text = $objCustomFieldType->PossibleValues;
			$this->ckRequired->Checked	= ($objCustomFieldType->Required) ? true : false;
			$this->ckActive->Checked	= ($objCustomFieldType->Active) ? true : false;
			$this->objCustomFieldType = $objCustomFieldType;
		}
	}

	public function Save() {
		
		if (!$this->Validate()) {
			return;
		}

		if (!$this->objCustomFieldType) {
			$this->objCustomFieldType = new \CustomFieldType();
		}
		\QCubed\Project\Application::Log($this->objCustomFieldType->Id);
		$check = \CustomFieldType::QuerySingle(
						\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::Equal(\QQN::customFieldType()->NameNl, $this->txtNameNl->Text), 
										\QCubed\Query\QQ::Equal(\QQN::customFieldType()->NameEn, $this->txtNameEn->Text), 
										\QCubed\Query\QQ::Equal(\QQN::customFieldType()->NameFr, $this->txtNameFr->Text), 
										\QCubed\Query\QQ::NotEqual(\QQN::customFieldType()->Id,$this->objCustomFieldType->Id)
								)
				);
		\QCubed\Project\Application::Log(json_encode($check));
		
		if (!$check) {
			$this->objCustomFieldType->NameEn = $this->txtNameEn->Text;
			$this->objCustomFieldType->NameFr = $this->txtNameFr->Text;
			$this->objCustomFieldType->NameNl = $this->txtNameNl->Text;
			$this->objCustomFieldType->Type = $this->lstType->SelectedValue;
			$this->objCustomFieldType->PossibleValues = $this->txtPossibleValues->Text;
			$this->objCustomFieldType->Container = $this->lstContainer->SelectedValue;
			$this->objCustomFieldType->Required	= $this->ckRequired->Checked;
			$this->objCustomFieldType->Active	= $this->ckActive->Checked;
			$this->objCustomFieldType->Save();
			\QCubed\Project\Application::Redirect('/?c=maintenance&a=customfields');
			
		} else {
			$this->objForm->ShowAlert(tr('A customfield with the same name already exists.'));
		}
	}

	private function Build() {
		$this->txtNameEn = new \QCubed\Project\Control\TextBox($this);
		$this->txtNameEn->Name = tr('Name EN');
		$this->txtNameEn->Required = true;

		$this->txtNameFr = new \QCubed\Project\Control\TextBox($this);
		$this->txtNameFr->Name = tr('Name FR');
		$this->txtNameFr->Required = true;

		$this->txtNameNl = new \QCubed\Project\Control\TextBox($this);
		$this->txtNameNl->Name = tr('Name NL');
		$this->txtNameNl->Required = true;

		$this->txtPossibleValues = new \QCubed\Project\Control\TextBox($this);
		$this->txtPossibleValues->Name = tr('Possible values');
		$this->txtPossibleValues->Placeholder = tr("Add values commaseperated => ex. (listbox) Yes;No;Unknown");

		$this->lstType = new \QCubed\Project\Control\ListBox($this);
		$this->lstType->Name = tr("Type");
		$this->lstType->AddItem(tr("Text"), "text");
		$this->lstType->AddItem(tr("Number"), "number");
		$this->lstType->AddItem(tr("List"), "list");
		$this->lstType->AddItem(tr("Date"), "date");
		$this->lstType->AddItem(tr("Boolean"), "boolean");
		$this->lstType->AddItem(tr("Textarea"), "textarea");
		
		$this->ckRequired						= new \QCubed\Project\Jqui\Checkbox($this);
		$this->ckRequired->HtmlBefore			= "<label class='chk_select_label'>";
		$this->ckRequired->addWrapperCssClass("chk_select");
		$this->ckRequired->HtmlAfter				= "<span>".tr("Required")."</span></label>";
		
		$this->ckActive						= new \QCubed\Project\Jqui\Checkbox($this);
		
		$this->ckActive->HtmlBefore			= "<label class='chk_select_label'>";
		$this->ckActive->addWrapperCssClass("chk_select");
		$this->ckActive->HtmlAfter				= "<span>".tr("Active")."</span></label>";
		
		$this->lstContainer = new \QCubed\Project\Control\ListBox($this);
		$this->lstContainer->Name = tr("Container");
		$this->lstContainer->AddItem(tr("Job"), "job");
		$this->lstContainer->AddItem(tr("Entity"), "entity");
	//	$this->lstContainer->AddItem(tr("Entity job"), "entity_job");
		$this->lstContainer->AddItem(tr("Vehicle"), "vehicle");
		$this->lstContainer->AddItem(tr("Damage"), "damage");
		$this->lstContainer->AddItem(tr("Appointment"), "appointment");

		$this->btnSave = \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Field'));
	}

}
