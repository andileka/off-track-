
<div class="row" style="margin-top:15px;">
	<div class="col-md-12">
		<div>
			<?= tr("Information about the appointment") ?>
		</div>
	</div>
	<div class="col-md-12 ListingAppointment">
		<h4 class="booking_car"><?= tr('Vehicle') ?></h4>
		<strong><?= tr("Type") ?>:</strong><?= $_CONTROL->lblType->RenderFormGroup() ?></br>
		<strong><?= tr("Make") ?>:</strong><?= $_CONTROL->lblMake->RenderFormGroup() ?></br>
		<strong><?= tr("Model")?>:</strong><?= $_CONTROL->lblModel->RenderFormGroup() ?></br>
		<strong><?= tr("Licenseplate") ?>:</strong><?= $_CONTROL->lblPlate->RenderFormGroup() ?></br>
		<strong><?= tr("Color") ?>:</strong><?= $_CONTROL->lblColor->RenderFormGroup() ?></br>
		<strong><?= tr("Vin") ?>:</strong><?= $_CONTROL->lblVin->RenderFormGroup() ?></br>
		<strong><?= tr("Date accident") ?>:</strong><?= $_CONTROL->lblDate->RenderFormGroup() ?></br>
	</div>
	<hr>
	<div class="col-md-12 ListingAppointment">
		<h4 class="booking_entity"><?= tr('Entity') ?></h4>
		<strong><?= tr("Entity") ?>:</strong><?= $_CONTROL->lblEntity->RenderFormGroup() ?></br>
		<strong><?= tr("Adress") ?>:</strong><?= $_CONTROL->lblAddress->RenderFormGroup() ?></br>
	</div>
	<div class="col-md-12 ListingAppointment">
		<h4 class="booking_appointment"><?= tr('Appointment') ?></h4>
		<strong><?= tr("Type") ?>:</strong><?= $_CONTROL->lblappointmentType->RenderFormGroup() ?></br>
		<strong><?= tr("Date") ?>:</strong><?= $_CONTROL->lblDateAppointment->RenderFormGroup() ?></br>
		<strong><?= tr("Date may change") ?>:</strong><?= $_CONTROL->lblDateMayChange->RenderFormGroup() ?></br>
	</div>
	<div class="col-md-12 ListingAppointment">
		<h4 class="booking_options"><?= tr('Options') ?></h4>
		<strong><?= tr("Selected options") ?>:</strong><?= $_CONTROL->lblOptions->RenderFormGroup() ?></br>
	</div>
</div>
