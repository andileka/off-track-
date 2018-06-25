var appointment = function(){
		var _availability={};
		var _year=null;
		var _month=null;
		function getAvailabilityString (date) {
			var availability_on_day = getAvailabilityOn(date);
			if(availability_on_day) {
				return availability_on_day['Display'];
			}
			
			return '';
		};
		
		function getAvailabilityOn(date) {
			var key = date.getFullYear() + '-' + (parseInt(date.getMonth())+1) + '-' + date.getDate();
			if(key in _availability) {
				return _availability[key];
			}
		};
		return {
			init: function() {
				
			},
			getAvailability: function() {
				return _availability;
			},
			setAvailability: function(arr) {
				_availability = arr;
			},
			setYearAndMonth: function(year, month) {
				_year = year;
				_month = month;
			},
			getYearAndMonth: function() {
				return {'year':_year,'month':_month};
			},
			isDateAvailable: function(date){
				var availability = getAvailabilityOn(date);
				if(availability) {
					return availability['isAvailable']===true;
				}
			},
			getAvailabiltyCssClass: function(date) {
				var availability = getAvailabilityOn(date);
				if(availability) {
					return availability['ClassName'];
				}				
			},
			getAvailabilityDisplay: function(date) {
				return getAvailabilityString(date);
			},
			addCustomInformation: function() {
				
			}
		};
	}();