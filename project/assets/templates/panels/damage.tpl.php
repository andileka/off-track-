<div class="float50_50" style="margin-bottom: 20px">
	<div>
		<?php
			$_CONTROL->pnlAddress->RenderWithName();
			$_CONTROL->txtDate->RenderWithName();
			$_CONTROL->txtMileage->RenderWithName();
			$_CONTROL->txtOpponent->RenderWithName();
			$_CONTROL->txtThirdPartyCost->RenderWithName();
			$_CONTROL->lstCause->RenderWithName();
			$_CONTROL->lstFaultPercent->RenderWithName();
		?>
	</div><div style="padding: 0 0 15px 15px">
		<?php
			$_CONTROL->lblDamageForm->RenderWithName();
			$_CONTROL->lstPointOfContact->RenderWithName();
			$_CONTROL->pnlHitDirection->RenderWithName();
		?>
	</div>
</div>
<?php
$_CONTROL->btnDamageNote->Render();
?> <?php
$_CONTROL->btnRepairNote->Render();
?> <?php
$_CONTROL->btnOpponentRemarks->Render();

//render popup
$_CONTROL->popText->Render();

