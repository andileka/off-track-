<header class="main-header">
<!-- Logo -->
<a href="index.php" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Off Track</b></span>
</a>
<style>
	.selectpicker{
		width:100%;
		background: transparent;
		color: #FFF !important;
		padding: 5px;
		border: #3c8dbc !important;
	}
</style>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	<span class="sr-only">Toggle navigation</span>
  </a>
  <div class="navbar-custom-menu navbar-left">
	<div class="navbar-collapse collapse">		
		<?= implode("", $_CONTROL->subNav) ?>
		
		<!-- logout all the way to the right -->
	</div>
  </div>
</nav>
</header>
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar" style="height: auto;">
    <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header"><?= strtoupper(tr('Help')) ?></li>
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fas fa-life-ring"></i> <span>Help</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?= implode("", $_CONTROL->itemsRight) ?>
          </ul>
        </li>
        <li class="header"><?= strtoupper(tr('Main')) ?></li>

            <?= implode("", $_CONTROL->itemsLeft) ?>
   
		<li></li>

	</ul>
	<ul class="sidebar-menu tree" data-widget="tree">
		<li class="header"><?= strtoupper(tr('Language')) ?></li>
		<li>
			<?= $_CONTROL->lstLanguage->Render() ?>
		</li>
	</ul>
	<ul class="sidebar-menu tree" data-widget="tree">
		<li class="header"><?= strtoupper(tr('Leave')) ?></li>
		<li><a href="index.php?c=main&a=logout" onclick="return confirm('<?= tr('Are you sure you want to log out?') ?>')"><i class="fas fa-power-off"></i> <?= tr('Logout') ?></a></li>				
		 <li style="width:25px"><a href="#"><?php $_CONTROL->icoWait->Render() ?></a></li>
	</ul>
</section>
<!-- /.sidebar -->
    <footer class="footer-nav">
        <div class="">
            <b><?= tr("Version") ?></b> <?= date('Ym')?>
        </div>
        <strong>Copyright ©  <?= date('Y')?></strong>
    </footer>
</aside>
<script>
	jQuery( document ).ready(function() {
		jQuery('.dropdown-toggle').dropdown();
	});
</script>

