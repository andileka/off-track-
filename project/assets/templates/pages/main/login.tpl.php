<div class="login-box">
  <div class="login-logo">
    <h2 class="panel-title"><?= tr('Hikify Login'); ?></h2>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php if (isset($_CONTROL->msgLogoutSuccess)) { ?>
			<div class="alert alert-success"><?= $_CONTROL->msgLogoutSuccess->Render(); ?></div></p>

    <?php
			}

			$_CONTROL->txtEmail->RenderFormGroup();
			$_CONTROL->txtPassword->RenderFormGroup();
			$_CONTROL->btnLogin->Render(); 
			?>
	<div class="row" style="margin-top:15px;">
		<div class="col-md-12"
			<?php $_CONTROL->btnForgotPassword->Render(); ?><br>
		</div>
	</div>
  </div>
  <!-- /.login-box-body -->
</div>