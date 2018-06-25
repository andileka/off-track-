var sortable = function () {
	var _id				= "";
	var arrOrder		= [];

	return {
		init: function (strId){
			_id = strId;
			$( "#"+_id +" tbody" ).sortable({
				placeholder: "ui-state-highlight",
				update: function(event){
					var table = document.getElementById(_id);
					var rowLength = table.rows.length;
					arrOrder = [];
					for(var i=0; i<rowLength; i+=1){						
						var row = table.rows[i];
						if (row.attributes['data-value'] === undefined) {
							// DO NOTHING
						}else{
							arrOrder.push(row.attributes['data-value']['value']);
						}
						
					}
					qcubed.recordControlModification(_id, "_SelectedOrder",arrOrder);
					$("#"+_id +" tbody").trigger("CorrectOrder");	
				}
			});
		}
//		init: function (strId) {
//			_id = strId;
//			    $( "#"+_id +" tbody" ).sortable({
//					placeholder: "ui-state-highlight",
//					update: function(event) {
//						arrOrder = [];
//						var table = $("#"+_id +" tbody");
//						table.find('tr').each(function (key, val) {
//							$(this).find('td').each(function (key, val) {
//								if(val.firstElementChild){
//									arr = val.firstElementChild.control.attributes;
//									if(arr["order"]){
//										arrOrder.push(arr["order"].value);
//									}
//								}
//							});
//						});
//						qcubed.recordControlModification(_id, "_SelectedOrder",arrOrder);
//						$("#"+_id +" tbody").trigger("sortworkflowitem");	
//					}
//				  });
//		}
	};
}();