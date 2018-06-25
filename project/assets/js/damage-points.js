var damagepoints = function () {
	
	var SelectedZones		= [];
	var index				= "";
	var id					= "";
	var controlId			= "";

	return {
		init: function (_id) { 
			id = _id;
			SelectedZones[id] = [];
//			alert(id);
		},
		SetSelectedZones: function(zone){
			if(zone){
				$('#'+id + '').find('[zone='+zone+']').attr("checked","true");
				$('#'+id + '').find('[zone='+zone+']').css("background","rgba(255,0,0,0.5)");
				$('#'+id + '').find('[zone='+zone+']').css("color","#FFF");
				SelectedZones[id].push(zone);
			}
		},
		ClearZones: function(){
			SelectedZones		= [];
			$("div").find('[checked="checked"]').removeAttr('style');
			$("div").find('[checked="checked"]').removeAttr("checked");
		},
		GetSelectedZones: function(_ControlId, _id) {
			controlId = _ControlId
			zone  = $('#'+controlId).attr("zone");
			if(zone == '?'){
				qcubed.recordControlModification(_id, "_SelectedValue", SelectedZones[_id]);
				$('#'+_id).trigger("unknownselectorselected");
			}else{
				if(_id in SelectedZones){}else{;SelectedZones[_id] = [];}
				if(SelectedZones[_id].indexOf(zone) !== -1){
					$('#'+controlId).css("background","rgba(255,0,0,0)");
					$('#'+controlId).css("color","rgba(255,0,0,0)");
					SelectedZones[_id].splice(SelectedZones[_id].indexOf(zone), 1);
				}else{
					$('#'+controlId).css("background","rgba(255,0,0,0.5)");
					$('#'+controlId).css("color","rgba(255,255,255,1)");
					SelectedZones[_id].push(zone);
				}
				qcubed.recordControlModification(_id, "_SelectedValue", SelectedZones[_id]);
				$('#'+_id).trigger("zonesselected");
			}
			
		}
	};
}();
