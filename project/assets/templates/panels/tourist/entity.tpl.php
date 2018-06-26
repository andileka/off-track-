<div class="entityWrap">
	<?php if (isset($_CONTROL->txtSearch) && !$_CONTROL->txtSearch->Display): ?>
    <div class="row">
		<?= $_CONTROL->pnlNotification->RenderFormGroup(true, ['WrapperCssClass' => '+ col-sm-12']) ?>
    </div>
    <div class="legalSelect">
		<?= $_CONTROL->blnLegaltype->RenderFormGroup(); ?>
    </div>
    <div class="navtabs">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item active">
                <a onclick="showTabPane(event, '<?= $_CONTROL->strControlId ?>')" class="nav-link active" id="pills-general-tab" data-toggle="tab" href="#pills-general" role="tab" aria-controls="pills-home" aria-selected="true"><?= tr('General info') ?></a>
            </li>
            <li class="nav-item">
                <a onclick="showTabPane(event, '<?= $_CONTROL->strControlId ?>')" class="nav-link" id="pills-contact-tab" data-toggle="tab" href="#pills-contact" role="tab" aria-controls="pills-profile" aria-selected="false"><?= tr('Contact') ?></a>
            </li>
            <li class="nav-item">
                <a onclick="showTabPane(event, '<?= $_CONTROL->strControlId ?>')" class="nav-link" id="pills-address-tab" data-toggle="tab" href="#pills-address" role="tab" aria-controls="pills-contact" aria-selected="false"><?= tr('Address info') ?></a>
            </li>
        </ul>
    </div>

    <div class="tab-content no-padding" id="pills-tabContent">

    <div class="tab-pane fade show" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
    <div class="general-infocard card">
        <h3 class="subtitle"><?= tr('General info') ?></h3>
        <div class="form-group textWithIcon clearfix">
            <label><?= tr('Company number') ?></label>
            <div class="textboxWithList">
                <div class="listaddon"><?= $_CONTROL->lstCompanyCountry->Render(); ?></div>
                <div class="textField"><?= $_CONTROL->txtCompanyNumber->Render(); ?></div>
            </div>
			<?= $_CONTROL->btnCheckVies->Render(true, ['WrapperCssClass' => '+ addonIcon']); ?>
        </div>
        <div class="companyRating">
			<?= $_CONTROL->rtStars->RenderFormGroup(true, ['WrapperCssClass' => '+ rating']); ?>
			<?= $_CONTROL->txtCompanyName->RenderFormGroup(); ?>
        </div>
		<?= $_CONTROL->lstType->RenderFormGroup(); ?>
		<?= $_CONTROL->lstLang->RenderFormGroup(); ?>
		<?= $_CONTROL->txtCompanyType->RenderFormGroup(); ?>
		<?= $_CONTROL->lstSex->RenderFormGroup(); ?>
		<?= $_CONTROL->txtFirstname->RenderFormGroup(); ?>
		<?= $_CONTROL->txtLastname->RenderFormGroup(); ?>
		<?= $_CONTROL->txtProfession->RenderFormGroup(); ?>
    </div>
    </div>

    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
    <div class="contactcard card">
        <h3 class="subtitle"><?= tr('Contact') ?></h3>
        <div class="phoneFields clearfix">
            <label><?= tr('Phone') ?></label>
			<?= $_CONTROL->pnlPhone->Render(); ?>
			<?= $_CONTROL->btnAddfieldPhone->RenderFormGroup(); ?>
        </div>
        <div class="emailFields clearfix">
            <label><?= tr('Email') ?></label>
			<?= $_CONTROL->pnlEmail->Render(); ?>
			<?= $_CONTROL->btnAddfieldEmail->RenderFormGroup(); ?>
        </div>
    </div>
    </div>

    <div class="tab-pane fade" id="pills-address" role="tabpanel" aria-labelledby="pills-address-tab">
    <div class="addresscard card">
        <h3 class="subtitle"><?= tr('Address info') ?></h3>
        <div id="addressPanel">
            <div class="box">
                <div class="box-header with-border"
                     onclick="toggleCollapse('<?= $_CONTROL->strControlId ?>', 'homeAddress')">
                    <strong><?= tr("Home") ?></strong>
                    <div class="homeAddressTools box-tools pull-right">
                                    <span class="btn btn-box-tool"><i class="fa fa-plus"></i>
                                    </span>
                    </div>
                </div>
                <div class="homeAddress collapse box-body">
					<?= $_CONTROL->pnlHome->RenderFormGroup(); ?>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border"
                     onclick="toggleCollapse('<?= $_CONTROL->strControlId ?>', 'postalAddress')">
                    <strong><?= tr("Postal") ?></strong>
                    <div class="postalAddressTools box-tools pull-right">
                                    <span class="btn btn-box-tool"><i class="fa fa-plus"></i>
                                    </span>
                    </div>
                </div>
                <div class="postalAddress collapse box-body">
					<?= $_CONTROL->pnlPostal->RenderFormGroup(); ?>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border"
                     onclick="toggleCollapse('<?= $_CONTROL->strControlId ?>', 'visitingAddress')">
                    <strong><?=tr("Visiting") ?></strong>
                    <div class="visitingAddressTools box-tools pull-right">
                                    <span class="btn btn-box-tool"><i class="fa fa-plus"></i>
                                    </span>
                    </div>
                </div>
                <div class="visitingAddress collapse box-body">
					<?= $_CONTROL->pnlVisiting->RenderFormGroup(); ?>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border"
                     onclick="toggleCollapse('<?= $_CONTROL->strControlId ?>', 'invoiceAddress')">
                    <strong><?= tr("Invoice") ?></strong>
                    <div class="invoiceAddressTools box-tools pull-right">
                                    <span class="btn btn-box-tool"><i class="fa fa-plus"></i>
                                    </span>
                    </div>
                </div>
                <div class="invoiceAddress collapse box-body">
					<?= $_CONTROL->pnlInvoice->RenderFormGroup(); ?>
                </div>
            </div>
        </div>

		<?= $_CONTROL->pnlCustomfields->RenderFormGroup(); ?>
    </div>
    </div>

    </div>

	<?php else: ?>
        <div class="card">
           <?php $_CONTROL->txtSearch->RenderFormGroup(true, ['WrapperCssClass' => '+ search-field']); ?>
        </div>
	<?php endif; ?>
    <div>
       <?= $_CONTROL->btnSave->RenderFormGroup(); ?>
    </div>
</div>
