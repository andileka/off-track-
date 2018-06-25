<?php

namespace Hikify\Pages\Maintenance;

class Listing extends \QCubed\Control\Panel {

	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/listing.tpl.php';
		$this->addCssFile("/project/assets/css/maintenance.css");	
		\QCubed\Project\Application::executeJavaScript('
														var height = $(".wrapper").outerHeight();
														$(".content-wrapper").css("min-height",height+"px");
														$(".content-wrapper").css("height",height+"px")
													');
		$this->Build();
		
	}
	public function clicked_GotoPage(){
	\QCubed\Project\Application::Log("Click");
	}
	private function Build() {		
		$this->pnlIndex				= new \QCubed\Control\Panel($this);
		$this->pnlIndex->Text		= "<h3>".tr('Maintenance page')."</h3>";
		$this->pnlIndex	->AutoRenderChildren				= true;
		$this->pnlIndex->addCssClass("display-container");
		
		$this->ShowMenuBlocks();
		
		
	}
	
	public function ShowMenuBlocks(){
		$nav						= new \Hikify\Panels\Navigator($this);
		foreach($nav->GetNavItems()['maintenance'] as $key => $val){
			$blockItem = new \QCubed\Control\Panel($this->pnlIndex);
			$blockItem->addWrapperCssClass("menu_block_item_wrapper");
			$blockItem->HtmlBefore	= "<a href='index.php?c=maintenance&a=".$val[0]."'>";
			$blockItem->Text	= tr($key);
			$blockItem->addCssClass("menu_block_item block_".$key."");
			$blockItem->HtmlAfter	= "</a>";
		}
	}
	
}
