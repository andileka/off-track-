<div class="login-box booking-box">
  <div class="login-logo">
    <h1 class=""><?= tr('Book appointment'); ?></h1>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"></p>

    
	<div class="row" style="margin-top:15px;">
		<div class="col-md-10"><?= $_CONTROL->pnlBookingSlider->RenderFormGroup() ?></div>		
	</div>
	<div class="row" style="margin-top:15px;">
		<div class="col-md-1"><?= $_CONTROL->btnBack->RenderFormGroup() ?></div>
		<div class="col-md-1"><?= $_CONTROL->btnNext->RenderFormGroup() ?></div>
		<div class="col-md-1"><?= $_CONTROL->btnComplete->RenderFormGroup() ?></div>
	</div>
  </div>
  <!-- /.login-box-body -->
</div>