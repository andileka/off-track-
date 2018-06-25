var roundbutton = function () {
	
	var SelectedDirections	= [];
	var index				= "";
	var id					= "";
	var controlId			= "";

	return {
		init: function (_id) {
			id = _id;
		},
		addItemToArray: function(direction, _id){
			SelectedDirections[_id] = direction;
			$('#'+controlId).attr("checked","true");
			$("#"+ _id+" .circle_part").find('[checked="checked"]').css("background","rgba(255,0,0,0)");
			$("#"+ _id+" .circle_part").find('[checked="checked"]').css("color","#000");
			$('#'+controlId).css("background","rgba(255,0,0,0.5)");
			$('#'+controlId).css("color","#FFF");
		},
		ClearZones: function(){
			SelectedDirections		= "";			
			$(".circle_part").find('[checked="checked"]').removeAttr('style');
			$(".circle_part").find('[checked="checked"]').removeAttr("checked");
		},
		SetSelectedItem: function(direction,_id){
			if(direction){
				$("#"+ _id+" .circle_part").find('[direction='+direction+']').attr("checked","true");
				$("#"+ _id+" .circle_part").find('[direction='+direction+']').css("background","rgba(255,0,0,0.5)");
				$("#"+ _id+" .circle_part").find('[direction='+direction+']').css("color","#FFF");
				SelectedDirections[_id] = direction;
			}
		},
		GetSelectedItem: function(_ControlId, _id) {
			controlId = _ControlId
			direction  = $('#'+controlId).attr("direction");
			$('#'+controlId).attr("checked");

			var attr = $('#'+controlId).attr("checked");
				roundbutton.addItemToArray(direction, _id);
				qcubed.recordControlModification(_id, "_SelectedValue", SelectedDirections[_id]);
				$('#'+_id).trigger("directionslected");
		
		}
	};
}();
