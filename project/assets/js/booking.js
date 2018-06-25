var Booking = function () {
	var slideIndex = "";
	var _id;
	var x = document.getElementsByClassName("mySlides");
	
	return {
		init: function (_id) {
			slideIndex = 1;
			Booking.showDivs(slideIndex);
		},
		showDivs: function (n) {
			var i;
			
			if (n > x.length) {slideIndex = 1}    
			if (n < 1) {slideIndex = x.length}
			for (i = 0; i < x.length; i++) {
			   x[i].style.display = "none";  
			}
			x[slideIndex-1].style.display = "block";  
		},
		plusDivs: function (n) {
			Booking.showDivs(slideIndex += n);
		},
		ShowCompanyFields: function(_id){
			console.log("Company"+_id);
			$('#'+_id+' .companyField').show();
			$('#'+_id+' .privateField').hide();
		},
		ShowPrivateFields: function(_id){
			console.log("Private"+_id);
			$('#'+_id+' .privateField').show();
			$('#'+_id+' .companyField').hide();
		},
		ShowError: function(_arrFields){
			var arrFields = JSON.parse(_arrFields);
			for (i = 0; i < arrFields.length; i++) {
			  $('#'+arrFields[i]).addClass('has-error');
			}
			$("html, body").animate({ scrollTop: 150 }, "slow");
			
		},
		RemoveError: function(_arrFields){
			var arrFields = JSON.parse(_arrFields);
			for (i = 0; i < arrFields.length; i++) {
			  $('#'+arrFields[i]).removeClass('has-error');
			}
			
		}
	};
}();