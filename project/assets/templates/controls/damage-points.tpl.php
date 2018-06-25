<!-- Damagepoints screen  -->
<div class="damagepointsContainer">

        <div class="checkboxContainer">
            <div class="checkboxWithLabel"><?= $_CONTROL->btnDamage10->RenderFormGroup() ?></div>
            <div class="checkboxWithLabel"><?= $_CONTROL->btnDamage11->RenderFormGroup() ?></div>
            <div class="checkboxWithLabel"><?= $_CONTROL->btnDamage12->RenderFormGroup() ?></div>
            <div class="checkboxWithLabel"><?= $_CONTROL->btnDamage13->RenderFormGroup() ?></div>
            <div class="checkboxWithLabel"><?= $_CONTROL->btnDamage14->RenderFormGroup() ?></div>
        </div>
	<div class="clearfix">
		<div class="col-sm-12 col-md-5 car_wrapper">
			<div class="row">
				<div class='col-xs-1 col-sm-1 border'><?= $_CONTROL->btnDamage1->RenderFormGroup() ?></div>
				<div class='col-xs-3 col-sm-3'>
					<div class="row">
						<div class="col-xs-12 col-sm-12 border"><?= $_CONTROL->btnDamage2->RenderFormGroup() ?></div>
						<div class="col-xs-12 col-sm-12 car_block_2_disabled"></div>
						<div class="col-xs-12 col-sm-12 border"><?= $_CONTROL->btnDamage6->RenderFormGroup() ?></div>
					</div>
				</div>
				<div class='col-xs-3 col-sm-3'>
					<div class="row">
						<div class="col-xs-12 col-sm-12 border"><?= $_CONTROL->btnDamage3->RenderFormGroup() ?></div>
						<div class="col-xs-12 col-sm-12"><?= $_CONTROL->btnDamage9->RenderFormGroup() ?></div>
						<div class="col-xs-12 col-sm-12 border"><?= $_CONTROL->btnDamage7->RenderFormGroup() ?></div>
					</div>
				</div>
				<div class='col-xs-3 col-sm-3'>
					<div class="row">
						<div class="col-xs-12 col-sm-12 border"><?= $_CONTROL->btnDamage4->RenderFormGroup() ?></div>
						<div class="col-xs-12 col-sm-12 car_block_2_disabled"></div>
						<div class="col-xs-12 col-sm-12 border"><?= $_CONTROL->btnDamage8->RenderFormGroup() ?></div>
					</div>
				</div>
				<div class='col-xs-1 col-sm-1 car_block border'><?= $_CONTROL->btnDamage5->RenderFormGroup() ?></div>
			</div>
		</div>
	</div>
</div>