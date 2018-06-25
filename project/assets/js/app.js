window.togglePanel = function(panel){
    if(!$(panel).hasClass('disable')){
        $('.panel-collapse:not(#' + panel.id + ')').collapse('hide');
        $('.box:not(#' + panel.id  + 'Wrap) .box-tools .icon').removeClass('fa-minus');
        $('.box:not(#' + panel.id  + 'Wrap) .box-tools .icon').addClass('fa-plus');
        $('#' + panel.id + 'Wrap .box-tools .icon').toggleClass('fa-minus');
        $(panel).collapse('toggle');
    }
};
window.toggleCollapse = function(parenId, collapseableId){
	var pnlTarget = document.querySelector('#' + parenId + ' .' + collapseableId);
	$(pnlTarget).collapse('toggle');
	$('#' + parenId + ' .' + collapseableId + 'Tools .fa').toggleClass('fa-plus');
    $('#' + parenId + ' .' + collapseableId + 'Tools .fa').toggleClass('fa-minus');
};
window.showTabPane = function(event, parentId){
    event.preventDefault();
    var tabId = $(event.target).attr('href');
    var tabpane = $('#' + parentId).find(tabId);
    $('#' + parentId + ' .tab-pane').removeClass('show', 0.2);
    tabpane.addClass('show', 0.2);
};