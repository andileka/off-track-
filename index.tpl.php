	<!doctype html>
<html>
    <head>
	<title>Hikify</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="<?= QCUBED_JQUERY_JS ?>"></script>
	<script src="<?= QCUBED_JQUI_JS ?>"></script>
	<link href="<?= __BOOTSTRAP_CSS__ ?>" rel="stylesheet">
	<link href="<?= __BOOTSTRAP_ADMINLTE_CSS__ ?>" rel="stylesheet">
	<link href="<?= __BOOTSTRAP_ADMINLTE_CSS_SKINS__ ?>" rel="stylesheet">
	<link href="<?= __BOOTSTRAP_ADMINLTE_FONTAWSOME__ ?>" rel="stylesheet">	
	<script src="<?= __BOOTSTRAP_JS__ ?>"></script>
	<script src="<?= __BOOTSTRAP_ADMINLTE_JS__ ?>"></script>
    <script src="<?= __GLOBALJS__ ?>"></script>
	<link href="<?= __STYLE_CSS__ ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="<?= $this->ClassBody ?>" style="padding-top: 0px;">
		<?php $this->renderBegin(); ?>
		<div class="wrapper" style="height: auto; min-height: 100%;">
			<?php if(isset($this->pnlMenu)) { $this->pnlMenu->Render(); } ?> 
			<div class="content-wrapper">
				<div class="col-md-12 col-md-1-push">
					<?php if(isset($this->pnlAlert)) { $this->pnlAlert->Render(); } ?>
				</div>
					<?php $this->pnlAppController->Render(); ?>
				
			</div>

		</div>
		<!-- ./wrapper -->
		<?php $this->renderEnd(); ?>
		<img src="project/assets/images/sharebuttons.png" width="150"/>
	</body>
</html>	