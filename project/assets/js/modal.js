var Modal = function () {
	
	var id				= "";
	
	return {
		init: function (_id) {
			id = _id;
		},
		Close: function () {
		/*	$("#"+id).removeClass("fade in");*/
			$("#"+id).hide();
		},
		Open: function (){
		/*	$("#"+id).addClass("fade in");*/
			$("#"+id).show();
		}
		
	};
}();