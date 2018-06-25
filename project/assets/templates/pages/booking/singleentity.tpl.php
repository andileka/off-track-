
		<div class="col-md-4" style="min-height:800px;">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
				<span></span>
				<h3 class="profile-username text-center"><?= $_CONTROL->lblEntity->RenderFormGroup() ?></h3>
              <p><?= $_CONTROL->txtTypeId->RenderFormGroup() ?></p>

              <ul class="list-group">
				<li class="list-group-item">
                  <?= $_CONTROL->blnLegaltype->RenderFormGroup() ?>
                </li>
                <li class="list-group-item privateField">
                  <?= $_CONTROL->txtFirstname->RenderFormGroup() ?>
                </li>
                <li class="list-group-item privateField">
                  <?= $_CONTROL->txtLastname->RenderFormGroup() ?>
                </li>
                <li class="list-group-item companyField">
                  <?= $_CONTROL->txtName->RenderFormGroup() ?>
                </li>
				<li class="list-group-item companyField">
                  <?= $_CONTROL->txtCompanyNumber->RenderFormGroup() ?>
                </li>
                <li class="list-group-item">
                  <?= $_CONTROL->txtStreet->RenderFormGroup() ?>
                </li>
                <li class="list-group-item">
                  <?= $_CONTROL->txtNumber->RenderFormGroup() ?>
                </li>
                <li class="list-group-item">
					<?= $_CONTROL->lstCountry->RenderFormGroup() ?>
                </li>
                <li class="list-group-item">
                  <?= $_CONTROL->txtCity->RenderFormGroup() ?>
                </li>
				<li class="list-group-item">
                  <?= $_CONTROL->txtEmail->RenderFormGroup() ?>
                </li>
				<li class="list-group-item">
                  <?= $_CONTROL->txtPhone->RenderFormGroup() ?>
                </li>
              </ul>

              <?= $_CONTROL->chkSelect->RenderFormGroup() ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
        </div>
