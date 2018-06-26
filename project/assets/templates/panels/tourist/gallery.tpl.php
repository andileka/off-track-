	<?php
	
	foreach($_CONTROL->arrImages as $strControlId => $objs)  { 
		if($_CONTROL->blnCheckable) { ?>
			<div class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
				<div class="image-checkbox">
				<?php
					$objs['image']->Render();
				?>
				</div>
			</div>
  <?php } else { 
			echo '<a href="'.$objs['image']->ImageUrl.'" data-toggle="lightbox" data-type="image">';
			echo '<div class="wrapper-img-responsive col-md-1">';
			echo $objs['image']->getControlHtml(); 
			echo '<i class="fas fa-search fa-2x"></i>';
			echo '</div>';
			echo '</a>';
		} 		 
	} ?>	

